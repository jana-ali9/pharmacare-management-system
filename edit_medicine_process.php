<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];

    $sql = "UPDATE medicines SET name='$name', category='$category', stock='$stock', price='$price' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: medicines.php");
    } else {
        echo "Error updating: " . $conn->error;
    }
}
?>