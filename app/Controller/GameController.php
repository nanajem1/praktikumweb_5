<?php

namespace App\Controller;

include "app/Traits/ApiResponseFormatter.php";
include "app/Models/Games.php";

use App\Models\Games;
use App\Traits\ApiResponseFormatter;

class GameController
{
    use ApiResponseFormatter;

    public function index()
    {
        // Definisikan object model product yang sudah dibuats
        $gameModel = new Games;
        // Panggil fungsi get all product
        $response = $gameModel->findAll();
        // Return $response dengan melakukan formatting terlebih dahulu menggunakan trait yang sudah dipanggil
        return $this->apiResponse(200, "success", $response);
    }

    public function getById($id)
    {
        $gameModel = new Games();
        $response = $gameModel->findById($id);
        return $this->apiResponse(200, "success", $response);
    }

    public function insert()
    {
        // Tangkap input JSON
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        // Validasi apakah input valid
        if (json_last_error()) {
            return $this->apiResponse(400, "error invalid input", null);
        }

        // Lanjut jika tidak error
        $gameModel = new Games();
        $response = $gameModel->create_game([
            "title" => $inputData["title"],
            "publisher" => $inputData["publisher"],
            "review" => $inputData["review"],
            "id_category" => $inputData["id_category"]
        ]);

        return $this->apiResponse(200, "success", $response);
    }

    public function update($id)
    {
        // Tangkap input JSON
        $jsonInput = file_get_contents("php://input");
        $inputData = json_decode($jsonInput, true);
        // Validasi apakah input valid
        if (json_last_error()) {
            return $this->apiResponse(400, "error invalid input", null);
        }

        // Lanjut jika tidak error
        $gameModel = new Games();
        $response = $gameModel->update([
            "review" => $inputData["review"]
        ], $id);

        return $this->apiResponse(200, "success", $response);
    }

    public function delete($id)
    {
        $gameModel = new Games();
        $response = $gameModel->destroy($id);

        return $this->apiResponse(200, "success", $response);
    }

    public function getGamesWithPackages()
    {
        $gameModel = new Games;
        $response = $gameModel->findAllWithCategories();

        return $this->apiResponse(200, "success", $response);
    }
}
