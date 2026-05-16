<?php
include 'db_connect.php'; 

$res_rev = $conn->query("SELECT SUM(total_amount) AS total FROM orders WHERE status = 'Delivered'");
$revenue = $res_rev->fetch_assoc()['total'] ?? 0;

$res_orders = $conn->query("SELECT COUNT(*) AS count FROM orders");
$total_orders = $res_orders->fetch_assoc()['count'];

$recent_orders = $conn->query("
    SELECT orders.id, users.username, orders.total_amount, orders.status 
    FROM orders 
    JOIN users ON orders.user_id = users.id 
    ORDER BY orders.order_date DESC 
    LIMIT 5
");
?>