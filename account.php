<?php
include('config.php');
session_start();
$user = $_SESSION['username'];

// Get Account ID and Vote Points
$acc_query = $conn->query("SELECT id, vppoints FROM $auth_db.account WHERE username = '$user'");
$acc = $acc_query->fetch_assoc();
$acc_id = $acc['id'];

// Get Gold and Level from Characters table
$char_query = $conn->query("SELECT name, level, money FROM $char_db.characters WHERE account = '$acc_id' LIMIT 1");
$char = $char_query->fetch_assoc();

// Convert copper to gold
$gold = floor($char['money'] / 10000);
?>

<div class="sidebar">
    <h3>Character: <?php echo $char['name']; ?></h3>
    <p>Rank/Level: <?php echo $char['level']; ?></p>
    <p>Gold: <?php echo $gold; ?>g</p>
    <p>Vote Points: <?php echo $acc['vppoints']; ?></p>
</div>
