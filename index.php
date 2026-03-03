<?php 
// 1. DATABASE & ERROR HANDLING
include('config.php'); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 2. WOW UTILITIES
function formatWoWGold($copper) {
    $gold = floor($copper / 10000);
    $silver = floor(($copper % 10000) / 100);
    $cp = $copper % 100;
    return "<span class='g'>$gold</span> <span class='s'>$silver</span> <span class='c'>$cp</span>";
}

// 3. SERVER STATUS CHECK
$realm_ip = "hazardouswar.servegame.com";
$realm_port = 8085;
$connection = @fsockopen($realm_ip, $realm_port, $errno, $errstr, 1);
$status_text = $connection ? "ONLINE" : "OFFLINE";
$status_class = $connection ? "status-on" : "status-off";
if($connection) fclose($connection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HAZARDOUS WoW | The Frozen Throne</title>
    <style>
        /* --- ARTHAS THEME CORE --- */
        :root {
            --gold: #c4950d;
            --ice-blue: #00ccff;
            --blood-red: #880000;
            --dk-black: #02050a;
            --panel-bg: rgba(5, 10, 20, 0.95);
        }

        body {
            margin: 0;
            padding: 0;
            background: var(--dk-black);
            color: #bdc3c7;
            font-family: 'Times New Roman', serif;
            background-image: url('https://web.archive.org/web/20101204043250im_/http://www.worldofwarcraft.com/downloads/wallpapers/patch330/patch330-1280x1024.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
        }

        /* --- DETAILED NAVIGATION --- */
        .top-bar {
            background: linear-gradient(to bottom, #111, #000);
            border-bottom: 2px solid var(--gold);
            padding: 10px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 9999;
            box-shadow: 0 5px 20px #000;
        }

        .nav-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            font-size: 24px;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            margin-left: 30px;
            font-size: 14px;
            text-transform: uppercase;
            transition: 0.3s;
            border: 1px solid transparent;
            padding: 5px 10px;
        }

        .nav-links a:hover {
            color: var(--ice-blue);
            border: 1px solid var(--ice-blue);
            background: rgba(0, 204, 255, 0.1);
        }

        /* --- CONTENT WRAPPER --- */
        .master-container {
            max-width: 1200px;
            margin: 120px auto 50px;
            display: grid;
            grid-template-columns: 3fr 1fr;
            gap: 30px;
        }

        /* --- AUCTION HOUSE PANEL --- */
        .main-panel {
            background: var(--panel-bg);
            border: 1px solid #333;
            border-top: 4px solid var(--blood-red);
            padding: 30px;
            box-shadow: 0 0 30px #000;
        }

        .section-title {
            color: var(--gold);
            font-size: 32px;
            text-transform: uppercase;
            border-bottom: 1px solid #333;
            margin-bottom: 25px;
            padding-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: rgba(255,255,255,0.05);
            color: var(--ice-blue);
            padding: 15px;
            text-align: left;
            text-transform: uppercase;
            font-size: 13px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #111;
            font-size: 15px;
        }

        tr:hover { background: rgba(255,255,255,0.02); }

        /* --- ITEM QUALITY COLORS --- */
        .q5 { color: #ff8000; text-shadow: 0 0 10px #ff8000; font-weight: bold; }
        .q4 { color: #a335ee; text-shadow: 0 0 5px #a335ee; }
        .q3 { color: #0070dd; }
        .q2 { color: #1eff00; }

        /* --- SIDEBAR --- */
        .sidebar-box {
            background: var(--panel-bg);
            border: 1px solid #222;
            padding: 20px;
            margin-bottom: 20px;
        }

        .status-on { color: #1eff00; font-weight: bold; }
        .status-off { color: var(--blood-red); font-weight: bold; }

        /* --- GOLD ICONS --- */
        .g { color: #d4af37; font-weight: bold; }
        .s { color: #c0c0c0; font-weight: bold; }
        .c { color: #b87333; font-weight: bold; }

    </style>
</head>
<body>

<div class="top-bar">
    <div class="nav-content">
        <a href="#" class="nav-brand">Hazardous WoW</a>
        <div class="nav-links">
            <a href="index.php">Market</a>
            <a href="armory.php">Armory</a>
            <a href="register.php">Create Account</a>
            <a href="login.php">Login</a>
            <a href="dashboard.php">Player Panel</a>
        </div>
    </div>
</div>

<div class="master-container">
    <div class="main-panel">
        <div class="section-title">
            <span>Black Market Auctions</span>
            <span style="font-size:14px; color:#555;">Live Data from Northrend</span>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Bid Price</th>
                    <th>Seller</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT it.name, it.Quality, ah.buyoutprice, ah.itemowner 
                        FROM auctionhouse ah 
                        LEFT JOIN item_template it ON ah.itemguid = it.entry 
                        ORDER BY ah.buyoutprice DESC LIMIT 20";
                $res = $conn->query($sql);

                if ($res && $res->num_rows > 0) {
                    while($row = $res->fetch_assoc()) {
                        $quality = "q" . ($row['Quality'] ?? 0);
                        $name = !empty($row['name']) ? strtoupper($row['name']) : "LEGENDARY ARTIFACT";
                        echo "<tr>
                                <td class='$quality'>$name</td>
                                <td>" . formatWoWGold($row['buyoutprice']) . "</td>
                                <td style='color:#444;'>ID: {$row['itemowner']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' style='text-align:center;'>The Scourge has cleared the market...</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="sidebar">
        <div class="sidebar-box" style="border-top: 3px solid var(--ice-blue);">
            <h3 style="color: var(--ice-blue); margin-top:0;">REALM STATUS</h3>
            <p style="font-size:13px;">Server: <span class="<?php echo $status_class; ?>"><?php echo $status_text; ?></span></p>
            <p style="font-size:11px; color:#666;">hazardouswar.servegame.com</p>
        </div>

        <div class="sidebar-box" style="border-top: 3px solid var(--gold);">
            <h3 style="color: var(--gold); margin-top:0;">PATCH 3.3.5</h3>
            <p style="font-size:13px; line-height:1.6;">Welcome to <b>Hazardous WoW</b>. Experience the Wrath of the Lich King with increased rates and a custom Black Market.</p>
        </div>
        
        <div class="sidebar-box" style="border-top: 3px solid var(--blood
