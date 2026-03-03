<?php
include('config.php');

// 1. Handle Stats Sync (From PowerShell)
if (isset($_POST['key']) && $_POST['key'] === "Darkbishop1109") {
    if (isset($_POST['status'])) file_put_contents('status.txt', $_POST['status']);
    if (isset($_POST['count'])) file_put_contents('online.txt', (int)$_POST['count']);
    if (isset($_POST['auctions'])) file_put_contents('auctions.json', $_POST['auctions']);
    if (isset($_POST['zones'])) file_put_contents('zones.json', $_POST['zones']);
    if ($_POST['status'] == "ONLINE" && !file_exists('uptime.txt')) file_put_contents('uptime.txt', time());
    echo "Sync Successful";
}

// 2. Handle Custom Gear Requests
if (isset($_POST['type']) && $_POST['type'] === "gear_request") {
    $name = htmlspecialchars($_POST['char_name']);
    $item = htmlspecialchars($_POST['gear_type']);
    $details = htmlspecialchars($_POST['details']);
    
    $discord_msg = "⚔️ **NEW CUSTOM GEAR REQUEST** ⚔️\n\n**Character:** $name\n**Order:** $item\n**Details:** $details\n\n_Contact the player ingame to finalize payment._";
    
    // Call the function from your config.php
    if (function_exists('sendToDiscord')) {
        sendToDiscord($discord_msg);
    }
    
    echo "<script>alert('Request sent! A GM will contact you soon.'); window.location='index.php';</script>";
}
?>
