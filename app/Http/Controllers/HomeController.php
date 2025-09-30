<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Slider;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(): View
    {
        $sliders = Slider::orderBy('order', 'asc')->get();
        $products = Product::with('category')->orderBy('created_at', 'desc')->limit(8)->get();

        return view('home.index', compact('sliders', 'products'));
    }
}