<?php 
include('config.php'); 

// Function to format WoW Gold
function formatWoWGold($copper) {
    $gold = floor($copper / 10000);
    $silver = floor(($copper % 10000) / 100);
    $cp = $copper % 100;
    
    $output = "";
    if ($gold > 0) $output .= "$gold <span style='color:#d4af37;'>g</span> ";
    if ($silver > 0) $output .= "$silver <span style='color:#c0c0c0;'>s</span> ";
    $output .= "$cp <span style='color:#b87333;'>c</span>";
    return $output;
}

// Sample Auction Data (This will be replaced by your SQL query later)
$auctions = [
    ['item' => 'Shadowmourne', 'quality' => 'legendary', 'price' => 9990000, 'seller' => 'Arthas'],
    ['item' => 'Battered Hilt', 'quality' => 'epic', 'price' => 1550075, 'seller' => 'Uther'],
    ['item' => 'Titansteel Bar', 'quality' => 'rare', 'price' => 45000, 'seller' => 'Mogni']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hazardous WoW | Armory & Market</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ice-blue: #00ccff; --blizz-gold: #c4950d; --bg: #050a14;
            --legendary: #ff8000; --epic: #a335ee; --rare: #0070dd;
        }

        body { margin: 0; background: var(--bg); color: #e0e0e0; font-family: 'Open Sans', sans-serif; overflow-x: hidden; }

        /* Left Side MMO Navigation */
        .mmo-nav {
            position: fixed; left: 0; top: 0; bottom: 0; width: 80px;
            background: rgba(0,0,0,0.9); border-right: 1px solid var(--ice-blue);
            display: flex; flex-direction: column; align-items: center; padding-top: 50px; z-index: 100;
        }
        .nav-item { width: 40px; height: 40px; margin-bottom: 30px; border: 1px solid #333; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.3s; }
        .nav-item:hover { border-color: var(--ice-blue); box-shadow: 0 0 10px var(--ice-blue); color: var(--ice-blue); }

        /* Main Layout */
        .content-area { margin-left: 80px; padding: 40px; }
        .header-banner {
            height: 300px; background: linear-gradient(to bottom, transparent, var(--bg)), url('https://images.alphacoders.com/204/204172.jpg');
            background-size: cover; border-radius: 10px; display: flex; align-items: flex-end; padding: 40px;
        }
        .header-banner h1 { font-family: 'Cinzel'; font-size: 60px; margin: 0; text-shadow: 0 0 20px #000; }

        /* Auction House Display */
        .ah-container { display: grid; grid-template-columns: 2fr 1fr; gap: 30px; margin-top: 40px; }
        .ah-table { background: rgba(255,255,255,0.03); border: 1px solid #222; border-radius: 5px; padding: 20px; }
        .ah-row { display: flex; justify-content: space-between; padding: 15px; border-bottom: 1px solid #111; align-items: center; }
        .ah-row:hover { background: rgba(0, 204, 255, 0.05); }

        .quality-legendary { color: var(--legendary); text-shadow: 0 0 5px var(--legendary); }
        .quality-epic { color: var(--epic); }
        .quality-rare { color: var(--rare); }

        /* Armory Search */
        .armory-box { background: rgba(0,0,0,0.5); padding: 30px; border: 1px solid var(--blizz-gold); border-radius: 5px; }
        input { width: 100%; padding: 15px; background: #000; border: 1px solid #444; color: white; margin-bottom: 15px; }
        .btn-gold { width: 100%; padding: 15px; background: var(--blizz-gold); border: none; font-family: 'Cinzel'; font-weight: bold; cursor: pointer; transition: 0.3s; }
        .btn-gold:hover { background: #eab10e; box-shadow: 0 0 15px var(--blizz-gold); }

        /* Animated Realmlist Footer */
        .footer-realmlist { text-align: center; margin-top: 80px; padding: 40px; border-top: 1px solid #111; }
        code { background: #111; padding: 10px 25px; border: 1px dashed var(--ice-blue); color: var(--ice-blue); font-size: 18px; }
    </style>
</head>
<body>

    <div class="mmo-nav">
        <div class="nav-item" title="Home">🏰</div>
        <div class="nav-item" title="Armory">👤</div>
        <div class="nav-item" title="Auction House">💰</div>
        <div class="nav-item" title="Rankings">🏆</div>
    </div>

    <div class="content-area">
        <div class="header-banner">
            <h1>HAZARDOUS <span style="font-size: 20px; color: var(--ice-blue);">MARKETPLACE</span></h1>
        </div>

        <div class="ah-container">
            <div class="ah-table">
                <h2 style="font-family: 'Cinzel'; color: var(--blizz-gold);">Recent Auctions</h2>
                <?php foreach($auctions as $auc): ?>
                <div class="ah-row">
                    <div>
                        <span class="quality-<?php echo $auc['quality']; ?>" style="font-weight:bold; font-size:18px;">
                            <?php echo $auc['item']; ?>
                        </span>
                        <div style="font-size:11px; color:#666;">Seller: <?php echo $auc['seller']; ?></div>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-family:monospace;"><?php echo formatWoWGold($auc['price']); ?></div>
                        <div style="font-size
