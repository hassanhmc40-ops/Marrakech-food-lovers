<?php require_once __DIR__ . '/../layout/header.php'; ?>

<h2>My Recipes</h2>

<a href="index.php?action=createRecipe">Add New Recipe</a>

<hr>

<h3>Filter by Category</h3>

<div>
    <a href="index.php?action=recipes">All</a>

    <?php foreach ($categories as $category): ?>
        <a href="index.php?action=filterByCategory&category_id=<?= $category['id']; ?>">
            <?= htmlspecialchars($category['name']); ?>
        </a>
    <?php endforeach; ?>
</div>

<hr>

<?php if (!empty($recipes)): ?>

<table border="1">

    <tr>
        <th>Title</th>
        <th>Preparation Time</th>
        <th>Servings</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($recipes as $recipe): ?>

        <tr>

            <td><?= htmlspecialchars($recipe['title']); ?></td>

            <td><?= $recipe['prep_time']; ?> min</td>

            <td><?= $recipe['servings']; ?></td>

            <td>

                <a href="index.php?action=showRecipe&id=<?= $recipe['id']; ?>">
                    View
                </a>

                <a href="index.php?action=editRecipe&id=<?= $recipe['id']; ?>">
                    Edit
                </a>

                <a href="index.php?action=deleteRecipe&id=<?= $recipe['id']; ?>"
                   onclick="return confirm('Are you sure you want to delete this recipe?');">
                    Delete
                </a>

            </td>

        </tr>

    <?php endforeach; ?>

</table>

<?php else: ?>

<p>No recipes found.</p>

<?php endif; ?>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>