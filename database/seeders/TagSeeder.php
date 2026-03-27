<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Neon Box',
            'Papan Reklame',
            'Huruf Timbul',
            'Billboard',
            'LED Display',
            'Signage',
            'Branding Toko',
        ];

        foreach ($tags as $tag) {
            Tag::updateOrCreate(
                ['name' => $tag],
                ['slug' => Str::slug($tag)]
            );
        }
    }
}
