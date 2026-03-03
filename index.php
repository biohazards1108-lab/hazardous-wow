<?php
@include('config.php');

// Fetching Data (Add your DB/File logic here)
$status = (file_exists('status.txt')) ? trim(file_get_contents('status.txt')) : 'OFFLINE';
$online = (file_exists('online.txt')) ? trim(file_get_contents('online.txt')) : '0';
$uptime = (file_exists('uptime.txt')) ? trim(file_get_contents('uptime.txt')) : '0h 0m';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HAZARDOUS | Wrath of the Lich King</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Lora:ital,wght@0,400;1,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ice-blue: #adebff;
            --death-knight: #1a2e38;
            --gold: #c4a35a;
            --panel-bg: rgba(5, 10, 15, 0.9);
        }

        body {
            margin: 0;
            padding: 0;
            background: #000;
            color: #ddd;
            font-family: 'Lora', serif;
            overflow-x: hidden;
        }

        /* Video/Static Background */
        .master-bg {
            position: fixed;
            top: 0; width: 100%; height: 100%;
            background: url('https://wallpaperaccess.com/full/1154546.jpg') no-repeat center center fixed;
            background-size: cover;
            z-index: -1;
            filter: brightness(0.4) contrast(1.2);
        }

        .container {
            display: grid;
            grid-template-columns: 280px 1fr 280px;
            gap: 20px;
            max-width: 1600px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Side Panels */
        aside {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .panel {
            background: var(--panel-bg);
            border: 2px solid #2a3f5a;
            border-image: linear-gradient(to bottom, #4a6a8a, #1a2e38) 1;
            padding: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.8);
        }

        .panel-header {
            font-family: 'Cinzel', serif;
            color: var(--ice-blue);
            font-size: 0.9rem;
            text-align: center;
            border-bottom: 1px solid #333;
            margin-bottom: 15px;
            padding-bottom: 5px;
            text-shadow: 0 0 10px rgba(173, 235, 255, 0.5);
        }

        /* Navigation Links */
        .nav-list { list-style: none; padding: 0; margin: 0; }
        .nav-list li { margin-bottom: 8px; }
        .nav-list a {
            display: block;
            padding: 10px;
            background: rgba(255,255,255,0.05);
            color: #ccc;
            text-decoration: none;
            font-size: 0.85rem;
            border-left: 3px solid transparent;
            transition: 0.3s;
        }
        .nav-list a:hover {
            background: rgba(173, 235, 255, 0.1);
            border-left: 3px solid var(--ice-blue);
            color: white;
            padding-left: 15px;
        }

        /* Main Center Content */
        main {
            text-align: center;
        }

        .hero-title {
            font-family: 'Cinzel', serif;
            font-size: 4rem;
            margin: 40px 0 10px 0;
            color: #fff;
            text-shadow: 0 0 20px var(--ice-blue), 2px 2px 5px #000;
            letter-spacing: 5px;
        }

        .status-bar {
            background: rgba(0,0,0,0.6);
            display: inline-block;
            padding: 5px 20px;
            border-radius: 20px;
            border: 1px solid var(--ice-blue);
            font-size: 0.9rem;
            margin-bottom: 30px;
        }

        .big-cta {
            background: url('https://www.transparenttextures.com/patterns/dark-matter.png'), linear-gradient(#1e3c72, #2a5298);
            padding: 40px;
            border: 3px solid var(--gold);
            margin-top: 200px; /* Offset for Lich King visual */
            border-radius: 5px;
            box-shadow: 0 0 50px rgba(0,0,0,1);
        }

        .btn-gold {
            background: linear-gradient(#c4a35a, #8a6d2b);
            color: #000;
            padding: 15px 35px;
            font-family: 'Cinzel';
            font-weight: bold;
            text-decoration: none;
            border-radius: 3px;
            display: inline-block;
            margin-top: 20px;
            border: 1px solid #fff;
        }

        .status-on { color: #00ffcc; }
        .status-off { color: #ff4444; }

    </style>
</head>
<body>

<div class="master-bg"></div>

<div class="container">
    <aside>
        <div class="panel">
            <div class="panel-header">NAVIGATION</div>
            <ul class="nav-list">
                <li><a href="armory.php">⚔️ ARMORY</a></li>
                <li><a href="auction.php">⚖️ AUCTION HOUSE</a></li>
