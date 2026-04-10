<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-white p-5 shadow-sm">
                <h1 class="brand-font mb-2">Edit Manuscript</h1>
                <p class="text-muted small text-uppercase ls-2 mb-5 border-bottom pb-3">Marrakech Food Lovers Edition</p>

                <form action="index.php?action=updateRecipe&id=<?= $recipe['id'] ?>" method="POST">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <label class="form-label small text-uppercase fw-bold">Recipe Title</label>
                            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($recipe['title']) ?>" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label small text-uppercase fw-bold">Prep Time (min)</label>
                            <input type="number" name="prep_time" class="form-control" value="<?= $recipe['prep_time'] ?>" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label small text-uppercase fw-bold">Servings</label>
                            <input type="number" name="servings" class="form-control" value="<?= $recipe['servings'] ?>" required>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label small text-uppercase fw-bold">Category</label>
                            <select name="category_id" class="form-select" required>
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $recipe['category_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label small text-uppercase fw-bold">Ingredients</label>
                            <textarea name="ingredients" class="form-control" rows="5" required><?= htmlspecialchars($recipe['ingredients']) ?></textarea>
                        </div>

                        <div class="col-12 mb-5">
                            <label class="form-label small text-uppercase fw-bold">Instructions</label>
                            <textarea name="instructions" class="form-control" rows="8" required><?= htmlspecialchars($recipe['instructions']) ?></textarea>
                        </div>

                        <div class="col-12 d-flex justify-content-between">
                            <a href="index.php?action=recipes" class="btn btn-link text-dark text-decoration-none px-0">Cancel</a>
                            <button type="submit" class="btn btn-gold">Update Manuscript</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>