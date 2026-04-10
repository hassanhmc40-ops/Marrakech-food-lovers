<?php
require_once __DIR__ . '/../config/Database.php';

class Recipe {
    private $conn;
    private $table = "recipes";

    public function __construct() {
        $this->conn = Database::connect();
    }

    /**
     * Retrieve all recipes with category and author details.
     * Useful for administrative purposes or global statistics.
     */
    public function getAllRecipes() {
        $query = "SELECT r.*, c.name as category_name, u.username 
                  FROM " . $this->table . " r
                  LEFT JOIN categories c ON r.category_id = c.id
                  LEFT JOIN users u ON r.user_id = u.id
                  ORDER BY r.created_at DESC";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Retrieve recipes from other users only.
     * Used for the community "Explore" feed.
     */
    public function getOthersRecipes($current_user_id) {
        $query = "SELECT r.*, c.name as category_name, u.username 
                  FROM " . $this->table . " r
                  LEFT JOIN categories c ON r.category_id = c.id
                  LEFT JOIN users u ON r.user_id = u.id
                  WHERE r.user_id != :user_id
                  ORDER BY r.created_at DESC";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $current_user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Get details for a specific recipe by its ID.
    public function getRecipeById($id) {
        $query = "SELECT r.*, c.name as category_name, u.username
                  FROM " . $this->table . " r
                  LEFT JOIN categories c ON r.category_id = c.id
                  LEFT JOIN users u ON r.user_id = u.id
                  WHERE r.id = :id";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Retrieve all recipes belonging to the logged-in user.
    public function getRecipesByUser($user_id) {
        $query = "SELECT r.*, c.name as category_name 
                  FROM " . $this->table . " r 
                  LEFT JOIN categories c ON r.category_id = c.id
                  WHERE r.user_id = :user_id 
                  ORDER BY r.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Filter the logged-in user's recipes by a specific category.

    public function getRecipesByCategory($user_id, $category_id) {
        $query = "SELECT r.*, c.name as category_name 
                  FROM " . $this->table . " r 
                  LEFT JOIN categories c ON r.category_id = c.id
                  WHERE r.user_id = :user_id AND r.category_id = :category_id 
                  ORDER BY r.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    // Create and store a new recipe in the database.
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

    // Update an existing recipe's information.
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

    // Permanently delete a recipe from the database.
    public function deleteRecipe($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Search for recipes by title or ingredients.
    public function searchRecipes($term) {
        $searchTerm = "%" . htmlspecialchars($term) . "%";
        
        $query = "SELECT r.*, c.name as category_name, u.username 
                  FROM " . $this->table . " r
                  LEFT JOIN categories c ON r.category_id = c.id
                  LEFT JOIN users u ON r.user_id = u.id
                  WHERE r.title LIKE :term OR r.ingredients LIKE :term
                  ORDER BY r.created_at DESC";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":term", $searchTerm);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    // Add a recipe to user's favorites with validation to prevent duplicates.
    public function addFavorite($user_id, $recipe_id) {
        // Check if already in favorites
        $query = "SELECT COUNT(*) FROM favorites WHERE user_id = :u AND recipe_id = :r";
        $checkStmt = $this->conn->prepare($query);
        $checkStmt->execute([':u' => $user_id, ':r' => $recipe_id]);

        if ($checkStmt->fetchColumn() == 0) {
            // Insert only if not found
            $query = "INSERT INTO favorites (user_id, recipe_id) VALUES (:u, :r)";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([':u' => $user_id, ':r' => $recipe_id]);
        }
        return false; 
    }

    // Remove a recipe from user's favorites.
    public function removeFavorite($user_id, $recipe_id) {
        $query = "DELETE FROM favorites WHERE user_id = :u AND recipe_id = :r";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':u' => $user_id, ':r' => $recipe_id]);
    }

    public function toggleFavorite($user_id, $recipe_id) {
        // Correction : Utilisation de $this->conn au lieu de $this->db
        $query = "SELECT id FROM favorites WHERE user_id = :user_id AND recipe_id = :recipe_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['user_id' => $user_id, 'recipe_id' => $recipe_id]);
        
        if ($stmt->fetch()) {
            // Unfavorite
            $query = "DELETE FROM favorites WHERE user_id = :user_id AND recipe_id = :recipe_id";
        } else {
            // Favorite
            $query = "INSERT INTO favorites (user_id, recipe_id) VALUES (:user_id, :recipe_id)";
        }
        
        return $this->conn->prepare($query)->execute([
            'user_id' => $user_id,
            'recipe_id' => $recipe_id
        ]);
    }

    /**
     * Récupérer les recettes favorites d'un utilisateur avec les détails
     */
    public function getUserFavorites($user_id) {
        // Jointure pour récupérer le nom de la catégorie et l'auteur
        $query = "SELECT r.*, c.name as category_name, u.username 
                  FROM favorites f
                  JOIN recipes r ON f.recipe_id = r.id
                  LEFT JOIN categories c ON r.category_id = c.id
                  LEFT JOIN users u ON r.user_id = u.id
                  WHERE f.user_id = :user_id
                  ORDER BY f.created_at DESC";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Vérifier si une recette est déjà en favori (pour l'icône)
     */
    public function isFavorite($user_id, $recipe_id) {
        $query = "SELECT COUNT(*) FROM favorites WHERE user_id = :u AND recipe_id = :r";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':u' => $user_id, ':r' => $recipe_id]);
        return $stmt->fetchColumn() > 0;
    }
}