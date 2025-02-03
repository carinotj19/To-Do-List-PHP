<?php
namespace App\Models;

use PDO;

class User
{
    public static function findByUsername($username)
    {
        global $pdo;
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($username, $hashedPassword)
    {
        global $pdo;
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':password' => $hashedPassword
        ]);
    }
}
