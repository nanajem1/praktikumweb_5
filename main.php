<?php

header("Content-Type: application/json; charset=UTF-8");

include "app/Routes/GameRoutes.php";

use App\Routes\GameRoutes;

// Tangkap Request method
$method = $_SERVER["REQUEST_METHOD"];
// Tangkap request path
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// Panggil routes
$GameRoute = new GameRoutes();
$GameRoute->handle($method, $path);
