<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('public_page_seos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path')->unique();
            $table->string('view_name');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();
            $table->string('robots')->default('index, follow');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('public_page_seos')->insert([
            $this->page('Home', '/', 'pages.home', 'Jasa Neon Box & Papan Reklame Surabaya Murah | Mitramedia', 'Jasa pembuatan neon box Surabaya harga murah, desain gratis, dan bergaransi. Cocok untuk toko, cafe, dan branding usaha Anda. Konsultasi sekarang!', 'jasa neon box surabaya, jasa pembuatan neon box, neon box murah, billboard, papan reklame surabaya, jasa reklame surabaya, huruf timbul surabaya'),
            $this->page('About', '/about-us', 'pages.about', 'Tentang Mitramedia Advertising | Jasa Neon Box Indonesia', 'Mitra Media Advertising adalah perusahaan jasa reklame di Surabaya yang menyediakan neon box, papan reklame, dan huruf timbul dengan desain profesional dan kualitas terbaik.', 'mitramedia advertising, jasa neon box surabaya, jasa reklame surabaya, papan reklame surabaya, huruf timbul surabaya, perusahaan reklame surabaya'),
            $this->page('Artikel', '/artikel', 'pages.artikel', 'Artikel Mitramedia Advertising | Jasa Reklame Surabaya', 'Tips neon box, papan reklame, dan huruf timbul Surabaya dari Mitramedia Advertising.', 'artikel neon box surabaya, tips reklame surabaya, papan reklame surabaya, huruf timbul surabaya'),
            $this->page('Artikel Detail', '/artikel/*', 'article_detail', null, null, 'artikel neon box surabaya, tips reklame surabaya, papan reklame surabaya, huruf timbul surabaya'),
            $this->page('Project', '/project', 'pages.project', 'Portfolio Neon Box & Papan Reklame Surabaya | Mitramedia Advertising', 'Lihat portfolio project neon box, papan reklame, dan huruf timbul yang telah kami kerjakan di Surabaya dengan desain profesional dan pemasangan berkualitas.', 'portfolio neon box surabaya, project papan reklame surabaya, huruf timbul surabaya, jasa reklame surabaya, contoh neon box surabaya'),
            $this->page('Contact', '/contact-us', 'pages.contact', 'Hubungi Mitramedia Advertising | Jasa Reklame Surabaya', 'Hubungi Mitramedia Advertising untuk jasa neon box, papan reklame, dan huruf timbul di Surabaya. Konsultasi desain reklame profesional untuk bisnis Anda.', 'kontak mitramedia advertising, jasa reklame surabaya, jasa neon box surabaya, papan reklame surabaya'),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('public_page_seos');
    }

    private function page(string $name, string $path, string $view, ?string $title, ?string $description, ?string $keywords): array
    {
        return [
            'name' => $name,
            'path' => $path,
            'view_name' => $view,
            'meta_title' => $title,
            'meta_description' => $description,
            'meta_keywords' => $keywords,
            'robots' => 'index, follow',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
};
