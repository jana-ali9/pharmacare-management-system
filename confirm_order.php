<?php 
include 'db_connect.php'; 
include 'header.php'; 

$full_name = isset($_POST['full_name']) ? $_POST['full_name'] : 'Guest';
$phone     = isset($_POST['phone']) ? $_POST['phone'] : 'N/A';
$address   = isset($_POST['address']) ? $_POST['address'] : 'N/A';

$orderNumber = rand(70000000, 79999999);
$orderDate = date("F j, Y");
?>

<div class="container my-5 text-center px-4">
    <div class="mb-4">
        <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
             style="width: 100px; height: 100px; background-color: #e8f5e9;">
            <i class="bi bi-check2-circle" style="font-size: 50px; color: #4caf50;"></i>
        </div>
    </div>

    <h1 class="fw-bold mb-3" style="color: #0d2c54;">Order Placed Successfully!</h1>
    <p class="text-muted mx-auto mb-5" style="max-width: 500px;">
        Thank you <b><?php echo htmlspecialchars($full_name); ?></b>. We've received your order for the address: 
        <br><span class="badge bg-light text-dark border mt-2"><?php echo htmlspecialchars($address); ?></span>
    </p>

    <div class="card border-0 mx-auto mb-5 shadow-sm" 
         style="max-width: 600px; border-radius: 20px; background-color: #f8fbff; border: 1px solid #e1f0ff !important;">
        <div class="card-body p-4 text-start">
            <div class="d-flex align-items-center mb-4">
                <i class="bi bi-box-seam fs-4 me-2 text-primary"></i>
                <h5 class="fw-bold mb-0" style="color: #0d2c54;">Order Details</h5>
            </div>
            
            <div class="row mb-3">
                <div class="col-6 text-muted">Order Number:</div>
                <div class="col-6 text-end fw-bold">#<?php echo $orderNumber; ?></div>
            </div>
            
            <div class="row mb-3">
                <div class="col-6 text-muted">Customer Phone:</div>
                <div class="col-6 text-end fw-bold"><?php echo htmlspecialchars($phone); ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-6 text-muted">Order Date:</div>
                <div class="col-6 text-end fw-bold"><?php echo $orderDate; ?></div>
            </div>
            
            <div class="row">
                <div class="col-6 text-muted">Estimated Delivery:</div>
                <div class="col-6 text-end fw-bold text-success">2-3 Business Days</div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center gap-3 mb-5">
        <a href="index.php" class="btn btn-outline-secondary rounded-pill px-4 py-2 border-2 fw-bold shadow-sm">
            <i class="bi bi-house-door me-2"></i> Back to Home
        </a>
        <a href="index.php" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm" style="background-color: #1a4d8c; border: none;">
            <i class="bi bi-search me-2"></i> Continue Shopping
        </a>
    </div>

    <p class="text-muted small">You will receive an email confirmation shortly at your registered account.</p>
</div>

<?php include 'footer.php'; ?>