<?php

require_once __DIR__ . '/vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once __DIR__ . '/routes.php';
require_once __DIR__ . '/database.php';




try {


    $current_path = strtok($_SERVER["REQUEST_URI"], '?');
    $filtered_routes = array_filter($routes, function ($route) use ($current_path) {
        // Convert the route pattern into a regex pattern
        $route_pattern = preg_replace('/:\w+/', '(\w+)', $route['path']);
        $route_pattern = '#^' . $route_pattern . '$#'; // Add start and end anchors

        // Check if the current path matches the dynamic route pattern
        return preg_match($route_pattern, $current_path);
    });

// Check if any routes were matched
    if (sizeof($filtered_routes) === 0) {
        echo "Page Not Found";
        die();
    }

// Reset the keys of the filtered routes
    $filtered_routes = array_values($filtered_routes);
    $route = $filtered_routes[0];
    $controllerClassPath = $route['controller']; // e.g., Controllers\HomeController

// Create an instance of the controller
    $obj = new $controllerClassPath; // e.g., $obj = new Controllers\HomeController;

// Get the action method name
    $action = $route['action'];

// Generate the regex pattern again for parameter extraction
    $route_pattern = preg_replace('/:\w+/', '(\w+)', $route['path']);
    $route_pattern = '#^' . $route_pattern . '$#';

// Extract parameters from the current path
    preg_match($route_pattern, $current_path, $matches);

// Remove the first element, which is the full match, to get only the parameters
    array_shift($matches);

// Call the action method with the parameters
    if (method_exists($obj, $action)) {
        call_user_func_array([$obj, $action], $matches); // Pass parameters as an array
    } else {
        echo "Action not found.";
        die();
    }

} catch (Throwable $e) {
    var_export($e->getMessage());
    die();
}