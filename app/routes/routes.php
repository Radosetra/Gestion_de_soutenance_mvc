<?php

/**
 * Le mot cle `use path\to\myClass` permet d'importer une classe et de l'utiliser  sans avoir à spécifier le chemin complet à chaque fois.
 */
// use App\Controllers\EtudiantController;
// require_once "../controllers/EtudiantController.php";
// require_once "../../vendor/altorouter/altorouter/AltoRouter.php";



// $router = new AltoRouter();

// $router->map('GET', '/', function () {
//     require 'index.php';
// });

// $router->map('GET', '/etudiants', [EtudiantController::class, 'index']);
// $router->map('GET', '/etudiants/ajouter', [EtudiantController::class, 'create']);
// $router->map('GET', '/etudiants/[i:id]', [EtudiantController::class, 'show']);
// $router->map('POST', '/etudiants', [EtudiantController::class, 'store']);
// $router->map('PUT', '/etudiants/[i:id]', [EtudiantController::class, 'update']);
// $router->map('DELETE', '/etudiants/[i:id]', [EtudiantController::class, 'destroy']);

// $match = $router->match();

// if ($match) {
//     $target = $match['target'];
//     $params = $match['params'];
//     list($controller, $action) = $target;

//     $obj = new $controller();
//     $obj->$action($params);
// } else {
//     header("HTTP/1.0 404 Not Found");
//     echo 'Page not found';
// }
