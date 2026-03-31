<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidemenu extends Component
{
    /**
     * Create a new component instance.
     */
    public array $menus = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-house',
            'url' => '/admin/dashboard'
        ],
        [
            'name' => 'Artikel',
            'icon' => 'fa-solid fa-newspaper',
            'url' => '/admin/article'
            // 'submenu' => [
            //     [
            //         'name' => 'List Artikel',
            //         'url' => '/admin/article'
            //     ],
            //     [
            //         'name' => 'Tambah Artikel',
            //         'url' => '/admin/article/create'
            //     ]
            // ]
        ],
        [
            'name' => 'Project',
            'icon' => 'fa-solid fa-box',
            'url' => '/admin/projects'
        ],
        [
            'name' => 'Settings',
            'icon' => 'fa-solid fa-gear',
            'url' => '/admin/settings'
        ]
    ];

    public function __construct() {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.components.sidemenu');
    }
}
