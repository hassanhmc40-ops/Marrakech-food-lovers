<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="recipe-detail">
    <div class="auth-card">
        <a href="index.php" class="text-gold small text-decoration-none">← Retour aux recettes</a>
        
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

        <hr class="separator my-4">

        <?php if (isset($_SESSION['user_id']) && $recipe['user_id'] == $_SESSION['user_id']): ?>
            <div class="recipe-actions d-flex gap-2">
                <a href="index.php?action=edit&id=<?= $recipe['id'] ?>" class="btn-edit">Modifier la recette</a>
                
                <a href="index.php?action=delete&id=<?= $recipe['id'] ?>" 
                   class="btn-delete" 
                   onclick="return confirm('Es-tu sûr de vouloir supprimer cette recette ?');">
                   Supprimer
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>