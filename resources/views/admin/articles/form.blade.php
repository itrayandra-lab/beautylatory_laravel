@extends('admin.layouts.app')

@section('title', isset($article) ? 'Edit Article' : 'Add New Article')

@section('content')
    <div class="admin-page-header">
        <h1 class="admin-page-title">{{ isset($article) ? 'Edit Article' : 'Add New Article' }}</h1>
        <a href="{{ route('admin.articles.index') }}" class="btn btn--secondary">Back to Articles</a>
    </div>

    <div class="admin-card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($article) ? route('admin.articles.update', $article) : route('admin.articles.store') }}"
            method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf
            @if (isset($article))
                @method('PUT')
            @endif

            <div class="form-row">
                <div class="form-col-8">
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $article->title ?? '') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug"
                            class="form-control @error('slug') is-invalid @enderror"
                            value="{{ old('slug', $article->slug ?? '') }}">
                        <small class="form-text text-muted">Leave blank to auto-generate from title</small>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="15"
                            required>{{ old('content', $article->content ?? '') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-col-4">
                    <div class="form-group">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id"
                            class="form-control @error('category_id') is-invalid @enderror" required>
                            <option value="">-- Select a Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $article->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tags" class="form-label">Tags</label>
                        <select name="tags[]" id="tags"
                            class="form-control select2 @error('tags') is-invalid @enderror" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{ in_array($tag->id, old('tags', $article->tags->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Main Image</label>
                        <input type="file" name="image" id="image"
                            class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if (isset($article) && $article->image)
                            <div class="mt-2">
                                <p>Current Image:</p>
                                <img src="{{ asset('images/articles/' . $article->image) }}" alt="Current Image"
                                    class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror"
                            required>
                            <option value="published"
                                {{ old('status', $article->status ?? '') === 'published' ? 'selected' : '' }}>Published
                            </option>
                            <option value="unpublished"
                                {{ old('status', $article->status ?? '') === 'unpublished' ? 'selected' : '' }}>Unpublished
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- SEO Meta Fields -->
                    <div class="form-group">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title"
                            class="form-control @error('meta_title') is-invalid @enderror"
                            value="{{ old('meta_title', $article->meta_title ?? '') }}" maxlength="60">
                        <small class="form-text text-muted">Max 60 characters
                            ({{ old('meta_title', $article->meta_title ?? '') ? strlen(old('meta_title', $article->meta_title ?? '')) : 0 }}/60)</small>
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea name="meta_description" id="meta_description"
                            class="form-control @error('meta_description') is-invalid @enderror" maxlength="160" rows="3">{{ old('meta_description', $article->meta_description ?? '') }}</textarea>
                        <small class="form-text text-muted">Max 160 characters
                            ({{ old('meta_description', $article->meta_description ?? '') ? strlen(old('meta_description', $article->meta_description ?? '')) : 0 }}/160)</small>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords"
                            class="form-control @error('meta_keywords') is-invalid @enderror"
                            value="{{ old('meta_keywords', $article->meta_keywords ?? '') }}">
                        <small class="form-text text-muted">Comma separated keywords</small>
                        @error('meta_keywords')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit"
                    class="btn btn--primary">{{ isset($article) ? 'Update Article' : 'Save Article' }}</button>
            </div>
        </form>
    </div>

    <!-- TinyMCE Script -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | removeformat | help',
            height: 500,
            menubar: false,
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            image_advtab: true,
            image_uploadtab: true,
            images_upload_url: '/admin/articles/upload-image',
            automatic_uploads: false,
            valid_elements: 'p,br,strong,b,em,i,u,ol,ul,li,h1,h2,h3,h4,h5,h6,blockquote,code,pre,a[href],img[src|alt|width|height],hr',
            extended_valid_elements: 'img[class|src|alt|title|width|height|style|data-mce-src|data-mce-json]'
        });
    </script>

    <!-- Select2 CSS and JS if needed -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select tags",
                allowClear: true
            });
        });
    </script>
@endsection
