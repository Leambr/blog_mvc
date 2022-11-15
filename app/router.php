<?php

$uri = "/". trim(explode("?", $_SERVER["REQUEST_URI"]) [0], "/");

// if ($uri != "/login" && $uri != "/signup") {
//     if (!isset($_SESSION["user"])) {
//         //je vais à login
//         header("Location: /login");
//         exit;
//     }
// }

switch ($uri) {
    case "/":
        $title = "Timeline";
        $style = '';
        ob_start();
        require_once __DIR__ . "/views/index.php";
        $content = ob_get_clean();
        break;
    case "/login":
        $title = "Login";
        $style = '';
        ob_start();
        require_once __DIR__ . "/views/login.php";
        $content = ob_get_clean();
        break;
    case "/signup":
        $title = "SignUp";
        $style = '';
        ob_start();
        require_once __DIR__ . "/views/signup.php";
        $content = ob_get_clean();
        break;
    default:
        http_response_code(404);
        $title = "404 Not found";
        $style = '';
        $content = file_get_contents(__DIR__ . "/views/alert/404.php");
}
require_once __DIR__ . "/views/base.php";
?>
