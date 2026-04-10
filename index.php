<?php

session_start();

require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/RecipeController.php';
require_once __DIR__ . '/controllers/CategoryController.php';

$action = $_GET['action'] ?? 'login';
$id = $_GET['id'] ?? null;

$public_actions = ['login', 'register', 'auth_login', 'auth_register'];

if (!isset($_SESSION['user_id']) && !in_array($action, $public_actions)) {
    // Si pas connecté et action non publique -> Direction Login
    $authController = new AuthController();
    $authController->showLogin();
    exit();
}
if (isset($_SESSION['user_id']) && $action === 'login') {
    header('Location: index.php?action=recipes');
    exit();
}

switch ($action) {

    case 'login':
        $controller = new AuthController();
        // Si on arrive en GET (lien), on affiche. Si on arrive en POST, on traite.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login();
        } else {
            $controller->showLogin();
        }
        break;

    case 'register':
        $controller = new AuthController();
        // C'EST ICI : Si c'est juste un clic sur le lien, on affiche le formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->register();
        } else {
            $controller->showRegister();
        }
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
    case 'showRecipe':
    $controller = new RecipeController();
    $controller->show($id); 
    break;

    case 'editRecipe':
        $controller = new RecipeController();
        $controller->edit($id);
        break;

    case 'updateRecipe':
        $controller = new RecipeController();
        $controller->update($id);
        break;

    case 'deleteRecipe':
        $controller = new RecipeController();
        $controller->delete($id);
        break;

    case 'filterByCategory':
        $controller = new CategoryController();
        $controller->filterByCategory($id);
        break;

    case 'explore':
    $controller = new RecipeController(); 
    $controller->explore();
    break;

    default:
        echo "Page not found.";
}