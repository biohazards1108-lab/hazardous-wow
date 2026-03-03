<?php 
include('config.php'); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * 1. REAL-TIME PLAYER COUNT
 * Connects to the 'characters' table to see who is actually online.
 */
$online_players = 0;
$count_query = $conn->query("SELECT COUNT(*) AS total FROM characters WHERE online = 1");
if ($count_query) {
    $count_row = $count_query->fetch_assoc();
    $online_players = $count_row['total'];
}

/**
 * 2. SERVER STATUS CHECK
 * Checks if the world server port is open.
 */
$realm_ip = "hazardouswar.servegame.com";
$realm_port = 8085;
$connection = @fsockopen($realm_ip, $realm_port, $errno, $errstr, 1);
$status_text = $connection ? "ONLINE" : "OFFLINE";
$status_class = $connection ? "status-on" : "status-off";
if($connection) fclose($connection);

/**
 * 3. WOW UTILITIES
 */
function formatWoWGold($copper) {
    $gold = floor($copper / 10000);
    $silver = floor(($copper % 10000) / 100);
    $cp = $copper % 100;
    return "<span class='g'>$gold</span> <span class='s'>$silver</span> <span class='c'>$cp</span>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAZARDOUS WoW | The Frozen Throne</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Quicksand:wght@300;400&display=swap" rel="stylesheet">
    <style>
        :root {
            --frost-blue: #a3e4ff;
            --death-knell: #050b14;
            --gold-leaf: #d4af37;
            --ice-gradient: linear-gradient(180deg, rgba(10, 25, 41, 0.95) 0%, rgba(2, 5, 10, 1) 100%);
        }

        body {
            margin: 0;
            background: var(--death-knell);
            color: #d1d1d1;
            font-family: 'Quicksand', sans-serif;
            overflow-x: hidden;
        }

        h1, h2, h3, .nav-brand { font-family: 'Cinzel', serif; }

        .bg-wrap {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: url('https://web.archive.org/web/20101204043250im_/http://www.worldofwarcraft.com/downloads/wallpapers/patch330/patch330-1280x1024.jpg') center/cover no-repeat;
            z-index: -2;
            filter: brightness(0.3);
        }

        .bg-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle, transparent 10%, var(--death-knell) 100%);
            z-index: -1;
        }

        .top-bar {
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(163, 228, 255, 0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-content { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px; }
        .nav-brand { color: var(--frost-blue); text-decoration: none; font-size: 26px; letter-spacing: 3px; }
        .nav-links a { color: #fff; text-decoration: none; margin-left: 25px; font-size: 13px; text-transform: uppercase; transition: 0.3s; }
        .nav-links a:hover { color: var(--frost-blue); text-shadow: 0 0 10px var(--frost-blue); }

        .hero {
            height: 60vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .hero h1 {
            font-size: clamp(40px, 8vw, 80px);
            margin: 0;
            color: #fff;
            text-shadow: 0 0 40px rgba(0, 204, 255, 0.6);
            letter-spacing: 15px;
        }

        .hero p { color: var(--frost-blue); font-size: 1.2rem; margin-bottom: 2rem; opacity: 0.8; }

        .btn-group { display: flex; gap: 20px; }
        .cta-button {
            padding: 16px 35px;
            border: 1px solid var(--frost-blue);
            color: var(--frost-blue);
            text-decoration: none;
            font-family: 'Cinzel';
            transition: 0.4s;
            background: rgba(163, 228, 255, 0.05);
        }

        .cta-button.primary { background: var(--frost-blue); color: var(--death-knell); font-weight: bold; }
        .cta-button:hover { box-shadow: 0 0 30px rgba(163, 228, 255, 0.3); transform: translateY(-2px); }

        .master-
