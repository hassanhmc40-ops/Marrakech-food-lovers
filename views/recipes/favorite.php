<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="header-main-title">Favorite Archive</h1>
            <p class="header-sub-title">Your curated collection of recipes</p>
        </div>
        <a href="index.php?action=explore" class="btn btn-gold-archive px-4 shadow-sm">
            <i class="bi bi-compass me-2"></i> EXPLORE MORE
        </a>
    </div>

    <?php if (!empty($favorites)): ?>
    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4 bg-light">
        <form action="index.php" method="GET" class="row g-2 align-items-center">
            <input type="hidden" name="action" value="myFavorites">
            
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3">
                        <i class="bi bi-search text-gold"></i>
                    </span>
                    <input type="text" name="query" class="form-control border-start-0 rounded-end-pill py-2" 
                           placeholder="Search favorites..." 
                           value="<?= htmlspecialchars($_GET['query'] ?? '') ?>">
                </div>
            </div>

            <div class="col-md-5 col-9">
                <select name="category_id" class="form-select rounded-pill py-2 shadow-sm" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= (isset($_GET['category_id']) && $_GET['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-2 col-3">
                <a href="index.php?action=myFavorites" 
                   class="btn btn-white border w-100 rounded-pill py-2 shadow-sm text-muted fw-bold" 
                   title="Clear all filters">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <div class="table-container shadow-sm border-0 bg-white">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light border-bottom">
                <tr>
                    <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">Recipe</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted">Category</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted text-center">Prep Time</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted text-end pe-4">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($favorites)): ?>
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <h3 class="text-muted fw-bold text-uppercase">Empty</h3>
                            <p class="small text-muted">You haven't saved any favorites yet.</p>
                        </td>
                    </tr>
                <?php else: 
                    $hasResults = false;
                    $searchQuery = $_GET['query'] ?? '';
                    $catFilter = $_GET['category_id'] ?? '';

                    foreach ($favorites as $recipe): 
                        $matchSearch = empty($searchQuery) || stripos($recipe['title'], $searchQuery) !== false || stripos($recipe['ingredients'], $searchQuery) !== false;
                        $matchCat = empty($catFilter) || $recipe['category_id'] == $catFilter;

                        if ($matchSearch && $matchCat):
                            $hasResults = true;
                ?>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark"><?= htmlspecialchars($recipe['title']) ?></div>
                                <div class="small text-muted">By @<?= htmlspecialchars($recipe['username'] ?? 'User') ?></div>
                            </td>
                            <td><span class="badge-category"><?= htmlspecialchars($recipe['category_name']) ?></span></td>
                            <td class="text-center">
                                <span class="small fw-bold text-muted">
                                    <i class="bi bi-clock text-gold me-1"></i> 
                                    <?= $this->formatRecipeTime($recipe['prep_time']) ?>
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="index.php?action=showRecipe&id=<?= $recipe['id'] ?>&from=favorites" class="btn btn-sm btn-dark rounded-pill px-3 fw-bold shadow-sm">VIEW</a>
                                    <a href="index.php?action=toggleFavorite&id=<?= $recipe['id'] ?>" class="btn btn-sm btn-outline-danger border-0 rounded-circle" title="Remove">
                                        <i class="bi bi-heart-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                <?php 
                        endif;
                    endforeach; 

                    if (!$hasResults): ?>
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-search text-light-subtle d-block mb-3" style="font-size: 3rem;"></i>
                                <p class="text-muted">No favorite manuscripts match your search.</p>
                            </td>
                        </tr>
                    <?php endif; 
                endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>