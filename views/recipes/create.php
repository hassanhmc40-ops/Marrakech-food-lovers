<?php require_once __DIR__ . '/../layout/header.php'; ?>

<h2>Add New Recipe</h2>

<form action="index.php?action=storeRecipe" method="POST">

    <div>
        <label for="title">Recipe Title</label>
        <input type="text" name="title" id="title" required>
    </div>

    <div>
        <label for="ingredients">Ingredients</label>
        <textarea name="ingredients" id="ingredients" rows="5" required></textarea>
    </div>

    <div>
        <label for="instructions">Instructions</label>
        <textarea name="instructions" id="instructions" rows="6" required></textarea>
    </div>

    <div>
        <label for="prep_time">Preparation Time (minutes)</label>
        <input type="number" name="prep_time" id="prep_time" min="1" required>
    </div>

    <div>
        <label for="servings">Servings</label>
        <input type="number" name="servings" id="servings" min="1" required>
    </div>

    <div>
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" required>
            <option value="">-- Select a category --</option>

            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id']; ?>">
                    <?= htmlspecialchars($category['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <button type="submit">Save Recipe</button>
    </div>

</form>

<p>
    <a href="index.php?action=recipes">Back to recipes list</a>
</p>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>