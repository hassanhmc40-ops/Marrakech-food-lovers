<?php
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Recipe.php';

class CategoryController {
    private $categoryModel;
    private $recipeModel;

    public function __construct() {
        $this->categoryModel = new Category();
        $this->recipeModel = new Recipe();
    }

    public function index() {
        $categories = $this->categoryModel->getAllCategories();
        $recipes = $this->recipeModel->getAllRecipes();
        require_once __DIR__ . '/../views/recipes/index.php';
    }

    public function filterByCategory($id) { 

    $categories = $this->categoryModel->getAllCategories();

    if ($id && !empty($id)) {
        $category_id = (int) $id;
        $recipes = $this->recipeModel->getRecipesByCategory($_SESSION['user_id'], $category_id);
    } else {
        $recipes = $this->recipeModel->getRecipesByUser($_SESSION['user_id']);
    }

    require_once __DIR__ . '/../views/recipes/index.php';
}
}
?>