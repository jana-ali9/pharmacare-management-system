<?php
session_start();
include 'db_connect.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management - PharmaCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root { --primary-blue: #1a4d8c; --light-bg: #f4f7fe; }
        body { background-color: var(--light-bg); font-family: 'Segoe UI', sans-serif; }
        
        /* Sidebar الموحد كما في الصورة */
        .sidebar { background-color: var(--primary-blue); color: white; min-height: 100vh; position: fixed; width: 240px; }
        .sidebar-brand { padding: 25px; font-weight: bold; font-size: 20px; display: flex; align-items: center; gap: 10px; }
        .nav-link { color: rgba(255,255,255,0.7); padding: 12px 25px; display: flex; align-items: center; gap: 12px; transition: 0.3s; }
        .nav-link:hover { color: white; background: rgba(255,255,255,0.1); }
        .nav-link.active { background: #3498db; color: white; border-radius: 0 25px 25px 0; margin-right: 20px; }
        
        /* محتوى الصفحة */
        .main-content { margin-left: 240px; padding: 40px; }
        .user-card { background: white; border-radius: 20px; border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.02); padding: 25px; }
        
        /* تنسيق جدول المستخدمين */
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; background: #3498db; color: white; 
                       display: flex; align-items: center; justify-content: center; font-weight: bold; }
        .status-badge { padding: 6px 15px; border-radius: 20px; font-size: 12px; }
        .bg-active-light { background-color: #e8f5e9; color: #2e7d32; }
        
        .search-bar { background: white; border-radius: 15px; border: 1px solid #eee; padding: 10px 20px; width: 100%; max-width: 800px; margin-bottom: 30px; }
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
        <a class="nav-link active" href="users.php"><i class="bi bi-people"></i> Users</a>
        <a class="nav-link" href="orders.php"><i class="bi bi-cart"></i> Orders</a>
        <a class="nav-link" href="reports.php"><i class="bi bi-file-earmark-text"></i> Reports</a>
        <div style="margin-top: auto; padding-bottom: 20px;">
            <a class="nav-link" href="login.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
        </div>
    </nav>
</div>

<div class="main-content">
    <h2 class="fw-bold mb-1">User Management</h2>
    <p class="text-muted mb-4">Manage customer accounts and their information</p>

    <div class="search-bar">
        <i class="bi bi-search text-muted me-2"></i>
        <input type="text" placeholder="Search by name, email, or phone number..." style="border: none; outline: none; width: 90%;">
    </div>

    <div class="user-card">
        <table class="table align-middle border-0">
            <thead>
                <tr class="text-muted small">
                    <th>USER ID</th>
                    <th>NAME</th>
                    <th>CONTACT INFO</th>
                    <th>ADDRESS</th>
                    <th>REGISTERED</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
               <?php while($row = $result->fetch_assoc()): 
    // سنستخدم الجزء الأول من الإيميل كاسم مستخدم (مثلاً jana من jana@gmail.com)
    $emailParts = explode('@', $row['email']);
    $displayName = ucfirst($emailParts[0]); 
    
    // الحرف الأول للـ Avatar
    $initial = strtoupper(substr($displayName, 0, 1)); 
?>
<tr>
    <td class="text-muted">USR-<?php echo str_pad($row['id'], 3, '0', STR_PAD_LEFT); ?></td>
    <td>
        <div class="d-flex align-items-center gap-3">
            <div class="user-avatar" style="background: #3498db; width: 35px; height: 35px; border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                <?php echo $initial; ?>
            </div>
            <span class="fw-bold"><?php echo $displayName; ?></span>
        </div>
    </td>
    <td>
        <div class="small"><i class="bi bi-envelope text-muted"></i> <?php echo $row['email']; ?></div>
        <div class="small"><i class="bi bi-person-badge text-muted"></i> Role: <?php echo $row['role']; ?></div>
    </td>
    <td class="small">Lebanon</td> 
    <td class="small">2026-05-10</td> 
    <td><span class="status-badge" style="background: #e8f5e9; color: #2e7d32; padding: 4px 12px; border-radius: 15px; font-size: 12px;">Active</span></td>
    <td>
        <button class="btn btn-sm text-primary"><i class="bi bi-pencil-square"></i></button>
        <button class="btn btn-sm text-danger"><i class="bi bi-trash"></i></button>
    </td>
</tr>
<?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>