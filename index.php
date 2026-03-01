<?php 
include('config.php'); 

// Live Gold Counter Logic
// This sums up all the money from every character on the server
$gold_query = $conn->query("SELECT SUM(money) as total_money FROM $char_db.characters");
$gold_data = $gold_query->fetch_assoc();
$total_gold = floor($gold_data['total_money'] / 10000); // Convert copper to gold
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hazardous War | The Frozen Throne</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

<canvas id="canvas"></canvas>

<div class="wrapper">
    <header class="main-header">
        <h1 class="main-title">HAZARDOUS WAR</h1>
    </header>

    <div class="grid-layout">
        <aside class="shard shard-left">
            <div class="shard-header">COMMUNITY</div>
            <div class="shard-body" style="text-align:center; padding: 20px;">
                <p>Join our official Discord to chat with the developers and get the latest updates.</p>
                <a href="https://discord.gghttps://discord.gg/k2wt8Tjz" target="_blank">
                    <button class="btn-summon" style="background: linear-gradient(to bottom, #5865F2, #3539df); border-color: #fff;">JOIN OUR DISCORD</button>
                </a>
            </div>

            <div class="shard-header" style="margin-top:20px;">ECONOMY WATCH</div>
            <div class="shard-body" style="text-align:center; padding: 15px;">
                <span style="color: #ffd100; font-size: 1.2rem; font-weight: bold;">
                    Server Wealth: <?php echo number_format($total_gold); ?>g
                </span>
            </div>
        </aside>

        <main class="content-shard">
            <div class="welcome-text">
                <h2>THE DEAD RISE AT HIS COMMAND</h2>
                <div class="cta-row">
                    <a href="register.php" class="btn-summon" style="text-decoration:none; display:inline-block; width: 200px;">JOIN THE REALM</a>
                </div>
            </div>
        </main>

        <aside class="shard shard-right">
            <div class="shard-header">CHAMPION LOGIN</div>
            <form action="login.php" method="POST" class="shard-form" style="padding:15px;">
                <input type="text" name="username" placeholder="ACCOUNT NAME" class="ice-input">
                <input type="password" name="password" placeholder="PASSWORD" class="ice-input">
                <button type="submit" class="btn-summon">ENTER WORLD</button>
            </form>
        </aside>
    </div>
</div>

<script src="flare.js"></script>
</body>
</html>
