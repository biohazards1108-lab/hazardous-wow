<?php
include('config.php');
$secret_key = "YourSecretPassword123"; 

if (isset($_POST['key']) && $_POST['key'] === $secret_key) {
    
    // 1. Update Player Count
    if (isset($_POST['count'])) {
        file_put_contents('online.txt', (int)$_POST['count']);
    }

    // 2. Update Auction House
    if (isset($_POST['auctions'])) {
        file_put_contents('auctions.json', $_POST['auctions']);
    }

    // 3. Update Uptime Timestamp
    // When the server starts, it sends 'reset=1' to start the clock over
    if (isset($_POST['reset']) && $_POST['reset'] == "1") {
        file_put_contents('uptime.txt', time());
        
        // Notify Discord that the server is BACK ONLINE
        sendToDiscord("🛡️ **Server Status:** The Frozen Throne is now **ONLINE**!");
    }

    echo "Sync Successful";
} else {
    die("Access Denied");
}
?>
