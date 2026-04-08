<?php
require_once __DIR__ . '/../models/Recipe.php';

class RecipeController {
    private $recipeModel;

    public function __construct() {
        $this->recipeModel = new Recipe();
    }

    
    public function index() {
        $recipes = $this->recipeModel->getAllRecipes();
        include __DIR__ . '/../views/recipes/index.php';
    }

 
    public function show($id) {
        $recipe = $this->recipeModel->getRecipeById($id);
        if ($recipe) {
            include __DIR__ . '/../views/recipes/show.php';
        } else {
            header('Location: index.php?error=not_found');
        }
    }

    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            
            
            $user_id = $_SESSION['user_id'];
            
            $data = [
                'category_id'  => $_POST['category_id'],
                'title'        => $_POST['title'],
                'ingredients'  => $_POST['ingredients'],
                'instructions' => $_POST['instructions'],
                'prep_time'    => $_POST['prep_time'],
                'servings'     => $_POST['servings']
            ];

            $success = $this->recipeModel->createRecipe(
                $user_id, 
                $data['category_id'], 
                $data['title'], 
                $data['ingredients'], 
                $data['instructions'], 
                $data['prep_time'], 
                $data['servings']
            );
            if (empty($title) || empty($ingredients) || empty($instructions) || empty($category_id)) {
                $error = "Veuillez remplir tous les champs obligatoires";
                include __DIR__ . '/../views/recipes/create.php';
                return;
            }

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
        session_start();
        $recipe = $this->recipeModel->getRecipeById($id);


        if ($recipe && $recipe['user_id'] == $_SESSION['user_id']) {
            include __DIR__ . '/../views/recipes/edit.php';
        } else {
            header('Location: index.php?error=unauthorized');
            exit();
        }
    }

    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $recipe = $this->recipeModel->getRecipeById($id);


            if ($recipe && $recipe['user_id'] == $_SESSION['user_id']) {
                $category_id = $_POST['category_id'];
                $title = $_POST['title'];
                $ingredients = $_POST['ingredients'];
                $instructions = $_POST['instructions'];
                $prep_time = $_POST['prep_time'];
                $servings = $_POST['servings'];

                $success = $this->recipeModel->updateRecipe( 
                    $id,
                    $category_id, 
                    $title,
                    $ingredients,
                    $instructions,
                    $prep_time,
                    $servings
                );

                if (empty($title) || empty($ingredients) || empty($instructions)) {
                    $error = "Les champs ne peuvent pas être vides lors de la modification.";
                    include __DIR__ . '/../views/recipes/edit.php';
                    return;
                }

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
}