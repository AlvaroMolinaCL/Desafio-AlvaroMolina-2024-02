<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        // $popularAlbums = Album::with('artists')->orderBy('views', 'desc')->take(10)->get();
        // return view('public.index', compact('popularAlbums'));
        return view('public.index');
    }

    public function search(Request $request)
    {
        /*
        $query = Album::query();

        if ($request->filled('artist')) {
            $query->where('artist', 'like', '%' . $request->artist . '%');
        }

        return view('public.search', ['albums' => $query->get()]);
        */
    }
}
