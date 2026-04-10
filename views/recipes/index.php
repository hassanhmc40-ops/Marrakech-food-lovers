<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-5">
    <h1 class="brand-font">Mes Recettes</h1>
    <a href="index.php?action=createRecipe" class="btn btn-gold">+ Ajouter</a>
</div>

<div class="row mb-5">
    <div class="col-md-6">
        <form action="index.php" method="GET" class="d-flex gap-2">
            <input type="hidden" name="action" value="filterByCategory">
            <select name="id" class="form-select border-gold-focus" onchange="this.form.submit()">
                <option value="">Toutes les catégories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= (isset($_GET['id']) && $_GET['id'] == $cat['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
</div>

<div class="row g-4">
    <?php if (!empty($recipes)): ?>
        <?php foreach ($recipes as $recipe): ?>
            <div class="col-md-4">
                <div class="card h-100 recipe-card p-3 shadow-sm">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-gold small fw-bold text-uppercase">
                            <?= htmlspecialchars($recipe['category_name'] ) ?>
                        </span>
                    </div>
                    <h4 class="brand-font"><?= htmlspecialchars($recipe['title']); ?></h4>
                    <p class="text-muted small"><?= $recipe['prep_time']; ?> min | <?= $recipe['servings']; ?> pers.</p>
                    
                    <div class="mt-auto d-flex gap-2 border-top pt-3">
                        <a href="index.php?action=showRecipe&id=<?= $recipe['id']; ?>" class="btn btn-sm btn-outline-dark">Voir</a>
                        <a href="index.php?action=editRecipe&id=<?= $recipe['id']; ?>" class="btn btn-sm btn-outline-secondary">Éditer</a>
                        <a href="index.php?action=deleteRecipe&id=<?= $recipe['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ?');">X</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center italic">Vous n'avez pas encore de recettes dans cette catégorie.</p>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>