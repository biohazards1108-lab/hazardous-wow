<?php 
include('config.php'); 
session_start(); 

/** * HAZARDOUS: THE FROZEN THRONE 
 * Premium WotLK CMS Core - Index Module
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
    <title>Hazardous: The Frozen Throne | 3.3.5a Blizzlike</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Metamorphous&family=Open+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        :root {
            --blizz-gold: #f8b700;
            --blizz-gold-dim: #c89200;
            --ice-blue: #00d2ff;
            --death-knight: #C41F3B;
            --lich-blue: #111a28;
            --stone-border: #3d4653;
            --shadow-black: rgba(0, 0, 0, 0.85);
        }

        /* RESET & BASE */
        * { box-sizing: border-box; }
        body {
            margin: 0; padding: 0;
            background: #050b13 url('https://web.archive.org/web/20101115144747im_/http://www.worldofwarcraft.com/wrath/_images/background.jpg') no-repeat center top fixed;
            background-size: cover;
            color: #d1d1d1;
            font-family: 'Open Sans', sans-serif;
            line-height: 1.6;
        }

        /* ARTISTIC OVERLAYS */
        .vignette {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle, transparent 20%, rgba(0,0,0,0.8) 100%);
            pointer-events: none; z-index: 1;
        }

        /* TOP BAR */
        .top-utility {
            background: rgba(0,0,0,0.9);
            border-bottom: 1px solid #222;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 50px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative; z-index: 100;
        }

        .status-dot { height: 8px; width: 8px; background: #00ff00; border-radius: 50%; display: inline-block; margin-right: 5px; box-shadow: 0 0 5px #00ff00; }

        /* CINEMATIC HEADER */
        header {
            position: relative;
            height: 550px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        .main-title {
            font-family: 'Cinzel Decorative', serif;
            font-size: 6rem;
            color: #fff;
            text-shadow: 0 0 30px var(--ice-blue), 4px 4px 0px #000;
            margin: 0;
            padding: 0;
            animation: ice-glow 4s ease-in-out infinite;
        }

        .sub-title {
            font-family: 'Metamorphous', serif;
            color: var(--blizz-gold);
            font-size: 1.8rem;
            letter-spacing: 12px;
            text-transform: uppercase;
            margin-top: -20px;
        }

        /* BLIZZ-LIKE NAVIGATION */
        nav {
            background: url('https://web.archive.org/web/20101115144747im_/http://www.worldofwarcraft.com/wrath/_images/menu-bg.jpg');
            border-top: 1px solid #4a5a6a;
            border-bottom: 2px solid var(--blizz-gold);
            position: sticky; top: 0; z-index: 999;
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
        }

        .nav-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
        }

        .nav-item {
            position: relative;
            padding: 22px 35px;
            color: #eee;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            transition: 0.2s;
            font-family: 'Metamorphous', serif;
        }

        .nav-item:hover {
            color: var(--blizz-gold);
            background: rgba(255,255,255,0.05);
            text-shadow: 0 0 10px var(--blizz-gold);
        }

        /* MAIN CONTENT GRID */
        .content-container {
            max-width: 1260px;
            margin: 50px auto;
            display: grid;
            grid-template-columns: 320px 1fr 300px;
            gap: 25px;
            padding: 0 20px;
            position: relative; z-index: 5;
        }

        /* COMPONENT: ICE PANEL (The Classic Blizz Container) */
        .ice-panel {
            background: var(--shadow-black);
            border: 1px solid var(--stone-border);
            position: relative;
            margin-bottom: 25px;
        }

        .ice-panel::before {
            content: ""; position: absolute; top: -2px; left: -2px; right: -2px; bottom: -2px;
            border: 1px solid rgba(0, 210, 255, 0.2);
            pointer-events: none;
        }

        .panel-cap {
            background: linear-gradient(to right, #111, #1a2a3a, #111);
            height: 45px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid var(--stone-border);
        }

        .panel-cap h3 {
            font-family: 'Cinzel Decorative', serif;
            color: var(--blizz-gold);
            font-size: 14px;
            margin: 0;
            letter-spacing: 2px;
        }

        .panel-content { padding: 25px; }

        /* FEATURE CARD */
        .feature-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid #333;
            padding: 15px;
            margin-bottom: 15px;
            transition: 0.3s;
        }

        .feature-card:hover { border-color: var(--ice-blue); transform: translateX(5px); }

        /* TYPOGRAPHY & BUTTONS */
        .gold-btn {
            background: linear-gradient(to bottom, #7a5a12, #3a2a0a);
            border: 1px solid var(--blizz-gold);
            color: #fff;
            padding: 12px 25px;
            font-family: 'Metamorphous', serif;
            text-transform: uppercase;
            font-size: 12px;
            cursor: pointer;
            transition: 0.3s;
            display: inline-block;
            text-decoration: none;
            text-align: center;
        }

        .gold-btn:hover {
            box-shadow: 0 0 20px rgba(248, 183, 0, 0.4);
            filter: brightness(1.2);
        }

        .ice-text { color: var(--ice-blue); text-shadow: 0 0 5px rgba(0,210,255,0.5); }

        /* NEWS POSTS */
        .news-entry {
            border-bottom: 1px solid #222;
            padding-bottom: 30px;
            margin-bottom: 30px;
        }

        .news-entry h2 {
            font-family: 'Cinzel Decorative', serif;
            color: #fff;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .news-meta { font-size: 11px; color: #666; text-transform: uppercase; margin-bottom: 15px; }

        @keyframes ice-glow {
            0%, 100% { text-shadow: 0 0 20px var(--ice-blue); }
            50% { text-shadow: 0 0 50px #fff, 0 0 10px var(--ice-blue); }
        }

        /* FOOTER */
        footer {
            background: #000;
            padding: 80px 0;
            text-align: center;
            border-top: 1px solid #222;
            margin-top: 100px;
        }
    </style>
</head>
<body>

<div class="vignette"></div>

<section class="top-utility">
    <div>
        <span class="status-dot"></span> Server Status: <span class="ice-text">Online</span> 
        <span style="margin-left: 20px;">Realm: <b style="color:white">Hazardous WotLK</b></span>
    </div>
    <div>
        <?php if($is_logged_in): ?>
            Logged in as <span class="ice-text"><?php echo $username; ?></span> | <a href="logout.php" style="color:var(--blizz-gold)">Logout</a>
        <?php else: ?>
            <a href="login.php" style="color:white; text-decoration:none;">Sign In</a> | 
            <a href="register.php" style="color:var(--blizz-gold); text-decoration:none;">Join the Crusade</a>
        <?php endif; ?>
    </div>
</section>

<header>
    <h1 class="main-title">HAZARDOUS</h1>
    <div class="sub-title">The Frozen Throne</div>
    <div style="margin-top: 30px;">
        <a href="register.php" class="gold-btn" style="font-size: 18px; padding: 15px 50px;">Play For Free</a>
    </div>
</header>

<nav>
    <div class="nav-wrapper">
        <a href="index.php" class="nav-item">News</a>
        <a href="register.php" class="nav-item">Account</a>
        <a href="community.php" class="nav-item">Community</a>
        <a href="stats.php" class="nav-item">Rankings</a>
        <a href="store.php" class="nav-item">Donations</a>
        <a href="support.php" class="nav-item">Support</a>
    </div>
</nav>

<div class="content-container">
    
    <aside>
        <div class="ice-panel">
            <div class="panel-cap"><h3>Kingdom Stats</h3></div>
            <div class="panel-content">
                <div style="display:flex; justify-content:space-between; margin-bottom: 10px;">
                    <span>Players Online:</span>
                    <span class="ice-text"><?php echo $online_chars; ?></span>
                </div>
                <div style="display:flex; justify-content:space-between; margin-bottom: 10px;">
                    <span>Total Accounts:</span>
                    <span class="ice-text"><?php echo $total_accounts; ?></span>
                </div>
                <div style="display:flex; justify-content:space-between;">
                    <span>Uptime:</span>
                    <span class="ice-text">99.8%</span>
                </div>
                <hr style="border:0; border-top:1px solid #222; margin: 20px 0;">
                <p style="font-size: 12px; font-style: italic;">"The Lich King's influence grows stronger every day. Join the resistance."</p>
            </div>
        </div>

        <div class="ice-panel">
            <div class="panel-cap"><h3>Latest Artifacts</h3></div>
            <div class="panel-content">
                <div class="feature-card">
                    <div style="color: #a335ee; font-weight:bold;">Shadowmourne</div>
                    <div style="font-size: 11px;">Claimed by: <span class="ice-text">ArthasX</span></div>
                </div>
                <div class="feature-card">
                    <div style="color: #ff8000; font-weight:bold;">Val'anyr</div>
                    <div style="font-size: 11px;">Claimed by: <span class="ice-text">HealBot</span></div>
                </div>
            </div>
        </div>
    </aside>

    <main>
        <div class="ice-panel">
            <div class="panel-cap"><h3>The Chronicles of Northrend</h3></div>
            <div class="panel-content">
                
                <article class="news-entry">
                    <div class="news-meta">Posted March 01, 2026 by Administrator</div>
                    <h2>The Gates of Icecrown Are Opening</h2>
                    <p>The Argent Crusade has established a base in Icecrown. We are proud to announce that the **Icecrown Citadel (10/25)** raid is now undergoing final testing and will be released next Tuesday. Prepare your guilds, stock up on flasks, and sharpen your blades.</p>
                    <p>Our dev team has worked tirelessly to ensure every script, from the Gunship Battle to the Lich King himself, is pixel-perfect and blizz-like.</p>
                    <a href="#" class="gold-btn">View Patch Notes</a>
                </article>

                <article class="news-entry">
                    <div class="news-meta">Posted March, 1st, 2026 by GM_Frozen</div>
                    <h2>Double XP Weekend: The Frozen Rush</h2>
                    <p>To celebrate our website launch, we are enabling 2x Experience rates across all zones for the next 48 hours. This is the perfect time to level that Death Knight alt you've been thinking about!</p>
                </article>

            </div>
        </div>
    </main>

    <aside>
        <div class="ice-panel">
            <div class="panel-cap"><h3>Join the Discord</h3></div>
            <div class="panel-content">
                <iframe src="https://discord.com/widget?id=YOUR_ID&theme=dark" width="100%" height="300" allowtransparency="true" frameborder="0"></iframe>
            </div>
        </div>

        <div class="ice-panel">
            <div class="panel-cap"><h3>Realmlist</h3></div>
            <div class="panel-content" style="text-align:center;">
                <code style="background:#000; padding:10px; display:block; border:1px solid #333; color:var(--ice-blue); font-size:12px;">
                    set realmlist logon.hazardous-wow.com
                </code>
            </div>
        </div>
    </aside>
</div>

<footer>
    <img src="https://web.archive.org/web/20101115144747im_/http://www.worldofwarcraft.com/wrath/_images/logo-wotlk.png" alt="WotLK" style="max-width:200px; opacity: 0.6;">
    <p style="color:#444; font-size: 12px; margin-top: 20px;">
        &copy; 2026 Hazardous: The Frozen Throne. All rights reserved.<br>
        World of Warcraft and Blizzard Entertainment are trademarks of Blizzard Entertainment, Inc.
    </p>
</footer>

</body>
</html>
