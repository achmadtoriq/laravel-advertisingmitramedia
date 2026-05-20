<?php

namespace App\Http\Controllers;

use App\Models\PublicPageSeo;
use Illuminate\Http\Request;

class PublicPageSeoController extends Controller
{
    public function index()
    {
        $this->ensureDefaultPages();

        $pages = PublicPageSeo::query()
            ->orderBy('path')
            ->get();

        return view('admin.seo.index', compact('pages'));
    }

    public function edit(PublicPageSeo $seo)
    {
        return view('admin.seo.edit', compact('seo'));
    }

    public function create()
    {
        $seo = new PublicPageSeo([
            'robots' => 'index, follow',
            'is_active' => true,
        ]);

        return view('admin.seo.create', compact('seo'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        PublicPageSeo::create($data);

        return redirect('/admin/seo')->with('success', 'SEO halaman berhasil ditambahkan');
    }

    public function update(Request $request, PublicPageSeo $seo)
    {
        $data = $this->validatedData($request, $seo);

        $seo->update($data);

        return redirect('/admin/seo')->with('success', 'SEO halaman berhasil diperbarui');
    }

    public function destroy(PublicPageSeo $seo)
    {
        $seo->delete();

        return redirect('/admin/seo')->with('success', 'SEO halaman berhasil dihapus');
    }

    private function validatedData(Request $request, ?PublicPageSeo $seo = null): array
    {
        $request->merge([
            'path' => $this->normalizePath($request->input('path', '')),
        ]);

        $data = $request->validate([
            'name' => 'required|max:255',
            'path' => 'required|max:255|unique:public_page_seos,path,' . ($seo?->id ?? 'NULL'),
            'view_name' => 'required|max:255',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
            'og_title' => 'nullable|max:255',
            'og_description' => 'nullable',
            'og_image' => 'nullable|max:255',
            'twitter_title' => 'nullable|max:255',
            'twitter_description' => 'nullable',
            'twitter_image' => 'nullable|max:255',
            'robots' => 'required|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function ensureDefaultPages(): void
    {
        foreach (PublicPageSeo::DEFAULT_PAGES as $page) {
            PublicPageSeo::firstOrCreate(
                ['path' => $page['path']],
                [
                    'name' => $page['name'],
                    'view_name' => $page['view_name'],
                    'meta_title' => $page['meta_title'],
                    'meta_description' => $page['meta_description'],
                    'meta_keywords' => $page['meta_keywords'],
                    'robots' => 'index, follow',
                    'is_active' => true,
                ]
            );
        }
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '' || $path === '/') {
            return '/';
        }

        return '/' . trim($path, '/');
    }
}
