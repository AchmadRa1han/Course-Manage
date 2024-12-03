<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium mb-4">Daftar Kursus</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @if ($courses->isEmpty())
                        <div class="col-span-1">
                            <div class="bg-gray-100 p-4 rounded-lg text-center">
                                <p class="text-gray-600">Anda tidak terdaftar di kursus manapun.</p>
                            </div>
                        </div>
                    @else
                        @foreach ($courses as $enrollment)
                            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                <div class="p-4">
                                    <h5 class="text-xl font-semibold mb-2">{{ $enrollment->course->name }}</h5>
                                    <p class="text-gray-700 mb-4">{{ Str::limit($enrollment->course->description, 100) }}</p>
                                    <a href="{{ route('content.show', $enrollment->course->course_id) }}" class="text-blue-600 hover:text-blue-900 font-medium">Lihat Konten</a>

                                    <!-- Form untuk menandai konten sebagai selesai -->
                                    <div class="mt-4">
                                        @foreach ($enrollment->course->contents as $content)
                                            <form action="{{ route('content.markAsDone', $content->content_id) }}" method="POST" class="mt-2">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <input type="checkbox" name="is_done" value="1" 
                                                    {{ isset(json_decode($content->progress, true)["user_id_".Auth::user()->id]) && json_decode($content->progress, true)["user_id_".Auth::user()->id] ? 'checked' : '' }}>
                                                <label for="is_done" class="ml-2">Mark "{{ $content->title }}" as done</label>
                                                <button type="submit" class="btn btn-secondary ml-2">Update</button>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
