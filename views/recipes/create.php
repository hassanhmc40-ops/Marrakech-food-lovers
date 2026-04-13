<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="bg-white p-5 shadow-sm border rounded-4 text-start">
                <div class="mb-5">
                    <h1 class="header-main-title fs-2 mb-2">New Entry</h1>
                    <p class="header-sub-title mb-0">Add a recipe to the digital archive</p>
                </div>

                <form action="index.php?action=storeRecipe" method="POST">
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="sidebar-header bg-transparent p-0 border-0 d-block mb-2">Manuscript Title</label>
                            <input type="text" name="title" class="form-control form-control-lg border-light-subtle" 
                                   placeholder="ex: Royal Lamb Tagine" required>
                        </div>

                        <div class="col-md-12">
                            <label class="sidebar-header bg-transparent p-0 border-0 d-block mb-2">Collection Category</label>
                            <select name="category_id" class="form-select border-light-subtle" required>
                                <option value="" selected disabled>Select a collection...</option>
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="sidebar-header bg-transparent p-0 border-0 d-block mb-2">Prep Time (min)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-light-subtle"><i class="bi bi-clock"></i></span>
                                <input type="number" name="prep_time" class="form-control border-light-subtle" placeholder="120" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="sidebar-header bg-transparent p-0 border-0 d-block mb-2">Servings</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-light-subtle"><i class="bi bi-people"></i></span>
                                <input type="number" name="servings" class="form-control border-light-subtle" placeholder="4" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="sidebar-header bg-transparent p-0 border-0 d-block mb-2">Ingredients List</label>
                            <textarea name="ingredients" class="form-control border-light-subtle" rows="5" 
                                      placeholder="List ingredients here (one per line)..." required></textarea>
                        </div>

                        <div class="col-12">
                            <label class="sidebar-header bg-transparent p-0 border-0 d-block mb-2">Preparation Instructions</label>
                            <textarea name="instructions" class="form-control border-light-subtle" rows="8" 
                                      placeholder="Describe the culinary process step by step..." required></textarea>
                        </div>

                        <div class="col-12 text-end mt-5 pt-4 border-top">
                            <a href="index.php?action=recipes" class="btn btn-cancel me-4 text-decoration-none">Discard</a>
                            <button type="submit" class="btn btn-gold-archive shadow-sm">
                                <i class="bi bi-journal-plus me-2"></i> SAVE TO ARCHIVE
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>