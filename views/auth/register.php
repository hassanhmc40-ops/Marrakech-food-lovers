<?php require_once __DIR__ . '/../layout/header.php'; ?>

<?php if (isset($error)): ?>
    <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
        <?php echo $error; ?>
    </div>
<?php endif; ?>
<h2>Create Account</h2>

<form action="index.php?action=register" method="POST">

    <label for="username">Username</label>
    <input type="text" name="username" id="username" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
    
    <label for="confirm_password">Confirm Password</label>
    <input type="password" name="confirm_password" id="confirm_password" required>

    <button type="submit">Register</button>

</form>

<p>
    Already have an account?
    <a href="index.php?action=login">Login here</a>
</p>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
