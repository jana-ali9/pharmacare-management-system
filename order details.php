<?php
session_start();
include 'db_connect.php';

// التأكد من وجود ID في الرابط
if (!isset($_GET['id'])) {
    header("Location: orders.php");
    exit();
}

$order_id = $_GET['id'];

// استعلام لجلب معلومات الطلب وصاحب الطلب
$sql = "SELECT orders.*, users.email FROM orders 
        JOIN users ON orders.user_id = users.id 
        WHERE orders.id = $order_id";
$result = $conn->query($sql);
$order = $result->fetch_assoc();

if (!$order) {
    echo "Order not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Invoice #<?php echo $order_id; ?> - PharmaCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7fe; font-family: 'Segoe UI', sans-serif; padding: 40px; }
        .invoice-card { background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; max-width: 900px; margin: auto; }
        .invoice-header { background: #1a4d8c; color: white; padding: 40px; display: flex; justify-content: space-between; align-items: center; }
        .invoice-body { padding: 40px; }
        .table thead th { background: #f8f9fa; border: none; color: #718096; font-size: 13px; }
        .status-badge { padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: 500; }
        .badge-delivered { background: #e8f5e9; color: #2e7d32; }
        .total-section { background: #f8f9fa; padding: 20px; border-radius: 15px; margin-top: 30px; }
    </style>
</head>
<body>

<div class="mb-4">
    <a href="orders.php" class="text-decoration-none text-muted"><i class="bi bi-arrow-left"></i> Back to Orders</a>
</div>

<div class="invoice-card">
    <div class="invoice-header">
        <div>
            <h2 class="fw-bold mb-0"><i class="bi bi-box-seam me-2"></i>PharmaCare</h2>
            <p class="mb-0 opacity-75">Order Invoice #ORD-<?php echo str_pad($order_id, 3, '0', STR_PAD_LEFT); ?></p>
        </div>
        <div class="text-end">
            <span class="status-badge badge-delivered">
                <i class="bi bi-check-circle-fill me-1"></i> <?php echo $order['status']; ?>
            </span>
            <p class="mt-2 mb-0 opacity-75">Date: <?php echo date('d M, Y', strtotime($order['order_date'])); ?></p>
        </div>
    </div>

    <div class="invoice-body">
        <div class="row mb-5">
            <div class="col-md-6">
                <h6 class="text-muted fw-bold mb-3">CUSTOMER DETAILS</h6>
                <p class="mb-1 fw-bold"><?php echo explode('@', $order['email'])[0]; ?></p>
                <p class="mb-1 text-muted small"><i class="bi bi-envelope me-1"></i> <?php echo $order['email']; ?></p>
                <p class="text-muted small"><i class="bi bi-geo-alt me-1"></i> Beirut, Lebanon</p>
            </div>
            <div class="col-md-6 text-md-end">
                <h6 class="text-muted fw-bold mb-3">SHIPPING INFO</h6>
                <p class="mb-1 small">Standard Delivery</p>
                <p class="mb-1 small">Estimated: 1-2 Business Days</p>
            </div>
        </div>

        <h6 class="text-muted fw-bold mb-3">ORDER ITEMS</h6>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>MEDICINE NAME</th>
                    <th class="text-center">QTY</th>
                    <th class="text-end">UNIT PRICE</th>
                    <th class="text-end">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="fw-bold">Aspirin 500mg</div>
                        <div class="small text-muted">Bayer Pharmaceutical</div>
                    </td>
                    <td class="text-center">2</td>
                    <td class="text-end">$10.00</td>
                    <td class="text-end fw-bold">$20.00</td>
                </tr>
                <tr>
                    <td>
                        <div class="fw-bold">Panadol Extra</div>
                        <div class="small text-muted">GSK</div>
                    </td>
                    <td class="text-center">1</td>
                    <td class="text-end">$12.50</td>
                    <td class="text-end fw-bold">$12.50</td>
                </tr>
            </tbody>
        </table>

        <div class="row justify-content-end mt-4">
            <div class="col-md-4">
                <div class="total-section">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal:</span>
                        <span>$<?php echo number_format($order['total_amount'] - 5, 2); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Shipping:</span>
                        <span>$5.00</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Grand Total:</span>
                        <span class="fw-bold text-primary fs-5">$<?php echo number_format($order['total_amount'], 2); ?></span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <button class="btn btn-outline-primary btn-sm me-2" onclick="window.print()"><i class="bi bi-printer me-1"></i> Print Invoice</button>
        </div>
    </div>
</div>

</body>
</html>