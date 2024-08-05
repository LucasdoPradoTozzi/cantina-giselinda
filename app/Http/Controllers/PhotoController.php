<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public static function store($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/photos', $fileName);

        return $fileName;
    }
}
