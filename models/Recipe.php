<?php
require_once __DIR__ . '/../config/Database.php';

class Recipe {
    private $conn;
    private $table = "recipes";

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function getAllRecipes() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRecipeById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getRecipesByUser($user_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createRecipe($user_id, $category_id, $title, $ingredients, $instructions, $prep_time, $servings) {
        $query = "INSERT INTO " . $this->table . " 
                  (user_id, category_id, title, ingredients, instructions, prep_time, servings) 
                  VALUES (:user_id, :category_id, :title, :ingredients, :instructions, :prep_time, :servings)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":ingredients", $ingredients);
        $stmt->bindParam(":instructions", $instructions);
        $stmt->bindParam(":prep_time", $prep_time);
        $stmt->bindParam(":servings", $servings);

        return $stmt->execute();
    }

    public function updateRecipe($id, $category_id, $title, $ingredients, $instructions, $prep_time, $servings) {
        $query = "UPDATE " . $this->table . " 
                  SET category_id = :category_id,
                      title = :title,
                      ingredients = :ingredients,
                      instructions = :instructions,
                      prep_time = :prep_time,
                      servings = :servings
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":ingredients", $ingredients);
        $stmt->bindParam(":instructions", $instructions);
        $stmt->bindParam(":prep_time", $prep_time);
        $stmt->bindParam(":servings", $servings);

        return $stmt->execute();
    }

    public function deleteRecipe($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function getRecipesByCategory($category_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE category_id = :category_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>