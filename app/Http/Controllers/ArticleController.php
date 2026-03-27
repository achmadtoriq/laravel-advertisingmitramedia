<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(5);
        return view('admin.article-menu', compact('articles'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('admin.article-create', compact('tags'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $tags = Tag::all();
        
        return view('admin.article-edit', compact('article', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:articles_data,slug', // 🔥 fix nama tabel
            'content' => 'required',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tags' => 'nullable|array' // 🔥 tambahan
        ]);

        // 🔥 Upload image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');

            // jadi full url
            $data['image'] = asset('storage/' . $path);
        }

        // 🔥 Excerpt otomatis
        $data['excerpt'] = Str::limit(strip_tags($data['content']), 150);

        // 🔥 Default views
        $data['views'] = 0;

        // 🔥 SEO fallback
        $data['seo_title'] = $data['seo_title'] ?? $data['title'];
        $data['seo_description'] = $data['seo_description'] ?? $data['excerpt'];

        // dd($data);
        // 🔥 Simpan artikel
        $article = Article::create($data);

        // 🔥 SIMPAN TAG (INI YANG KAMU MAU)
        if ($request->filled('tags')) {
            $article->tags()->sync($request->tags);
        }

        return redirect('/admin/article')->with('success', 'Artikel berhasil dibuat');
    }

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


    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil dihapus'
        ]);
    }
}
