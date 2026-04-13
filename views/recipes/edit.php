<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container-fluid py-5 px-md-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="header-main-title mb-0">Edit Recipe</h1>
            <p class="header-sub-title mb-0">MARRAKECH FOOD LOVERS EDITION</p>
        </div>
        <a href="index.php?action=recipes" class="btn btn-outline-secondary shadow-sm px-4">
            <i class="bi bi-arrow-left me-2"></i> BACK TO ARCHIVE
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="sidebar-header py-3 px-4">Recipe Details</div>
                
                <div class="card-body p-4 p-md-5 bg-white">
                    <form action="index.php?action=updateRecipe&id=<?= $recipe['id'] ?>" method="POST">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label small text-uppercase fw-bold text-muted">Recipe Title</label>
                                <input type="text" name="title" class="form-control form-control-lg border-2 shadow-none" 
                                       value="<?= htmlspecialchars($recipe['title']) ?>" placeholder="e.g. Traditional Lamb Tagine" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small text-uppercase fw-bold text-muted">Prep Time (min)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-2"><i class="bi bi-clock"></i></span>
                                    <input type="number" name="prep_time" class="form-control border-2 shadow-none" 
                                           value="<?= $recipe['prep_time'] ?>" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small text-uppercase fw-bold text-muted">Servings</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-2"><i class="bi bi-people"></i></span>
                                    <input type="number" name="servings" class="form-control border-2 shadow-none" 
                                           value="<?= $recipe['servings'] ?>" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small text-uppercase fw-bold text-muted">Category</label>
                                <select name="category_id" class="form-select border-2 shadow-none" required>
                                    <?php foreach($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $recipe['category_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($cat['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label small text-uppercase fw-bold text-muted">Ingredients</label>
                                <textarea name="ingredients" class="form-control border-2 shadow-none" rows="6" 
                                          placeholder="List ingredients line by line..." required><?= htmlspecialchars($recipe['ingredients']) ?></textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label small text-uppercase fw-bold text-muted">Instructions</label>
                                <textarea name="instructions" class="form-control border-2 shadow-none" rows="10" 
                                          placeholder="Describe the cooking process..." required><?= htmlspecialchars($recipe['instructions']) ?></textarea>
                            </div>

                            <div class="col-12 pt-4 border-top mt-5">
                                <div class="d-flex justify-content-end align-items-center gap-3">
                                    <a href="index.php?action=recipes" class="text-muted fw-bold text-decoration-none me-3">
                                        DISCARD CHANGES
                                    </a>
                                    <button type="submit" class="btn btn-gold-archive px-5 py-3 shadow-sm">
                                        <i class="bi bi-journal-check me-2"></i> UPDATE Recipe
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>