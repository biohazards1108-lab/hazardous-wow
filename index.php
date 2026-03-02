<?php 
include('config.php'); 
// Mock Data for the "Sharp" MMO look if the DB is empty
$featured_items = [
    ['name' => "Shadowmourne", 'quality' => "legendary", 'price' => "999,000g"],
    ['name' => "Invincible's Reins", 'quality' => "epic", 'price' => "500,000g"],
    ['name' => "Battered Hilt", 'quality' => "epic", 'price' => "12,500g"]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hazardous WoW | Armory & Market</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --ice: #00ccff; --gold: #c4950d; --rarity-legendary: #ff8000; --rarity-epic: #a335ee;
            --bg: #020712; --panel: rgba(10, 20, 35, 0.95);
        }
        body { margin: 0; background: var(--bg); color: #eee; font-family: 'Open Sans', sans-serif; overflow-x: hidden; }
        
        /* Glassmorphism Navigation */
        .side-nav {
            position: fixed; left: 0; top: 0; bottom: 0; width: 80px;
            background: rgba(0,0,0,0.8); border-right: 1px solid var(--ice);
            display: flex; flex-direction: column; align-items: center; padding-top: 30px; z-index: 1000;
        }
        .nav-icon { margin-bottom: 40px; cursor: pointer; transition: 0.3s; opacity: 0.6; }
        .nav-icon:hover { opacity: 1; transform: scale(1.2); color: var(--ice); }

        /* Hero Section */
        .main-wrapper { margin-left: 80px; padding: 40px; }
        .hero { 
            height: 60vh; background: linear-gradient(to bottom, transparent, var(--bg)), url('https://images.alphacoders.com/204/204172.jpg');
            background-size: cover; background-position: center; border-radius: 15px;
            display: flex; flex-direction: column; justify-content: center; padding: 60px;
        }
        .hero h1 { font-family: 'Cinzel'; font-size: 72px; margin: 0; text-shadow: 0 0 20px var(--ice); }

        /* Auction House Grid */
        .section-title { font-family: 'Cinzel'; border-bottom: 2px solid var(--gold); padding-bottom: 10px; margin: 40px 0 20px; color: var(--gold); letter-spacing: 3px; }
        .ah-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
        .item-card {
            background: var(--panel); border: 1px solid rgba(255,255,255,0.1); padding: 20px;
            border-radius: 4px; position: relative; overflow: hidden; transition: 0.3s;
        }
        .item-card:hover { border-color: var(--ice); box-shadow: 0 0 15px rgba(0, 204, 255, 0.2); transform: translateY(-5px); }
        .legendary { border-left: 4px solid var(--rarity-legendary); }
        .epic { border-left: 4px solid var(--rarity-epic); }
        
        .item-name { font-weight: bold; font-size: 18px; margin-bottom: 5px; }
        .item-name.legendary { color: var(--rarity-legendary); }
        .item-name.epic { color: var(--rarity-epic); }
        .price { color: var(--gold); font-family: monospace; font-size: 16px; }

        /* Registration Floating Box */
        .floating-reg {
            position: fixed; right: 40px; bottom: 40px; background: var(--panel);
            width: 320px; padding: 30px; border: 1px solid var(--ice); box-shadow: 0 0 30px rgba(0,0,0,0.8); z-index: 500;
        }
        input { width: 100%; padding: 12px; margin: 8px 0; background: #000; border: 1px solid #333; color: #fff; }
        button { width: 100%; padding: 15px; background: var(--ice); border: none; font-family: 'Cinzel'; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>

    <div class="side-nav">
        <div class="nav-icon">⚔️</div>
        <div class="nav-icon">🛡️</div>
        <div class="nav-icon">💰</div>
        <div class="nav-icon">📜</div>
    </div>

    <div class="main-wrapper">
        <header class="hero">
            <h1>HAZARDOUS</h1>
            <p style="letter-spacing: 10px; font-weight: lighter;">AUCTION HOUSE & ARMORY</p>
        </header>

        <h2 class="section-title">LIVE AUCTION HOUSE</h2>
        <div class="ah-grid">
            <?php foreach($featured_items as $item): ?>
            <div class="item-card <?php echo $item['quality']; ?>">
                <div class="item-name <?php echo $item['quality']; ?>"><?php echo $item['name']; ?></div>
                <div class="price">Current Bid: <?php echo $item['price']; ?></div>
                <div style="font-size: 11px; color: #666; margin-top: 10px;">Time Left: 2h 44m</div>
            </div>
            <?php endforeach; ?>
        </div>

        <h2 class="section-title">PLAYER SEARCH (ARMORY)</h2>
        <div class="item-card" style="max-width: 500px;">
            <input type="text" placeholder="Enter Character Name...">
            <button style="margin-top: 10px;">Inspect Character</button>
        </div>
    </div>

    <div class="floating-reg">
        <h3 style="font-family: 'Cinzel'; margin-top: 0;">Join the Fight</h3>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Create Account</button>
        </form>
    </div>

</body>
</html>
