<?php 
include('config.php'); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
// 1. Connect to the Characters Database
// Replace these with your actual characters database credentials
$char_db_host = 'localhost';
$char_db_user = 'auth';
$char_db_pass = 'Darkbishop1109';
$char_db_name = 'characters'; 

$char_conn = new mysqli($char_db_host, $char_db_user, $char_db_pass, $char_db_name);

if ($char_conn->connect_error) {
    $online_players = 0; // Fallback if connection fails
} else {
    // 2. Fetch the real count
    $result = $char_conn->query("SELECT COUNT(*) AS total FROM characters WHERE online = 1");
    if ($result) {
        $row = $result->fetch_assoc();
        $online_players = $row['total'];
    } else {
        $online_players = 0;
    }
    $char_conn->close();
}
// WoW Gold Formatting
function formatWoWGold($copper) {
    $gold = floor($copper / 10000);
    $silver = floor(($copper % 10000) / 100);
    $cp = $copper % 100;
    return "<span class='g'>$gold</span> <span class='s'>$silver</span> <span class='c'>$cp</span>";
}

// Server Status & Player Count
$realm_ip = "hazardouswar.servegame.com";
$realm_port = 8085;
$connection = @fsockopen($realm_ip, $realm_port, $errno, $errstr, 1);
$status_text = $connection ? "ONLINE" : "OFFLINE";
$status_class = $connection ? "status-on" : "status-off";

// Mock Player Count (Replace with your SOAP or DB query if available)
$online_players = $connection ? rand(15, 45) : 0; 

if($connection) fclose($connection);
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
            --lich-blue: #00334d;
            --death-knell: #050b14;
            --gold-leaf: #d4af37;
            --dk-purple: #301934;
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

        /* --- BACKGROUND --- */
        .bg-wrap {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: url('https://web.archive.org/web/20101204043250im_/http://www.worldofwarcraft.com/downloads/wallpapers/patch330/patch330-1280x1024.jpg') center/cover no-repeat;
            z-index: -2;
            filter: brightness(0.3) grayscale(0.3);
        }

        .bg-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle, transparent 10%, var(--death-knell) 100%);
            z-index: -1;
        }

        /* --- NAVIGATION --- */
        .top-bar {
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(163, 228, 255, 0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .nav-brand { color: var(--frost-blue); text-decoration: none; font-size: 26px; letter-spacing: 3px; }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            margin-left: 25px;
            font-size: 13px;
            text-transform: uppercase;
            transition: 0.3s;
        }

        .nav-links a:hover { color: var(--frost-blue); text-shadow: 0 0 10px var(--frost-blue); }

        /* --- HERO --- */
        .hero {
            height: 70vh;
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

        /* --- BUTTONS --- */
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

        .cta-button.primary {
            background: var(--frost-blue);
            color: var(--death-knell);
            font-weight: bold;
        }

        .cta-button:hover {
            box-shadow: 0 0 30px rgba(163, 228, 255, 0.3);
            transform: translateY(-2px);
        }

        /* --- CONTENT --- */
        .master-container {
            max-width: 1200px;
            margin: -60px auto 100px;
            display: grid;
            grid-template-columns: 2.5fr 1fr;
            gap: 30px;
            padding: 0 20px;
        }

        .main-panel, .sidebar-box {
            background: var(--ice-gradient);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 30px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.7);
        }

        .section-title {
            font-family: 'Cinzel';
            color: var(--frost-blue);
            font-size: 24px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::after {
            content: ""; height: 1px; flex-grow: 1; background: linear-gradient(90deg, var(--frost-blue), transparent);
        }

        /* --- SIDEBAR ELEMENTS --- */
        .stat-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .player-count {
            font-size: 24px;
            color: #fff;
            font-family: 'Cinzel
