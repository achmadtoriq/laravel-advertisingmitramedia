<?php

use App\Models\PublicPageSeo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('public_page_seos')) {
            return;
        }

        foreach (PublicPageSeo::DEFAULT_PAGES as $page) {
            $exists = DB::table('public_page_seos')
                ->where('path', $page['path'])
                ->exists();

            if (! $exists) {
                DB::table('public_page_seos')->insert([
                    'name' => $page['name'],
                    'path' => $page['path'],
                    'view_name' => $page['view_name'],
                    'meta_title' => $page['meta_title'],
                    'meta_description' => $page['meta_description'],
                    'meta_keywords' => $page['meta_keywords'],
                    'robots' => 'index, follow',
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                continue;
            }

            DB::table('public_page_seos')
                ->where('path', $page['path'])
                ->whereNull('view_name')
                ->update(['view_name' => $page['view_name']]);

            DB::table('public_page_seos')
                ->where('path', $page['path'])
                ->whereNull('meta_title')
                ->update(['meta_title' => $page['meta_title']]);

            DB::table('public_page_seos')
                ->where('path', $page['path'])
                ->whereNull('meta_description')
                ->update(['meta_description' => $page['meta_description']]);

            DB::table('public_page_seos')
                ->where('path', $page['path'])
                ->whereNull('meta_keywords')
                ->update(['meta_keywords' => $page['meta_keywords']]);
        }
    }

    public function down(): void
    {
        //
    }
};
