@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Add Content</h1>

    <form action="{{ route('content.store', $courseId) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
            <input type="text" name="title" id="title" class="form-input mt-1" required>
        </div>

        <div class="mb-4">
            <label for="content_text" class="block font-medium text-sm text-gray-700">Content</label>
            <textarea name="content_text" id="content_text" class="form-input mt-1" required></textarea>
        </div>

        <input type="hidden" name="course_id" value="{{ $courseId }}">

        <button type="submit" class="btn btn-primary">Add Content</button>
    </form>
</div>
@endsection
