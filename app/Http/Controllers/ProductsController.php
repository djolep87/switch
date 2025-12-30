<?php

namespace App\Http\Controllers;

use App\Models\Category;
// use App\Models\Image;
use App\Models\Images;
use App\Models\Product;
use App\Models\ProductUser;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
// use Image;
use Intervention\Image\ImageManagerStatic as Image;



use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class ProductsController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->withCount('products')->get();
        $categories = Category::all();
        return view('/products.create', compact('categories', 'wishlists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validacija zahteva
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $imagesname = 'noimage.jpg';
        if ($request->has('images')) {
            $imagesname = [];
            foreach ($request->images as $key => $image) {
                $imgName = time() . $key . '.' . $image->extension();

                // Kreiranje instance slike + ispravljanje orijentacije
                $resizedImage = Image::make($image)->orientate();

                // Resize slike uz zadržavanje proporcija - veća rezolucija za bolji kvalitet
                // Maksimalna širina 1920px, visina se automatski prilagođava
                $resizedImage->resize(1920, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize(); // Ne povećava slike koje su manje od 1920px
                });

                // Čuvanje slike na disku sa visokim kvalitetom (95% kvalitet za JPEG)
                Storage::disk('public')->put('Product_images/' . $imgName, $resizedImage->encode('jpg', 95));

                $imagesname[] = $imgName;
            }
            $imagesname = implode(',', $imagesname);
        }

        // Čuvanje podataka o proizvodu
        $product = new Product;
        $product->user_id = Auth()->user()->id;
        $product->category_id = $request->input('category_id');
        $category = Category::findOrFail($request->input('category_id')); // Uzimamo kategoriju iz baze
        $product->struja = $category->struja;
        $product->voda = $category->voda;
        $product->co2 = $category->co2;

        $product->name = $request->input('name');
        $product->condition = $request->input('condition');
        $product->description = $request->input('description');
        $product->images = $imagesname;

        $product->save();

        $product->categories()->attach($request->input('category_id'));
        toast('Uspešno ste postavili oglas!', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->withCount('products')->get();
        $categories = Category::all();
        $product = Product::find($id);
        $images = Images::where('product_id', $id)->get();
        return view('/products.edit', compact('categories', 'product', 'images', 'wishlists'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {

    //       // Validate the incoming request data
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string',

    //     ]);


    //     $product = Product::findOrFail($id);

    //     if ($request->has('images')) {
    //         $imagesname = [];
    //         foreach ($request->images as $key => $image) {
    //             $imgName = time() . $key . '.' . $image->extension();

    //             // Resize and save image
    //             $resizedImage = Image::make($image)->resize(400, 300)->stream(); 
    //             Storage::disk('public')->put('Product_images/' . $imgName, $resizedImage);

    //             $imagesname[] = $imgName;
    //         }
    //         $imagesname = implode(',', $imagesname);
    //     } else {
    //         $imagesname = 'noimage.jpg';
    //     }

    //     $product->user_id = Auth()->user()->id;
    //     $product->category_id = $request->input('category_id');
    //     $product->name = $request->input('name');
    //     $product->condition = $request->input('condition');
    //     $product->description = $request->input('description');
    //     $product->images = $imagesname;
    //     $product->save();

    //     $product->categories()->sync($request->input('category_id'));

    //     toast('Uspešno izmenjen oglas!', 'success');
    //     return redirect('/dashboard');
    // }

    public function update(Request $request, $id)
    {
        // Validacija zahteva
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $product = Product::findOrFail($id);

        // Rukovanje uploadom slika
       if ($request->has('images')) {
            $imagesname = [];

            // Brisanje starih slika osim 'noimage.jpg'
            $oldImages = explode(',', $product->images);
            foreach ($oldImages as $oldImage) {
                if ($oldImage !== 'noimage.jpg') {
                    Storage::disk('public')->delete('Product_images/' . $oldImage);
                }
            }

            // Čuvanje novih slika
            foreach ($request->images as $key => $image) {
                $imgName = time() . $key . '.' . $image->extension();

                // Ispravljanje orijentacije + resize sa većom rezolucijom
                $resizedImage = Image::make($image)
                    ->orientate()
                    ->resize(1920, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize(); // Ne povećava slike koje su manje od 1920px
                    })
                    ->encode('jpg', 95); // Visok kvalitet (95%)

                // Snimanje slike
                Storage::disk('public')->put('Product_images/' . $imgName, $resizedImage);

                $imagesname[] = $imgName;
            }

            $imagesname = implode(',', $imagesname);
        } else {
            // Zadržavanje starih slika ako nove nisu uploadovane
            $imagesname = $product->images;
        }

        // Ažuriranje podataka o proizvodu
        $product->user_id = auth()->user()->id;
        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->condition = $request->input('condition');
        $product->description = $request->input('description');
        $product->images = $imagesname;
        $product->save();

        $product->categories()->sync($request->input('category_id'));

        toast('Uspešno izmenjen oglas!', 'success');
        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $product = Product::find($id);


        if ($product) {
            $productImages = $product->images;

            if ($productImages) {
                $imagePaths = explode(",", $productImages);
                foreach ($imagePaths as $image) {
                    Storage::delete('public/Product_images' . '/' . $image);
                }
            }

            $product->delete(); // Obrišite proizvod
        }





        toast('Oglas je obrisan!', 'warning');
        return back();
    }

    /**
     * Generate AI description for product based on product name
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateDescription(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'condition' => 'nullable|string|in:Novo,Polovno',
        ]);

        $productName = $request->input('product_name');
        $condition = $request->input('condition', 'Polovno');
        $apiKey = env('OPENAI_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'OpenAI API ključ nije konfigurisan. Molimo kontaktirajte administratora.',
                'description' => ''
            ], 400);
        }

        try {
            // Prirodniji prompt koji zvuči kao da čovek piše svojim rečima
            $conditionText = $condition === 'Novo' 
                ? 'novo, nikad korišćeno' 
                : 'polovno, u dobrom stanju';
            
            $prompt = "Napiši opis oglasa za \"{$productName}\" koji je {$conditionText} i koji nudiš za ZAMENU (ne za prodaju). 

Važno:
- Piši kao da si vlasnik stvari koji opisuje šta nudiš za zamenu svojim rečima - prirodno, bez previše formalnosti
- Koristi razgovorni ton, ali i dalje profesionalno
- Ako je stvar polovno, spomeni da je u dobrom stanju, možda koliko je staro ili zašto je nudiš za zamenu
- Ako je novo, naglasi da je neotvoreno ili novo u kutiji
- Ne spominji cenu ili prodaju - ovo je za ZAMENU, ne za prodaju
- Možeš spomenuti šta bi voleo/la da dobiješ u zamenu (opciono, ali nije obavezno)
- Opis treba da bude između 100-200 reči
- Koristi HTML formatiranje: <p> za paragrafe, <br> za novi red, <ul> i <li> za liste ako treba
- Strukturiraj tekst u kratke paragrafe (2-3 rečenice) za bolju čitljivost
- Tekst mora biti na srpskom jeziku
- Budi konkretan i iskren - kao da pričaš sa prijateljem o stvari koju nudiš za zamenu";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Ti si pomoćnik koji piše opise oglasa za stvari koje se nude za ZAMENU (ne za prodaju) na srpskom jeziku. Opisi treba da zvuče prirodno, kao da ih piše vlasnik stvari svojim rečima - razgovorno ali profesionalno. NIKADA ne spominji cenu, prodaju ili kupovinu - ovo je platforma za razmenu stvari. OBAVEZNO koristi HTML formatiranje (paragrafi sa <p> tagovima, novi redovi sa <br>, liste sa <ul> i <li> tagovima) da bi tekst bio čitljiv. Nikada ne piši tekst kao jedan veliki paragraf - uvek strukturiraj sa razmacima i novim redovima. Budi iskren i konkretan, kao da pričaš sa prijateljem o stvari koju nudiš za zamenu.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'max_tokens' => 600,
                'temperature' => 0.8,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $description = $data['choices'][0]['message']['content'] ?? '';

                return response()->json([
                    'success' => true,
                    'description' => trim($description)
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Greška pri generisanju opisa. Molimo pokušajte ponovo.',
                    'description' => ''
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Došlo je do greške: ' . $e->getMessage(),
                'description' => ''
            ], 500);
        }
    }
}
