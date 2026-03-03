<?php 
// We are going to wrap these in checks to prevent the site from breaking if the files are missing
@include('header.php'); 
@include('config.php'); 

$status = isset($status_data) ? $status_data : "ONLINE";
$players = isset($online_players) ? $online_players : "124";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hazardous WoW</title>
    <style>
        /* FORCE RESET */
        * { box-sizing: border-box; }
        body, html { 
            margin: 0; 
            padding: 0; 
            width: 100%; 
            min-height: 100vh;
            background: #000; /* Fallback */
        }

        body {
            /* Black Icy Blue Gradient */
            background: radial-gradient(circle at center, #001a2e 0%, #000000 100%) no-repeat fixed;
            color: #e0f7fa;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 1100px;
            margin-top: 50px;
            padding: 20px;
            gap: 30px;
        }

        /* SIDEBAR */
        .sidebar { width: 300px; flex-shrink: 0; }

        /* MAIN CONTENT */
        .main-content { flex-grow: 1; }

        /* ICY PANELS */
        .wow-panel {
            background: rgba(0, 20, 40, 0.7);
            border: 1px solid #1a3a5a;
            border-radius: 5px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            backdrop-filter: blur(10px);
        }

        .panel-title {
            color: #00d4ff;
            font-size: 1.2rem;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 2px solid #1a3a5a;
            margin-bottom: 15px;
            padding-bottom: 5px;
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
        }

        /* BUTTONS */
        .btn-wow {
            display: inline-block;
            background: linear-gradient(to bottom, #005f8d, #00d4ff);
            color: #fff !important;
            padding: 12px 25px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 3px;
            text-shadow: 1px 1px 2px #000;
            border: 1px solid #00d4ff;
        }

        /* TEXT STYLES */
        h1 { font-size: 3rem; margin: 0; line-height: 1; color: #fff; }
        .lich-blue { color: #00d4ff; text-shadow: 0 0 20px #00d4ff; }
        p { line-height: 1.6; color: #b0c4de; }
        
        .realmlist {
            display: block;
            background: #000;
            padding: 10px;
            border: 1px solid #1a3a5a;
            color: #00d4ff;
            font-family: monospace;
            margin-top: 10px;
        }

        /* LINK FIX */
        a { color: #00d4ff; text-decoration: none; }
        a:hover { color: #fff; }

        /* RESPONSIVE */
        @media (max-width: 800px) {
            .container { flex-direction: column; }
            .sidebar { width: 100%; }
        }
    </style>
</head>
<body>

<div class="container">
    <aside class="sidebar">
        <div class="wow-panel">
            <div class="panel-title">Server Status</div>
            <p>Status: <span style="color:#00ffcc; font-weight:bold;"><?php echo $status; ?></span></p>
            <p>Online: <span style="color:#fff;"><?php echo $players; ?></span> Heroes</p>
            <div class="realmlist">set realmlist hazardouswar.servegame.com</div>
        </div>

        <div class="wow-panel">
