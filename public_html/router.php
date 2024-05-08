<?php 

// Get the requested URL
$request_uri = $_SERVER['REQUEST_URI'];

// Remove leading/trailing slashes and query parameters
$request_uri = trim($request_uri, '/');
$request_uri = strtok($request_uri, '?');

// Define the routes and their corresponding files/controllers
$routes = [
    'contact' => 'pages/contact-us.php',
    'about' => 'pages/about-us.php',
    'cancellation' => 'pages/cancellation.php',
    'info' => 'pages/info.php',
    'privacy' => 'pages/privacy.php',
    'terms' => 'pages/terms.php',
    'post' => 'sendemail.php',
];

// read config file
// $config_file = file_get_contents('config.json');
// $config = json_decode($config_file);

require('fragments/header.php');

// Check if the requested route exists
if (array_key_exists($request_uri, $routes)) {
    $file = $routes[$request_uri];
    require_once($file);
} else {
    // Handle 404 error or show a custom error page
    require_once('pages/404.php');
}

require('fragments/footer.php');



?>

