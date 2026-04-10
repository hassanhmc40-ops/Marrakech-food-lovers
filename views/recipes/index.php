<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="row">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 mb-4">
            <h5 class="brand-font mb-4 px-3">Collections</h5>
            <div class="list-group list-group-flush">
                <a href="index.php?action=recipes" class="collection-item rounded <?= !isset($_GET['id']) ? 'active' : '' ?>">
                    <span>All Recipes</span>
                    <span class="badge bg-light text-dark rounded-pill"><?= count($recipes) ?></span>
                </a>
                <?php foreach($categories as $cat): ?>
                <a href="index.php?action=filterByCategory&id=<?= $cat['id'] ?>" class="collection-item rounded">
                    <?= $cat['name'] ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="p-4 bg-white shadow-sm italic text-muted small border-start border-4 border-warning">
            "Cuisine is the bridge between history and the senses."
        </div>
    </div>

    <div class="col-md-9">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h1 class="brand-font display-4 mb-0">Digital Archive</h1>
                <p class="text-muted text-uppercase small ls-2">Marrakech Food Lovers Edition</p>
            </div>
            <a href="index.php?action=createRecipe" class="btn btn-gold px-4">
                <i class="bi bi-plus-lg me-2"></i> Add Recipe
            </a>
        </div>

        <div class="table-responsive bg-white shadow-sm p-4">
            <table class="table table-hover align-middle">
                <thead class="text-uppercase small text-muted">
                    <tr>
                        <th>Title</th>
                        <th>Prep Time</th>
                        <th>Category</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($recipes as $recipe): ?>
                    <tr>
                        <td>
                            <div class="fw-bold"><?= $recipe['title'] ?></div>
                            <div class="small text-muted">Published on <?= date('M d, Y', strtotime($recipe['created_at'])) ?></div>
                        </td>
                        <td><?= $recipe['prep_time'] ?> min</td>
                        <td><span class="badge-category"><?= $recipe['category_name'] ?></span></td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-link text-dark p-0" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                    <li><a class="dropdown-item" href="index.php?action=showRecipe&id=<?= $recipe['id'] ?>"><i class="bi bi-eye me-2"></i> Show</a></li>
                                    <li><a class="dropdown-item" href="index.php?action=editRecipe&id=<?= $recipe['id'] ?>"><i class="bi bi-pencil me-2"></i> Edit</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="index.php?action=deleteRecipe&id=<?= $recipe['id'] ?>" onclick="return confirm('Archive this recipe?')"><i class="bi bi-trash me-2"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>