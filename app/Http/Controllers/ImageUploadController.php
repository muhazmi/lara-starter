<?php
// This controller used in CKEditor Image upload
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function storeImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->hashName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->extension();
            $fileName = $fileName . now()->format('YmdHis') . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('storage/images/articles/detail/'), $fileName);

            $url = asset('storage/images/articles/detail/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
