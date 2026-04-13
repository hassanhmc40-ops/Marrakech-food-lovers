<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marrakech Food Lovers | Digital Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<?php if (isset($_SESSION['user_id'])): ?>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 sticky-top">
    <div class="container-fluid px-md-5">
        <a class="navbar-brand brand-font fs-3 fw-bold" href="index.php">
            Marrakech <span style="color: var(--gold-main);">Food Lovers</span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto gap-lg-4 text-uppercase small fw-bold">
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['action']) && $_GET['action'] == 'explore') ? 'active text-gold' : '' ?>" href="index.php?action=explore">Explore</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['action']) && $_GET['action'] == 'recipes') ? 'active text-gold' : '' ?>" href="index.php?action=recipes">My Recipes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['action']) && $_GET['action'] == 'myFavorites') ? 'active text-gold' : '' ?>" href="index.php?action=myFavorites">Favorites</a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-3">
                <span class="small text-muted">@<?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="index.php?action=logout" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-bold">LOGOUT</a>
            </div>
        </div>
    </div>
</nav>
<?php endif; ?>

<main class="min-vh-100">