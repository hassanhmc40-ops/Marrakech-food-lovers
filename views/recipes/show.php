<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="recipe-detail">
    <div class="auth-card">
        <a href="index.php?action=recipes" class="text-gold small text-decoration-none">← Retour aux recettes</a>
        
        <h1 class="brand-gold mt-3"><?= htmlspecialchars($recipe['title']) ?></h1>
        
        <div class="recipe-meta mb-4">
            <span class="badge-gold">Temps : <?= htmlspecialchars($recipe['prep_time']) ?> min</span>
            <span class="badge-gold">Portions : <?= htmlspecialchars($recipe['servings']) ?> pers.</span>
        </div>

        <div class="row">
            <div class="col-section">
                <h3 class="text-light">Ingrédients</h3>
                <p class="text-secondary">
                    <?= nl2br(htmlspecialchars($recipe['ingredients'])) ?>
                </p>
            </div>

            <div class="col-section mt-4">
                <h3 class="text-light">Instructions</h3>
                <p class="text-secondary">
                    <?= nl2br(htmlspecialchars($recipe['instructions'])) ?>
                </p>
            </div>
        </div>



<?php require_once __DIR__ . '/../layout/footer.php'; ?>