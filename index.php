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
    case 'myRecipes': // Added to handle the first tab
        $controller = new RecipeController();
        $controller->index();
        break;

    case 'myFavorites': // Added for the Favorites tab
        $controller = new RecipeController();
        $controller->showFavorites(); // You need to create this method in RecipeController
        break;

    case 'search': // Added for the search bar
        $controller = new RecipeController();
        $controller->search(); // You need to create this method in RecipeController
        break;

    case 'createRecipe':
        (new RecipeController())->create();
        break;

    case 'storeRecipe':
        (new RecipeController())->store();
        break;

    case 'showRecipe':
        (new RecipeController())->show($id); 
        break;

    case 'editRecipe':
        (new RecipeController())->edit($id);
        break;

    case 'updateRecipe':
        (new RecipeController())->update($id);
        break;

    case 'deleteRecipe':
        (new RecipeController())->delete($id);
        break;

    // --- CATEGORIES & EXPLORE ---
    case 'filterByCategory':
        (new CategoryController())->filterByCategory($id);
        break;

    case 'explore':
        (new RecipeController())->explore();
        break;

    default:
        http_response_code(440);
        echo "Page not found.";
}