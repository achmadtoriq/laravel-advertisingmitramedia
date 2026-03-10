<?php

namespace App\View\Components;

use App\Models\Article;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class Artikel extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $articles = Article::with('tags')->latest()->get()->map(function ($article) {
            return [
                'title' => $article->title,
                'slug' => $article->slug,
                'image' => $article->image,
                'excerpt' => $article->excerpt,
                'content' => $article->content,
                'views' => $article->views,
                'tags' => $article->tags->pluck('name')->toArray()
            ];
        });

        $page = request()->get('page', 1);
        $perPage = 4;

        $items = $articles->forPage($page, $perPage)->values();

        $paginated = new LengthAwarePaginator(
            $items,
            $articles->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query()
            ]
        );

        return view('components.artikel', [
            'articles' => $paginated
        ]);
    }
}
