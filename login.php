<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PharmaCare - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body, html { height: 100%; margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow: hidden; }
    
    .main-wrapper { display: flex; height: calc(100% - 50px); }

    .left-side { 
        background-color: #1a4d8c; 
        color: white; 
        width: 50%; 
        padding: 40px; 
        display: flex; 
        flex-direction: column; 
        align-items: flex-start;
        justify-content: center;
    }
    
    .left-side h1 { font-size: 1.8rem; margin-bottom: 10px; }
    .left-side p { font-size: 0.9rem; max-width: 90%; margin-bottom: 20px; opacity: 0.9; }

    .left-side img.pharmacy-img { 
        width: 100%;
        max-width: 450px; 
        max-height: 45vh; 
        object-fit: cover;
        border-radius: 15px; 
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .right-side { 
        width: 50%; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        background-color: white;
    }
    
    .login-box { 
        width: 100%;
        max-width: 380px; 
        padding: 30px; 
    }
    
    .login-box h3 { font-size: 1.5rem; margin-bottom: 5px; }
    .form-label { font-size: 0.85rem; font-weight: 600; }
    .form-control { padding: 10px; font-size: 0.9rem; }
    .btn-primary { background-color: #1a4d8c; border: none; padding: 10px; font-weight: 600; margin-top: 10px; }
    
    footer { 
        background-color: #1a4d8c; 
        color: white; 
        height: 50px; 
        display: flex; 
        align-items: center; 
        font-size: 12px;
        position: relative;
        z-index: 10;
    }
</style>
</head>
<body>

    <div class="main-wrapper">
        <div class="left-side">
            <img src="logo.png" width="60" class="mb-3">
            <h1>PharmaCare Management System</h1>
            <p>Professional pharmacy management solution for modern healthcare facilities. Manage inventory, prescriptions, and patient care efficiently.</p>
            <img src="doctor.png" class="pharmacy-img" alt="Pharmacist">
        </div>

        <div class="right-side">
            <div class="login-box text-center">
                <img src="logo.png" width="50" class="mb-3">
                <h3>Welcome Back</h3>
                <p class="text-muted">Sign in to your account to continue</p>
                
                <form action="login_process.php" method="POST">
                    <div class="mb-3 text-start">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="admin@pharmacare.com" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div><input type="checkbox"> Remember me</div>
                        <a href="#" class="text-decoration-none" style="color: #1a4d8c;">Forgot password?</a>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary w-100">SignIn</button>
                </form>
                <p class="mt-4 text-muted small">Don't have an account? <a href="signup.php" class="text-decoration-none fw-bold" style="color: #1a4d8c;">Sign Up</a></p>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>