<?php
session_start();
include 'db_connect.php';

// جلب الطلبات مع ربطها بجدول المستخدمين لجلب الاسم (الإيميل حالياً)
$sql = "SELECT orders.*, users.email FROM orders 
        LEFT JOIN users ON orders.user_id = users.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Management - PharmaCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root { --sidebar-blue: #1a4d8c; --active-blue: #3498db; --bg-light: #f4f7fe; }
        body { background-color: var(--bg-light); font-family: 'Segoe UI', sans-serif; overflow-x: hidden; }
        
        /* Sidebar الموحد */
        .sidebar { background-color: var(--sidebar-blue); color: white; min-height: 100vh; position: fixed; width: 240px; top: 0; left: 0; }
        .sidebar-brand { padding: 25px; font-weight: bold; font-size: 20px; display: flex; align-items: center; gap: 10px; }
        .nav-link { color: rgba(255,255,255,0.7); padding: 12px 25px; display: flex; align-items: center; gap: 12px; transition: 0.3s; text-decoration: none; }
        .nav-link:hover { color: white; background: rgba(255,255,255,0.1); }
        .nav-link.active { background: var(--active-blue); color: white; border-radius: 0 25px 25px 0; margin-right: 20px; }
        
        /* محتوى الصفحة الرئيسي */
        .main-content { margin-left: 240px; padding: 40px; width: calc(100% - 240px); }
        
        /* صندوق البحث كما في البرزنتايشن */
        .search-wrapper { position: relative; max-width: 100%; margin-bottom: 25px; }
        .search-wrapper i { position: absolute; left: 15px; top: 13px; color: #a0aec0; }
        .search-input { 
            padding-left: 45px !important; 
            border-radius: 12px !important; 
            border: 1px solid #e2e8f0 !important; 
            height: 48px; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        /* حاوية الجدول */
        .order-container { background: white; border-radius: 20px; padding: 0; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.02); }
        .table { margin-bottom: 0; }
        .table thead th {
            background-color: #f8f9fa;
            color: #718096;
            font-weight: 600;
            font-size: 13px;
            padding: 18px 20px;
            border-bottom: 1px solid #edf2f9;
            text-transform: none;
        }
        .table tbody td { padding: 18px 20px; border-bottom: 1px solid #edf2f9; color: #2d3748; font-size: 14px; }
        
        /* تنسيق الـ Badges (الألوان الفاتحة والأيقونات) */
        .status-badge { padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 500; display: inline-flex; align-items: center; gap: 5px; }
        .badge-delivered { background-color: #e8f5e9; color: #2e7d32; }
        .badge-processing { background-color: #e3f2fd; color: #1976d2; }
        .badge-pending { background-color: #fff8e1; color: #f57f17; }
        .badge-cancelled { background-color: #ffebee; color: #c62828; }
        
        .logout-btn { position: absolute; bottom: 20px; width: 100%; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-box-seam"></i> PharmaCare
    </div>
    <nav class="nav flex-column mt-3">
        <a class="nav-link" href="admin_dashboard.php"><i class="bi bi-house-door"></i> Dashboard</a>
        <a class="nav-link" href="medicines.php"><i class="bi bi-box"></i> Medicines</a>
        <a class="nav-link" href="users.php"><i class="bi bi-people"></i> Users</a>
        <a class="nav-link active" href="orders.php"><i class="bi bi-cart"></i> Orders</a>
        <a class="nav-link" href="reports.php"><i class="bi bi-file-earmark-text"></i> Reports</a>
    </nav>
    <div class="logout-btn">
        <a class="nav-link" href="login.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
    </div>
</div>

<div class="main-content">
    <h2 class="fw-bold mb-1">Order Management</h2>
    <p class="text-muted mb-4">Track and manage customer orders</p>

    <div class="search-wrapper">
        <i class="bi bi-search"></i>
        <input type="text" class="form-control search-input" placeholder="Search by order ID, customer name, or medicine...">
    </div>

    <div class="order-container">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Medicine</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): 
                    // منطق الألوان والأيقونات بناءً على الحالة
                    $status = $row['status'];
                    $badgeClass = "badge-pending";
                    $iconClass = "bi-clock";
                    
                    if($status == 'Delivered') { $badgeClass = "badge-delivered"; $iconClass = "bi-check-circle"; }
                    elseif($status == 'Processing') { $badgeClass = "badge-processing"; $iconClass = "bi-info-circle"; }
                    elseif($status == 'Cancelled') { $badgeClass = "badge-cancelled"; $iconClass = "bi-x-circle"; }
                ?>
                <tr>
                    <td class="text-primary fw-medium">ORD-<?php echo str_pad($row['id'], 3, '0', STR_PAD_LEFT); ?></td>
                    <td class="fw-bold"><?php echo explode('@', $row['email'])[0]; ?></td>
                    <td>Aspirin 500mg</td> <td>3</td>
                    <td class="fw-bold">$<?php echo number_format($row['total_amount'], 2); ?></td>
                    <td class="text-muted"><?php echo date('Y-m-d', strtotime($row['order_date'])); ?></td>
                    <td>
                        <span class="status-badge <?php echo $badgeClass; ?>">
                            <i class="bi <?php echo $iconClass; ?>"></i> <?php echo $status; ?>
                        </span>
                    </td>
                    <td>

                    <a href="order details.php?id=<?php echo $row['id']; ?>" class="btn btn-link p-0 text-muted">
                  <i class="bi bi-eye"></i>
           </a>
                    </td>
                </tr>
                <?php endwhile; ?>
                
                <?php if($result->num_rows == 0): ?>
                <tr>
                    <td colspan="8" class="text-center py-5 text-muted">No orders found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>