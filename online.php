<?php
include('config.php');
$online_query = $conn->query("SELECT COUNT(*) as total FROM $char_db.characters WHERE online = 1");
$online_data = $online_query->fetch_assoc();
echo "<h3>Players Online: " . $online_data['total'] . "</h3>";
?>
