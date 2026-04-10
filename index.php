<?php

session_start();

require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/RecipeController.php';
require_once __DIR__ . '/controllers/CategoryController.php';

$action = $_GET['action'] ?? 'login';
$id = $_GET['id'] ?? null;

$public_actions = ['login', 'register', 'auth_login', 'auth_register'];

// Authentication Guard
if (!isset($_SESSION['user_id']) && !in_array($action, $public_actions)) {
    $authController = new AuthController();
    $authController->showLogin();
    exit();
}

if (isset($_SESSION['user_id']) && $action === 'login') {
    header('Location: index.php?action=recipes');
    exit();
}

$recipeController = new RecipeController(); // On l'instancie une fois pour gagner en clarté

switch ($action) {
    // --- AUTHENTICATION ---
    case 'login':
        $controller = new AuthController();
        ($_SERVER['REQUEST_METHOD'] === 'POST') ? $controller->login() : $controller->showLogin();
        break;

    case 'register':
        $controller = new AuthController();
        ($_SERVER['REQUEST_METHOD'] === 'POST') ? $controller->register() : $controller->showRegister();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;

    // --- RECIPE MANAGEMENT ---
    case 'recipes':
    case 'myRecipes':
        $recipeController->index();
        break;

    // --- FAVORITES (CORRECTION ICI) ---
    case 'toggleFavorite':
        if ($id) {
            $recipeController->toggleFavorite($id);
        }
        break;

    case 'myFavorites':
        $recipeController->showFavorites();
        break;

    case 'search':
        $recipeController->search();
        break;

    case 'createRecipe':
        $recipeController->create();
        break;

    case 'storeRecipe':
        $recipeController->store();
        break;

    case 'showRecipe':
        $recipeController->show($id); 
        break;

    case 'editRecipe':
        $recipeController->edit($id);
        break;

    case 'updateRecipe':
        $recipeController->update($id);
        break;

    case 'deleteRecipe':
        $recipeController->delete($id);
        break;

    // --- CATEGORIES & EXPLORE ---
    case 'filterByCategory':
        (new CategoryController())->filterByCategory($id);
        break;

    case 'explore':
        $recipeController->explore();
        break;

    default:
        http_response_code(404); // Correction : 404 est le code standard pour Not Found
        echo "Page not found.";
}