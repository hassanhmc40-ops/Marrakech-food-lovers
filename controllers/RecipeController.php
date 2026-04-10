<?php
require_once __DIR__ . '/../models/Recipe.php';
require_once __DIR__ . '/../models/Category.php';

class RecipeController {
    private $recipeModel;

    public function __construct() {
        $this->recipeModel = new Recipe();
    }

    
    public function index() {
    // Affiche uniquement les recettes de l'utilisateur connecté
    $recipes = $this->recipeModel->getRecipesByUser($_SESSION['user_id']);
    $categoryModel = new Category();
    $categories = $categoryModel->getAllCategories();
    include __DIR__ . '/../views/recipes/index.php';
}

    public function create() {
        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories();
        include __DIR__ . '/../views/recipes/create.php';
    }
 
    public function show($id) {
        $recipe = $this->recipeModel->getRecipeById($id);
        if ($recipe) {
            include __DIR__ . '/../views/recipes/show.php';
        } else {
            header('Location: index.php?action=recipes&error=not_found');
        }
    }

    
   public function store() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        
        $user_id = $_SESSION['user_id'];
        
        // Extraction des données pour faciliter la vérification
        $category_id  = $_POST['category_id'] ?? '';
        $title        = $_POST['title'] ?? '';
        $ingredients  = $_POST['ingredients'] ?? '';
        $instructions = $_POST['instructions'] ?? '';
        $prep_time    = $_POST['prep_time'] ?? 0;
        $servings     = $_POST['servings'] ?? 0;

        // VERIFICATION : On utilise les variables qu'on vient de créer
        if (empty($title) || empty($ingredients) || empty($instructions) || empty($category_id)) {
            $error = "Veuillez remplir tous les champs obligatoires";
            // Important : on doit aussi récupérer les catégories pour le formulaire de création
            $categoryModel = new Category();
            $categories = $categoryModel->getAllCategories();
            include __DIR__ . '/../views/recipes/create.php';
            return;
        }

        $success = $this->recipeModel->createRecipe(
            $user_id, 
            $category_id, 
            $title, 
            $ingredients, 
            $instructions, 
            $prep_time, 
            $servings
        );

        if ($success) {
            header('Location: index.php?msg=recipe_added');
            exit();
        } else {
            $error = "Impossible d'ajouter la recette.";
            include __DIR__ . '/../views/recipes/create.php';
        }
    }
}
    
    public function edit($id) {
         if (session_status() === PHP_SESSION_NONE){ session_start();}
        $recipe = $this->recipeModel->getRecipeById($id);

        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories();

        if ($recipe && $recipe['user_id'] == $_SESSION['user_id']) {
            include __DIR__ . '/../views/recipes/edit.php';
        } else {
            header('Location: index.php?error=unauthorized');
            exit();
        }
    }

    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             if (session_status() === PHP_SESSION_NONE){ session_start();}
            $recipe = $this->recipeModel->getRecipeById($id);


            if ($recipe && $recipe['user_id'] == $_SESSION['user_id']) {
                $category_id = $_POST['category_id'];
                $title = $_POST['title'];
                $ingredients = $_POST['ingredients'];
                $instructions = $_POST['instructions'];
                $prep_time = $_POST['prep_time'];
                $servings = $_POST['servings'];

               

                if (empty($title) || empty($ingredients) || empty($instructions)) {
                    $error = "Les champs ne peuvent pas être vides lors de la modification.";
                    include __DIR__ . '/../views/recipes/edit.php';
                    return;
                }
                 $success = $this->recipeModel->updateRecipe( 
                    $id,
                    $category_id, 
                    $title,
                    $ingredients,
                    $instructions,
                    $prep_time,
                    $servings
                );

                if ($success) {
                    header('Location: index.php?msg=updated');
                } else {
                    $error = "Erreur lors de la mise à jour.";
                    include __DIR__ . '/../views/recipes/edit.php';
                }
            } else {
                header('Location: index.php?error=unauthorized');
            }
            exit();
        }
    }
    
    public function delete($id) {
        if (session_status() === PHP_SESSION_NONE){ session_start();}
        session_start();
        $recipe = $this->recipeModel->getRecipeById($id);

        if ($recipe && $recipe['user_id'] == $_SESSION['user_id']) {
            $this->recipeModel->deleteRecipe($id);
            header('Location: index.php?msg=deleted');
        } else {
            header('Location: index.php?error=unauthorized');
        }
        exit();
    }
    public function explore() {
    $current_user_id = $_SESSION['user_id']; 
    $recipes = $this->recipeModel->getOthersRecipes($current_user_id); 
    
    $categoryModel = new Category();
    $categories = $categoryModel->getAllCategories();

    include __DIR__ . '/../views/recipes/explore.php';
}
// Handle the search logic
public function search() {
    $query = $_GET['query'] ?? '';
    $recipeModel = new Recipe();
    $categoryModel = new Category();
    
    $recipes = $recipeModel->searchRecipes($query);
    $categories = $categoryModel->getAllCategories();
    
    include __DIR__ . '/../views/recipes/index.php';
}

// Show the user's favorite recipes
public function showFavorites() {
    $recipeModel = new Recipe();
    $categoryModel = new Category();
    
    $recipes = $recipeModel->getUserFavorites($_SESSION['user_id']);
    $categories = $categoryModel->getAllCategories();
    
    include __DIR__ . '/../views/recipes/index.php';
}
public function toggleFavorite($recipe_id) {
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    
    $user_id = $_SESSION['user_id'];
    
    $success = $this->recipeModel->toggleFavorite($user_id, $recipe_id);

    if ($success) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        header('Location: index.php?action=explore&error=fav_failed');
    }
    exit();
}
}