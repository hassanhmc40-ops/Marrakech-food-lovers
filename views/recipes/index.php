<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="brand-font">My Collection</h1>
    <a href="index.php?action=createRecipe" class="btn btn-gold">+ Add Recipe</a>
</div>

<ul class="nav nav-tabs mb-4 border-gold">
    <li class="nav-item">
        <a class="nav-link <?= (!isset($_GET['action']) || $_GET['action'] == 'myRecipes') ? 'active bg-gold text-white' : 'text-dark' ?>" 
           href="index.php?action=myRecipes">My Recipes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= (isset($_GET['action']) && $_GET['action'] == 'myFavorites') ? 'active bg-gold text-white' : 'text-dark' ?>" 
           href="index.php?action=myFavorites">My Favorites</a>
    </li>
</ul>

<div class="row mb-5 g-3">
    <div class="col-md-4">
        <form action="index.php" method="GET" class="d-flex gap-2">
            <input type="hidden" name="action" value="filterByCategory">
            <select name="id" class="form-select border-gold-focus" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= (isset($_GET['id']) && $_GET['id'] == $cat['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <div class="col-md-8">
        <form action="index.php" method="GET" class="d-flex gap-2">
            <input type="hidden" name="action" value="search">
            <input type="text" name="query" class="form-control border-gold-focus" 
                   placeholder="Search by title or ingredients..." 
                   value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '' ?>">
            <button type="submit" class="btn btn-dark">Search</button>
        </form>
    </div>
</div>

<div class="row g-4">
    <?php if (!empty($recipes)): ?>
        <?php foreach ($recipes as $recipe): ?>
            <div class="col-md-4">
                <div class="card h-100 recipe-card p-3 shadow-sm border-0">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-gold small fw-bold text-uppercase">
                            <?= htmlspecialchars($recipe['category_name'] ?? 'Cuisine') ?>
                        </span>
                        <?php if(isset($recipe['username'])): ?>
                            <span class="text-muted small">by <?= htmlspecialchars($recipe['username']) ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <h4 class="brand-font"><?= htmlspecialchars($recipe['title']); ?></h4>
                    <p class="text-muted small"><?= $recipe['prep_time']; ?> min | <?= $recipe['servings']; ?> pers.</p>
                    
                    <div class="mt-auto d-flex gap-2 border-top pt-3">
                        <a href="index.php?action=showRecipe&id=<?= $recipe['id']; ?>" class="btn btn-sm btn-outline-dark">View</a>
                        
                        <?php if (isset($_SESSION['user_id']) && $recipe['user_id'] == $_SESSION['user_id']): ?>
                            <a href="index.php?action=editRecipe&id=<?= $recipe['id']; ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <a href="index.php?action=deleteRecipe&id=<?= $recipe['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this recipe?');">X</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <p class="text-muted fs-5 italic">No recipes found in this section.</p>
            <a href="index.php?action=myRecipes" class="btn btn-sm btn-gold">Back to my list</a>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>