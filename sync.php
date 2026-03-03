<?php
include('config.php');

// CHANGE THIS to a secure password
$secret_key = "Frostknight1109"; 

if (isset($_POST['key']) && $_POST['key'] === $secret_key) {
    
    // Handle Player Count
    if (isset($_POST['count'])) {
        file_put_contents('online.txt', (int)$_POST['count']);
    }

    // Handle Auction House Data
    if (isset($_POST['auctions'])) {
        file_put_contents('auctions.json', $_POST['auctions']);
    }

    echo "Sync Successful";
} else {
    die("Access Denied");
}
?>
