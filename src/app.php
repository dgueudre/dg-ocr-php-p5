<?php

use App\Controller\AuthController;
use App\Controller\CmdController;
use App\Controller\PostController;
use App\Model\Fixture\UserFixture;
use Prout\Database;
use Prout\DotEnv;
use Prout\Route;
use Prout\Router;

DotEnv::init();

Database::init(
    DotEnv::get('DB_HOST'),
    DotEnv::get('DB_NAME'),
    DotEnv::get('DB_USER'),
    DotEnv::get('DB_PASS')
);

UserFixture::run();

DotEnv::init();

$routes = [
    new Route('/', PostController::class, 'list'),
    new Route('/login', AuthController::class, 'login'),
    new Route('/register', AuthController::class, 'register'),
    new Route('/posts', PostController::class, 'list'),
    new Route('/posts/:id/edit/:tata', PostController::class, 'edit'),
    new Route('/posts/:id', PostController::class, 'view'),
    new Route('cmd/fixture/user', CmdController::class, 'test'),
];

$url = $_SERVER['REQUEST_URI'] ?? $argv[1] ?? null;

if (!$url) {
    echo 'bad request' . PHP_EOL;
    exit(1);
}

$route = Router::find($url, $routes);

if ($route) {
    echo $route->execute();
}
