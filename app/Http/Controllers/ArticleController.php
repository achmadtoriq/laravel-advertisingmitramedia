<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('tags')->latest()->paginate(10);
        return view('admin.artikel.article-menu', compact('articles'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('admin.artikel.article-create', compact('tags'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $tags = Tag::all();

        return view('admin.artikel.article-edit', compact('article', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:articles_data,slug',
            'content' => 'required',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tags' => 'nullable|array'
        ]);

        $data['slug'] = $data['slug']
            ? Str::slug($data['slug'])
            : $this->uniqueSlug($data['title']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $data['image'] = asset('storage/' . $path);
        }

        $data['excerpt'] = Str::limit(strip_tags($data['content']), 150);
        $data['views'] = 0;
        $data['seo_title'] = $data['seo_title'] ?? $data['title'];
        $data['seo_description'] = $data['seo_description'] ?? $data['excerpt'];

        $article = Article::create($data);
        $article->tags()->sync($this->resolveTagIds($request->input('tags', [])));

        return redirect('/admin/article')->with('success', 'Artikel berhasil dibuat');
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => [
                'nullable',
                'max:255',
                Rule::unique('articles_data', 'slug')->ignore($article->id),
            ],
            'content' => 'required',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tags' => 'nullable|array',
        ]);

        $data['slug'] = $data['slug']
            ? Str::slug($data['slug'])
            : $this->uniqueSlug($data['title'], $article->id);

        if ($request->hasFile('image')) {
            $this->deleteStoredImage($article->image);

            $path = $request->file('image')->store('articles', 'public');
            $data['image'] = asset('storage/' . $path);
        }

        $data['excerpt'] = Str::limit(strip_tags($data['content']), 150);
        $data['seo_title'] = $data['seo_title'] ?? $data['title'];
        $data['seo_description'] = $data['seo_description'] ?? $data['excerpt'];

        $article->update($data);
        $article->tags()->sync($this->resolveTagIds($request->input('tags', [])));

        return redirect('/admin/article')->with('success', 'Artikel berhasil diperbarui');
    }

    /* Tiny MCE
    public function upload_image_article(Request $request)
    {
        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('articles', $filename, 'public');

            return response()->json([
                'location' => url('storage/' . $path)
            ]);
        }
    }
    */

    public function upload_image_article(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
        ]);

        if ($request->hasFile('upload')) {

            $file = $request->file('upload');

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('articles', $filename, 'public');

            return response()->json([
                'uploaded' => true,
                'url' => asset('storage/' . $path)
            ], 200, [], JSON_UNESCAPED_SLASHES);
        }

        return response()->json([
            'uploaded' => false,
            'error' => [
                'message' => 'Upload gagal'
            ]
        ], 400);
    }


    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $article->tags()->detach();
        $this->deleteStoredImage($article->image);
        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil dihapus'
        ]);
    }

    private function resolveTagIds(array $tags): array
    {
        return collect($tags)
            ->filter()
            ->map(function ($tag) {
                if (is_numeric($tag)) {
                    return (int) $tag;
                }

                $name = trim((string) $tag);

                if ($name === '') {
                    return null;
                }

                $slug = Str::slug($name) ?: 'tag';
                $existing = Tag::where('slug', $slug)->orWhere('name', $name)->first();

                if ($existing) {
                    return $existing->id;
                }

                return Tag::create([
                    'name' => $name,
                    'slug' => $this->uniqueTagSlug($name),
                ])->id;
            })
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'artikel';
        $slug = $base;
        $counter = 2;

        while (Article::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }

    private function uniqueTagSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'tag';
        $slug = $base;
        $counter = 2;

        while (Tag::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }

    private function deleteStoredImage(?string $image): void
    {
        if (! $image) {
            return;
        }

        $path = parse_url($image, PHP_URL_PATH);
        $path = str_replace('/storage/', '', $path ?? '');

        if ($path !== '') {
            Storage::disk('public')->delete($path);
        }
    }
}
