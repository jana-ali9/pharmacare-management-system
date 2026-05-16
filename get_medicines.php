<?php
include 'db_connect.php';

$sql = "SELECT * FROM medicines";
$result = $conn->query($sql);

$medicines = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $medicines[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($medicines);
?>