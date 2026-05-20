<?php

namespace App\View\Components;

use App\Models\Article;
use App\Models\Tag;
use Closure;
use Illuminate\Contracts\View\View;
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
        $articles = Article::with('tags')
            ->latest()
            ->paginate(6)
            ->withQueryString()
            ->through(fn ($article) => $this->formatArticle($article));

        $popularArticles = Article::with('tags')
            ->orderByDesc('views')
            ->latest()
            ->take(5)
            ->get()
            ->map(fn ($article) => $this->formatArticle($article));

        $tagFilters = Tag::orderBy('name')->pluck('name')->values();

        return view('components.artikel', [
            'articles' => $articles,
            'popularArticles' => $popularArticles,
            'tagFilters' => $tagFilters,
        ]);
    }

    private function formatArticle(Article $article): array
    {
        $content = strip_tags($article->content ?? '');

        return [
            'title' => $article->title,
            'slug' => $article->slug,
            'image' => $article->image ?: asset('assets/images/about-img.webp'),
            'excerpt' => $article->excerpt ?: str($content)->limit(150)->value(),
            'content' => $content,
            'reading_time' => max(1, (int) ceil(str_word_count($content) / 200)),
            'views' => $article->views ?? 0,
            'tags' => $article->tags->pluck('name')->values()->toArray(),
            'tag_keys' => $article->tags->pluck('name')->map(fn ($tag) => str($tag)->lower()->value())->values()->toArray(),
        ];
    }
}
