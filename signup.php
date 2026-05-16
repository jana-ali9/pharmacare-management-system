<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PharmaCare - Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body style="background-color: #f4f7fe; display: flex; align-items: center; justify-content: center; height: 100vh;">

    <div class="card shadow border-0 p-4" style="width: 100%; max-width: 400px; border-radius: 15px;">
        <h3 class="text-center fw-bold mb-4">Create Account</h3>
        <form action="signup process.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="yourname@gmail.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Create password" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary w-100 fw-bold" style="background-color: #1a4d8c;">Sign Up</button>
        </form>
        <p class="mt-3 text-center small text-muted">Already have an account? <a href="login.php">Login here</a></p>
    </div>

</body>
</html>