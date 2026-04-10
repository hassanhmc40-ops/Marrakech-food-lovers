<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger border-0 rounded-0 shadow-sm mb-4 d-flex align-items-center" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        <div><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    </div>
<?php endif; ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-end mb-5 border-bottom pb-4">
            <div>
                <h1 class="brand-font display-4">Edit Manuscript</h1>
                <p class="text-muted text-uppercase small">Modify your culinary entry</p>
            </div>
            <a href="index.php?action=recipes" class="btn btn-outline-dark rounded-0 px-4">Cancel</a>
        </div>

        <form action="index.php?action=updateRecipe&id=<?= $recipe['id'] ?>" method="POST" class="bg-white p-5 shadow-sm">
            <div class="row mb-4">
                <div class="col-md-8">
                    <label class="form-label small fw-bold text-uppercase text-muted">Title</label>
                    <input type="text" name="title" class="form-control form-control-lg rounded-0 border-0 border-bottom px-0" 
                           value="<?= htmlspecialchars($recipe['title']) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-uppercase text-muted">Category</label>
                    <select name="category_id" class="form-select rounded-0 border-0 border-bottom px-0" required>
                        <?php foreach($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $recipe['category_id']) ? 'selected' : '' ?>>
                                <?= $cat['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase text-muted">Prep Time (min)</label>
                    <input type="number" name="prep_time" class="form-control rounded-0 border-0 border-bottom px-0" 
                           value="<?= $recipe['prep_time'] ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase text-muted">Servings</label>
                    <input type="number" name="servings" class="form-control rounded-0 border-0 border-bottom px-0" 
                           value="<?= $recipe['servings'] ?>">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase text-muted">Ingredients</label>
                <textarea name="ingredients" class="form-control rounded-0 border-1 p-3" rows="5"><?= htmlspecialchars($recipe['ingredients']) ?></textarea>
            </div>

            <div class="mb-5">
                <label class="form-label small fw-bold text-uppercase text-muted">Instructions</label>
                <textarea name="instructions" class="form-control rounded-0 border-1 p-3" rows="8"><?= htmlspecialchars($recipe['instructions']) ?></textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-gold btn-lg px-5 shadow-sm">Update Entry</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>