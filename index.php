<?php 
include('config.php'); 

// --- CORE UTILITY FUNCTIONS ---
function formatWoWGold($copper) {
    if ($copper <= 0) return "0 <span style='color:#b87333;'>c</span>";
    $gold = floor($copper / 10000);
    $silver = floor(($copper % 10000) / 100);
    $cp = $copper % 100;
    $output = "";
    if ($gold > 0) $output .= "$gold <span style='color:#d4af37;'>g</span> ";
    if ($silver > 0) $output .= "$silver <span style='color:#c0c0c0;'>s</span> ";
    if ($cp > 0 || $output == "") $output .= "$cp <span style='color:#b87333;'>c</span>";
    return $output;
}

// --- SERVER STATUS CHECKER ---
$server_online = false;
$ip = "hazardouswar.servegame.com"; 
$port = 8085; // Default Trinity/Azeroth port
$check = @fsockopen($ip, $port, $errno, $errstr, 1);
if($check) { $server_online = true; fclose($check); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hazardous WoW | Wrath of the Lich King</title>
    <style>
        /* --- BLIZZ-LIKE THEME SETTINGS --- */
        :root {
            --blizz-blue: #00ccff;
            --blizz-gold: #c4950d;
            --blizz-red: #880000;
            --bg-dark: #050a14;
            --card-bg: rgba(10, 15, 25, 0.9);
            --border-gold: #3d3118;
        }

        body {
            background: var(--bg-dark);
            background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                              url('https://images.blizzard.com/wow/media/wallpapers/patch/fall-of-the-lich-king/fall-of-the-lich-king-1920x1080.jpg');
            background-attachment: fixed;
            background-size: cover;
            color: #e0e0e0;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            overflow-x: hidden;
        }

        /* --- HEADER & NAVIGATION (Blizz-Style) --- */
        header {
            background: rgba(0, 0, 0, 0.8);
            border-bottom: 2px solid var(--blizz-gold);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }

        .nav-container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: var(--blizz-gold);
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 2px 2px 4px #000;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            margin-left: 25px;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            transition: 0.3s;
            border-bottom: 2px solid transparent;
            padding-bottom: 5px;
        }

        .nav-links a:hover {
            color: var(--blizz-blue);
            border-bottom: 2px solid var(--blizz-blue);
        }

        /* --- HERO SECTION --- */
        .hero {
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: radial-gradient(circle, rgba(0,204,255,0.1) 0%, rgba(0,0,0,0) 70%);
        }

        .hero h1 {
            font-size: 60px;
            color: #fff;
            margin: 0;
            text-shadow: 0 0 20px var(--blizz-blue);
            font-variant: small-caps;
        }

        .hero p {
            color: var(--blizz-blue);
            font-size: 18px;
            letter-spacing: 5px;
            text-transform: uppercase;
        }

        /* --- MAIN LAYOUT --- */
        .main-content {
            max-width: 1200px;
            margin: -50px auto 50px;
            display: grid;
            grid-template-columns: 8fr 3fr;
            gap: 30px;
            padding: 0 20px;
        }

        /* --- AUCTION HOUSE STYLING --- */
        .ah-card {
            background: var(--card-bg);
            border: 1px solid var(--border-gold);
            border-radius: 5px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
        }

        .ah-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .ah-table th {
            text-align: left;
            border-bottom: 1px solid var(--blizz-gold);
            padding: 10px;
            color: var(--blizz-gold);
            text-transform: uppercase;
            font-size: 12px;
        }

        .ah-table td {
            padding: 15px 10px;
            border-bottom: 1px solid #111;
        }

        .item-name { font-weight: bold; font-size: 16px; }
        .common { color: #fff; }
        .rare { color: #0070dd; text-shadow: 0 0 5px #0070dd; }
        .epic { color: #a335ee; text-shadow: 0 0 8px #a335ee; }
        .legendary { color: #ff8000; text-shadow: 0 0 12px #ff8000; }

        /* --- SIDEBAR --- */
        .sidebar-card {
            background: rgba(0,0,0,0.6);
            border: 1px solid #222;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .online { background: #1eff00; color: #000; }
        .offline { background: var(--blizz-red); color: #fff; }

        footer {
            text-align: center;
            padding: 50px;
            background: #000;
            border-top: 1px solid var(--border-gold);
            color: #555;
            font-size: 12px;
        }
    </style>
</head>
<body>

<header>
    <div class="nav-container">
        <div class="logo">Hazardous</div>
        <nav class="nav-links">
            <a href="index.php">Market</a>
            <a href="armory.php">Armory</a>
            <a href="register.php">Join Us</a>
            <a href="login.php">Login</a>
            <a href="dashboard.php">Account</a>
        </nav>
    </div>
</header>

<div class="hero">
