<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Admin;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with(['category', 'author'])->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::orderBy('name', 'asc')->get();
        $authors = Admin::orderBy('username', 'asc')->get();

        return view('admin.articles.index', compact('articles', 'categories', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $tags = Tag::orderBy('name', 'asc')->get();
        $article = new Article();

        return view('admin.articles.form', compact('article', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'status' => 'required|in:published,unpublished',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:500',
        ]);

        // Upload image if provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->fileUploadService->uploadArticleImage($request->image);
        }

        // Set published_at if status is published
        if ($validated['status'] === 'published' && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Set author to current admin
        $validated['admin_id'] = Auth::guard('admin')->id();

        // Create article
        $article = Article::create(array_merge($validated, ['image' => $imagePath]));

        // Sync tags
        if (isset($validated['tags'])) {
            $article->tags()->sync($validated['tags']);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        // This method is for admin to view article details
        $article->load(['category', 'author', 'tags']);

        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $article->load('tags');
        $categories = Category::orderBy('name', 'asc')->get();
        $tags = Tag::orderBy('name', 'asc')->get();

        return view('admin.articles.form', compact('article', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'status' => 'required|in:published,unpublished',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:500',
        ]);

        // Handle image upload if provided
        $imagePath = $article->image; // Keep existing image if no new one is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($article->image) {
                $this->fileUploadService->delete('images/articles/' . $article->image);
            }
            
            $imagePath = $this->fileUploadService->uploadArticleImage($request->image);
        }

        // Update published_at if status changes to published and it wasn't set before
        if ($validated['status'] === 'published' && !$article->published_at) {
            $validated['published_at'] = now();
        }

        // Update article
        $article->update(array_merge($validated, ['image' => $imagePath]));

        // Sync tags
        if (isset($validated['tags'])) {
            $article->tags()->sync($validated['tags']);
        } else {
            $article->tags()->sync([]);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Delete image if exists
        if ($article->image) {
            $this->fileUploadService->delete('images/articles/' . $article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully.');
    }

    /**
     * Toggle the status of the article.
     */
    public function toggleStatus(Article $article)
    {
        $newStatus = $article->status === 'published' ? 'unpublished' : 'published';
        $article->update([
            'status' => $newStatus,
            'published_at' => $newStatus === 'published' && !$article->published_at ? now() : $article->published_at
        ]);

        return redirect()->back()->with('success', 'Article status updated successfully.');
    }

    /**
     * Display articles on the public site.
     */
    public function guestIndex()
    {
        $articles = Article::with(['category', 'author'])
            ->published()
            ->orderedByNewest()
            ->paginate(12);

        return view('articles.index', compact('articles'));
    }

    /**
     * Display a single article on the public site.
     */
    public function guestShow($slug)
    {
        $article = Article::with(['category', 'author', 'tags'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('articles.show', compact('article'));
    }
}