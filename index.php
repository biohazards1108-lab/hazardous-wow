<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hazardous War | The Frozen Throne</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="ice-background">
    <div class="skulls-layer"></div>
    <div class="lich-king-summon"></div>
</div>

<div class="wrapper">
    <nav class="navbar">
        <div class="nav-content">
            <a href="index.php" class="nav-item active">HOME</a>
            <a href="register.php" class="nav-item">JOIN REALM</a>
            <a href="armory.php" class="nav-item">ARMORY</a>
            <a href="donate.php" class="nav-item">STORE</a>
        </div>
    </nav>

    <header class="main-header">
        <h1 class="main-title">HAZARDOUS WAR</h1>
        <div class="server-status">
            <?php
            $fp = @fsockopen("127.0.0.1", 8085, $errno, $errstr, 0.5);
            if ($fp) {
                echo "<span class='status-glow online'></span> <span class='status-text'>FROSTREANNE ONLINE</span>";
                fclose($fp);
            } else {
                echo "<span class='status-glow offline'></span> <span class='status-text'>REALM OFFLINE</span>";
            }
            ?>
        </div>
    </header>

    <div class="grid-layout">
        <aside class="shard shard-left">
            <div class="shard-header">CHAMPION LOGIN</div>
            <form action="login.php" method="POST" class="shard-form">
                <input type="text" name="username" placeholder="ACCOUNT NAME" class="ice-input">
                <input type="password" name="password" placeholder="PASSWORD" class="ice-input">
                <button type="submit" class="btn-summon">ENTER WORLD</button>
            </form>
            <div class="realmlist-shard">
                <span>SET REALMLIST</span>
                <code>hazardouswar.servegame.com</code>
            </div>
        </aside>

        <main class="content-shard">
            <div class="welcome-text">
                <h2>THE DEAD RISE AT HIS COMMAND</h2>
                <p>Experience a high-rate WotLK realm featuring custom Trinity Creator artifacts and a balanced PvP ecosystem.</p>
                <div class="cta-row">
                    <a href="register.php" class="btn-primary">CREATE ACCOUNT</a>
                </div>
            </div>
        </main>

        <aside class="shard shard-right">
            <div class="shard-header">SUPPORT & BUGS</div>
            <p class="shard-desc">Found a bug? The Lich King demands perfection. Report it to Discord below.</p>
            <form action="report.php" method="POST" class="shard-form">
                <textarea name="bug" placeholder="Describe the issue..." class="ice-input"></textarea>
                <button type="submit" class="btn-summon">SEND REPORT</button>
            </form>
        </aside>
    </div>
</div>

<script src="flare.js"></script>
</body>
</html>
