<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"> 
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Informasi Profil') }}
                    </h2>
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-700">Nama</label>
                        <input type="text" name="name" id="name" class="form-input mt-1" value="{{ $user->name }}" disabled>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="form-input mt-1" value="{{ $user->email }}" disabled>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Enrollment') }}
                    </h2>
                    @if ($enrollments->count() > 0)
                        <ul class="list-disc list-inside">
                            @foreach ($enrollments as $enrollment)
                                <li>{{ $enrollment->course->name }}</li> 
                            @endforeach
                        </ul>
                    @else
                        <p>Anda belum terdaftar di kursus apa pun.</p>
                    @endif
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Update Profile') }}
                    </h2>
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')
                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" class="form-input mt-1" value="{{ $user->name }}" required autofocus autocomplete="name">
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="form-input mt-1" value="{{ $user->email }}" required autocomplete="username">
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <button class="btn btn-primary">Simpan</button>

                            @if (session('status') === 'profile-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>