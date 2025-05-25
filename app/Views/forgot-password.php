<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- http://localhost/AuthPower/public/index.php?page=forgot-password -->
</head>

<body>

    <?php

    use AuthPower\Helpers\Csrf; ?>
    <div class="container mt-5">
        <h2>Forgot Password</h2>
        <form method="POST" action="?page=forgot-password">
            <?= Csrf::inputField(); ?>
            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button class="btn btn-primary">Send Reset Link</button>
        </form>
    </div>

</body>

</html>