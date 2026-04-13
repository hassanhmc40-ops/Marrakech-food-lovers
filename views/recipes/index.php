<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container-fluid py-5 px-md-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="header-main-title mb-0">Digital Archive</h1>
            <p class="header-sub-title mb-0">MARRAKECH FOOD LOVERS EDITION</p>
        </div>
        <a href="index.php?action=createRecipe" class="btn btn-gold-archive shadow-sm text-decoration-none">
            <i class="bi bi-plus-lg me-2"></i> <span class="fw-bold">ADD RECIPE</span>
        </a>
    </div>

    <div class="row g-4">
        <div class="col-md-3 text-start">
            <div class="card border-0 shadow-sm rounded-4 p-2 mb-4 bg-white border">
                <form action="index.php" method="GET">
                    <input type="hidden" name="action" value="recipes">
                    <?php if(isset($_GET['category_id'])): ?>
                        <input type="hidden" name="category_id" value="<?= htmlspecialchars($_GET['category_id']) ?>">
                    <?php endif; ?>
                    
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0 ps-3">
                            <i class="bi bi-search text-gold"></i>
                        </span>
                        <input type="text" name="query" class="form-control border-0 shadow-none py-2 small" 
                               placeholder="Search..." 
                               value="<?= htmlspecialchars($_GET['query'] ?? '') ?>">
                        
                        <?php if(!empty($_GET['query'])): ?>
                            <a href="index.php?action=recipes<?= isset($_GET['category_id']) ? '&category_id='.$_GET['category_id'] : '' ?>" 
                               class="input-group-text bg-white border-0 pe-3 text-muted text-decoration-none">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="sidebar-header">Collections</div>
                <div class="list-group list-group-flush">
                    <a href="index.php?action=recipes" 
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?= !isset($_GET['category_id']) ? 'bg-light fw-bold text-dark' : '' ?>">
                        <span>All Recipes</span>
                        <span class="badge rounded-pill bg-white text-dark border"><?= count($recipes) ?></span>
                    </a>
                    <?php foreach($categories as $cat): ?>
                    <a href="index.php?action=recipes&category_id=<?= $cat['id'] ?>" 
                       class="list-group-item list-group-item-action <?= (isset($_GET['category_id']) && $_GET['category_id'] == $cat['id']) ? 'bg-light fw-bold text-dark' : '' ?>">
                        <?= htmlspecialchars($cat['name']) ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-md-9 text-start">
            <div class="table-container bg-white shadow-sm" style="overflow: visible;">
                <table class="table align-middle mb-0" style="overflow: visible;">
                    <thead>
                        <tr>
                            <th class="ps-4">Recipe Title</th>
                            <th>Prep Time</th>
                            <th>Category</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $hasResults = false;
                        $searchQuery = $_GET['query'] ?? '';
                        $catFilter = $_GET['category_id'] ?? '';

                        foreach($recipes as $recipe): 
                            $matchSearch = empty($searchQuery) || stripos($recipe['title'], $searchQuery) !== false;
                            $matchCategory = empty($catFilter) || $recipe['category_id'] == $catFilter;

                            if ($matchSearch && $matchCategory):
                                $hasResults = true;
                        ?>
                        <tr>
                            <td class="py-4 ps-4">
                                <div class="fw-bold mb-1 fs-5 text-dark"><?= htmlspecialchars($recipe['title']) ?></div>
                                <div class="text-muted small">Archived on <?= date('M d, Y', strtotime($recipe['created_at'])) ?></div>
                            </td>
                            <td>
                                <span class="small fw-bold text-muted">
                                    <i class="bi bi-clock-history me-1 text-gold"></i> 
                                    <?= $this->formatRecipeTime($recipe['prep_time']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge-category"><?= htmlspecialchars($recipe['category_name']) ?></span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="dropdown">
                                    <button class="btn btn-link text-dark p-0" 
                                            data-bs-toggle="dropdown" 
                                            data-bs-boundary="viewport"
                                            aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical fs-5"></i>
                                    </button>
                                    <ul class="dropdown-menu shadow border-0 p-2 dropdown-menu-end">
                                        <li><a class="dropdown-item rounded" href="index.php?action=showRecipe&id=<?= $recipe['id'] ?>&from=archive"><i class="bi bi-eye me-2 text-primary"></i> View</a></li>
                                        <li><a class="dropdown-item rounded" href="index.php?action=editRecipe&id=<?= $recipe['id'] ?>"><i class="bi bi-pencil me-2 text-success"></i> Edit</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><button class="dropdown-item text-danger rounded" data-bs-toggle="modal" data-bs-target="#delModal<?= $recipe['id'] ?>"><i class="bi bi-trash me-2"></i> Delete</button></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="delModal<?= $recipe['id'] ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg text-start">
                                    <div class="modal-header border-0 pt-4 px-4">
                                        <h5 class="fw-bold mb-0">Delete Manuscript?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body px-4 py-3 text-muted">
                                        Remove <span class="fw-bold text-dark">"<?= htmlspecialchars($recipe['title']) ?>"</span>?
                                    </div>
                                    <div class="modal-footer border-0 pb-4 px-4">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Keep</button>
                                        <a href="index.php?action=deleteRecipe&id=<?= $recipe['id'] ?>" class="btn btn-danger text-white px-4">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            endif;
                        endforeach; ?>

                        <?php if (!$hasResults): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <p class="text-muted">No results found.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>