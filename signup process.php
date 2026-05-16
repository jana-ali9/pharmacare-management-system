<?php
include 'db_connect.php';

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; // يفضل لاحقاً استخدام password_hash
    $role = 'user'; // الدور الافتراضي للزبائن

    // استعلام لإدخال المستخدم الجديد
    $sql = "INSERT INTO users (email, password, role) VALUES ('$email', '$password', '$role')";

    if ($conn->query($sql)) {
        echo "<script>alert('Account created successfully! Please login.'); window.location='login.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>