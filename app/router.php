<?php

// $uri = "/". trim(explode("?", $_SERVER["REQUEST_URI"]) [0], "/");

// // if ($uri != "/login" && $uri != "/signup") {
// //     if (!isset($_SESSION["user"])) {
// //         //je vais à login
// //         header("Location: /login");
// //         exit;
// //     }
// // }

// switch ($uri) {
//     case "/":
//         $title = "Timeline";
//         $style = '';
//         ob_start();
//         require_once __DIR__ . "/views/index.php";
//         $content = ob_get_clean();
//         break;
//     case "/login":
//         $title = "Login";
//         $style = '';
//         ob_start();
//         require_once __DIR__ . "/views/login.php";
//         $content = ob_get_clean();
//         break;
//     case "/signup":
//         $title = "SignUp";
//         $style = '';
//         ob_start();
//         require_once __DIR__ . "/views/signup.php";
//         $content = ob_get_clean();
//         break;
//     default:
//         http_response_code(404);
//         $title = "404 Not found";
//         $style = '';
//         $content = file_get_contents(__DIR__ . "/views/alert/404.php");
// }
// require_once __DIR__ . "/views/base.php";


use App\Route\Route;

$controllerDir = dirname(__FILE__) . '/src/Controller';
$dirs = scandir($controllerDir);
$controllers = [];

foreach ($dirs as $dir) {
    if ($dir === "." || $dir === "..") {
        continue;
    }

    $controllers[] = "App\\Controller\\" . pathinfo($controllerDir . DIRECTORY_SEPARATOR . $dir)['filename'];
}

$routesObj = [];

foreach ($controllers as $controller) {
    $reflection = new ReflectionClass($controller);
    foreach ($reflection->getMethods() as $method) {
       foreach ($method->getAttributes() as $attribute) {
           /** @var Route $route */
           $route = $attribute->newInstance();
           $route->setController($controller)
               ->setAction($method->getName());

           $routesObj[] = $route;
       }
    }
}

$url = "/" . trim(explode("?", $_SERVER['REQUEST_URI'])[0], "/");

foreach ($routesObj as $route) {
    if (!$route->match($url) || !in_array($_SERVER['REQUEST_METHOD'], $route->getMethods())) {
        continue;
    }

    $controlerClassName = $route->getController();
    $action = $route->getAction();
    $params = $route->mergeParams($url);

    new $controlerClassName($action, $params);
    exit();
}

http_response_code(404);
$title = "404 Not found";
$style = '';
$content = file_get_contents(__DIR__ . "/views/alert/404.php");
require_once __DIR__ . "/views/base.php";
die;
?>
