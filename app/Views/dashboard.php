<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - AuthPower</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1>Welcome, <?= htmlspecialchars($user['name']) ?></h1>
    <p>Email: <?= htmlspecialchars($user['email']) ?></p>
    <a href="?page=logout" class="btn btn-danger">Logout</a>
</div>
</body>
</html>
