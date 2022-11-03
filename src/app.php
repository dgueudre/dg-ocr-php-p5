<?php

use App\Controller\AuthController;
use App\Controller\CmdController;
use App\Controller\CommentController;
use App\Controller\PostController;
use Prout\Database;
use Prout\DotEnv;
use Prout\Route;
use Prout\Router;

session_start();

set_error_handler(function ($severity, $message, $filename, $lineno) {
    throw new ErrorException($message, 0, $severity, $filename, $lineno);
});

set_exception_handler(function ($e) {
    echo '<pre>';
    echo $e;
    echo '</pre>';
});

DotEnv::init();

Database::init(
    DotEnv::get('DB_HOST'),
    DotEnv::get('DB_NAME'),
    DotEnv::get('DB_USER'),
    DotEnv::get('DB_PASS')
);

DotEnv::init();

$_SESSION['alerts'] = $_SESSION['alerts'] ?? [];

$routes = [
    new Route('/', PostController::class, 'list'),
    new Route('/login', AuthController::class, 'login'),
    new Route('/logout', AuthController::class, 'logout'),
    new Route('/register', AuthController::class, 'register'),
    new Route('/posts', PostController::class, 'list'),
    new Route('/posts/create', PostController::class, 'create'),
    new Route('/posts/:id', PostController::class, 'view'),
    new Route('/posts/:id/edit', PostController::class, 'edit'),
    new Route('/posts/:id/comment', CommentController::class, 'create'),
    new Route('x/install', CmdController::class, 'install'),
];

$url = $_SERVER['REQUEST_URI'] ?? $argv[1] ?? null;

if (!$url) {
    echo 'bad request'.PHP_EOL;
    exit(1);
}

$route = Router::find($url, $routes);

if ($route) {
    echo $route->execute();
}
