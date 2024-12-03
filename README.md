To present the SQL schema in a clean and organized manner in your `README.md` file on GitHub, you can use Markdown formatting. Here’s how you can structure it:

```markdown
# Database Schema

This document outlines the SQL schema for the application, including the tables and their relationships.

## Course Table

The `course` table stores information about the courses offered.

```sql
CREATE TABLE course (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    start_date DATE,
    end_date DATE,
    teacher_id BIGINT, -- Using BIGINT to reference users.id
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE SET NULL
);
```

## Enrollment Table

The `enrollment` table tracks the enrollment of users in courses.

```sql
CREATE TABLE enrollment (
    enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT,
    course_id INT,
    role ENUM('teacher', 'student'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES course(course_id) ON DELETE CASCADE
);
```

## Content Table

The `content` table contains the content associated with each course.

```sql
CREATE TABLE content (
    content_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content_text TEXT,
    course_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    is_done TINYINT(1) DEFAULT 0,
    progress JSON,
    FOREIGN KEY (course_id) REFERENCES course(course_id) ON DELETE CASCADE
);
```

## Notes

- Ensure that the `users` table exists before creating these tables, as foreign key constraints reference it.
- The `teacher_id` in the `course` table can be set to `NULL` if the teacher is deleted.
```

