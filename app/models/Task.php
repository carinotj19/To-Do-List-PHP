<?php
namespace App\Models;

use PDO;

class Task
{
    // Fetch tasks with optional search and priority filter
    public static function getAll($search = '', $priority = '')
    {
        global $pdo;
        $sql = "SELECT tasks.*, users.username AS created_by_username
            FROM tasks
            JOIN users ON tasks.user_id = users.id -- Changed created_by to user_id
            WHERE 1=1";
        $params = [];

        if ($search) {
            $sql .= " AND (tasks.title LIKE :search OR tasks.description LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }

        if ($priority) {
            $sql .= " AND tasks.priority = :priority";
            $params[':priority'] = $priority;
        }

        $sql .= " ORDER BY tasks.created_at DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Find one task by ID
    public static function find($id)
    {
        global $pdo;
        $sql = "SELECT * FROM tasks WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new task
    public static function create($title, $description, $dueDate, $status, $priority, $tags, $userId)
    {
        global $pdo;
        $sql = "INSERT INTO tasks (title, description, due_date, status, priority, tags, user_id)
                VALUES (:title, :description, :due_date, :status, :priority, :tags, :user_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':due_date' => $dueDate,
            ':status' => $status,
            ':priority' => $priority,
            ':tags' => $tags,
            ':user_id' => $userId,
        ]);
    }


    // Update an existing task
    public static function update($id, $title, $description, $dueDate, $status, $priority, $tags)
    {
        global $pdo;
        $sql = "UPDATE tasks
                SET title = :title, description = :description, due_date = :due_date,
                    status = :status, priority = :priority, tags = :tags
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':due_date' => $dueDate,
            ':status' => $status,
            ':priority' => $priority,
            ':tags' => $tags,
            ':id' => $id
        ]);
    }

    // Delete a task
    public static function delete($id)
    {
        global $pdo;
        $sql = "DELETE FROM tasks WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
