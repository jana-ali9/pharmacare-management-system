<?php
session_start();
include 'db_connect.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $role = 'user'; 
    $sql = "INSERT INTO users (email, password, role) VALUES ('$email', '$password', '$role')";
    if($conn->query($sql)) {
        header("Location: login.php?msg=account_created");
    }
}
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: index.php");
        }
    } else {
        echo "<script>alert('Invalid Email or Password'); window.location='login.php';</script>";
    }
}
?>