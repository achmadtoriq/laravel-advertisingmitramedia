<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AllProject extends Component
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
        $projects = [
            [
                'image' => 'assets/images/project/project-1.jpg',
                'title' => 'Neon Box Samsung',
                'category' => 'neonbox',
                'location' => 'Mall Surabaya'
            ],
            [
                'image' => 'assets/images/project/project-2.jpg',
                'title' => 'Huruf Timbul Toko',
                'category' => 'huruf',
                'location' => 'Surabaya'
            ],
            [
                'image' => 'assets/images/project/project-3.jpg',
                'title' => 'Billboard Advertising',
                'category' => 'billboard',
                'location' => 'Outdoor Media'
            ],
            [
                'image' => 'assets/images/project/project-4.jpg',
                'title' => 'Neon Box Samsung',
                'category' => 'neonbox',
                'location' => 'Mall Surabaya'
            ],
            [
                'image' => 'assets/images/project/project-5.jpg',
                'title' => 'Huruf Timbul Toko',
                'category' => 'huruf',
                'location' => 'Surabaya'
            ],
            [
                'image' => 'assets/images/project/project-6.jpg',
                'title' => 'Billboard Advertising',
                'category' => 'billboard',
                'location' => 'Outdoor Media'
            ],
            [
                'image' => 'assets/images/project/project-7.jpg',
                'title' => 'Neon Box Samsung',
                'category' => 'neonbox',
                'location' => 'Mall Surabaya'
            ],
            [
                'image' => 'assets/images/project/project-8.jpg',
                'title' => 'Huruf Timbul Toko',
                'category' => 'huruf',
                'location' => 'Surabaya'
            ],
            [
                'image' => 'assets/images/project/project-9.jpg',
                'title' => 'Billboard Advertising',
                'category' => 'billboard',
                'location' => 'Outdoor Media'
            ],
        ];

        return view('components.all-project', compact('projects'));
    }
}
