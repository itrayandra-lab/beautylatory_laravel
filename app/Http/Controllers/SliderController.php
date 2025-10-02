<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sliders = Slider::orderBy('order', 'asc')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.slider.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB
            'order' => 'required|integer|min:1|unique:sliders,order',
        ]);

        $imagePath = FileUploadService::upload($request->file('image'), 'sliders');

        Slider::create([
            'image' => $imagePath,
            'order' => $request->order,
        ]);

        return redirect()->route('admin.slider.index')->with('success', 'Slider item created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.form', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB
            'order' => 'required|integer|min:1|unique:sliders,order,' . $slider->id,
        ]);

        $sliderData = $request->only(['order']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = FileUploadService::update($request->file('image'), $slider->image, 'sliders');
            $sliderData['image'] = $imagePath;
        } elseif ($request->has('remove_image') && $request->remove_image) {
            // Delete existing image if requested
            FileUploadService::delete($slider->image);
            $sliderData['image'] = null;
        }

        $slider->update($sliderData);

        return redirect()->route('admin.slider.index')->with('success', 'Slider item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $slider = Slider::findOrFail($id);

        // Delete image file if exists
        FileUploadService::delete($slider->image);

        $slider->delete();

        return redirect()->route('admin.slider.index')->with('success', 'Slider item deleted successfully.');
    }
}