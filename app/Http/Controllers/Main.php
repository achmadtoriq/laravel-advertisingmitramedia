<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Main extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function artikel()
    {
        return view('pages.artikel');
    }

    public function artikelDetail($slug)
    {

        $articles = collect(config('artikel'));
        $article = $articles->firstWhere('slug', $slug);

        abort_if(!$article, 404);

        return view('pages.artikel-detail', compact('article'));
    }

    public function project()
    {
        return view('pages.project');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
