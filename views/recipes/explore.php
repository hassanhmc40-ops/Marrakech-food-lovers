<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="mb-5 text-center">
    <h1 class="brand-font display-4">Community Discoveries</h1>
    <p class="text-muted text-uppercase small ls-2">Explore manuscripts from other culinary curators</p>
</div>

<?php if (isset($_GET['msg'])): ?>
    <div class="alert alert-archive mb-4">
        <i class="bi bi-check2-circle me-2"></i> Collection updated.
    </div>
<?php endif; ?>

<div class="row g-4">
    <?php foreach($recipes as $recipe): ?>
    <div class="col-md-4">
        <div class="card recipe-card h-100 shadow-sm p-4 border-0">
            <div class="d-flex justify-content-between mb-3">
                <span class="badge-category"><?= htmlspecialchars($recipe['category_name']) ?></span>
                
                <a href="index.php?action=toggleFavorite&id=<?= $recipe['id'] ?>" class="text-decoration-none">
                    <?php if ($this->recipeModel->isFavorite($_SESSION['user_id'], $recipe['id'])): ?>
                        <i class="bi bi-heart-fill text-danger"></i>
                    <?php else: ?>
                        <i class="bi bi-heart text-muted"></i>
                    <?php endif; ?>
                </a>
            </div>
            
            <h4 class="brand-font"><?= htmlspecialchars($recipe['title']) ?></h4>
            <p class="small text-muted mb-4">By <strong>@<?= htmlspecialchars($recipe['username']) ?></strong></p>
            
            <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top">
                <span class="small text-muted"><i class="bi bi-clock me-1"></i> <?= $recipe['prep_time'] ?> min</span>
                <a href="index.php?action=showRecipe&id=<?= $recipe['id'] ?>" class="btn btn-sm btn-dark rounded-0 px-3">View</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>