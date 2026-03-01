<?php 
include('config.php'); 
session_start();

// Calculate Server Lifetime
$uptime_query = $conn->query("SELECT starttime FROM $auth_db.uptime ORDER BY starttime ASC LIMIT 1");
$first_start = ($uptime_query && $uptime_query->num_rows > 0) ? $uptime_query->fetch_assoc()['starttime'] : time();
$days_online = floor((time() - $first_start) / 86400);

$user_points = 0;
$user_gold = 0;

if(isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    // Pulling the vpoints we just fixed in HeidiSQL
    $point_check = $conn->query("SELECT vpoints FROM $auth_db.account WHERE id = $uid");
    if($point_check) { $user_points = $point_check->fetch_assoc()['vpoints'] ?? 0; }

    // Pulling actual In-Game Gold
    $gold_check = $conn->query("SELECT SUM(money) as total_gold FROM $char_db.characters WHERE account = $uid");
    if($gold_check) {
        $gold_raw = $gold_check->fetch_assoc()['total_gold'] ?? 0;
        $user_gold = floor($gold_raw / 10000); 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><p>Need help? <a href="https://discord.gg/YOUR_LINK" style="color: #5865F2; font-weight: bold;">Connect to our Discord</a></p>
    <meta charset="UTF-8">
    <title>Hazardous Server | WotLK</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Oswald:wght@700&display=swap" rel="stylesheet">
    <style>
        /* Stand-out Navigation */
        .premium-nav {
            background: rgba(0, 0, 0, 0.9);
            border-bottom: 4px solid #00d2ff;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .nav-tabs {
            display: flex;
            justify-content: center;
            list-style: none;
            margin: 0; padding: 0;
        }
        .nav-tabs li a {
            padding: 30px 50px;
            display: block;
            color: #fff;
            text-decoration: none;
            font-family: 'Oswald', sans-serif;
            font-size: 1.5rem; /* Larger tabs */
            text-transform: uppercase;
            transition: 0.3s;
        }
        .nav-tabs li a:hover {
            background: #00d2ff;
            color: #000;
            box-shadow: 0 0 20px #00d2ff;
        }
        .nav-tabs li.active a {
            background: rgba(0, 210, 255, 0.3);
            border-bottom: 4px solid #ffd100;
        }
    </style>
</head>
<body>
<canvas id="canvas"></canvas>

<nav class="premium-nav">
    <ul class="nav-tabs">
        <li class="active"><a href="index.php">HOME</a></li>
        <li><a href="register.php">CREATE ACCOUNT</a></li>
        <li><a href="armory.php">ARTIFACTS</a></li>
        <li><a href="stats.php">RANKINGS</a></li>
        <li><a href="https://discord.gg/yourlink">DISCORD</a></li>
    </ul>
</nav>

<div class="wrapper" style="text-align:center; padding-top: 50px;">
    <h1 style="font-family: 'Cinzel'; font-size: 5rem; text-shadow: 0 0 20px #00d2ff;">HAZARDOUS SERVER</h1>
    
    <div class="uptime-display" style="color: #ffd100; font-family: 'Oswald'; font-size: 1.2rem; letter-spacing: 3px;">
        TOTAL TIME ACTIVE: <?php echo $days_online; ?> DAYS
    </div>

    <div class="grid-layout" style="margin-top: 50px;">
        <aside class="shard shard-left">
            <div class="shard-header">ACCOUNT SUMMARY</div>
            <div class="shard-body">
                <p>VOTING POINTS: <span class="gold-text"><?php echo $user_points; ?></span></p>
                <p>IN-GAME GOLD: <span class="gold-text"><?php echo number_format($user_gold); ?>g</span></p>
            </div>
        </aside>

        <main class="content-shard">
            <h2 style="font-family: 'Cinzel'; color: #00d2ff;">Welcome, Champion</h2>
            <p>You are currently viewing the official Hazardous Server portal. All new accounts are initialized with 0 points.</p>
        </main>
    </div>
</div>

<script src="flare.js"></script>
</body>
</html>
