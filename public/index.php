<?php
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id']) && ($_GET['controller'] ?? '') !== 'auth') {
    header('Location: index.php?controller=auth&action=showLogin');
    exit;
}

// Load the database connection (creates $pdo).
require_once '../config/database.php';

// Manually load your models.
require_once '../app/models/User.php';
require_once '../app/models/Task.php';

// Manually load your controllers.
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/TaskController.php';

// Finally, load the router.
require_once '../app/core/Router.php';

// Use the Router class from the App\Core namespace.
use App\Core\Router;

// Create and run the router.
$router = new Router();
$router->run();
