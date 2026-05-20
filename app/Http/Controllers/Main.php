<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\PublicPageSeo;
use Illuminate\Support\Facades\Schema;
use Throwable;

class Main extends Controller
{
    public function show(?string $path = null)
    {
        $path = PublicPageSeo::normalizePath($path ?? '/');
        $page = $this->resolvePublicPage($path);

        abort_if(! $page, 404);

        if ($page['view_name'] === 'article_detail') {
            $slug = str($path)->after('/artikel/')->value();

            abort_if($slug === '' || $slug === $path, 404);

            return $this->artikelDetail($slug);
        }

        abort_if(! view()->exists($page['view_name']), 404);

        return view($page['view_name']);
    }

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
            'image' => $article->image ?: asset('assets/images/about-img.webp'),
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

    private function resolvePublicPage(string $path): ?array
    {
        try {
            if (! Schema::hasTable('public_page_seos')) {
                return PublicPageSeo::defaultForPath($path);
            }

            $page = PublicPageSeo::forPath($path);

            if ($page) {
                return [
                    'path' => $page->path,
                    'view_name' => $page->view_name,
                ];
            }

            return null;
        } catch (Throwable) {
            return PublicPageSeo::defaultForPath($path);
        }
    }
}
