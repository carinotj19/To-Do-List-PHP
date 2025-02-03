<?php
namespace App\Core;

class Router
{
    public function run()
    {
        // Default to 'task' controller and 'index' action
        $controller = $_GET['controller'] ?? 'task';
        $action = $_GET['action'] ?? 'index';

        // Build the class name, e.g. 'App\Controllers\TaskController'
        $controllerName = ucfirst($controller) . 'Controller';
        $controllerClass = 'App\\Controllers\\' . $controllerName;

        // Check if that class exists
        if (class_exists($controllerClass)) {
            $controllerObject = new $controllerClass();

            // Call the method if it exists
            if (method_exists($controllerObject, $action)) {
                $controllerObject->$action();
            } else {
                echo "Method '$action' not found in controller '$controllerName'.";
            }
        } else {
            echo "Controller '$controllerName' not found.";
        }
    }
}
