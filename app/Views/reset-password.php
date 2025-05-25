<?php use AuthPower\Helpers\Csrf; ?>
<div class="container mt-5">
    <h2>Reset Password</h2>
    <form method="POST">
        <?= Csrf::inputField(); ?>
        <div class="form-group mb-3">
            <label>New Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-success">Reset</button>
    </form>
</div>
