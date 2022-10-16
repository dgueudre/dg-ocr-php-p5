<pre>
<?php

use App\Controller\AuthController;
use App\Controller\PostController;
use Prout\Route;
use Prout\Router;

$routes = [
    new Route('/', PostController::class, 'list'),
    new Route('/login', AuthController::class, 'login'),
    new Route('/register', AuthController::class, 'register'),
    new Route('/posts', PostController::class, 'list'),
    new Route('/posts/:id/edit/:tata', PostController::class, 'edit'),
    new Route('/posts/:id', PostController::class, 'view'),
];

$route = Router::find($_SERVER['REQUEST_URI'], $routes);

if($route) {
    echo $route->execute();
}


?>

</pre>