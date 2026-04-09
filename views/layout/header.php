<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marrakech Food Lovers</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="bg-dark text-light">

<header class="main-header">
    <div class="nav-wrapper">
        <a href="index.php" class="logo">
            <span class="brand-gold">MARRAKECH</span> FOOD LOVERS
        </a>
        
        <nav class="nav-menu">
            <ul class="nav-list">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="index.php?action=recipes" class="nav-link">Accueil</a></li>
                    <li class="user-controls">
                        <span class="welcome-text">
                            Bienvenue, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
                        </span>
                        <a href="index.php?action=logout" class="btn-logout">Déconnexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<main class="content-container">