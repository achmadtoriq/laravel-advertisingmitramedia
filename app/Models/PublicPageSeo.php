<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicPageSeo extends Model
{
    public const DEFAULT_PAGES = [
        [
            'name' => 'Home',
            'path' => '/',
            'view_name' => 'pages.home',
            'meta_title' => 'Jasa Neon Box & Papan Reklame Surabaya Murah | Mitramedia',
            'meta_description' => 'Jasa pembuatan neon box Surabaya harga murah, desain gratis, dan bergaransi. Cocok untuk toko, cafe, dan branding usaha Anda. Konsultasi sekarang!',
            'meta_keywords' => 'jasa neon box surabaya, jasa pembuatan neon box, neon box murah, billboard, papan reklame surabaya, jasa reklame surabaya, huruf timbul surabaya',
        ],
        [
            'name' => 'About',
            'path' => '/about-us',
            'view_name' => 'pages.about',
            'meta_title' => 'Tentang Mitramedia Advertising | Jasa Neon Box Indonesia',
            'meta_description' => 'Mitra Media Advertising adalah perusahaan jasa reklame di Surabaya yang menyediakan neon box, papan reklame, dan huruf timbul dengan desain profesional dan kualitas terbaik.',
            'meta_keywords' => 'mitramedia advertising, jasa neon box surabaya, jasa reklame surabaya, papan reklame surabaya, huruf timbul surabaya, perusahaan reklame surabaya',
        ],
        [
            'name' => 'Artikel',
            'path' => '/artikel',
            'view_name' => 'pages.artikel',
            'meta_title' => 'Artikel Mitramedia Advertising | Jasa Reklame Surabaya',
            'meta_description' => 'Tips neon box, papan reklame, dan huruf timbul Surabaya dari Mitramedia Advertising.',
            'meta_keywords' => 'artikel neon box surabaya, tips reklame surabaya, papan reklame surabaya, huruf timbul surabaya',
        ],
        [
            'name' => 'Artikel Detail',
            'path' => '/artikel/*',
            'view_name' => 'article_detail',
            'meta_title' => null,
            'meta_description' => null,
            'meta_keywords' => 'artikel neon box surabaya, tips reklame surabaya, papan reklame surabaya, huruf timbul surabaya',
        ],
        [
            'name' => 'Project',
            'path' => '/project',
            'view_name' => 'pages.project',
            'meta_title' => 'Portfolio Neon Box & Papan Reklame Surabaya | Mitramedia Advertising',
            'meta_description' => 'Lihat portfolio project neon box, papan reklame, dan huruf timbul yang telah kami kerjakan di Surabaya dengan desain profesional dan pemasangan berkualitas.',
            'meta_keywords' => 'portfolio neon box surabaya, project papan reklame surabaya, huruf timbul surabaya, jasa reklame surabaya, contoh neon box surabaya',
        ],
        [
            'name' => 'Contact',
            'path' => '/contact-us',
            'view_name' => 'pages.contact',
            'meta_title' => 'Hubungi Mitramedia Advertising | Jasa Reklame Surabaya',
            'meta_description' => 'Hubungi Mitramedia Advertising untuk jasa neon box, papan reklame, dan huruf timbul di Surabaya. Konsultasi desain reklame profesional untuk bisnis Anda.',
            'meta_keywords' => 'kontak mitramedia advertising, jasa reklame surabaya, jasa neon box surabaya, papan reklame surabaya',
        ],
    ];

    protected $fillable = [
        'name',
        'path',
        'view_name',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'robots',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public static function forCurrentPath(): ?self
    {
        return self::forPath(self::normalizePath(request()->path()));
    }

    public static function forPath(string $path): ?self
    {
        $path = self::normalizePath($path);

        $pages = self::query()
            ->where('is_active', true)
            ->orderByRaw('LENGTH(path) DESC')
            ->get();

        return $pages->first(fn (self $page) => self::pathMatches($page->path, $path));
    }

    public static function defaultForPath(string $path): ?array
    {
        $path = self::normalizePath($path);

        return collect(self::DEFAULT_PAGES)
            ->sortByDesc(fn (array $page) => strlen($page['path']))
            ->first(fn (array $page) => self::pathMatches($page['path'], $path));
    }

    public static function normalizePath(string $path): string
    {
        $path = '/' . trim($path, '/');

        return $path === '/.' ? '/' : $path;
    }

    private static function pathMatches(string $pattern, string $path): bool
    {
        $pattern = self::normalizePath($pattern);
        $path = self::normalizePath($path);

        if (! str_contains($pattern, '*')) {
            return $pattern === $path;
        }

        $regex = '#^' . str_replace('\*', '.*', preg_quote($pattern, '#')) . '$#';

        return (bool) preg_match($regex, $path);
    }
}
