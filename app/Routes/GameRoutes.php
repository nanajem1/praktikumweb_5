<?php

namespace App\Routes;

include "app/Controller/GameController.php";

use App\Controller\GameController;

class GameRoutes
{
    public function handle($method, $path)
    {
        // Jika request method get dan path sama dengan "/api/Game"
        if ($method === "GET" && $path === "/api/game") {
            $controller = new GameController();
            echo $controller->index();
        }

        // Jika request method get dan path mengandung "/api/Game/
        if ($method === "GET" && strpos($path, "/api/game/") === 0) {
            // Extract id dari path
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new GameController();
            echo $controller->getById($id);
        }

        // Jika request method post dan path sama dengan "/api/Game"
        if ($method === "POST" && $path === "/api/game") {
            $controller = new GameController();
            echo $controller->insert();
        }

        // Jika request method put dan path mengandung "/api/Game/
        if ($method === "PUT" && strpos($path, "/api/game/") === 0) {
            // Extract id dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new GameController;
            echo $controller->update($id);
        }

        // Jika request method delete dan path mengandung "/api/Game/"
        if ($method === "DELETE" && strpos($path, "/api/game/") === 0) {
            // Extract id dari path
            $pathParts = explode("/", $path);
            // $id = $pathParts[count($pathParts) - 1];
            $id = $pathParts[count($pathParts) - 1];

            $controller = new GameController();
            echo $controller->delete($id);
        }

        if ($method === "GET" && $path === "/api/game-with-category") {
            $controller = new GameController();
            echo $controller->getGamesWithPackages();
        }
    }
}
