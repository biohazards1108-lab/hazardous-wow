<?php 
include('config.php'); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. REAL-TIME PLAYER COUNT (From Sync File)
$online_players = 0;
if (file_exists('online.txt')) {
    $online_players = (int)file_get_contents('online.txt');
}

// 2. SERVER STATUS (Socket Check)
$realm_ip = "hazardouswar.servegame.com";
$realm_port = 8085;
$connection = @fsockopen($realm_ip, $realm_port, $errno, $errstr, 1);
$status_text = $connection ? "ONLINE" : "OFFLINE";
$status_class = $connection ? "status-on" : "status-off";
if($connection) fclose($connection);

// 3. WOW UTILITIES
function formatWoWGold($copper) {
    $gold = floor($copper / 10000);
    $silver = floor(($copper % 10000) / 100);
    $cp = $copper % 100;
    return "<span class='g'>$gold</span> <span class='s'>$silver</span> <span class='c'>$cp</span>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAZARDOUS WoW | The Frozen Throne</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Quicksand:wght@300;400&display=swap" rel="stylesheet">
    <style>
        :root {
            --frost-blue: #a3e4ff;
            --death-knell: #050b14;
            --gold-leaf: #d4af37;
            --ice-gradient: linear-gradient(180deg, rgba(10, 25, 41, 0.95) 0%, rgba(2, 5, 10, 1) 100%);
        }
        body { margin: 0; background: var(--death-knell); color: #d1d1d1; font-family: 'Quicksand', sans-serif; overflow-x: hidden; }
        h1, h2, h3, .nav-brand { font-family: 'Cinzel', serif; }
        .bg-wrap { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: url('https://web.archive.org/web/20101204043250im_/http://www.worldofwarcraft.com/downloads/wallpapers/patch330/patch330-1280x1024.jpg') center/cover no-repeat; z-index: -2; filter: brightness(0.3); }
        .bg-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle, transparent 10%, var(--death-knell) 100%); z-index: -1; }
        .top-bar { background: rgba(0, 0, 0, 0.9); backdrop-filter: blur(15px); border-bottom: 1px solid rgba(163, 228, 255, 0.1); padding: 15px 0; position: sticky; top: 0; z-index: 1000; }
        .nav-content { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px; }
        .nav-brand { color: var(--frost-blue); text-decoration: none; font-size: 26px; letter-spacing: 3px; }
        .nav-links a { color: #fff; text-decoration: none; margin-left: 25px; font-size: 13px; text-transform: uppercase; }
        .hero { height: 50vh; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; }
        .hero h1 { font-size: 60px; color: #fff; text-shadow: 0 0 40px rgba(0, 204, 255, 0.6); letter-spacing: 15px; margin: 0; }
        .master-container { max-width: 1200px; margin: -40px auto 100px; display: grid; grid-template-columns: 2.5fr 1fr; gap: 30px; padding: 0 20px; }
        .main-panel, .sidebar-box { background: var(--ice-gradient); border: 1px solid rgba(255, 255, 255, 0.05); padding: 30px; box-shadow: 0 30px 60px rgba(0,0,0,0.7); }
        .section-title { font-family: 'Cinzel'; color: var(--frost-blue); font-size: 24px; margin-bottom: 20px; border-bottom: 1px solid rgba(163, 228, 255, 0.1); padding-bottom: 15px; }
        .player-count { font-size: 32px; color: #fff; font-family: 'Cinzel'; text-align: center; margin: 10px 0; text-shadow: 0 0 20px var(--frost-blue); }
        .status-on { color: #00ffcc; font-weight: bold; }
        .status-off { color: #ff4444; font-weight: bold; }
        .dl-btn { display: block; background: rgba(163, 228, 255, 0.1); border: 1px solid var(--frost-blue); color: var(--frost-blue); text-align: center; padding: 12px; text-decoration: none; font-family: 'Cinzel'; margin-top: 15px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 15px 10px; border-bottom: 1px solid rgba(255,255,255,0.03); }
        .q5 { color: #ff8000; font-weight: bold; }
        .g { color: var(--gold-leaf); font-weight: bold; }
    </style>
</head>
<body>
<div class="bg-wrap"></div><div class="bg-overlay"></div>
<nav class="top-bar">
    <div class="nav-content">
        <a href="index.php" class="nav-brand">HAZARDOUS</a>
        <div class="nav-links">
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
        </div>
    </div>
</nav>
<header class="hero">
    <h1>THE FROZEN THRONE</h1>
    <p style="color:var(--frost-blue)">Wrath of the Lich King 3.3.5a</p>
</header>
<div class="master-container">
    <div class="main-panel">
        <div class="section-title">Black Market</div>
        <table>
            <?php
            if (file_exists('auctions.json')) {
                $auctions = json_decode(file_get_contents('auctions.json'), true);
                if (!empty($auctions)) {
                    foreach ($auctions as $row) {
                        $q = "q" . ($row['Quality'] ?? 0);
                        echo "<tr><td class='$q'>".strtoupper($row['name'])."</td><td>".formatWoWGold($row['buyoutprice'])."</td></tr>";
                    }
                } else { echo "<tr><td>No auctions found.</td></tr>"; }
            } else { echo "<tr><td>Waiting for server sync...</td></tr>"; }
            ?>
        </table>
    </div>
    <div class="sidebar">
        <div class="sidebar-box">
            <div style="display:flex; justify-content:space-between;"><span>Status</span><span class="<?=$status_class?>"><?=$status_text?></span></div>
            <div class="player-count"><?=$online_players?></div>
            <div style="text-align:center; font-size:10px; color:gray;">ONLINE CHAMPIONS</div>
        </div>
        <div class="sidebar-box" style="margin-top:20px;">
            <h3 style="margin-top:0">DOWNLOAD</h3>
            <a href="#" class="dl-btn">Download Client</a>
        </div>
    </div>
</div>
</body>
</html>
