<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reports & Analytics - PharmaCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root { --sidebar-blue: #1a4d8c; --active-blue: #3498db; --bg-light: #f4f7fe; }
        body { background-color: var(--bg-light); font-family: 'Segoe UI', sans-serif; }
        
        .sidebar { background-color: var(--sidebar-blue); color: white; min-height: 100vh; position: fixed; width: 240px; top: 0; left: 0; }
        .sidebar-brand { padding: 25px; font-weight: bold; font-size: 20px; display: flex; align-items: center; gap: 10px; }
        .nav-link { color: rgba(255,255,255,0.7); padding: 12px 25px; display: flex; align-items: center; gap: 12px; transition: 0.3s; text-decoration: none; }
        .nav-link:hover { color: white; background: rgba(255,255,255,0.1); }
        .nav-link.active { background: var(--active-blue); color: white; border-radius: 0 25px 25px 0; margin-right: 20px; }

        .main-content { margin-left: 240px; padding: 40px; }
        
        /* كروت الإحصائيات الملونة */
        .stat-card { border: none; border-radius: 15px; padding: 25px; color: white; position: relative; overflow: hidden; height: 160px; }
        .bg-revenue { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .bg-orders { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
        .bg-sold { background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%); }
        .bg-customers { background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%); }
        
        .stat-icon { position: absolute; right: 20px; top: 20px; font-size: 2rem; opacity: 0.3; }
        .report-box { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); height: 100%; }
        
        .progress { height: 10px; border-radius: 5px; margin-top: 10px; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand"><i class="bi bi-box-seam"></i> PharmaCare</div>
    <nav class="nav flex-column mt-3">
        <a class="nav-link" href="admin_dashboard.php"><i class="bi bi-house-door"></i> Dashboard</a>
        <a class="nav-link" href="medicines.php"><i class="bi bi-box"></i> Medicines</a>
        <a class="nav-link" href="users.php"><i class="bi bi-people"></i> Users</a>
        <a class="nav-link" href="orders.php"><i class="bi bi-cart"></i> Orders</a>
        <a class="nav-link active" href="reports.php"><i class="bi bi-file-earmark-text"></i> Reports</a>
    </nav>
    <div class="logout-btn">
        <a class="nav-link" href="login.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
    </div>
</div>

<div class="main-content">
    <h2 class="fw-bold mb-1">Reports & Analytics</h2>
    <p class="text-muted mb-4">View business insights and performance metrics</p>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="stat-card bg-revenue">
                <i class="bi bi-currency-dollar stat-icon"></i>
                <p class="mb-1">Total Revenue</p>
                <h2 class="fw-bold">$94,250</h2>
                <small><i class="bi bi-arrow-up-short"></i> +15% from last month</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-orders">
                <i class="bi bi-cart-check stat-icon"></i>
                <p class="mb-1">Total Orders</p>
                <h2 class="fw-bold">3,567</h2>
                <small><i class="bi bi-arrow-up-short"></i> +24% from last month</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-sold">
                <i class="bi bi-box-seam stat-icon"></i>
                <p class="mb-1">Medicines Sold</p>
                <h2 class="fw-bold">8,932</h2>
                <small><i class="bi bi-arrow-up-short"></i> +18% from last month</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-customers">
                <i class="bi bi-people stat-icon"></i>
                <p class="mb-1">New Customers</p>
                <h2 class="fw-bold">284</h2>
                <small><i class="bi bi-arrow-up-short"></i> +32% from last month</small>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-7">
            <div class="report-box">
                <h5 class="fw-bold mb-4">Sales Overview (Q1 2026)</h5>
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Jan</span><span class="text-muted">$12,500</span>
                    </div>
                    <div class="progress"><div class="progress-bar" style="width: 45%"></div></div>
                </div>
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Feb</span><span class="text-muted">$15,200</span>
                    </div>
                    <div class="progress"><div class="progress-bar bg-info" style="width: 60%"></div></div>
                </div>
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Mar</span><span class="text-muted">$18,900</span>
                    </div>
                    <div class="progress"><div class="progress-bar bg-success" style="width: 85%"></div></div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="report-box">
                <h5 class="fw-bold mb-4">Top Selling Medicines</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div>
                            <span class="badge bg-light text-dark me-2">1</span> Aspirin 500mg
                        </div>
                        <span class="text-primary fw-bold">450 sold</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div>
                            <span class="badge bg-light text-dark me-2">2</span> Amoxicillin 250mg
                        </div>
                        <span class="text-primary fw-bold">320 sold</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div>
                            <span class="badge bg-light text-dark me-2">3</span> Metformin 500mg
                        </div>
                        <span class="text-primary fw-bold">280 sold</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>
</html>