<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $path = $request->file('upload')->store('public/uploads');
            $url = Storage::url($path);
            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}
}
