<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hazardous War | Wrath of the Lich King</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Verdana&display=swap" rel="stylesheet">
</head>
<body>

<canvas id="canvas"></canvas>

<div class="main-wrapper">
    <header>
        <img src="https://fontmeme.com/permalink/231026/0b8e7349191e483582496a77d13f9661.png" alt="Hazardous War Logo" class="logo">
    </header>

    <div class="container">
        <aside class="glass-box sidebar">
            <h3 class="box-title">Realm Status</h3>
            <div class="status-container">
                <?php
                $fp = @fsockopen("127.0.0.1", 8085, $errno, $errstr, 0.5);
                if ($fp) {
                    echo "<div class='status-indicator online'></div> <span class='online-text'>Northrend: ONLINE</span>";
                    fclose($fp);
                } else {
                    echo "<div class='status-indicator offline'></div> <span class='offline-text'>Northrend: OFFLINE</span>";
                }
                ?>
            </div>
            
            <div class="realmlist-box">
                <small>SET REALMLIST</small>
                <p>hazardouswar.servegame.com</p>
            </div>

            <h3 class="box-title">Bug Tracker</h3>
            <form action="report.php" method="POST" class="bug-form">
                <textarea name="bug" placeholder="Report a bug to Discord..."></textarea>
                <button type="submit" class="blizz-btn">Submit Report</button>
            </form>
        </aside>

        <main class="glass-box main-content">
            <h2 class="warcraft-font">Frostmourne Hungers...</h2>
            <p class="flavor-text">Join the most hardcore WotLK experience. Custom weapons, dedicated hardware, and a world where every choice matters.</p>
            
            <div class="action-grid">
                <a href="register.php" class="action-card">
                    <img src="https://render.worldofwarcraft.com/us/icons/56/inv_misc_armornugget_01.jpg" alt="Join">
                    <span>Create Account</span>
                </a>
                <a href="armory.php" class="action-card">
                    <img src="https://render.worldofwarcraft.com/us/icons/56/inv_sword_39.jpg" alt="Shop">
                    <span>Custom Armory</span>
                </a>
            </div>
        </main>

        <aside class="glass-box sidebar">
            <h3 class="box-title">Account Login</h3>
            <form action="login.php" method="POST" class="login-form">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="blizz-btn gold">Enter World</button>
            </form>
        </aside>
    </div>
</div>

<script src="flare.js"></script>
</body>
</html>
