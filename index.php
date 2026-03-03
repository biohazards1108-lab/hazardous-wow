<?php
// PHP LOGIC - Place your data fetching here
@include('config.php');

// Placeholder variables - ensure these files exist or replace with your logic
$status_data = (file_exists('status.txt')) ? trim(file_get_contents('status.txt')) : 'OFFLINE';
$online_players = (file_exists('online.txt')) ? trim(file_get_contents('online.txt')) : '0';
$uptime = (file_exists('uptime.txt')) ? trim(file_get_contents('uptime.txt')) : '0h 0m';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAZARDOUS WoW | Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Quicksand:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --frost: #a3e4ff;
            --dk-bg: #010409;
            --panel: rgba(13, 22, 38, 0.85);
            --accent: #d4af37;
        }

        body {
            margin: 0;
            background: var(--dk-bg);
            color: #e0e0e0;
            font-family: 'Quicksand', sans-serif;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .bg-wrap {
            position: fixed;
            width: 100%;
            height: 100%;
            background: url('https://web.archive.org/web/20101204043250im_/http://www.worldofwarcraft.com/downloads/wallpapers/patch330/patch330-1280x1024.jpg') center/cover;
            z-index: -2;
            filter: brightness(0.12);
        }

        /* SIDEBAR */
        aside {
            width: 320px;
            background: rgba(0, 0, 0, 0.9);
            border-right: 1 px solid rgba(163, 228, 255, 0.15);
            padding: 25px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .side-card {
            background: var(--panel);
            border: 1px solid #1a2a3a;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6);
        }

        .side-card h2 {
            font-family: 'Cinzel';
            color: var(--frost);
            font-size: 13px;
            margin: 0 0 12px 0;
            border-bottom: 1px solid #222;
            padding-bottom: 8px;
        }

        /* MAIN CONTENT */
        main {
            flex: 1;
            padding: 50px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hero-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .hero-header h1 {
            font-family: 'Cinzel';
            font-size: 52px;
            margin: 0;
            color: #fff;
            text-shadow: 0 0 40px rgba(163, 228, 255, 0.5);
            letter-spacing: 12px;
        }

        .news-image {
            width: 100%;
            max-width: 1000px;
            height: 600px;
            background: url('https://wallpaperaccess.com/full/1154546.jpg') center/cover no-repeat;
            border: 2px solid rgba(163, 228, 255, 0.2);
            border-radius: 12px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8);
            position: relative;
            display: flex;
            align-items: flex-end;
        }

        .news-overlay {
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.9) 0%, transparent 100%);
            width: 100%;
            padding: 40px;
            border-radius: 0 0 12px 12px;
        }

        .btn {
            display: inline-block;
            text-align: center;
            padding: 12px 24px;
            border: 1px solid var(--frost);
            color: var(--frost);
            text-decoration: none;
            font-size: 11px;
            font-family: 'Cinzel';
            border-radius: 4px;
            transition: 0.3s;
            margin-top: 15px;
        }

        .btn:hover {
            background: var(--frost);
            color: #000;
            box-shadow: 0 0 20px var(--frost);
            transform: scale(1.02);
        }

        .status-on { color: #00ffcc; font-weight: bold; }
        .status-off { color: #ff4444; font-weight: bold; }
    </style>
</head>
<body>
    <div class="bg-wrap"></div>

    <aside>
        <div class="side-card">
            <h2>REALM INFO</h2>
            <p>Welcome to <strong>Hazardous WoW</strong>. Check back here for updates and realm statistics.</p>
        </div>
        
        <div class="side-card">
            <h2>QUICK LINKS</h2>
            <a href="#" class="btn" style="width:80%">ACCOUNT</a>
            <a href="#" class="btn" style="width:80%">FORUMS</a>
        </div>
    </aside>

    <main>
        <div class="hero-header">
            <h1>HAZARDOUS</h1>
            <p>Server Status: 
                <span class="<?php echo (strtoupper($status_data) == 'ONLINE') ? 'status-on' : 'status-off'; ?>">
                    <?php echo htmlspecialchars($status_data); ?>
                </span>
            </p>
        </div>

        <div class="news-image">
            <div class="news-overlay">
                <h2>Welcome to the Realm</h2>
                <p>Uptime: <?php echo htmlspecialchars($uptime); ?> | Players Online: <?php echo htmlspecialchars($online_players); ?></p>
                <a href="#" class="btn">JOIN DISCORD</a>
            </div>
        </div>
    </main>
</body>
</html>
