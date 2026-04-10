<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5">
    <div class="mb-4">
        <a href="index.php?action=recipes" class="text-muted text-decoration-none small">
            <i class="bi bi-arrow-left me-1"></i> BACK TO ARCHIVE
        </a>
    </div>

    <div class="row g-5">
        <div class="col-md-4">
            <div class="p-4 bg-white shadow-sm border-top border-4 border-gold">
                <span class="badge-category mb-3 d-inline-block"><?= htmlspecialchars($recipe['category_name']) ?></span>
                <h1 class="brand-font mb-4"><?= htmlspecialchars($recipe['title']) ?></h1>
                
                <div class="recipe-meta mb-4">
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span class="text-muted small">Prep Time</span>
                        <span class="fw-bold"><?= $recipe['prep_time'] ?> min</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span class="text-muted small">Servings</span>
                        <span class="fw-bold"><?= $recipe['servings'] ?> pers</span>
                    </div>
                    <div class="d-flex justify-content-between py-2">
                        <span class="text-muted small">Curated by</span>
                        <span class="fw-bold">@<?= htmlspecialchars($recipe['username'] ?? 'Chef') ?></span>
                    </div>
                </div>

                <a href="index.php?action=editRecipe&id=<?= $recipe['id'] ?>" class="btn btn-outline-dark w-100 rounded-0 mb-2">
                    Edit Manuscript
                </a>
            </div>
        </div>

        <div class="col-md-8">
            <div class="bg-white p-5 shadow-sm">
                <section class="mb-5">
                    <h5 class="text-uppercase ls-2 mb-4 border-bottom pb-2">Ingredients</h5>
                    <div class="lh-lg" style="white-space: pre-line;">
                        <?= htmlspecialchars($recipe['ingredients']) ?>
                    </div>
                </section>

                <section>
                    <h5 class="text-uppercase ls-2 mb-4 border-bottom pb-2">Instructions</h5>
                    <div class="lh-lg" style="white-space: pre-line;">
                        <?= htmlspecialchars($recipe['instructions']) ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>