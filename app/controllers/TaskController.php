<?php
namespace App\Controllers;

use App\Models\Task;

class TaskController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=showLogin');
            exit;
        }
    }
    // List tasks (supports optional search and filtering by priority).
    public function index()
    {
        $search = $_GET['search'] ?? '';
        $priority = $_GET['priority'] ?? '';

        // Fetch tasks from the model, optionally with search/priority.
        $tasks = Task::getAll($search, $priority);

        // Load the view
        require_once '../app/views/tasks/index.php';
    }

    // Show form to create a new task or handle form submission.
    public function create()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title       = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $dueDate     = $_POST['due_date'] ?? null;
        $status      = $_POST['status'] ?? 'open';
        $priority    = $_POST['priority'] ?? 'low';
        $tags        = $_POST['tags'] ?? '';
        $userId      = $_SESSION['user_id'];

        // Server-side validation
        if (empty($title)) {
            $errors['title'] = 'Title is required.';
        }

        if (empty($dueDate)) {
            $errors['due_date'] = 'Due Date is required.';
        }

        if (empty($errors)) {
            // Proceed with task creation if there are no errors
            Task::create($title, $description, $dueDate, $status, $priority, $tags, $userId);
            header('Location: index.php?controller=task&action=index');
            exit;
        }
    }

    require_once '../app/views/tasks/create.php';
}


    // Show a single task (and possibly subtasks/comments if you want).
    public function show()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "Task ID is missing.";
            return;
        }

        $task = Task::find($id);
        if (!$task) {
            echo "Task not found.";
            return;
        }

        // Load a details view for this task
        require_once '../app/views/tasks/show.php';
    }

    // Show edit form or update task after form submit.
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "Task ID is missing.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $dueDate = $_POST['due_date'] ?? null;
            $status = $_POST['status'] ?? 'open';
            $priority = $_POST['priority'] ?? 'low';
            $tags = $_POST['tags'] ?? '';

            Task::update($id, $title, $description, $dueDate, $status, $priority, $tags);
            header('Location: index.php?controller=task&action=index');
            exit;
        }

        // Show the edit form
        $task = Task::find($id);
        if (!$task) {
            echo "Task not found.";
            return;
        }

        require_once '../app/views/tasks/edit.php';
    }

    // Delete a task
    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            Task::delete($id);
        }
        header('Location: index.php?controller=task&action=index');
        exit;
    }
}
