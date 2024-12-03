@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Course Catalog</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('courses.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search for courses..." aria-label="Search for courses" value="{{ request()->get('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ $course->name }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $course->description }}</p>
                            <p class="card-text">
                                <strong>Pengajar:</strong> 
                                @if ($course->teacher)
                                    {{ $course->teacher->name }}
                                @else
                                    -
                                @endif
                                <br>
                                <strong>Tanggal Mulai:</strong> {{ $course->start_date }}<br>
                                <strong>Tanggal Selesai:</strong> {{ $course->end_date }}
                            </p>

                            <h6 class="font-semibold">Jumlah Siswa Terdaftar:</h6>
                            <p>{{ $course->enrollments->count() }} siswa</p>

                            @if (Auth::check() && Auth::user()->role === 'student')
                                @php
                                    $isEnrolled = \App\Models\Enrollment::where('user_id', Auth::user()->id)
                                                    ->where('course_id', $course->course_id)
                                                    ->exists();
                                @endphp

                                @if (!$isEnrolled)
                                    <form action="{{ route('courses.enroll', $course->course_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Enroll</button>
                                    </form>
                                @else
                                    <p class="text-success">You are enrolled in this course!</p>
                                @endif

                                <!-- Form untuk menandai konten sebagai selesai -->
                                @foreach ($course->contents as $content)
                                    <form action="{{ route('content.markAsDone', $content->content_id) }}" method="POST" class="mt-2">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="checkbox" name="is_done" value="1" 
                                            {{ isset(json_decode($content->progress, true)["user_id_".Auth::user()->id]) && json_decode($content->progress, true)["user_id_".Auth::user()->id] ? 'checked' : '' }}>
                                        <label for="is_done">Mark "{{ $content->title }}" as done</label>
                                        <button type="submit" class="btn btn-secondary">Update</button>
                                    </form>
                                @endforeach
                            @endif

                            @if (Auth::check() && (Auth::user()->role === 'teacher' || Auth::user()->role === 'admin'))
                                <a href="{{ route('content.show', $course->course_id) }}" class="btn btn-success">View Content</a>
                                <a href="{{ route('content.create', $course->course_id) }}" class="btn btn-warning">Add Content</a>
                                <a href="{{ route('courses.viewStudents', $course->course_id) }}" class="btn btn-secondary">View Students</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
