<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hazardous War | The Frozen Throne</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Nanum+Myeongjo:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="video-bg-container">
    <div class="frost-overlay"></div>
</div>

<div class="site-wrapper">
    <nav class="main-nav">
        <div class="nav-links">
            <a href="index.php" class="active">Home</a>
            <a href="register.php">Join Now</a>
            <a href="armory.php">Custom Armory</a>
            <a href="donate.php">Support Us</a>
        </div>
    </nav>

    <header class="hero">
        <img src="https://fontmeme.com/permalink/231026/0b8e7349191e483582496a77d13f9661.png" class="main-logo" alt="Hazardous War">
        <div class="server-status-pill">
            <?php
            $fp = @fsockopen("127.0.0.1", 8085, $errno, $errstr, 0.5);
            if ($fp) {
                echo "<span class='pulse-green'></span> <b>REALM ONLINE</b>";
                fclose($fp);
            } else {
                echo "<span class='pulse-red'></span> <b>MAINTENANCE</b>";
            }
            ?>
        </div>
    </header>

    <div class="content-grid">
        <aside class="side-panel">
            <div class="exotic-box">
                <div class="box-header">Account Portal</div>
                <div class="box-body">
                    <form action="login.php" method="POST">
                        <input type="text" name="username" class="blizz-input" placeholder="ACCOUNT NAME">
                        <input type="password" name="password" class="blizz-input" placeholder="PASSWORD">
                        <button type="submit" class="gold-btn">ENTER WORLD</button>
                    </form>
                    <div class="realmlist-display">
                        <code>SET REALMLIST hazardouswar.servegame.com</code>
                    </div>
                </div>
            </div>
        </aside>

        <main class="main-feature">
            <div class="feature-card">
                <div class="feature-img"></div>
                <div class="feature-text">
                    <h2 class="warcraft-title">The King Returns</h2>
                    <p>Experience the definitive WotLK expansion with our custom <b>Trinity Creator</b> artifacts. Balanced for competitive play, built for legends.</p>
                    <div class="btn-row">
                        <a href="register.php" class="ice-btn">START JOURNEY</a>
                        <a href="armory.php" class="ghost-btn">VIEW ARMORY</a>
                    </div>
                </div>
            </div>
        </main>

        <aside class="side-panel">
            <div class="exotic-box">
                <div class="box-header">Development</div>
                <div class="box-body">
                    <p class="small-text">Help us polish Northrend. Reports are sent directly to our developers.</p>
                    <form action="report.php" method="POST">
                        <textarea name="bug" class="blizz-input" placeholder="DESCRIBE BUG..."></textarea>
                        <button type="submit" class="blue-btn">SEND REPORT</button>
                    </form>
                </div>
            </div>
        </aside>
    </div>
</div>

<script src="flare.js"></script>
</body>
</html>
