<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kursus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.courses.update', $course->course_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Nama Kursus:</label>
                            <input type="text" name="name" id="name" class="form-input" value="{{ old('name', $course->name) }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold mb-2">Deskripsi:</label>
                            <textarea name="description" id="description" class="form-textarea" required>{{ old('description', $course->description) }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="start_date" class="block text-gray-700 font-bold mb-2">Tanggal Mulai:</label>
                            <input type="date" name="start_date" id="start_date" class="form-input" value="{{ old('start_date', $course->start_date) }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="end_date" class="block text-gray-700 font-bold mb-2">Tanggal Selesai:</label>
                            <input type="date" name="end_date" id="end_date" class="form-input" value="{{ old('end_date', $course->end_date) }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="teacher_id" class="block text-gray-700 font-bold mb-2">Pengajar:</label>
                            <select name="teacher_id" id="teacher_id" class="form-select" required>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id', $course->teacher_id) == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button> 1 
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>