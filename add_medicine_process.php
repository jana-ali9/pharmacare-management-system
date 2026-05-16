<?php
// الاتصال بقاعدة البيانات
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استقبال البيانات من الفورم
    $name = $_POST['name'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $expiry_date = $_POST['expiry_date'];

    // كود الإدخال (تأكدي أن أسماء الأعمدة تطابق جدولك في phpMyAdmin)
    $sql = "INSERT INTO medicines (name, category, stock, price, expiry_date) 
            VALUES ('$name', '$category', '$stock', '$price', '$expiry_date')";

    if ($conn->query($sql) === TRUE) {
        // إذا نجح الإدخال، ارجع لصفحة الأدوية فوراً
        header("Location: medicines.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>