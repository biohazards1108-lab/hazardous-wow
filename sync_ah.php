<?php
include('config.php');
$secret_key = "YourSecretPassword123"; // Must match your local script

if (isset($_POST['key']) && $_POST['key'] === $secret_key && isset($_POST['data'])) {
    $auctions = json_decode($_POST['data'], true);
    
    if ($auctions) {
        // Save the auction data to a local JSON file
        file_put_contents('auctions.json', json_encode($auctions));
        echo "Auction House Sync Successful.";
    }
} else {
    echo "Access Denied.";
}
?>
