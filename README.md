# To-Do List Application (PHP & MySQL)

This is a simple To-Do List application built using PHP, MySQL, and Bootstrap. The project follows the **MVC (Model-View-Controller)** design pattern and includes user authentication to manage tasks effectively.

## Features

- **User Authentication**: Login and register functionality.
- **Task Management**:
  - Add, edit, delete, and view tasks.
  - Tasks include fields for title, description, due date, status, priority, and tags.
  - Tasks are associated with the user who created them.
- **Validation**:
  - Title and due date are required when creating a task.
  - Server-side and client-side validation.
- **Search & Filter**:
  - Search tasks by title or description.
  - Filter tasks by priority (low, medium, high).
- **Responsive Design**:
  - Bootstrap for a clean and modern UI.

---

## Prerequisites

1. PHP (>=7.4 recommended)
2. MySQL or MariaDB
3. XAMPP, WAMP, or a similar local server environment
4. A modern web browser

---

## Installation

### 1. Clone the Repository
Clone this repository to your local machine:
```bash
git clone https://github.com/carinotj19/To-Do-List-PHP.git
```

### 2. Configure the Database

1. Create a MySQL database (e.g., todo_db).
2. Import the SQL schema using the provided file:

```
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    due_date DATE NOT NULL,
    status ENUM('open', 'pending', 'completed') DEFAULT 'open',
    priority ENUM('low', 'medium', 'high') DEFAULT 'low',
    tags VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### 3. Configure the Project
Update the database connection in config/database.php:
```
<?php
$host = 'localhost';
$dbname = 'todo_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
```

---

## Usage

### 1. Start Your Local Server
If using XAMPP, start the Apache and MySQL modules.

### 2. Access the Application
Open your browser and navigate to:
```
http://localhost/your-project-folder/public/

```

### 3. Register and Login
- Register a new user.
- Log in to manage your tasks.

---

Project Structure

```
├── app
│   ├── controllers
│   │   ├── AuthController.php
│   │   ├── TaskController.php
│   ├── core
│   │   └── Router.php
│   ├── models
│   │   ├── Task.php
│   │   └── User.php
│   ├── views
│       ├── auth
│       │   ├── login.php
│       │   └── register.php
│       ├── tasks
│       │   ├── create.php
│       │   ├── edit.php
│       │   └── index.php
│       └── partials
│           └── navbar.php
├── config
│   └── database.php
├── public
│   └── index.php
└── README.md
```

---

## Key Features Overview

## User Authentication
    - Login: Users can log in using their credentials.
    - Registration: New users can register.
    - Session Management: Sessions are used to track logged-in users.
## Tasks
    - Create Task:
        - Title and due date are required.
        - Server-side validation displays errors for missing fields.
    - Edit Task:
        - Modify an existing task's details.
    - Delete Task:
        - Remove a task permanently.
    - View Tasks:
        - Displays tasks in a table format with filtering and search options.
## Validation
    - Client-side HTML validation for required fields.
    - Server-side validation to ensure data integrity.

---

## Future Improvements
    - Add categories for tasks.
    - Implement pagination for large task lists.
    - Enhance UI with additional Bootstrap components.
    - Add password hashing during registration.

--- 

## License

This project is open-source and available under the MIT License.