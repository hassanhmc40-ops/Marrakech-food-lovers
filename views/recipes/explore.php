<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="text-center mb-5">
    <h6 class="text-gold fw-bold mb-2">COMMUNAUTÉ</h6>
    <h1 class="brand-font display-4">LE MUR DES SAVEURS</h1>
    <div class="bg-gold mx-auto" style="width: 60px; height: 2px;"></div>
</div>
<div class="row mb-5 justify-content-center">
    <div class="col-md-6 text-center">
        <form action="index.php" method="GET" class="d-flex gap-2 justify-content-center">
            <input type="hidden" name="action" value="filterByCategory">
            
            <select name="id" class="form-select shadow-none border-gold-focus" style="max-width: 300px; border-radius: 0;">
                <option value="">Toutes les catégories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= (isset($_GET['id']) && $_GET['id'] == $cat['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <button type="submit" class="btn btn-gold px-4">FILTRER</button>
        </form>
    </div>
</div>
<div class="row g-4">
    <?php foreach ($recipes as $recipe): ?>
    <div class="col-md-4">
        <div class="card h-100 recipe-card p-4">
            <div class="d-flex justify-content-between mb-3">
                <span class="badge bg-light text-gold border"><?= htmlspecialchars($recipe['category_name']) ?></span>
                <span class="small text-muted italic">Par <?= htmlspecialchars($recipe['username'] ?? 'Chef Anonyme') ?></span>
            </div>
            
            <h4 class="brand-font mb-3"><?= htmlspecialchars($recipe['title']) ?></h4>
            <p class="text-muted small mb-4"><?= substr(htmlspecialchars($recipe['ingredients']), 0, 70) ?>...</p>
            
            <div class="mt-auto pt-3 border-top">
                <a href="index.php?action=showRecipe&id=<?= $recipe['id'] ?>" class="btn btn-link text-dark p-0 fw-bold small text-decoration-none border-bottom border-dark">DÉCOUVRIR LA RECETTE</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>