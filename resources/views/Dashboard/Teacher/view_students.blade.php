@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Students Enrolled in {{ $course->name }}</h1>

        <h6 class="font-semibold">Enrolled Students:</h6>
        <ul>
            @foreach ($course->enrollments as $enrollment)
                <li>{{ $enrollment->user->name }}</li> <!-- Menampilkan nama siswa -->
            @endforeach
        </ul>

        <h6 class="font-semibold mt-4">Content Status:</h6>
        <table class="table">
            <thead>
                <tr>
                    <th>Content Title</th>
                    <th>Status</th>
                    <th>Progress</th> <!-- Kolom untuk menampilkan status per siswa -->
                </tr>
            </thead>
            <tbody>
                @foreach ($course->contents as $content)
                    <tr>
                        <td>{{ $content->title }}</td>
                        <td>
                            @php
                                $isDone = $content->is_done; // Cek status is_done langsung dari objek content
                            @endphp
                            {{ $isDone ? 'Done' : 'Not Done' }}
                        </td>
                        <td>
                            <ul>
                                @foreach ($course->enrollments as $enrollment)
                                    @php
                                        $userId = $enrollment->user->id;
                                        $progress = json_decode($content->progress, true) ?? [];
                                        $isUserDone = $progress["user_id_{$userId}"] ?? false; // Cek status penyelesaian untuk siswa ini
                                    @endphp
                                    <li>
                                        {{ $enrollment->user->name }}: {{ $isUserDone ? 'Done' : 'Not Done' }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
