<?php 
include('config.php'); 
session_start();

// 1. Calculate Server Lifetime (Uptime)
// Pulls the very first start time recorded in your database
$uptime_query = $conn->query("SELECT starttime FROM $auth_db.uptime ORDER BY starttime ASC LIMIT 1");
$first_start = $uptime_query->fetch_assoc()['starttime'] ?? time();
$total_active_seconds = time() - $first_start;
$days_online = floor($total_active_seconds / 86400);

// 2. Voting Points Logic (Pulling actual DB value)
$user_points = 0;
$user_gold = 0;

if(isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    // Points from Auth DB
    $point_check = $conn->query("SELECT vpoints FROM $auth_db.account WHERE id = $uid");
    $user_points = ($point_check) ? $point_check->fetch_assoc()['vpoints'] : 0;

    // Gold from Character DB (Actual in-game amount)
    $gold_check = $conn->query("SELECT SUM(money) as total_gold FROM $char_db.characters WHERE account = $uid");
    $gold_raw = ($gold_check) ? $gold_check->fetch_assoc()['total_gold'] : 0;
    $user_gold = floor($gold_raw / 10000); // Convert copper to Gold
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hazardous Server | WotLK Professional</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Oswald:wght@600&display=swap" rel="stylesheet">
    <style>
        /* Stand-out Navigation Styling */
        .premium-nav {
            background: linear-gradient(to bottom, #0a1a2a, #000);
            border-bottom: 3px solid #00d2ff;
            box-shadow: 0 10px 20px rgba(0,0,0,0.8);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .nav-tabs {
            display: flex;
            justify-content: center;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .nav-tabs li a {
            padding: 25px 45px;
            display: block;
            color: #fff;
            text-decoration: none;
            font-family: 'Oswald', sans-serif;
            font-size: 1.3rem;
            letter-spacing: 2px;
            transition: all 0.3s;
            border-right: 1px solid rgba(0, 210, 255, 0.2);
        }
        .nav-tabs li a:hover, .nav-tabs li.active a {
            background: rgba(0, 210, 255, 0.2);
            color: #00d2ff;
            text-shadow: 0 0 15px #00d2ff;
            box-shadow: inset 0 -5px 0 #00d2ff;
        }
        .server-title-hero {
            font-family: 'Cinzel', serif;
            font-size: 4.5rem;
            color: #fff;
            text-shadow: 0 0 30px #00d2ff;
            margin: 40px 0 10px 0;
        }
    </style>
</head>
<body>

<canvas id="canvas"></canvas>

<nav class="premium-nav">
    <ul class="nav-tabs">
        <li class="active"><a href="index.php">HOME</a></li>
        <li><a href="register.php">JOIN US</a></li>
        <li><a href="armory.php">ARTIFACTS</a></li>
        <li><a href="stats.php">RANKINGS</a></li>
        <li><a href="https://discord.gg/yourlink">DISCORD</a></li>
    </ul>
</nav>

<div class="wrapper" style="text-align:center;">
    <h1 class="server-title-hero">HAZARDOUS SERVER</h1>
    
    <div class="uptime-pill" style="background: rgba(0,0,0,0.8); padding: 10px 25px; border: 1px solid #ffd100; border-radius: 50px; display: inline-block;">
        <span style="color:#fff;">SERVER ESTABLISHED:</span> 
        <span style="color:#ffd100; font-weight:bold;"><?php echo $days_online; ?> DAYS AGO</span>
    </div>

    <div class="grid-layout" style="margin-top: 50px;">
        <aside class="shard shard-left">
            <div class="shard-header">MY CHARACTER</div>
            <div class="shard-body">
                <p>Voting Points: <b style="color:#00d2ff;"><?php echo $user_points; ?></b></p>
                <p>In-Game Gold: <b style="color:#ffd100;"><?php echo number_format($user_gold); ?>g</b></p>
            </div>
        </aside>

        <main class="content-shard">
            <h2 style="font-family: 'Cinzel'; color: #00d2ff;">THE FROZEN THRONE AWAITS</h2>
            <p>Welcome to <b>Hazardous Server</b>. Every new champion begins with 0 Voting Points. Earn your legacy through raids, voting, and conquest.</p>
        </main>
    </div>
</div>

<script src="flare.js"></script>
</body>
</html>
