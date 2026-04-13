<?php include __DIR__ . '/../layout/header.php'; ?>
<?php
// Détection de la provenance
$source = $_GET['from'] ?? 'archive';

switch($source) {
    case 'favorites':
        $backUrl = 'index.php?action=myFavorites';
        $backText = 'BACK TO FAVORITES';
        $canEdit = false;
        break;
    case 'explore':
        $backUrl = 'index.php?action=explore';
        $backText = 'BACK TO EXPLORE';
        $canEdit = false;
        break;
    default:
        $backUrl = 'index.php?action=recipes';
        $backText = 'BACK TO ARCHIVE';
        $canEdit = true;
}
?>

<div class="container py-5">
    <div class="mb-4">
        <a href="<?= $backUrl ?>" class="text-muted text-decoration-none small fw-bold">
            <i class="bi bi-arrow-left me-2"></i> <?= $backText ?>
        </a>
    </div>

    <div class="row g-5">
        <div class="col-lg-4">
            <div class="bg-white border-top border-4 border-warning p-4 shadow-sm rounded-4">
                <span class="badge-category mb-3 d-inline-block"><?= htmlspecialchars($recipe['category_name']) ?></span>
                <h1 class="header-main-title fs-3 mb-4"><?= htmlspecialchars($recipe['title']) ?></h1>
                
                <div class="py-3 border-top border-bottom mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="sidebar-header border-0 p-0 bg-transparent">Prep Time</span>
                        <span class="fw-bold"><?= $this->formatRecipeTime($recipe['prep_time']) ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="sidebar-header border-0 p-0 bg-transparent">Servings</span>
                        <span class="fw-bold"><?= $recipe['servings'] ?> pers</span>
                    </div>
                </div>

                <p class="small text-muted mb-4">Curated by <span class="text-dark fw-bold">@<?= htmlspecialchars($recipe['username']) ?></span></p>
                
                <?php if ($canEdit): ?>
                    <a href="index.php?action=editRecipe&id=<?= $recipe['id'] ?>" class="btn btn-outline-dark w-100 rounded-3 fw-bold small">EDIT RECIPE</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="bg-white border-top border-4 border-warning p-5 shadow-sm rounded-4 min-vh-100 text-start">
                <h5 class="sidebar-header bg-transparent p-0 border-0 border-bottom mb-4 pb-2 text-uppercase fw-bold" style="letter-spacing: 1px;">Ingredients</h5>
                <div class="lh-lg mb-5" style="white-space: pre-line; color: #555;"><?= htmlspecialchars($recipe['ingredients']) ?></div>
                
                <h5 class="sidebar-header bg-transparent p-0 border-0 border-bottom mb-4 pb-2 text-uppercase fw-bold" style="letter-spacing: 1px;">Instructions</h5>
                <div class="lh-lg" style="white-space: pre-line; color: #555;"><?= htmlspecialchars($recipe['instructions']) ?></div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>