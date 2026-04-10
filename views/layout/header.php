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
        
        <nav class="d-flex align-items-center">
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="index.php?action=explore" class="nav-link px-3 fw-bold text-gold small text-uppercase">Explorer</a>
        
        <a href="index.php?action=recipes" class="nav-link px-3 fw-light text-uppercase small">Mes Recettes</a>
        
        <div class="ms-3 border-start ps-3">
            <strong class="small text-uppercase"><?= htmlspecialchars($_SESSION['username']) ?></strong>
            <a href="index.php?action=logout" class="ms-2 text-danger small fw-bold text-decoration-none">DECONNEXION</a>
        </div>
    
        <?php endif; ?>
</nav>
</header>

<main class="content-container">

