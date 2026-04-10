<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container-fluid py-5 px-md-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-sidebar shadow-sm mb-4">
                <div class="p-4 border-bottom">
                    <h5 class="brand-font mb-0">Collections</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="index.php?action=recipes" class="collection-item <?= !isset($_GET['id']) ? 'active' : '' ?>">
                        <span>All Recipes</span>
                        <span class="badge rounded-pill bg-light text-dark border"><?= count($recipes) ?></span>
                    </a>
                    <?php foreach($categories as $cat): ?>
                    <a href="index.php?action=filterByCategory&id=<?= $cat['id'] ?>" class="collection-item">
                        <?= htmlspecialchars($cat['name']) ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="p-4 bg-white border-start border-4 border-warning shadow-sm small italic text-muted">
                "Cuisine is the bridge between history and the senses."
            </div>
        </div>

        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h1 class="brand-font display-4 mb-0">Digital Archive</h1>
                    <p class="text-muted text-uppercase small ls-2">Marrakech Food Lovers Edition</p>
                </div>
                <a href="index.php?action=createRecipe" class="btn btn-gold">
                    <i class="bi bi-plus-lg me-2"></i> Add Recipe
                </a>
            </div>

            <div class="table-container">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Manuscript Title</th>
                                <th>Prep Time</th>
                                <th>Category</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($recipes as $recipe): ?>
                            <tr>
                                <td class="py-4">
                                    <div class="fw-bold mb-1 fs-5 brand-font">
                                        <?php if ($this->recipeModel->isFavorite($_SESSION['user_id'], $recipe['id'])): ?>
                                            <i class="bi bi-star-fill text-warning me-2" style="font-size: 0.8rem;"></i>
                                        <?php endif; ?>
                                        <?= htmlspecialchars($recipe['title']) ?>
                                    </div>
                                    <div class="small text-muted text-uppercase ls-2" style="font-size: 0.6rem;">
                                        Archived on <?= date('M d, Y', strtotime($recipe['created_at'])) ?>
                                    </div>
                                </td>
                                <td><span class="text-muted small"><i class="bi bi-hourglass-split me-1"></i> <?= $recipe['prep_time'] ?> min</span></td>
                                <td><span class="badge-category"><?= htmlspecialchars($recipe['category_name']) ?></span></td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-link text-dark p-0" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm p-2">
                                            <li><a class="dropdown-item rounded" href="index.php?action=showRecipe&id=<?= $recipe['id'] ?>"><i class="bi bi-eye me-2"></i> View</a></li>
                                            <li><a class="dropdown-item rounded" href="index.php?action=editRecipe&id=<?= $recipe['id'] ?>"><i class="bi bi-pencil me-2"></i> Edit</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger rounded" href="index.php?action=deleteRecipe&id=<?= $recipe['id'] ?>" onclick="return confirm('Archive this manuscript?')"><i class="bi bi-trash me-2"></i> Delete</a></li>
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
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>