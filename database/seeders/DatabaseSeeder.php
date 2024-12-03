<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() 
    {
        // Buat 1 admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'), // Password: admin123
            'role' => 'admin'
        ]);

        // // Buat 4 student
        // User::create([
        //     'name' => 'Student 1',
        //     'email' => 'student1@example.com',
        //     'password' => bcrypt('student123'), // Password: student123
        //     'role' => 'student'
        // ]);
        // User::create([
        //     'name' => 'Student 2',
        //     'email' => 'student2@example.com',
        //     'password' => bcrypt('student456'), // Password: student456
        //     'role' => 'student'
        // ]);

        // // Buat 5 teacher
        // User::create([
        //     'name' => 'Teacher 1',
        //     'email' => 'teacher1@example.com',
        //     'password' => bcrypt('teacher123'), // Password: teacher123
        //     'role' => 'teacher'
        // ]);
        // User::create([
        //     'name' => 'Teacher 2',
        //     'email' => 'teacher2@example.com',
        //     'password' => bcrypt('teacher456'), // Password: teacher456
        //     'role' => 'teacher'
        // ]);

    }
}