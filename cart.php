<?php 
include 'db_connect.php'; 
include 'header.php'; 
?>
<?php
session_start();

if (isset($_GET['add'])) {
    $medicine_id = $_GET['add'];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    $_SESSION['cart'][] = $medicine_id;
        header("Location: cart.php");
    exit();
}
?>
<div class="container my-5 px-4">
    <div class="row">
        <div class="col-lg-8">
            <h2 class="fw-bold mb-1" style="color: #0d2c54;">Shopping Cart</h2>
            <p class="text-muted mb-4">3 items in your cart</p>
            
            <!-- دواء 1 -->
            <div class="card border-0 shadow-sm mb-3 p-3" style="border-radius: 15px;">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 me-3" style="background-color: #e3f2fd;">
                        <i class="bi bi-capsule fs-2 text-primary"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fw-bold mb-0">Aspirin 500mg</h5>
                        <p class="text-muted small mb-3">Al-Amal Pharmacy - Beirut</p>
                        <div class="d-flex align-items-center">
                            <div class="btn-group btn-group-sm border rounded-pill overflow-hidden me-3" style="background: #f8f9fa;">
                                <button class="btn btn-light px-3 border-0">-</button>
                                <span class="px-3 py-1 fw-bold">1</span>
                                <button class="btn btn-light px-3 border-0">+</button>
                            </div>
                            <button class="btn btn-link text-danger text-decoration-none small p-0">
                                <i class="bi bi-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                    <div class="text-end">
                        <h5 class="fw-bold mb-0">$12.99</h5>
                        <small class="text-muted">$12.99 each</small>
                    </div>
                </div>
            </div>

            <!-- دواء 2 -->
            <div class="card border-0 shadow-sm mb-3 p-3" style="border-radius: 15px;">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 me-3" style="background-color: #e3f2fd;">
                        <i class="bi bi-capsule fs-2 text-primary"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fw-bold mb-0">Levothyroxine 100mcg</h5>
                        <p class="text-muted small mb-3">Al-Amal Pharmacy - Beirut</p>
                        <div class="d-flex align-items-center">
                            <div class="btn-group btn-group-sm border rounded-pill overflow-hidden me-3" style="background: #f8f9fa;">
                                <button class="btn btn-light px-3 border-0">-</button>
                                <span class="px-3 py-1 fw-bold">1</span>
                                <button class="btn btn-light px-3 border-0">+</button>
                            </div>
                            <button class="btn btn-link text-danger text-decoration-none small p-0">
                                <i class="bi bi-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                    <div class="text-end">
                        <h5 class="fw-bold mb-0">$16.25</h5>
                        <small class="text-muted">$16.25 each</small>
                    </div>
                </div>
            </div>

        </div>

        <!-- ملخص الطلب -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px;">
                <h5 class="fw-bold mb-4">Order Summary</h5>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Subtotal</span>
                    <span class="fw-bold">$39.23</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Tax (8%)</span>
                    <span class="fw-bold">$3.14</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Shipping</span>
                    <span class="text-success fw-bold">Free</span>
                </div>
                <hr class="my-4">
                <div class="d-flex justify-content-between mb-4">
                    <span class="h4 fw-bold">Total</span>
                    <span class="h4 fw-bold text-primary">$42.37</span>
                </div>
   <button class="btn btn-primary w-100 rounded-3 py-3 fw-bold mb-3" 
        style="background-color: #1a8c70; border: none;" 
        data-bs-toggle="modal" 
        data-bs-target="#orderModal"> 
    Place Order
</button>
                <p class="text-center text-muted small px-3">
                    By placing this order, you agree to our terms and conditions.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" style="color: #0d2c54;">Complete Your Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <form action="confirm_order.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Full Name *</label>
                        <input type="text" name="full_name" class="form-control border-0" 
                               style="background-color: #f0f7ff; border-radius: 12px; padding: 12px;" 
                               placeholder="Jana Ali" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Phone Number *</label>
                        <input type="tel" name="phone" class="form-control border-0" 
                               style="background-color: #f0f7ff; border-radius: 12px; padding: 12px;" 
                               placeholder="76776544" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold">Detailed Delivery Address *</label>
                        <textarea name="address" class="form-control border-0" rows="3" 
                                  style="background-color: #f0f7ff; border-radius: 12px; padding: 12px;" 
                                  placeholder="beirout, hamra, LAU" required></textarea>
                    </div>

                    <div class="p-3 mb-4" style="background-color: #f0f7ff; border-radius: 15px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold" style="color: #0d2c54;">Order Summary</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-muted small">Total Amount:</span>
                            <span class="fw-bold" style="color: #1a4d8c;">$42.37</span>
                        </div>
                    </div>

                    <div class="d-flex gap-2 pb-3">
                        <button type="button" class="btn btn-outline-secondary w-100 rounded-pill py-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2" style="background-color: #0d2c54; border: none;">Confirm Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>