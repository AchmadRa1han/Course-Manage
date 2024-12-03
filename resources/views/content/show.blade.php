@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Content for {{ $course->name }}</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'teacher'))
            <a href="{{ route('content.create', $course->course_id) }}" class="btn btn-primary">Add Content</a>
        @endif
    </div>

    <div class="list-group">
        @foreach ($course->contents as $content)
            <div class="list-group-item">
                <h5 class="mb-1">{{ $content->title }}</h5>
                <p class="mb-1">{{ $content->content_text }}</p>
                <div>
                    @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'teacher'))
                        <a href="{{ route('content.edit', $content->content_id) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('content.destroy', $content->content_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @elseif (Auth::check() && Auth::user()->role === 'student')
                    <form action="{{ route('content.markAsDone', $content->content_id) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="checkbox" name="is_done" id="is_done_{{ $content->content_id }}" 
                            onchange="this.form.submit()" 
                            {{ isset(json_decode($content->progress, true)["user_id_".Auth::user()->id]) && json_decode($content->progress, true)["user_id_".Auth::user()->id] ? 'checked' : '' }}>
                        <label for="is_done_{{ $content->content_id }}" class="ml-2">Mark as Done</label>
                    </form>
                    
                        </form>
                    @endif
                </div> 
            </div>
        @endforeach
    </div>
</div>
@endsection
