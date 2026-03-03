<?php 
include('config.php'); 

// 1. WoW Gold Formatter
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

// 2. Data Fetching
$auctions = [];
$query = "SELECT it.name, it.Quality, ah.buyoutprice, ah.itemowner 
          FROM auctionhouse ah 
          LEFT JOIN item_template it ON ah.itemguid = it.entry 
          ORDER BY ah.buyoutprice DESC LIMIT 10";

if (isset($conn) && !$conn->connect_error) {
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $qualities = [0=>'common', 1=>'common', 2=>'uncommon', 3=>'rare', 4=>'epic', 5=>'legendary'];
            $q_class = $qualities[$row['Quality'] ?? 0] ?? 'common';
            $auctions[] = [
                'item' => $row['name'] ?? 'Unknown Item (Import item_template!)',
                'quality' => $q_class,
                'price' => $row['buyoutprice'],
                'seller' => 'Owner ID: ' . $row['itemowner']
            ];
        }
    } else {
        $auctions = [['item' => 'No Live Auctions Found', 'quality' => 'common', 'price' => 0, 'seller' => 'Marketplace']];
    }
} else {
    $auctions = [['item' => 'Database Offline', 'quality' => 'common', 'price' => 0, 'seller' => 'System']];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hazardous WoW | Live Market</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root {--ice-blue: #00ccff; --blizz-gold: #c4950d; --bg: #050a14; --legendary: #ff8000; --epic: #a335ee; --rare: #0070dd; }
        body { margin: 0; background: var(--bg); color: #e0e0e0; font-family: 'Open Sans', sans-serif; }
        .mmo-nav { position: fixed; left: 0; top: 0; bottom: 0; width: 80px; background: rgba(0,0,0,0.9); border-right: 1px solid var(--ice-blue); display: flex; flex-direction: column; align-items: center; padding-top: 50px; }
        .nav-item { width: 40px; height: 40px; margin-bottom: 30px; border: 1px solid #333; display: flex; align-items: center; justify-content: center; font-size: 20px; cursor: pointer; }
        .content-area { margin-left: 80px; padding: 40px; }
        .header-banner { height: 250px; background: linear-gradient(to bottom, transparent, var(--bg)), url('https://images.alphacoders.com/204/204172.jpg'); background-size: cover; border-radius: 10px; display: flex; align-items: flex-end; padding: 40px; }
        .ah-container { display: grid; grid-template-columns: 2fr 1fr; gap: 30px; margin-top: 40px; }
        .ah-table { background: rgba(255,255,255,0.03); border: 1px solid #222; border-radius: 5px; padding: 20px; }
        .ah-row { display: flex; justify-content: space-between; padding: 15px; border-bottom: 1px solid #111; align-items: center; }
        .quality-legendary { color: var(--legendary); text-shadow: 0 0 5px var(--legendary); }
        .quality-epic { color: var(--epic); }
        .quality-rare { color: var(--rare); }
        .armory-box { background: rgba(0,0,0,0.5); padding: 30px; border: 1px solid var(--blizz-gold); border-radius: 5px; }
        input { width: 100%; padding: 15px; background: #000; border: 1px solid #444; color: white; margin-bottom: 15px; }
        .btn-gold { width: 100%; padding: 15px; background: var(--blizz-gold); border: none; font-family: 'Cinzel'; font-weight: bold; cursor: pointer; color: white; }
        code { background: #111; padding: 10px 25px; border: 1px dashed var(--ice-blue); color: var(--ice-blue); font-family: monospace; }
    </style>
</head>
<body>
    <div class="mmo-nav">
        <div class="nav-item">🏰</div>
        <div class="nav-item">👤</div>
        <div class="nav-item">💰</div>
    </div>
    <div class="content-area">
        <div class="header-banner">
            <h1 style="font-family:'Cinzel'; font-size: 50px; margin:0;">HAZARDOUS MARKET</h1>
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
                        <div style="font-size:11px; color:#666;"><?php echo $auc['seller']; ?></div>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-family:monospace;"><?php echo formatWoWGold($auc['price']); ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="armory-box">
                <h3 style="font-family: 'Cinzel'; margin-top:0;">Hero Armory</h3>
                <input type="text" placeholder="Character Name...">
                <button class="btn-gold">SEARCH</button>
            </div>
        </div>
        <div style="text-align:center; margin-top:50px;">
            <code>set realmlist hazardouswar.servegame.com</code>
        </div>
    </div>
</body>
</html>
