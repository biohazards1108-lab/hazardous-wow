<?php 
include('config.php'); 
session_start(); 

/** * HAZARDOUS: THE FROZEN THRONE 
 * Premium WotLK CMS Core - Index Module
 * Version: 2.0.0 "The Lich King's Wrath"
 */

// Server Logic - Stats Fetching
$total_accounts = $conn->query("SELECT COUNT(id) as count FROM $auth_db.account")->fetch_assoc()['count'] ?? 0;
$online_chars = $conn->query("SELECT COUNT(guid) as count FROM $char_db.characters WHERE online = 1")->fetch_assoc()['count'] ?? 0;

// User Context
$is_logged_in = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? 'Adventurer';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hazardous: The Frozen Throne | WotLK Private Server</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Metamorphous&family=Open+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        :root {
            --blizz-gold: #f8b700;
            --blizz-gold-dim: #c89200;
            --ice-blue: #00d2ff;
            --ice-glow: rgba(0, 210, 255, 0.4);
            --death-knight: #C41F3B;
            --lich-blue: #050b13;
            --stone-border: #3d4653;
            --shadow-black: rgba(0, 0, 0, 0.9);
            --panel-bg: rgba(10, 15, 25, 0.95);
        }

        /* --- BASE RESET & LAYOUT --- */
        * { box-sizing: border-box; scroll-behavior: smooth; }
        body {
            margin: 0; padding: 0;
            background: #000 url('https://web.archive.org/web/20101115144747im_/http://www.worldofwarcraft.com/wrath/_images/background.jpg') no-repeat center top fixed;
            background-size: cover;
            color: #d1d1d1;
            font-family: 'Open Sans', sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* --- CINEMATIC EFFECTS --- */
        .vignette {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle, transparent 30%, rgba(0,0,0,0.9) 100%);
            pointer-events: none; z-index: 2;
        }

        .ice-shimmer {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(125deg, transparent 45%, rgba(255,255,255,0.05) 50%, transparent 55%);
            background-size: 200% 200%;
            animation: shimmer 8s infinite linear;
            pointer-events: none;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        /* --- TOP UTILITY BAR --- */
        .top-utility {
            background: rgba(0,0,0,0.95);
            border-bottom: 1px solid #222;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 5%;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            position: relative; z-index: 100;
        }

        .status-dot { 
            height: 8px; width: 8px; background: #00ff00; 
            border-radius: 50%; display: inline-block; margin-right: 8px; 
            box-shadow: 0 0 8px #00ff00; 
        }

        /* --- HERO HEADER --- */
        header {
            position: relative;
            height: 650px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 10;
            text-align: center;
        }

        .main-title {
            font-family: 'Cinzel Decorative', serif;
            font-size: 7rem;
            color: #fff;
            text-shadow: 0 0 35px var(--ice-blue), 5px 5px 0px #000;
            margin: 0; line-height: 1;
            animation: ice-pulse 5s ease-in-out infinite;
        }

        .sub-title {
            font-family: 'Metamorphous', serif;
            color: var(--blizz-gold);
            font-size: 2rem;
            letter-spacing: 15px;
            text-transform: uppercase;
            margin-top: -10px;
            text-shadow: 2px 2px 4px #000;
        }

        @
