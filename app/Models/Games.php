<?php

namespace app\Models;

include "app/Config/DatabaseConfig.php";

use app\Config\DatabaseConfig;
use mysqli;

class Games extends DatabaseConfig
{
    public $conn;

    public function __construct()
    {
        // Connect ke database mysql
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database_name, $this->port);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Proses menampilkan semua data
    public function findAll()
    {
        $sql = "SELECT * FROM game";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    // Proses menampilkan data dengan id
    public function findById($id)
    {
        $sql = "SELECT * FROM game WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    // Proses insert data
    public function create_game($data)
    {
        $title = $data["title"];
        $publisher = $data["publisher"];
        $review = $data["review"];
        $id_category = $data["id_category"];

        $query = "INSERT INTO game (title,publisher,review,id_category) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $title, $publisher, $review, $id_category);
        $stmt->execute();
        $this->conn->close();
    }

    // Proses update data dengan id
    public function update($data, $id)
    {
        $review = $data["review"];

        $query = "UPDATE game SET review = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        // Huruf "s" berarti tipe parameter product_name adalah String dan huruf "i" berarti parameter id adalah integer
        $stmt->bind_param("si", $review, $id);
        $stmt->execute();
        $this->conn->close();
    }

    // Proses delete data dengan id
    public function destroy($id)
    {
        $query = "DELETE FROM game WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        // Huruf "i" berarti parameter pertama adalah integer
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
    }

    public function findAllWithCategories()
    {
        $sql = "SELECT g.title, g.publisher, g.review, c.genre FROM game g INNER JOIN category c ON g.id_category = c.id";

        $result = $this->conn->query($sql);

        $this->conn->close();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
}
