@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Edit Content</h1>

    <form action="{{ route('content.update', $content->content_id) }}" method="POST"> <!-- Pastikan menggunakan content_id -->
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $content->title) }}" class="form-input mt-1" required>
        </div>

        <div class="mb-4">
            <label for="content_text" class="block font-medium text-sm text-gray-700">Content</label>
            <textarea name="content_text" id="content_text" class="form-input mt-1" required>{{ old('content_text', $content->content_text) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Content</button>
    </form>
</div>
@endsection
