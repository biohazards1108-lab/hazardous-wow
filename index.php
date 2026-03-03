<?php 
// Suppress errors from missing files to prevent black screen
@include('config.php'); 

error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. DATA FETCHING (Using @ to prevent crashes if files don't exist yet)
$online_players = file_exists('online.txt') ? (int)@file_get_contents('online.txt') : 0;
$auctions = file_exists('auctions.json') ? json_decode(@file_get_contents('auctions.json'), true) : [];

// 2. SERVER STATUS
$realm_ip = "hazardouswar.servegame.com";
$realm_port = 8085;
$connection = @fsockopen($realm_ip, $realm_port, $errno, $errstr, 0.5);
$status_text = $connection ? "ONLINE" : "OFFLINE";
$status_class = $connection ? "status-on" : "status-off";
if($connection) @fclose($connection);

// 3. UPTIME LOGIC
$uptime = "OFFLINE";
if (file_exists('uptime.txt') && $connection) {
    $start_time = (int)@file_get_contents('uptime.txt');
    $diff = time() - $start_time;
    $days = floor($diff / 86400);
    $hours = floor(($diff % 86400) / 3600);
    $mins = floor(($diff % 3600) / 60);
    $uptime = "{$days}d {$hours}h {$mins}m";
}

function formatWoWGold($copper) {
    $gold = floor($copper / 10000); $silver = floor(($copper % 10000) / 100); $cp = $copper % 100;
    return "<span class='g'>$gold</span> <span class='s'>$silver</span> <span class='c'>$cp</span>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HAZARDOUS WoW | The Frozen Throne</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Quicksand:wght@300;500&display=swap" rel="stylesheet">
    <style>
        :root { --frost: #a3e4ff; --dk-bg: #02050a; --panel: rgba(10, 20, 35, 0.9); }
        body { margin: 0; background: var(--dk-bg); color: #e0e0e0; font-family: 'Quicksand', sans-serif; overflow-x: hidden; }
        .bg-wrap { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: url('https://web.archive.org/web/20101204043250im_/http://www.worldofwarcraft.com/downloads/wallpapers/patch330/patch330-1280x1024.jpg') center/cover no-repeat; z-index: -2; filter: brightness(0.2); }
        nav { background: rgba(0,0,0,0.9); border-bottom: 1px solid rgba(163,228,255,0.2); padding: 15px 0; position: sticky; top: 0; z-index: 1000; }
        .nav-container { max-width: 1300px; margin: 0 auto; display: flex; justify-content: space-between; padding: 0 20px; }
        .nav-links a { color: #fff; text-decoration: none; margin-left: 20px; font-size: 13px; text-transform: uppercase; }
        .hero { height: 50vh; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; }
        .hero h1 { font-size: 70px; font-family: 'Cinzel'; color: #fff; text-shadow: 0 0 50px rgba(0, 204, 255, 0.6); margin: 0; }
        .content-grid { max-width: 1300px; margin: -50px auto 100px; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; padding: 0 20px; }
        .card { background: var(--panel); border: 1px solid rgba(255,255,255,0.05); padding: 25px; border-radius: 4px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .card:hover { transform: translateY(-5px); border-color: var(--frost); box-shadow: 0 0 20px rgba(163, 228, 255, 0.2); }
        .card h2 { font-family: 'Cinzel'; color: var(--frost); font-size: 18px; margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 10px; }
        .btn { display: block; width: 100%; padding: 10px; text-align: center; text-decoration: none; background: rgba(163, 228, 255, 0.1); border: 1px solid var(--frost); color: var(--frost); margin-top: 10px; font-family: 'Cinzel'; }
        .btn:hover { background: var(--frost); color: #000; box-shadow: 0 0 15px var(--frost); }
        .status-on { color: #00ffcc; font-weight: bold; }
        .status-off { color: #ff4444; font-weight: bold; }
        .g { color: #d4af37; font-weight: bold; }
    </style>
</head>
<body>
<div class="bg-wrap"></div>
<nav><div class="nav-container"><a href="#" style="color:var(--frost); font-family:'Cinzel'; text-decoration:none;">HAZARDOUS</a><div class="nav-links"><a href="index.php">Home</a><a href="register.php">Join</a><a href="login.php">Login</a></div></div></nav>
<header class="hero"><h1>THE FROZEN THRONE</h1><p style="color:var(--frost); letter-spacing:3px;">LIVE WORLD STATUS</p></header>

<div class="content-grid">
    <div class="card">
        <h2>REALM STATUS</h2>
        <div style="display:flex; justify-content:space-between;"><span>World:</span><span class="<?=$status_class?>"><?=$status_text?></span></div>
        <div style="text-align:center; margin: 20px 0;">
            <span style="font-size:40px; color:#fff; font-family:'Cinzel';"><?=$online_players?></span><br>
            <small style="color:gray;">PLAYERS ONLINE</small>
        </div>
        <div style="font-size:12px; border-top:1px solid #222; padding-top:10px;">UPTIME: <?=$uptime?></div>
    </div>

    <div class="card">
        <h2>BLACK MARKET</h2>
        <table style="width:100%; font-size:13px;">
            <?php if(!empty($auctions)): foreach(array_slice($auctions, 0, 5) as $item): ?>
                <tr><td><?=strtoupper($item['name'])?></td><td style="text-align:right;"><?=formatWoWGold($item['buyoutprice'])?></td></tr>
            <?php endforeach; else: ?>
                <tr><td>No active auctions.</td></tr>
            <?php endif; ?>
        </table>
        <a href="market.php" class="btn">View All Items</a>
    </div>

    <div class="card">
        <h2>SERVER HISTORY</h2>
        <div style="font-size: 11px; font-family: monospace; background: rgba(0,0,0,0.4); padding: 10px; height: 100px; overflow-y: auto;">
            <?php echo file_exists('history.log') ? nl2br(@file_get_contents('history.log')) : "No incidents logged."; ?>
        </div>
    </div>

    <div class="card">
        <h2>CUSTOM ARMORY</h2>
        <p style="font-size:13px;">Request custom GM-crafted gear or browse high-level players.</p>
        <a href="custom_gear.php" class="btn" style="border-color:#d4af37; color:#d4af37;">Request Gear ($)</a>
        <a href="armory.php" class="btn">Player Search</a>
    </div>

    <div class="card">
        <h2>REPORT BUGS</h2>
        <form action="send_bugs.php" method="POST">
            <textarea name="bug_desc" style="width:100%; background:#000; color:#fff; border:1px solid #333; padding:5px;" placeholder="What's broken?"></textarea>
            <button type="submit" class="btn">Submit to Discord</button>
        </form>
    </div>
</div>
</body>
</html>
