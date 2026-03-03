<?php 
@include('config.php'); 
error_reporting(E_ALL); ini_set('display_errors', 1);

// FETCH DATA FROM SYNCED FILES
$online_players = file_exists('online.txt') ? (int)@file_get_contents('online.txt') : 0;
$auctions = file_exists('auctions.json') ? json_decode(@file_get_contents('auctions.json'), true) : [];
$zones = file_exists('zones.json') ? json_decode(@file_get_contents('zones.json'), true) : [];
$status_data = file_exists('status.txt') ? trim(@file_get_contents('status.txt')) : "OFFLINE";

// CALCULATE UPTIME
$uptime = "0m";
if (file_exists('uptime.txt') && $status_data == "ONLINE") {
    $diff = time() - (int)@file_get_contents('uptime.txt');
    $d = floor($diff / 86400); $h = floor(($diff % 86400) / 3600); $m = floor(($diff % 3600) / 60);
    $uptime = "{$d}d {$h}h {$m}m";
}

function formatWoWGold($c) { $g=floor($c/10000); $s=floor(($c%10000)/100); $cp=$c%100; return "<span class='g'>$g</span><span class='s'>$s</span><span class='c'>$cp</span>"; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HAZARDOUS WoW | Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Quicksand:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root { --frost: #a3e4ff; --dk-bg: #010409; --panel: rgba(13, 22, 38, 0.85); --accent: #d4af37; }
        body { margin: 0; background: var(--dk-bg); color: #e0e0e0; font-family: 'Quicksand', sans-serif; display: flex; height: 100vh; overflow: hidden; }
        .bg-wrap { position: fixed; width: 100%; height: 100%; background: url('https://web.archive.org/web/20101204043250im_/http://www.worldofwarcraft.com/downloads/wallpapers/patch330/patch330-1280x1024.jpg') center/cover; z-index: -2; filter: brightness(0.12); }

        /* SIDEBAR */
        aside { width: 320px; background: rgba(0,0,0,0.9); border-right: 1px solid rgba(163,228,255,0.15); padding: 25px; overflow-y: auto; display: flex; flex-direction: column; gap: 20px; }
        .side-card { background: var(--panel); border: 1px solid #1a2a3a; padding: 20px; border-radius: 8px; box-shadow: 0 8px 24px rgba(0,0,0,0.6); }
        .side-card h2 { font-family: 'Cinzel'; color: var(--frost); font-size: 13px; margin: 0 0 12px 0; border-bottom: 1px solid #222; padding-bottom: 8px; }

        /* MAIN CONTENT */
        main { flex: 1; padding: 50px; overflow-y: auto; display: flex; flex-direction: column; align-items: center; }
        .hero-header { text-align: center; margin-bottom: 30px; }
        .hero-header h1 { font-family: 'Cinzel'; font-size: 52px; margin: 0; color: #fff; text-shadow: 0 0 40px rgba(163, 228, 255, 0.5); letter-spacing: 12px; }
        
        .news-image { 
            width: 100%; 
            max-width: 1000px; 
            height: 600px; 
            background: url('https://wallpaperaccess.com/full/1154546.jpg') center/cover no-repeat; 
            border: 2px solid rgba(163, 228, 255, 0.2); 
            border-radius: 12px; 
            box-shadow: 0 20px 50px rgba(0,0,0,0.8); 
            position: relative;
            display: flex;
            align-items: flex-end;
        }

        .news-overlay {
            background: linear-gradient(0deg, rgba(0,0,0,0.9) 0%, transparent 100%);
            width: 100%;
            padding: 40px;
            border-radius: 0 0 12px 12px;
        }

        .btn { display: block; text-align: center; padding: 12px; border: 1px solid var(--frost); color: var(--frost); text-decoration: none; font-size: 11px; font-family: 'Cinzel'; border-radius: 4px; transition: 0.3s; margin-top: 8px; }
        .btn:hover { background: var(--frost); color: #000; box-shadow: 0 0 20px var(--frost); transform: scale(1.02); }
        .status-on { color: #00ffcc; font-weight: bold; }
        .status-off { color: #ff4444; font-weight: bold; }
        .g { color: var(--accent); font-weight: bold; }
    </style>
</head>
<body>
    <div class="bg-wrap"></div>
    <aside
