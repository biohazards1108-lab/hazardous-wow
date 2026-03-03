<?php 
include('header.php'); 
include('config.php'); 

// Fallback status if config isn't loaded
$status = $status_data ?? "OFFLINE";
$players = $online_players ?? "0";
?>

<style>
/* Base Theme Colors */
:root {
    --ice-blue: #00d4ff;
    --dark-ice: #002b36;
    --frost-white: #e0f7fa;
    --deep-black: #050505;
    --panel-bg: rgba(0, 10, 20, 0.85);
}

body {
    /* The "Black Icy Blue" Background */
    background: radial-gradient(circle at center, #001a2e 0%, var(--deep-black) 100%);
    background-attachment: fixed;
    color: var(--frost-white);
    font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    margin: 0;
}

/* Container & Layout */
.container {
    display: flex;
    max-width: 1200px;
    margin: 40px auto;
    gap: 30px;
    padding: 0 20px;
}

/* WoW Panel Styling - The "Icy" look */
.wow-panel {
    background: var(--panel-bg);
    border: 1px solid #1a3a5a;
    border-radius: 4px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 0 15px rgba(0, 212, 255, 0.1), inset 0 0 10px rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);
}

.panel-title {
    color: var(--ice-blue);
    text-transform: uppercase;
    font-weight: bold;
    letter-spacing: 1px;
    border-bottom: 1px solid #1a3a5a;
    padding-bottom: 10px;
    margin-bottom: 15px;
    text-shadow: 0 0 8px rgba(0, 212, 255, 0.6);
}

/* Hero Section */
.hero-banner {
    padding: 60px 40px;
    background: linear-gradient(to right, rgba(0,0,0,0.8), transparent), 
                url('https://images.blizzard.com/wow/media/artwork/wow-wrath/lich-king-wallpaper-large.jpg'); /* Optional background img */
    background-size: cover;
    border-radius: 8px;
    border: 1px solid #1a3a5a;
    margin-bottom: 30px;
}

.lich-blue {
    color: var(--ice-blue);
    text-shadow: 0 0 15px var(--ice-blue);
}

/* Buttons */
.btn-wow {
    display: inline-block;
    padding: 12px 24px;
    text-decoration: none;
    font-weight: bold;
    border-radius: 3px;
    transition: all 0.3s ease;
    text-transform: uppercase;
}

.gold-btn {
    background: linear-gradient(to bottom, #1a3a5a, #00d4ff);
    color: white;
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
}

.gold-btn:hover {
    filter: brightness(1.2);
    box-shadow: 0 0 20px rgba(0, 212, 255, 0.6);
}

/* Status Indicators */
.indicator {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin-right: 10px;
}
.online { background: #00ffcc; box-shadow: 0 0 8px #00ffcc; }
.offline { background: #ff4d4d; }

.realmlist {
    display: block;
    margin-top: 15px;
    background: #000;
    padding: 8px;
