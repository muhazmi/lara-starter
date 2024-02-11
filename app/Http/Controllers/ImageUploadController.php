<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function storeImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            // $file = $request->file('upload');
            // $fileName = now()->format('YmdHis') . '_.' . $file->extension();
            // Storage::disk('public')->put('images/posts/detail/' . $fileName, file_get_contents($file));
            // $url = asset('public/images/posts/detail/' . $fileName);

            $originName = $request->file('upload')->hashName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->extension();
            $fileName = $fileName . now()->format('YmdHis') . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('storage/images/posts/detail/'), $fileName);

            $url = asset('storage/images/posts/detail/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
