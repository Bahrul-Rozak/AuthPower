<!DOCTYPE html>
<html>
<head>
    <title>Register - AuthPower</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <!-- http://localhost/AuthPower/public/index.php?page=register -->
    <h2>Register</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="?page=register">
        <?= \AuthPower\Helpers\Csrf::inputField(); ?>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirm" class="form-control" required>
        </div>
        <button class="btn btn-primary" type="submit">Register</button>
        <a href="?page=login" class="btn btn-link">Login</a>
    </form>
</div>
</body>
</html>
