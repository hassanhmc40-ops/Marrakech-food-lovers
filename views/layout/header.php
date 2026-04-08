<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marrakech Food Lovers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="bg-dark text-light">

<header class="navbar navbar-expand-lg navbar-dark sticky-top custom-nav">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <span class="brand-gold">MARRAKECH</span> FOOD LOVERS
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                    <li class="nav-item ms-lg-3 d-flex align-items-center">
                        <span class="nav-text text-secondary me-2 small">
                            Bienvenue, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
                        </span>
                        <a href="index.php?action=logout" class="btn btn-outline-gold btn-sm">Déconnexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>

<main class="container my-5">