<?php

namespace App\Http\Controllers;

use App\Models\Article;
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

        $article = Article::with('tags')
        ->where('slug', $slug)
        ->firstOrFail();

        // 🔥 tambah views +1
        $article->increment('views');

        $data = [
            'title' => $article->title,
            'slug' => $article->slug,
            'image' => $article->image,
            'excerpt' => $article->excerpt,
            'content' => $article->content,
            'views' => $article->views,
            'tags' => $article->tags->pluck('name')->toArray(),
            'seo_description' => $article->seo_description,
            'seo_title' => $article->seo_title

        ];

        abort_if(!$article, 404);

        return view('pages.artikel-detail',['article' => $data]);
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
