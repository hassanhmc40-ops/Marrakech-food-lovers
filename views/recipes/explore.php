<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="mb-5 text-center">
    <h1 class="brand-font display-4">Explore Community Recipes</h1>
    <p class="text-muted">Discover authentic flavors from other food lovers</p>
</div>

<div class="row g-4">
    <?php if (!empty($recipes)): ?>
        <?php foreach ($recipes as $recipe): ?>
            <div class="col-md-4">
                <div class="card h-100 recipe-card p-3 shadow-sm border-0">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-gold small fw-bold text-uppercase">
                            <?= htmlspecialchars($recipe['category_name'] ?? 'Cuisine') ?>
                        </span>
                        <span class="badge bg-light text-dark">
                            By <?= htmlspecialchars($recipe['username']) ?>
                        </span>
                    </div>
                    
                    <h4 class="brand-font"><?= htmlspecialchars($recipe['title']); ?></h4>
                    <p class="text-muted small"><?= $recipe['prep_time']; ?> min | <?= $recipe['servings']; ?> pers.</p>
                    
                    <div class="mt-auto d-flex gap-2 border-top pt-3">
                        <a href="index.php?action=showRecipe&id=<?= $recipe['id']; ?>" class="btn btn-sm btn-dark w-100">View Recipe</a>
                        <button class="btn btn-sm btn-outline-danger">❤️</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <p class="text-muted fs-5 italic">No community recipes available yet.</p>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>