<?php
include 'db_connect.php'; 
include 'header.php'; 

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT medicines.*, pharmacies.name AS ph_name, pharmacies.address, pharmacies.phone 
        FROM medicines 
        INNER JOIN pharmacies ON medicines.pharmacy_id = pharmacies.id 
        WHERE medicines.name LIKE '%$search%'";
$result = $conn->query($sql);
?>

<section class="hero-section text-center" style="padding: 60px 0; background-color: #f8fbff;">
    <div class="container">
        <h1 class="fw-bold mb-3" style="color: #0d2c54; font-size: 2.5rem;">Your Trusted Pharmacy<br>Management System</h1>
        <p class="text-muted">Find and order medicines from verified pharmacies. Fast, secure, and reliable.</p>
    </div>
</section>

<div class="container" style="max-width: 650px; margin: -30px auto 0;">
    <form action="" method="GET" class="input-group shadow-sm">
        <input type="text" name="search" class="form-control" style="border-radius: 50px 0 0 50px; padding: 12px 25px;" placeholder="Find your medicine..." value="<?php echo $search; ?>">
        <button class="btn btn-primary" style="border-radius: 0 50px 50px 0; padding: 0 30px; background-color: #1a4d8c;" type="submit">Search</button>
    </form>
</div>

<div class="container mt-5 pt-3 mb-5">
    <?php if ($search != ""): ?>
        <div class="row">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 15px;">
                            <div class="card-body">
                                <h5 class="fw-bold text-primary"><?php echo $row['name']; ?></h5>
                                <p class="small mb-1"><i class="bi bi-geo-alt-fill text-danger"></i> <?php echo $row['ph_name']; ?></p>
                                <p class="text-muted small"><?php echo $row['address']; ?></p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="h5 fw-bold text-success mb-0">$<?php echo $row['price']; ?></span>
<a href="cart.php?add=<?php echo $row['id']; ?>" 
   class="btn btn-outline-primary rounded-pill px-4" 
   style="border-color: #1a4d8c; color: #1a4d8c; font-weight: bold;">
   <i class="bi bi-cart-plus me-1"></i> Add to Cart
</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="text-center py-5">
                    <p class="text-muted">No medicines found for "<?php echo htmlspecialchars($search); ?>".</p>
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="row text-center mt-2">
            <div class="col-md-4 mb-4">
                <div class="p-4 border rounded-4 bg-white h-100">
                    <i class="bi bi-shield-check fs-1 text-primary mb-3"></i>
                    <h6 class="fw-bold">Verified Pharmacies</h6>
                    <p class="text-muted small mb-0">All medicines from licensed and certified pharmacies.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 border rounded-4 bg-white h-100">
                    <i class="bi bi-clock-history fs-1 text-primary mb-3"></i>
                    <h6 class="fw-bold">Quick Delivery</h6>
                    <p class="text-muted small mb-0">Fast and reliable delivery to your doorstep.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 border rounded-4 bg-white h-100">
                    <i class="bi bi-award fs-1 text-primary mb-3"></i>
                    <h6 class="fw-bold">Quality Assured</h6>
                    <p class="text-muted small mb-0">Genuine medicines with expiration date tracking.</p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>