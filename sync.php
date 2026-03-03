<?php
// Password must match the one in your PowerShell script
$secret_key = "Darkbishop1109"; 

if (isset($_POST['key']) && $_POST['key'] === $secret_key) {
    
    // Update Player Count
    if (isset($_POST['count'])) {
        file_put_contents('online.txt', (int)$_POST['count']);
    }

    // Update Auction House
    if (isset($_POST['auctions'])) {
        // We save the raw data coming from your local DB
        file_put_contents('auctions.json', $_POST['auctions']);
    }

    echo "Sync Successful";
} else {
    // If someone tries to guess the URL without the key, they get this:
    header('HTTP/1.0 403 Forbidden');
    echo "Access Denied";
}
?>
