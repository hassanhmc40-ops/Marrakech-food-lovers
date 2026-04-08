<?php require_once __DIR__ . '/../layout/header.php'; ?>

<h2>Login</h2>

<form action="index.php?action=login" method="POST">

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>

    <button type="submit">Login</button>

</form>

<p>
    Don't have an account? 
    <a href="index.php?action=register">Register here</a>
</p>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>