<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use App\Notifications\AcceptNotifications;
use App\Notifications\Notifications;
use App\Notifications\RejectedNotifications;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class OffersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $wishlists = Wishlist::where('user_id', auth()->user()->id)->withCount('products')->get();

        if (Auth::check()) {
            $listproducts = Product::where('user_id', auth()->user()->id)->where('status', 'active')->get();
        } else {
            $listproducts = null;
        }

        $offers = Offer::with(['user', 'product', 'acceptor', 'sendproduct'])
            ->orderBy('created_at', 'desc')
            ->where('acceptor', auth()->user()->id)
            ->get();

        $sendoffers = Offer::with(['user', 'product', 'acceptor', 'sendproduct'])
            ->orderBy('created_at', 'desc')
            ->where('user_id', auth()->user()->id)
            ->get();


        return view('offers.index', compact('offers', 'sendoffers', 'listproducts', 'wishlists'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sendproduct_id' => 'required|exists:products,id',
            'product_id' => 'required|exists:products,id',
            'acceptor' => 'required|exists:users,id',
            'acceptorName' => 'required|string|max:255',
            'acceptorNumber' => 'required|string|max:255',
        ]);

        // Check if an offer already exists between these users for these specific products
        $existingOffer = Offer::where(function ($query) use ($request) {
            $query->where('user_id', auth()->id())
                  ->where('acceptor', $request->acceptor)
                  ->where('product_id', $request->product_id)
                  ->where('sendproduct_id', $request->sendproduct_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('user_id', $request->acceptor)
                  ->where('acceptor', auth()->id())
                  ->where('product_id', $request->sendproduct_id)
                  ->where('sendproduct_id', $request->product_id);
        })->where('accepted', 0)->first();

        if ($existingOffer) {
            toast('Već ste poslali zahtev za razmenu ovih proizvoda sa ovim korisnikom!', 'error');
            return back();
        }

        $offer = new Offer();
        $offer->user_id = auth()->id();
        $offer->sendproduct_id = $request->sendproduct_id;
        $offer->product_id = $request->product_id;
        $offer->acceptor = $request->acceptor;
        $offer->acceptorName = $request->acceptorName;
        $offer->acceptorNumber = $request->acceptorNumber;
        $offer->accepted = 0;
        $offer->sendaccepted = 0;
        $offer->save();

        $user = User::find($offer->acceptor);
        if ($user) {
            $user->notify(new Notifications());
        }

        toast('Vaš zahtev je uspešno poslat!', 'success');
        return back();
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $offers = Offer::find($id);
        $offers->accepted =  $request->input('accepted');
        $offers->sendaccepted =  $request->input('accepted');
        $offers->save();
        toast('Uspešno ste prihvatili zahtev. Kontaktirajte korisnika radi uspešne razmene. Srećno!', 'success');
        $user = User::find($offers->user_id);
        User::find($offers->user_id)->notify(new AcceptNotifications);
        return redirect('/offers');
    }

    public function rejected(Request $request, $id)
    {
        $offers = Offer::find($id);
        $offers->accepted =  $request->input('accepted');
        $offers->sendaccepted =  $request->input('accepted');
        $offers->save();
        toast('Zahtev je odbijen!', 'error');
        $user = User::find($offers->user_id);
        User::find($offers->user_id)->notify(new RejectedNotifications);
        return redirect('/offers');
    }

    public function confirmation(Request $request, $id)
    {
        $offers = Offer::find($id);
        $offers->accepted =  $request->input('accepted');
        $offers->save();
        toast('Čestitamo! Uspešna zamena! ', 'success');
        $user = User::find($offers->user_id);

        // Dodavanje novih vrednosti na postojeće
        $user->struja += $offers->product->struja;
        $user->voda += $offers->product->voda;
        $user->co2 += $offers->product->co2;
        
        $user->save();

        // Mark products as inactive after successful swap
        if ($offers->product) {
            $offers->product->update(['status' => 'inactive']);
        }
        if ($offers->sendproduct) {
            $offers->sendproduct->update(['status' => 'inactive']);
        }

        return redirect('/offers');
    }
    public function confirmation_sendoffer(Request $request, $id)
    {
        $offers = Offer::find($id);
        $offers->sendaccepted =  $request->input('accepted');
        $offers->save();
        toast('Čestitamo! Uspešna zamena! ', 'success');
        $user = User::find($offers->acceptor);
        $user->struja += $offers->sendproduct->struja;
        $user->voda += $offers->sendproduct->voda;
        $user->co2 += $offers->sendproduct->co2;

        $user->save();

        // Mark products as inactive after successful swap
        if ($offers->product) {
            $offers->product->update(['status' => 'inactive']);
        }
        if ($offers->sendproduct) {
            $offers->sendproduct->update(['status' => 'inactive']);
        }

        return redirect('/sendOffers');
    }

    public function canceled(Request $request, $id)
    {
        $offers = Offer::find($id);
        $offers->accepted =  $request->input('accepted');
        $offers->save();
        toast('Zamena neuspešna!', 'error');
        return redirect('/offers');
    }

    public function canceled_sendoffer(Request $request, $id)
    {
        $offers = Offer::find($id);
        $offers->sendaccepted =  $request->input('accepted');
        $offers->save();
        toast('Zamena neuspešna!', 'error');
        return redirect('/sendOffers');
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
        return redirect('/offers');
    }

    public function offer_archived(Request $request, $id)
    {
        $offers = Offer::find($id);
        $offers->offer_archived =  $request->input('offer_archived');
        $offers->save();
        toast('Zahtev je obrisan!', 'danger');
        return redirect('/offers');
    }


    public function sendoffer_archived(Request $request, $id)
    {
        $offers = Offer::find($id);
        $offers->sendoffer_archived =  $request->input('sendoffer_archived');
        $offers->save();
        toast('Zahtev je obrisan!', 'danger');
        return redirect('/sendOffers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);

        if ($offer->offer_archived == 1 && $offer->sendoffer_archived == 1) {
            // Brisanje proizvoda
            $this->deleteProductWithImages($offer->product);
            $this->deleteProductWithImages($offer->sendproduct);
        }

        $offer->delete();
        toast('Zahtev je obrisan!', 'warning');
        return back();
    }

    private function deleteProductWithImages($product)
    {
        if ($product) {
            // Brisanje slika povezanih sa proizvodom
            $productImages = $product->images;

            if ($productImages) {
                $imagePaths = explode(",", $productImages);
                foreach ($imagePaths as $image) {
                    Storage::delete('public/Product_images' . '/' . $image);
                }
            }

            // Brisanje samog proizvoda
            $product->delete();
        }
    }
}
