<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM medicines WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: medicines.php"); 
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>