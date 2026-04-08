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

    public function filterByCategory() {
        $categories = $this->categoryModel->getAllCategories();

        if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
            $category_id = (int) $_GET['category_id'];
            $recipes = $this->recipeModel->getRecipesByCategory($category_id);
        } else {
            $recipes = $this->recipeModel->getAllRecipes();
        }

        require_once __DIR__ . '/../views/recipes/index.php';
    }
}
?>