<?php 
include('config.php'); 

// 1. Get Server Start Time & Calculate Uptime (from realmd.uptime table)
$uptime_query = $conn->query("SELECT starttime FROM $auth_db.uptime ORDER BY starttime ASC LIMIT 1");
$first_start = $uptime_query->fetch_assoc()['starttime'] ?? time();
$total_active_seconds = time() - $first_start;
$days_online = floor($total_active_seconds / 86400);

// 2. Voting Points Logic (Ensure new players start at 0)
// This is handled in your register.php by setting the default value to 0, 
// but here we pull the logged-in user's points.
$user_points = 0;
if(isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $point_check = $conn->query("SELECT vpoints FROM $auth_db.account WHERE id = $uid");
    $user_points = $point_check->fetch_assoc()['vpoints'] ?? 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hazardous Server | The Frozen Throne</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Oswald:wght@500&display=swap" rel="stylesheet">
</head>
<body>

<canvas id="canvas"></canvas>

<div class="wrapper">
    <nav class="premium-nav">
        <ul class="nav-tabs">
            <li class="active"><a href="index.php">HOME</a></li>
            <li><a href="register.php">CREATE ACCOUNT</a></li>
            <li><a href="armory.php">ARTIFACTS</a></li>
            <li><a href="stats.php">RANKINGS</a></li>
            <li><a href="https://discord.gg/"k2wt8Tjz>COMMUNITY</a></li>
        </ul>
    </nav>

    <header class="main-header">
        <h1 class="main-title">HAZARDOUS SERVER</h1>
        <div class="uptime-pill">
            PROJECT ACTIVE FOR: <span><?php echo $days_online; ?> DAYS</span>
        </div>
    </header>

    <div class="grid-layout">
        <aside class="shard shard-left">
            <div class="shard-header">CHAMPION STATS</div>
            <div class="shard-body">
                <div class="stat-row">
                    <span>VOTING POINTS:</span>
                    <span class="gold-text"><?php echo $user_points; ?></span>
                </div>
                <div class="stat-row">
                    <span>IN-GAME GOLD:</span>
                    <span class="gold-text">
                        <?php 
                        // Pull actual in-game gold amount for the logged in user
                        echo "0"; // Placeholder: Add your character gold query here
                        ?>
                    </span>
                </div>
            </div>
        </aside>

        <main class="content-shard">
            <div class="welcome-text">
                <h2>A NEW ERA OF NORTHREND</h2>
                <p>Hazardous Server offers a custom-tuned WotLK experience. No pay-to-win, just pure legendary progression.</p>
            </div>
        </main>
    </div>
</div>

<script src="flare.js"></script>
</body>
</html>
