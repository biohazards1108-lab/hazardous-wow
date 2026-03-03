<?php 
include('config.php'); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. DATA FETCHING (Sync Files)
$online_players = file_exists('online.txt') ? (int)file_get_contents('online.txt') : 0;
$auctions = file_exists('auctions.json') ? json_decode(file_get_contents('auctions.json'), true) : [];

// 2. SERVER STATUS & UPTIME
$realm_ip = "hazardouswar.servegame.com";
$realm_port = 8085;
$connection = @fsockopen($realm_ip, $realm_port, $errno, $errstr, 0.5);
$status_text = $connection ? "ONLINE" : "OFFLINE";
$status_class = $connection ? "status-on" : "status-off";
if($connection) fclose($connection);

// Mock Uptime (For real uptime, you'd sync a timestamp from your server)
$uptime = $connection ? "4d 12h 31m" : "0s";

// 3. WOW UTILITIES
function formatWoWGold($copper) {
    $gold = floor($copper / 10000); $silver = floor(($copper % 10000) / 100); $cp = $copper % 100;
    return "<span class='g'>$gold</span> <span class='s'>$silver</span> <span class='c'>$cp</span>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAZARDOUS WoW | The Frozen Throne</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Quicksand:wght@300;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --frost: #a3e4ff;
            --dk-bg: #02050a;
            --panel: rgba(10, 20, 35, 0.9);
            --glow: 0 0 15px rgba(163, 228, 255, 0.4);
            --accent: #d4af37;
        }

        * { box-sizing: border-box; transition: all 0.3s ease; }
        body { margin: 0; background: var(--dk-bg); color: #e0e0e0; font-family: 'Quicksand', sans-serif; overflow-x: hidden; }
        h1, h2, h3, .nav-brand { font-family: 'Cinzel', serif; text-transform: uppercase; letter-spacing: 2px; }

        /* Background Visuals */
        .bg-wrap { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: url('https://web.archive.org/web/20101204043250im_/http://www.worldofwarcraft.com/downloads/wallpapers/patch330/patch330-1280x1024.jpg') center/cover no-repeat; z-index: -2; filter: brightness(0.2); }
        .bg-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle, transparent, var(--dk-bg)); z-index: -1; }

        /* 1. TOP NAV */
        nav { background: rgba(0,0,0,0.9); border-bottom: 1px solid rgba(163,228,255,0.2); padding: 15px 0; position: sticky; top: 0; z-index: 1000; backdrop-filter: blur(10px); }
        .nav-container { max-width: 1300px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px; }
        .nav-links a { color: #fff; text-decoration: none; margin-left: 20px; font-size: 13px; font-weight: 500; }
        .nav-links a:hover { color: var(--frost); text-shadow: var(--glow); }

        /* 2. HERO AREA */
        .hero { height: 60vh; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; }
        .hero h1 { font-size: clamp(40px, 8vw, 90px); color: #fff; text-shadow: 0 0 50px rgba(0, 204, 255, 0.6); margin: 0; }
        .hero p { color: var(--frost); font-size: 1.2rem; letter-spacing: 5px; opacity: 0.8; }

        /* 3. CARD GRID LAYOUT */
        .content-grid { max-width: 1300px; margin: -50px auto 100px; display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 25px; padding: 0 20px; }

        .card { background: var(--panel); border: 1px solid rgba(255,255,255,0.05); padding: 30px; position: relative; overflow: hidden; border-radius: 4px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .card:hover { transform: translateY(-10px); border-color: var(--frost); box-shadow: 0 15px 45px rgba(0, 204, 255, 0.2); }
        
        /* Section Titles */
        .card h2 { font-size: 18px; color: var(--frost); margin-top: 0; border-bottom: 1px solid rgba(163,228,255,0.1); padding-bottom: 15px; display: flex; align-items: center; justify-content: space-between; }
        
        /* Interactive Buttons */
        .btn { display: block; width: 100%; padding: 12px; text-align: center; text-decoration: none; font-family: 'Cinzel'; background: rgba(163, 228, 255, 0.05); border: 1px solid var(--frost); color: var(--frost); margin-top: 15px; cursor: pointer; }
        .btn:hover { background: var(--frost); color: var(--dk-bg); box-shadow: 0 0 20px var(--frost); font-weight: bold; }

        /* Special Highlights */
        .news-item { margin-bottom: 20px; padding-left: 15px; border-left: 2px solid var(--accent); }
        .news-item small { color: var(--accent); display: block; margin-bottom: 5px; }
        
        .stat-val { font-family: 'Cinzel'; font-size: 28px; color: #fff; text-align: center; display: block; margin: 10px 0; }
        .status-on { color: #00ffcc; text-shadow: 0 0 10px #00ffcc; }
        .status-off { color: #ff4444; }

        /* Bug Report Area */
        textarea { width: 100%; background: rgba(0,0,0,0.3); border: 1px solid #333; color: #fff; padding: 10px; font-family: inherit; resize: none; margin-top: 10px; }

        /* Gold Icons */
        .g { color: var(--accent); } .s { color: #c0c0c0; } .c { color: #b87333; }
    </style>
</head>
<body>

<div class="bg-wrap"></div><div class="bg-overlay"></div>

<nav>
    <div class="nav-container">
        <a href="index.php" class="nav-brand" style="text-decoration:none; color:var(--frost);">HAZARDOUS</a>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="#connect">Connect</a>
            <a href="register.php">Join</a>
            <a href="login.php">Login</a>
        </div>
    </div>
</nav>

<header class="hero">
