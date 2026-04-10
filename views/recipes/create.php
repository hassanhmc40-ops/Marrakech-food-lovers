<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger border-0 rounded-0 shadow-sm mb-4 d-flex align-items-center" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        <div><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    </div>
<?php endif; ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="text-center mb-5">
            <h1 class="auth-title">New Entry</h1>
            <p class="auth-subtitle">Add a recipe to the digital archive</p>
        </div>

        <form action="index.php?action=storeRecipe" method="POST" class="auth-card mx-auto w-100" style="max-width: 100%;">
            <div class="row">
                <div class="col-md-8">
                    <label class="form-label-custom">Recipe Title</label>
                    <input type="text" name="title" class="form-control-custom" placeholder="ex: Royal Lamb Tagine" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label-custom">Category</label>
                    <select name="category_id" class="form-control-custom" required>
                        <option value="">Select...</option>
                        <?php foreach($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label-custom">Prep Time (minutes)</label>
                    <input type="number" name="prep_time" class="form-control-custom" placeholder="120">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Servings</label>
                    <input type="number" name="servings" class="form-control-custom" placeholder="4">
                </div>
            </div>

            <label class="form-label-custom">Ingredients</label>
            <textarea name="ingredients" class="form-control-custom" rows="4" placeholder="List ingredients here..."></textarea>

            <label class="form-label-custom">Instructions</label>
            <textarea name="instructions" class="form-control-custom" rows="6" placeholder="Describe the process..."></textarea>

            <div class="mt-4">
                <button type="submit" class="btn-gold shadow-sm">Save to Archive</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>