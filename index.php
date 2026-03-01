<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Hazardous WoW - WotLK</title>
    <style>
        body { background: #000 url('https://web.archive.org/web/20101201/http://us.media.blizzard.com/wow/media/wallpapers/patch3-2/patch3-2-1920x1200.jpg') no-repeat center top; color: #fff; font-family: 'Verdana', sans-serif; }
        .container { width: 1000px; margin: 200px auto; display: flex; }
        .sidebar { width: 250px; background: rgba(0, 0, 20, 0.8); border: 1px solid #333; padding: 15px; margin: 10px; }
        .main-content { flex-grow: 1; background: rgba(0, 0, 10, 0.7); padding: 20px; border: 1px solid #444; }
        .status-on { color: #0f0; } .status-off { color: #f00; }
        h2 { color: #4ae2ff; text-shadow: 0 0 5px #000; font-family: serif; }
        button { background: #1a3a5a; color: white; border: 1px solid #4ae2ff; cursor: pointer; padding: 5px 10px; }
    </style>
</head>
<body>

<div class="container">
    <div class="sidebar">
        <h3>Server Status</h3>
        <?php
            $fp = @fsockopen("hazardouswar.servegame.com", 8085, $errno, $errstr, 1);
            if ($fp) { echo "<p class='status-on'>Online</p>"; fclose($fp); }
            else { echo "<p class='status-off'>Offline</p>"; }
        ?>
        <hr>
        <h3>Connection</h3>
        <code>set realmlist hazardouswar.servegame.com</code>
        <hr>
        <h3>Bug Report</h3>
        <form method="POST" action="report.php">
            <textarea name="bug" placeholder="Describe the bug..." required></textarea>
            <button type="submit">Send to Discord</button>
        </form>
    </div>

    <div class="main-content">
        <h2>Frostmourne Hungers...</h2>
        <p>Welcome to Hazardous WoW. Log in to manage your champion.</p>
        
        <div id="tabs">
            <a href="armory.php"><button>Custom Armory</button></a>
            <a href="register.php"><button>Create Account</button></a>
        </div>

        <h3>Login</h3>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <button type="submit">Enter Northrend</button>
        </form>
    </div>
</div>

</body>
</html>
