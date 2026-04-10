<?php
require_once __DIR__ . '/../config/Database.php';

class Category {
    private $db;
    private $table = "categories";

    public function __construct() {
        $this->db = Database::connect();
    }

    // Retrieve all categories sorted alphabetically.
    public function getAllCategories() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY name ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Retrieve specific category details by its ID.
    public function getCategoryById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
}