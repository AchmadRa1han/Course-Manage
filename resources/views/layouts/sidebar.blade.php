<ul class="p-2">
    @if (Auth::check())
        <li class="p-2 hover:bg-gray-700"><a href="{{ route('profile.edit') }}">Profile</a></li>
    @endif

    @if (Auth::check() && Auth::user()->role === 'admin')
        <li class="p-2 hover:bg-gray-700"><a href="{{ route('admin.course-management') }}">Course Management</a></li> 
        <li class="p-2 hover:bg-gray-700"><a href="{{ route('admin.user-management') }}">User Management</a></li>
    @elseif (Auth::check() && Auth::user()->role === 'teacher')
        <li class="p-2 hover:bg-gray-700"><a href="{{ route('teacher.course-management') }}">Course Management</a></li> 
    @elseif (Auth::check() && Auth::user()->role === 'student')
        <li class="p-2 hover:bg-gray-700"><a href="{{ route('student.my-courses') }}">My Courses</a></li> <!-- Item untuk siswa -->
    @endif
</ul>
