<?php

namespace App\Http\Controllers;

use App\Name;

use App\Http\Requests;
use DirectoryIterator;

class WordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $wordDirectory = 'downloads/MSWord';
        $documentFiles = [];

        $dir = new DirectoryIterator(public_path($wordDirectory));
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $documentFiles[] = $fileinfo->getFilename();
            }
        }

        return view('docs', compact('documentFiles'));
    }

    /**
     * Private
     */
}

