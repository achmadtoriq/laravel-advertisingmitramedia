<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('public_page_seos', function (Blueprint $table) {
            if (! Schema::hasColumn('public_page_seos', 'view_name')) {
                $table->string('view_name')->nullable()->after('path');
            }
        });

        $views = [
            '/' => 'pages.home',
            '/about-us' => 'pages.about',
            '/artikel' => 'pages.artikel',
            '/artikel/*' => 'article_detail',
            '/project' => 'pages.project',
            '/contact-us' => 'pages.contact',
        ];

        foreach ($views as $path => $view) {
            DB::table('public_page_seos')
                ->where('path', $path)
                ->whereNull('view_name')
                ->update(['view_name' => $view]);
        }
    }

    public function down(): void
    {
        Schema::table('public_page_seos', function (Blueprint $table) {
            if (Schema::hasColumn('public_page_seos', 'view_name')) {
                $table->dropColumn('view_name');
            }
        });
    }
};
