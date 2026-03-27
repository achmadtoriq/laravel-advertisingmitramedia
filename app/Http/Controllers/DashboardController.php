<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }  

    public function produk_menu() {
        return view('admin.produk-menu');
    }

    public function setting_menu() {
        return view('admin.setting-menu');
    }
}
