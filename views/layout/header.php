<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culinary Curator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3">
    <div class="container">
        <a class="navbar-brand" href="index.php">Culinary Curator</a>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav gap-4">
                    <li class="nav-item"><a class="nav-link <?= $action == 'explore' ? 'active' : '' ?>" href="index.php?action=explore">Explore</a></li>
                    <li class="nav-item"><a class="nav-link <?= $action == 'recipes' ? 'active' : '' ?>" href="index.php?action=recipes">My Recipes</a></li>
                    <li class="nav-item"><a class="nav-link <?= $action == 'myFavorites' ? 'active' : '' ?>" href="index.php?action=myFavorites">Favorites</a></li>
                </ul>
            </div>
        <?php endif; ?>

        <div class="d-flex align-items-center gap-3">
            <?php if (isset($_SESSION['username'])): ?>
                <span class="small text-muted">
                    <i class="bi bi-person-circle me-1"></i> 
                    <?= htmlspecialchars($_SESSION['username']) ?>
                </span>
                <a href="index.php?action=logout" class="btn btn-sm btn-outline-dark rounded-0">Logout</a>
            <?php else: ?>
                <a href="index.php?action=login" class="nav-link small">Login</a>
                <a href="index.php?action=register" class="btn btn-sm btn-gold rounded-0">Join</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container mt-5">