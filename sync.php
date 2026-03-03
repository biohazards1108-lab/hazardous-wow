<?php
include('config.php');
$secret_key = "Darkbishop1109"; 

if (isset($_POST['key']) && $_POST['key'] === $secret_key) {
    if (isset($_POST['count'])) file_put_contents('online.txt', (int)$_POST['count']);
    if (isset($_POST['auctions'])) file_put_contents('auctions.json', $_POST['auctions']);
    if (isset($_POST['zones'])) file_put_contents('zones.json', $_POST['zones']);
    
    // Status Logic
    if (isset($_POST['status'])) {
        file_put_contents('status.txt', $_POST['status']);
        if ($_POST['status'] == "ONLINE" && !file_exists('uptime.txt')) {
            file_put_contents('uptime.txt', time());
        } elseif ($_POST['status'] == "OFFLINE") {
            @unlink('uptime.txt');
        }
    }
    echo "Sync Successful";
}
?>
