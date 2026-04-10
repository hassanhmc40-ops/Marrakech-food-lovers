<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="mb-5 text-center">
    <h1 class="brand-font display-4">Community Discoveries</h1>
    <p class="text-muted">Explore manuscripts from other culinary curators</p>
</div>

<div class="row g-4">
    <?php foreach($recipes as $recipe): ?>
    <div class="col-md-4">
        <div class="card recipe-card h-100 shadow-sm p-4">
            <div class="d-flex justify-content-between mb-3">
                <span class="badge-category"><?= $recipe['category_name'] ?></span>
                <a href="#" class="text-muted"><i class="bi bi-heart"></i></a>
            </div>
            <h4 class="brand-font"><?= $recipe['title'] ?></h4>
            <p class="small text-muted mb-4">By <strong>@<?= $recipe['username'] ?></strong></p>
            
            <div class="mt-auto d-flex justify-content-between align-items-center">
                <span class="small"><i class="bi bi-clock me-1"></i> <?= $recipe['prep_time'] ?> min</span>
                <a href="index.php?action=showRecipe&id=<?= $recipe['id'] ?>" class="btn btn-sm btn-dark rounded-0 px-3">View</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>