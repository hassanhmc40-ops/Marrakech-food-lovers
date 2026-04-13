<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="header-main-title">Community Discoveries</h1>
        <p class="header-sub-title">Explore culinary Recipe from other curators</p>
    </div>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-light border-0 shadow-sm rounded-3 mb-5 py-3 px-4 text-start">
            <i class="bi bi-info-circle-fill text-gold me-2"></i> 
            <span class="small fw-bold text-uppercase ls-1">Archive Update:</span> The collection has been refreshed.
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php foreach($recipes as $recipe): ?>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-start transition-hover">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge-category"><?= htmlspecialchars($recipe['category_name']) ?></span>
                    
                    <a href="index.php?action=toggleFavorite&id=<?= $recipe['id'] ?>" class="text-decoration-none">
                        <?php if ($this->recipeModel->isFavorite($_SESSION['user_id'], $recipe['id'])): ?>
                            <i class="bi bi-heart-fill text-danger fs-5"></i>
                        <?php else: ?>
                            <i class="bi bi-heart text-muted fs-5"></i>
                        <?php endif; ?>
                    </a>
                </div>
                
                <h4 class="fw-bold text-dark mb-1 brand-font lh-sm"><?= htmlspecialchars($recipe['title']) ?></h4>
                <p class="small text-muted mb-4 ls-1">Curated by <strong>@<?= htmlspecialchars($recipe['username']) ?></strong></p>
                
                <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top border-light-subtle">
                    <div class="d-flex align-items-center gap-3">
                        <span class="small text-muted">
                            <i class="bi bi-stopwatch me-1"></i> 
                             <?= $this->formatRecipeTime($recipe['prep_time']) ?>
                        </span>
                        <span class="small text-muted fw-bold" style="font-size: 0.7rem;">
                            <i class="bi bi-egg-fried text-gold me-1"></i> <?= $recipe['servings'] ?> PERS
                        </span>
                    </div>
                    
                   <a href="index.php?action=showRecipe&id=<?= $recipe['id'] ?>&from=explore" class="btn btn-sm btn-dark rounded-pill px-3 fw-bold shadow-sm">VIEW</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>



<?php include __DIR__ . '/../layout/footer.php'; ?>