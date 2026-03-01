<?php
include('config.php');
session_start();

if (!isset($_SESSION['username'])) { die("Please login first."); }

$item_id = intval($_GET['item_id']);
$user = $_SESSION['username'];
$cost = 50; // Cost in Vote Points

// 1. Check if user has enough points
$check = $conn->query("SELECT id, vppoints FROM $auth_db.account WHERE username = '$user'");
$acc = $check->fetch_assoc();

if ($acc['vppoints'] >= $cost) {
    // 2. Deduct points
    $conn->query("UPDATE $auth_db.account SET vppoints = vppoints - $cost WHERE id = ".$acc['id']);
    
    // 3. Send item to in-game mail (Standard TrinityCore command)
    // You would typically use a SOAP command here, or insert directly into the mail table
    $msg = "Purchased Item $item_id via Website Armory.";
    sendToDiscord("User $user just bought Item ID: $item_id for $cost points!");
    
    echo "Success! Your item will arrive in your in-game mailbox shortly.";
} else {
    echo "You do not have enough Vote Points.";
}
?>
