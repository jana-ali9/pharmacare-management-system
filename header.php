<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .navbar-brand img { height: 50px; object-fit: contain; }
        .nav-link { color: #1a4d8c !important; fw-bold; }
        .nav-link:hover { color: #0d2c54 !important; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="logo.png" alt="Smart Med Search Logo" class="me-2"> 
            <span class="fw-bold text-primary">PharmaSys</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Browse Medicines</a></li>
                <li class="nav-item ms-lg-3">
<div class="ms-auto d-flex align-items-center">
    <a href="cart.php" class="btn btn-outline-secondary rounded-circle px-2 py-1 position-relative">
        <i class="bi bi-cart"></i>
        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
    </a>
</div>                </li>
            </ul>
        </div>
    </div>
</nav>