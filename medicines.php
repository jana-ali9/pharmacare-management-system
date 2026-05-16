<?php
session_start();
include 'db_connect.php';

$query = "SELECT * FROM medicines";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medicine Management - PharmaCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7fe; font-family: 'Segoe UI', sans-serif; }
        
        .sidebar { background-color: #1a4d8c; color: white; min-height: 100vh; padding: 0; position: fixed; width: inherit; }
        .sidebar .nav-link { color: rgba(255,255,255,0.7); padding: 15px 25px; display: flex; align-items: center; gap: 15px; }
        .sidebar .nav-link:hover { color: white; background: rgba(255,255,255,0.1); }
        .sidebar .nav-link.active { background: #3498db; color: white; margin: 0 10px; border-radius: 10px; }
        
        .main-content { margin-left: 16.66%; padding: 40px; }
        
        .search-container { position: relative; margin-bottom: 30px; }
        .search-container i { position: absolute; left: 20px; top: 15px; color: #aaa; }
        .search-input { padding: 12px 12px 12px 50px; border-radius: 15px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.05); width: 100%; }

        .medicine-table-card { background: white; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.03); overflow: hidden; }
        .table thead { background-color: #f8f9fa; }
        .table th { border: none; padding: 20px; font-weight: 600; color: #555; }
        .table td { border-bottom: 1px solid #f0f0f0; padding: 20px; vertical-align: middle; }
        
        .med-icon { width: 40px; height: 40px; background: #eef2ff; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #1a4d8c; }
        
        .stock-badge { background: #e6f9f0; color: #2dce89; padding: 5px 12px; border-radius: 8px; font-weight: 600; font-size: 13px; }
        .action-btn { border: none; background: none; color: #adb5bd; transition: 0.3s; }
        .action-btn:hover { color: #1a4d8c; }
        .delete-btn:hover { color: #f5365c; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <div class="p-4">
                <h6 class="fw-bold"><i class="bi bi-plus-circle-fill text-info"></i> PharmaCare</h6>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link" href="admin_dashboard.php"><i class="bi bi-grid-fill"></i> Dashboard</a>
                <a class="nav-link active" href="medicines.php"><i class="bi bi-box-seam-fill"></i> Medicines</a>
                <a class="nav-link" href="users.php"><i class="bi bi-people-fill"></i> Users</a>
                <a class="nav-link" href="orders.php"><i class="bi bi-cart-fill"></i> Orders</a>
                <a class="nav-link" href="reports.php"><i class="bi bi-file-bar-graph-fill"></i> Reports</a>
                <a class="nav-link mt-5" href="login.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
            </nav>
        </div>

        <div class="col-md-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold">Medicine Management</h2>
                    <p class="text-muted">Manage your pharmacy inventory and stock levels</p>
                </div>
<button class="btn btn-primary px-4 py-2" style="background-color: #1a4d8c; border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#addMedicineModal">                    <i class="bi bi-plus-lg me-2"></i> Add Medicine
                </button>
            </div>

            <div class="search-container">
                <i class="bi bi-search"></i>
                <input type="text" class="search-input" placeholder="Search by name, category, or manufacturer...">
            </div>

            <div class="medicine-table-card">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Medicine Name</th>
                            <th>Category</th>
                            <th>Manufacturer</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Expiry Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="text-muted small"><?php echo "MED" . str_pad($row['id'], 3, '0', STR_PAD_LEFT); ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="med-icon"><i class="bi bi-box-seam"></i></div>
                                    <div>
                                        <div class="fw-bold"><?php echo $row['name']; ?></div>
                                        <?php if($row['requires_prescription']): ?>
                                            <small class="text-warning" style="font-size: 10px;">Requires Prescription</small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo $row['manufacturer']; ?></td>
                            <td><span class="stock-badge"><?php echo $row['stock']; ?> units</span></td>
                            <td class="fw-bold">$<?php echo number_format($row['price'], 2); ?></td>
                            <td class="text-muted"><?php echo $row['expiry_date']; ?></td>
                            <td>
<button class="action-btn" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">
    <i class="bi bi-pencil-square"></i>
</button>

<div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header border-0 p-4">
                <h5 class="fw-bold">Edit Medicine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="edit_medicine_process.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="mb-3">
                        <label class="form-label text-muted small">Medicine Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Category</label>
                            <input type="text" name="category" class="form-control" value="<?php echo $row['category']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Stock</label>
                            <input type="number" name="stock" class="form-control" value="<?php echo $row['stock']; ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small">Price ($)</label>
                        <input type="text" name="price" class="form-control" value="<?php echo $row['price']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mt-3 py-2" style="border-radius: 10px;">Update Changes</button>
                </form>
            </div>
        </div>
    </div>
</div> 
 <a href="delete_medicine.php?id=<?php echo $row['id']; ?>" 
   class="action-btn delete-btn" 
   onclick="return confirm('Are you sure you want to delete this medicine?')">
   <i class="bi bi-trash"></i>
</a>                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addMedicineModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header border-0 p-4">
                <h5 class="fw-bold">Add New Medicine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="add_medicine_process.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label text-muted small">Medicine Name</label>
                        <input type="text" name="name" class="form-control" style="border-radius: 10px;" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Category</label>
                            <input type="text" name="category" class="form-control" style="border-radius: 10px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Stock Quantity</label>
                            <input type="number" name="stock" class="form-control" style="border-radius: 10px;" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Price ($)</label>
                            <input type="text" name="price" class="form-control" style="border-radius: 10px;" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Expiry Date</label>
                            <input type="date" name="expiry_date" class="form-control" style="border-radius: 10px;">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3 py-2" style="background-color: #1a4d8c; border-radius: 10px;">Save Medicine</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>