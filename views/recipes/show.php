<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="text-center mb-5">
            <span class="badge-category mb-3 d-inline-block"><?= htmlspecialchars($recipe['category_name']) ?></span>
            <h1 class="brand-font display-3 mb-3"><?= htmlspecialchars($recipe['title']) ?></h1>
            <p class="text-muted text-uppercase small ls-2">Curated by <?= htmlspecialchars($recipe['username'] ?? $_SESSION['username']) ?></p>
            
            <div class="d-flex justify-content-center gap-4 mt-4 border-top border-bottom py-3">
                <div class="text-center">
                    <span class="d-block small text-muted text-uppercase">Prep Time</span>
                    <span class="fw-bold"><?= $recipe['prep_time'] ?> min</span>
                </div>
                <div class="vr"></div>
                <div class="text-center">
                    <span class="d-block small text-muted text-uppercase">Servings</span>
                    <span class="fw-bold"><?= $recipe['servings'] ?> pers</span>
                </div>
                <div class="vr"></div>
                <div class="text-center">
                    <span class="d-block small text-muted text-uppercase">Date</span>
                    <span class="fw-bold"><?= date('d.m.Y', strtotime($recipe['created_at'])) ?></span>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-md-4">
                <div class="p-4 bg-white shadow-sm border-top border-gold border-3">
                    <h4 class="brand-font mb-4">Ingredients</h4>
                    <div class="lh-lg" style="white-space: pre-line;">
                        <?= htmlspecialchars($recipe['ingredients']) ?>
                    </div>
                </div>
                
                <?php if($recipe['user_id'] == $_SESSION['user_id']): ?>
                <div class="mt-4 d-grid gap-2">
                    <a href="index.php?action=editRecipe&id=<?= $recipe['id'] ?>" class="btn btn-outline-dark rounded-0">Edit Manuscript</a>
                </div>
                <?php endif; ?>
            </div>

            <div class="col-md-8">
                <h4 class="brand-font mb-4">Instructions</h4>
                <div class="lh-lg fs-5 text-secondary" style="white-space: pre-line;">
                    <?= htmlspecialchars($recipe['instructions']) ?>
                </div>
                
                <div class="mt-5 pt-5 border-top">
                    <a href="index.php?action=recipes" class="text-dark text-decoration-none small text-uppercase fw-bold">
                        <i class="bi bi-arrow-left me-2"></i> Back to Archive
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>