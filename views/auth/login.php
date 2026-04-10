<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">

<div class="auth-card">
    <h1 class="auth-title">Welcome</h1>
    <p class="auth-subtitle">Access the Archive</p>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger small py-2 border-0 rounded-0 mb-4"><?= $error ?></div>
    <?php endif; ?>

    <form action="index.php?action=login" method="POST">
        <label class="form-label-custom">Email</label>
        <input type="email" name="email" class="form-control-custom" placeholder="votre@email.com" required>

        <label class="form-label-custom">Password</label>
        <input type="password" name="password" class="form-control-custom" placeholder="••••••••" required>

        <button type="submit" class="btn-gold shadow-sm mt-3">Log In</button>
    </form>

    <p class="mt-4 small text-muted">
        No account? <a href="index.php?action=register" class="text-dark fw-bold text-decoration-underline">Register here</a>
    </p>
</div>

</body>
</html>