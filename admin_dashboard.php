<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$total_meds = $conn->query("SELECT COUNT(*) AS count FROM medicines")->fetch_assoc()['count'];
$active_users = $conn->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc()['count'];
$total_orders = $conn->query("SELECT COUNT(*) AS count FROM orders")->fetch_assoc()['count'];
$revenue = $conn->query("SELECT SUM(total_amount) AS total FROM orders")->fetch_assoc()['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PharmaCare Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7fe; font-family: 'Segoe UI', sans-serif; }
        
        .sidebar { background-color: #1a4d8c; color: white; min-height: 100vh; padding: 0; }
        .sidebar-header { padding: 20px; display: flex; align-items: center; gap: 10px; }
        .sidebar .nav-link { 
            color: rgba(255,255,255,0.7); 
            padding: 15px 25px; 
            display: flex; 
            align-items: center; 
            gap: 15px;
            font-weight: 500;
        }
        .sidebar .nav-link:hover { color: white; background: rgba(255,255,255,0.1); }
        .sidebar .nav-link.active { 
            background: #3498db; 
            color: white; 
            margin: 0 10px; 
            border-radius: 10px; 
        }
        
        .stat-card { 
            background: white; 
            border-radius: 20px; 
            padding: 25px; 
            border: none; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: white; }
        
        .logout-btn { position: absolute; bottom: 20px; width: 100%; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar position-relative">
            <div class="sidebar-header">
                <img src="logo.png" width="40">
                <div>
                    <h6 class="mb-0 fw-bold">PharmaCare</h6>
                    <small style="font-size: 10px; opacity: 0.7;">Management System</small>
                </div>
            </div>
            
            <nav class="nav flex-column mt-4">
                <a class="nav-link active" href="admin_dashboard.php"><i class="bi bi-grid-fill"></i> Dashboard</a>
                <a class="nav-link" href="medicines.php"><i class="bi bi-box-seam"></i> Medicines</a>
                <a class="nav-link" href="users.php"><i class="bi bi-people"></i> Users</a>
                 <a class="nav-link" href="orders.php"><i class="bi bi-cart"></i> Orders</a> 
                 <a class="nav-link" href="reports.php"><i class="bi bi-file-earmark-bar-graph"></i> Reports</a>
            </nav>

            <div class="logout-btn">
                <a class="nav-link" href="login.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
            </div>
        </div>

        <div class="col-md-10 p-5">
            <h2 class="fw-bold">Dashboard Overview</h2>
            <p class="text-muted">Monitor your pharmacy operations and performance</p>

            <div class="row mt-4 g-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <small class="text-muted d-block mb-1">Total Medicines</small>
                            <h3 class="fw-bold mb-0"><?php echo number_format($total_meds); ?></h3>
                            <small class="text-success" style="font-size: 12px;">+12% from last month</small>
                        </div>
                        <div class="stat-icon bg-primary"><i class="bi bi-box"></i></div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <small class="text-muted d-block mb-1">Active Users</small>
                            <h3 class="fw-bold mb-0"><?php echo number_format($active_users); ?></h3>
                            <small class="text-success" style="font-size: 12px;">+18% from last month</small>
                        </div>
                        <div class="stat-icon bg-success"><i class="bi bi-people"></i></div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <small class="text-muted d-block mb-1">Total Orders</small>
                            <h3 class="fw-bold mb-0"><?php echo number_format($total_orders); ?></h3>
                            <small class="text-primary" style="font-size: 12px;">+24% from last month</small>
                        </div>
                        <div class="stat-icon bg-purple" style="background-color: #a855f7;"><i class="bi bi-cart"></i></div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <small class="text-muted d-block mb-1">Revenue</small>
                            <h3 class="fw-bold mb-0">$<?php echo number_format($revenue); ?></h3>
                            <small class="text-orange" style="font-size: 12px; color: #f97316;">+8% from last month</small>
                        </div>
                        <div class="stat-icon" style="background-color: #f97316;"><i class="bi bi-graph-up-arrow"></i></div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                
               
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                        <h5 class="fw-bold mb-4">Recent Orders</h5>
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Medicine</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php
    $recent_orders = $conn->query("SELECT * FROM orders ORDER BY order_date DESC LIMIT 5");
    
    if ($recent_orders->num_rows > 0) {
        while($row = $recent_orders->fetch_assoc()) {
            echo "<tr>";
            echo "<td>ORD-" . str_pad($row['id'], 3, '0', STR_PAD_LEFT) . "</td>";
            echo "<td>User #" . $row['user_id'] . "</td>";
            echo "<td>Medicine List</td>"; 
            
            $status_class = ($row['status'] == 'Completed' || $row['status'] == 'Active') ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning';
            
            echo "<td><span class='badge $status_class p-2'>" . $row['status'] . "</span></td>";
            echo "<td class='fw-bold'>$" . number_format($row['total_amount'], 2) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5' class='text-center'>No orders found</td></tr>";
    }
    ?>
</tbody>
                        </table>
                    </div>
                </div>

             
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                        <div class="d-flex align-items-center mb-4 text-warning">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>
                            <h5 class="fw-bold mb-0" style="color: #333;">Low Stock Alert</h5>
                        </div>
                        <p class="text-muted small">Items requiring restock</p>

                       
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-bold small">Aspirin 500mg</span>
                                <span class="text-warning small fw-bold">45 units</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 45%;"></div>
                            </div>
                            <small class="text-muted" style="font-size: 10px;">Threshold: 100 units</small>
                        </div>

                       
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-bold small">Insulin Glargine</span>
                                <span class="text-danger small fw-bold">12 units</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 12%;"></div>
                            </div>
                            <small class="text-muted" style="font-size: 10px;">Threshold: 50 units</small>
                        </div>
                    </div>
                </div> 

            </div> 
        </div> 

</body>
</html>