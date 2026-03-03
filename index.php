<?php 
@include('config.php'); 
error_reporting(E_ALL); ini_set('display_errors', 1);

// FETCH DATA
$online_players = file_exists('online.txt') ? (int)@file_get_contents('online.txt') : 0;
$auctions = file_exists('auctions.json') ? json_decode(@file_get_contents('auctions.json'), true) : [];
$zones = file_exists('zones.json') ? json_decode(@file_get_contents('zones.json'), true) : [];
$status_data = file_exists('status.txt') ? @file_get_contents('status.txt') : "OFFLINE";
$uptime = file_exists('uptime.txt') && $status_data == "ONLINE" ? (floor((time() - (int)@file_get_contents('uptime.txt'))/60)) . "m" : "0m";

function formatWoWGold($c) { $g=floor($c/10000); $s=floor(($c%10000)/100); $cp=$c%100; return "<span class='g'>$g</span><span class='s'>$s</span><span class='c'>$cp</span>"; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HAZARDOUS WoW</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Quicksand:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root { --frost: #a3e4ff; --dk-bg: #010307; --panel: rgba(10, 20, 35, 0.8); }
        body { margin: 0; background: var(--dk-bg); color: #e0e0e0; font-family: 'Quicksand', sans-serif; display: flex; height: 100vh; overflow: hidden; }
        .bg-wrap { position: fixed; width: 100%; height: 100%; background: url('https://web.archive.org/web/20101204043250im_/http://www.worldofwarcraft.com/downloads/wallpapers/patch330/patch330-1280x1024.jpg') center/cover; z-index: -2; filter: brightness(0.15); }
        
        /* SIDEBAR NAVIGATION */
        aside { width: 300px; background: rgba(0,0,0,0.95); border-right: 1px solid rgba(163,228,255,0.1); padding: 20px; overflow-y: auto; z-index: 10; }
        .side-card { background: var(--panel); border: 1px solid #1a2a3a; padding: 15px; border-radius: 4px; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.5); }
        .side-card h2 { font-family: 'Cinzel'; color: var(--frost); font-size: 14px; margin: 0 0 10px 0; border-bottom: 1px solid #333; padding-bottom: 5px; }
        
        /* MAIN CENTER CONTENT */
        main { flex: 1; padding: 40px; overflow-y: auto; position: relative; }
        .hero-title { font-family: 'Cinzel'; font-size: 50px; text-align: center; color: #fff; text-shadow: 0 0 30px var(--frost); margin-bottom: 40px; }
        .news-container { max-width: 900px; margin: 0 auto; }
        .discord-news-iframe { width: 100%; height: 800px; border: none; border-radius: 8px; background: rgba(0,0,0,0.5); }

        /* BUTTONS & STATS */
        .btn { display: block; text-align: center; padding: 8px; margin-top: 5px; border: 1px solid var(--frost); color: var(--frost); text-decoration: none; font-size: 12px; font-family: 'Cinzel'; }
        .btn:hover { background: var(--frost); color: #000; box-shadow: 0 0 10px var(--frost); }
        .status-on { color: #00ffcc; font-weight: bold; }
        .status-off { color: #ff4444; font-weight: bold; }
        .g { color: #d4af37; font-weight: bold; } .s { color: #c0c0c0; } .c { color: #b87333; }
    </style>
</head>
<body>
    <div class="bg-wrap"></div>
    
    <aside>
        <h1 style="font-family:'Cinzel'; color:var(--frost); font-size:22px; text-align:center;">HAZARDOUS</h1>
        
        <div class="side-card">
            <h2>REALM STATUS</h2>
            <div style="display:flex; justify-content:space-between; font-size:13px;">
                <span>World:</span><span class="<?=($status_data == "ONLINE" ? "status-on" : "status-off")?>"><?=$status_data?></span>
            </div>
            <div style="text-align:center; padding:10px 0;">
                <span style="font-size:30px; color:#fff; font-family:'Cinzel';"><?=$online_players?></span><br>
                <small>PLAYERS ONLINE</small>
            </div>
            <div style="font-size:11px; opacity:0.6;">UPTIME: <?=$uptime?></div>
        </div>

        <div class="side-card">
            <h2>LIVE ZONE MAP</h2>
            <div style="font-size:12px;">
                <?php if(!empty($zones)): foreach($zones as $z): ?>
                    <div style="display:flex; justify-content:space-between; margin-bottom:3px;">
                        <span>Zone #<?=$z['zone']?></span><span><?=$z['count']?> Players</span>
                    </div>
                <?php endforeach; else: ?>
                    <span style="color:gray;">No data synced.</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="side-card">
            <h2>BLACK MARKET</h2>
            <table style="width:100%; font-size:11px;">
                <?php foreach(array_slice($auctions, 0, 3) as $a): ?>
                    <tr><td><?=substr($a['name'],0,15)?>..</td><td><?=formatWoWGold($a['buyoutprice'])?></td></tr>
                <?php endforeach; ?>
            </table>
            <a href="market.php" class="btn">Full Market</a>
        </div>

        <div class="side-card">
            <h2>QUICK LINKS</h2>
            <a href="register.php" class="btn">Create Account</a>
            <a href="custom_gear.php" class="btn" style="border-color:#d4af37; color:#d4af37;">Custom Gear ($)</a>
            <a href="https://discord.com" class="btn">Join Discord</a>
        </div>
    </aside>

    <main>
        <div class="hero-title">THE FROZEN THRONE</div>
        <div class="news-container">
            <iframe class="discord-news-iframe" src="https://widgetbot.io/channels/YOUR_SERVER_ID/YOUR_NEWS_CHANNEL_ID"></iframe>
        </div>
    </main>
</body>
</html>
