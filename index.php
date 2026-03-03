<?php
// 1. SILENT DISCORD FUNCTION (Won't break the page if it fails)
function send_to_discord($message, $webhook_url) {
    if (!$webhook_url || $webhook_url == 'https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr') return;

    $data = json_encode([
        "username" => "Hazardous Bot",
        "embeds" => [[
            "title" => "Website Activity",
            "description" => $message,
            "color" => 16291328 
        ]]
    ]);

    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3); // Don't let it hang the site
    curl_exec($ch);
    curl_close($ch);
}

// 2. DEFINE YOUR CHANNELS
$reg_webhook = "https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr";
$bug_webhook = "https://discord.com/api/webhooks/1476634364090519622/xcPFqB7Qg3Mip--zu_Y0iYsCbJ6XTsj7Q5AVKPSmestbsuBPFdFfG1zjy-tVtsT4N9XY"; // Update this
$update_webhook = "https://discord.com/api/webhooks/1477193815109406865/tBZK0h7y0n_e8PyJQXOEoMAv69WtDtp4DYODdmHmATkH_TjG2BKR2lSGkdcee-VEFBfX"; // Update this

// 3. HANDLE ACTIONS
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'join') {
        send_to_discord("A player is joining the Discord!", $update_webhook);
        header("Location: https://discord.gg/382PfYAedc");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LICH KING | Hazardous WoW</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --ice-blue: #00d4ff;
            --gold: #c5a059;
            --deep-black: #050505;
            --panel-bg: rgba(15, 15, 15, 0.9);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background-color: var(--deep-black); color: #e0e0e0; font-family: 'Montserrat', sans-serif; }

        /* Navigation */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 10%;
            background: rgba(0, 0, 0, 0.9);
            border-bottom: 2px solid var(--gold);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .nav-logo { font-family: 'Cinzel'; color: var(--gold); font-size: 1.5rem; font-weight: 700; }
        .nav-links a { color: #fff; text-decoration: none; margin-left: 20px; font-weight: 600; font-size: 0.8rem; }
        
        /* STANDOUT BUTTONS */
        .gold-nav { 
            border: 1px solid var(--gold); 
            padding: 8px 15px; 
            color: var(--gold) !important; 
            background: #000;
            transition: 0.3s;
        }
        .gold-nav:hover { background: var(--gold); color: #000 !important; }

        /* Hero */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.7), var(--deep-black)), url('https://images.unsplash.com/photo-1618336753974-aae8e04506aa?q=80&w=2070');
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .hero h1 { font-family: 'Cinzel'; font-size: 4rem; color: #fff; text-shadow: 0 0 20px var(--ice-blue); }
        .cta-btn { padding: 15px 40px; border: 2px solid var(--gold); color: var(--gold); text-decoration: none; font-weight: bold; margin-top: 20px; display: inline-block; }
        .cta-btn:hover { background: var(--gold); color: #000; }

        /* Features */
        .features { padding: 80px 10%; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .feature-card { background: var(--panel-bg); padding: 30px; border: 1px solid #222; text-align: center; }
        .feature-card h3 { color: var(--gold); font-family: 'Cinzel'; margin-bottom: 10px; }

        footer { padding: 40px; text-align: center; border-top: 1px solid var(--gold); background: #000; }
    </style>
</head>
<body>

    <nav>
        <div class="nav-logo">HAZARDOUS</div>
        <div class="nav-links">
            <a href="index.php">HOME</a>
            <a href="register.php" class="gold-nav">ACCOUNT CREATE</a>
            <a href="login.php" class="gold-nav">LOGIN</a>
            <a href="index.php?action=join">JOIN DISCORD</a>
        </div>
    </nav>

    <header class="hero">
        <h1>FROSTMOURNE HUNGERS</h1>
        <p>The premier WotLK Private Server experience.</p>
        <a href="register.php" class="cta-btn">START YOUR JOURNEY</a>
    </header>

    <section class="features">
        <div class="feature-card">
            <h3>BUG GLITCHES</h3>
            <p>Report any issues directly to our dev team via our dedicated Discord channel.</p>
        </div>
        <div class="feature-card">
            <h3>LEVEL 80 CLUB</h3>
            <p>Race to the top and claim exclusive rewards for the first 80s on the realm.</p>
        </div>
        <div class="feature-card">
            <h3>WEBSITE UPDATES</h3>
            <p>Integrated Armory and player stats coming soon to the Hazardous hub.</p>
        </div>
    </section>

    <footer>
        <p style="color: var(--gold);">HAZARDOUS STUDIOS &copy; 2026</p>
    </footer>

</body>
</html>
