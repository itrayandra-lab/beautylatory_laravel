<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    /**
     * Show the admin profile page.
     */
    public function showProfile(): View
    {
        $admin = auth()->guard('admin')->user();
        
        return view('admin.profile.show', compact('admin'));
    }

    /**
     * Show the profile edit form.
     */
    public function editProfile(): View
    {
        $admin = auth()->guard('admin')->user();
        
        return view('admin.profile.edit', compact('admin'));
    }

    /**
     * Update the admin profile.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $admin = auth()->guard('admin')->user();
        
        $request->validate([
            'username' => 'required|string|max:255|unique:admins,username,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin->updateProfile([
            'username' => $request->username,
            'password' => $request->password,
        ]);

        return redirect()->route('admin.profile.show')->with('success', 'Profile updated successfully!');
    }
}