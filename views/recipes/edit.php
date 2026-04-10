<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="auth-container">
    <div class="auth-card">
        <h2 class="brand-gold text-center mb-4">MODIFIER LA RECETTE</h2>

        <?php if (isset($error)): ?>
            <div class="alert-error"><?= $error ?></div>
        <?php endif; ?>

<form action="index.php?action=updateRecipe&id=<?= $recipe['id'] ?>" method="POST">            
            <div class="form-group mb-3">
                <label for="title" class="text-light">Titre de la recette</label>
                <input type="text" name="title" id="title" class="custom-input w-100" 
                       value="<?= htmlspecialchars($recipe['title']) ?>" required>
            </div>

            <div class="row-flex mb-3">
                <div class="flex-item">
                    <label for="prep_time" class="text-light">Temps (min)</label>
                    <input type="number" name="prep_time" id="prep_time" class="custom-input w-100" 
                           value="<?= htmlspecialchars($recipe['prep_time']) ?>">
                </div>
                <div class="flex-item">
                    <label for="servings" class="text-light">Personnes</label>
                    <input type="number" name="servings" id="servings" class="custom-input w-100" 
                           value="<?= htmlspecialchars($recipe['servings']) ?>">
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="ingredients" class="text-light">Ingrédients</label>
                <textarea name="ingredients" id="ingredients" class="custom-input w-100" rows="5" required><?= htmlspecialchars($recipe['ingredients']) ?></textarea>
            </div>

            <div class="form-group mb-4">
                <label for="instructions" class="text-light">Instructions de préparation</label>
                <textarea name="instructions" id="instructions" class="custom-input w-100" rows="5" required><?= htmlspecialchars($recipe['instructions']) ?></textarea>
            </div>
            <div class="form-group mb-3">
    <label for="category_id" class="text-light">Catégorie</label>
    <select name="category_id" id="category_id" class="custom-input w-100" required>
        <option value="">-- Choisir une catégorie --</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id']; ?>" 
                <?= ($category['id'] == $recipe['category_id']) ? 'selected' : ''; ?>>
                <?= htmlspecialchars($category['name']); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

           <div class="actions-group">
           <button type="submit" class="btn-gold w-100">ENREGISTRER LES MODIFICATIONS</button>
        
           <a href="index.php?action=recipes" class="btn-cancel d-block text-center mt-3">Annuler</a>   
          </div>

        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>