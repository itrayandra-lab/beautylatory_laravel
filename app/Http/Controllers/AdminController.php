<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        $productCount = Product::count();
        $categoryCount = Category::count();
        $sliderCount = Slider::count();

        return view('admin.dashboard', compact('productCount', 'categoryCount', 'sliderCount'));
    }
}