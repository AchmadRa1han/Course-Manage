<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $course->name }}</title>
    <!-- Include CSS and other head elements -->
</head>
<body>
    <h1>{{ $course->name }}</h1>
    <p>{{ $course->description }}</p>
    <p>Enrolled Students: {{ $course->enrollments_count }}</p>
    <!-- Tambahkan konten lain yang relevan -->
</body>
</html>