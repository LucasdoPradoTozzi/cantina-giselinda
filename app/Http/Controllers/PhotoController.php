<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public static function store($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/photos', $fileName);

        return $fileName;
    }

    public static function delete($fileName)
    {
        $path = 'photos/' . $fileName;

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }
}
