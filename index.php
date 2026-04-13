<?php
session_start();

require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/RecipeController.php';
require_once __DIR__ . '/controllers/CategoryController.php';

$action = $_GET['action'] ?? 'login';
$id = $_GET['id'] ?? null;

$public_actions = ['login', 'register'];

// --- AUTHENTICATION GUARD ---
if (!isset($_SESSION['user_id']) && !in_array($action, $public_actions)) {
    header('Location: index.php?action=login');
    exit();
}

if (isset($_SESSION['user_id']) && in_array($action, $public_actions)) {
    header('Location: index.php?action=recipes');
    exit();
}

$recipeController = new RecipeController();
$authController = new AuthController();
$categoryController = new CategoryController();

switch ($action) {
    // AUTH
    case 'login':
        ($_SERVER['REQUEST_METHOD'] === 'POST') ? $authController->login() : $authController->showLogin();
        break;
    case 'register':
        ($_SERVER['REQUEST_METHOD'] === 'POST') ? $authController->register() : $authController->showRegister();
        break;
    case 'logout':
        $authController->logout();
        break;

    // NAVIGATION PRINCIPALE
    case 'recipes':
    case 'myRecipes':
        $recipeController->index();
        break;
    case 'explore':
        $recipeController->explore();
        break;
    case 'myFavorites':
        $recipeController->showFavorites();
        break;
    case 'toggleFavorite':
        if ($id) $recipeController->toggleFavorite($id);
        break;

    // CRUD RECETTES
    case 'showRecipe':
        $recipeController->show($id); 
        break;
    case 'createRecipe':
        $recipeController->create();
        break;
    case 'storeRecipe':
        $recipeController->store();
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

    // FILTRES & RECHERCHE
    case 'filterByCategory':
        $categoryController->filterByCategory($id);
        break;
    case 'search':
        $recipeController->search();
        break;

    default:
        http_response_code(404);
        echo "404 - Archive not found.";
}