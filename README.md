# Library Management System

A minimal admin-side Library Management System developed as a college mini project.

The system allows an administrator to manage books, issue books to students, process returns, track availability, and monitor overdue books.

## Features

- Dummy Admin Login
- Dashboard with library statistics
- Add, edit, delete and search books
- Issue books to students
- Return issued books
- Automatic book availability tracking
- Automatic overdue detection
- Issue/return history
- Success and error messages
- Automatic database setup

## Tech Stack

- HTML
- Tailwind CSS
- JavaScript
- PHP
- MySQL
- XAMPP
- Git & GitHub

## Database

The project uses two tables:

### books

- id
- title
- author
- category
- isbn
- quantity
- available

### issued_books

- id
- student_name
- roll_no
- book_id
- issue_date
- due_date
- return_date
- status

`issued_books.book_id` is connected to `books.id` using a foreign key.

## Installation

### 1. Clone the repository

```bash
git clone <repository-url>
```

Move the project into your XAMPP `htdocs` directory if required.

### 2. Create environment file

Copy:

```text
.env.example
```

and rename the copy to:

```text
.env
```

Default XAMPP configuration:

```env
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=library_management
```

Change these values if your MySQL configuration is different.

### 3. Start XAMPP

Start:

- Apache
- MySQL

### 4. Setup the database

Open:

```text
http://localhost/library-management/database/setup.php
```

The setup script automatically creates:

- `library_management` database
- `books` table
- `issued_books` table
- Starter book records

### 5. Run the application

Open:

```text
http://localhost/library-management/
```

## Project Structure

```text
library-management/
│
├── actions/
│   ├── add-book.php
│   ├── edit-book.php
│   ├── delete-book.php
│   ├── issue-book.php
│   └── return-book.php
│
├── assets/
│   └── js/
│       ├── books.js
│       └── issue-return.js
│
├── config/
│   └── database.php
│
├── database/
│   └── setup.php
│
├── pages/
│   ├── dashboard.php
│   ├── books.php
│   └── issue-return.php
│
├── .env.example
├── .gitignore
├── index.php
└── README.md
```

## Main Workflow

```text
Admin Login
     |
     v
 Dashboard
     |
     +----------------+
     |                |
     v                v
   Books         Issue / Return
     |                |
 Add/Edit/Delete     Issue Book
 Search              Return Book
                     Track Overdue
```

When a book is issued, its available quantity decreases by one.

When the book is returned, its available quantity increases by one.

Books with existing issue/return history cannot be deleted to preserve transaction records.

## Note

This project uses a dummy admin login because it is designed as a minimal college mini project focused primarily on library book management and issue/return operations.