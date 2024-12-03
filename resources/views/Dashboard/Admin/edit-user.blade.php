<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.update-user', $user->id) }}" method="POST"> 
                        @csrf
                        @method('PUT') 
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Nama:</label>
                            <input type="text" name="name" id="name" class="form-input" value="{{ old('name', $user->name) }}" required> 
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                            <input type="email" name="email" id="email" class="form-input" value="{{ old('email', $user->email) }}" required> 
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                            <input type="password" name="password" id="password" class="form-input">
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Konfirmasi Password:</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input">
                        </div>
                        <div class="mb-4">
                            <label for="role" class="block text-gray-700 font-bold mb-2">Role:</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="teacher" {{ old('role', $user->role) === 'teacher' ? 'selected' : '' }}>Teacher</option>
                                <option value="student" {{ old('role', $user->role) === 'student' ? 'selected' : '' }}>Student</option>
                                <option value="guest" {{ old('role', $user->role) === 'guest' ? 'selected' : '' }}>Guest</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>