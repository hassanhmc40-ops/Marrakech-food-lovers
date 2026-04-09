<?php

session_start();

require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/RecipeController.php';
require_once __DIR__ . '/../controllers/CategoryController.php';

$action = $_GET['action'] ?? 'recipes';

switch ($action) {

    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'register':
        $controller = new AuthController();
        $controller->register();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'recipes':
        $controller = new RecipeController();
        $controller->index();
        break;

    case 'createRecipe':
        $controller = new RecipeController();
        $controller->create();
        break;

    case 'storeRecipe':
        $controller = new RecipeController();
        $controller->store();
        break;

    case 'editRecipe':
        $controller = new RecipeController();
        $controller->edit();
        break;

    case 'updateRecipe':
        $controller = new RecipeController();
        $controller->update();
        break;

    case 'deleteRecipe':
        $controller = new RecipeController();
        $controller->delete();
        break;

    case 'filterByCategory':
        $controller = new CategoryController();
        $controller->filterByCategory();
        break;

    default:
        echo "Page not found.";
}