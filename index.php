<?php 
// Disable error reporting for a clean look, or keep it on to debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('config.php'); 

// 1. WoW Gold Formatter
function formatWoWGold($copper) {
    $gold = floor($copper / 10000);
    $silver = floor(($copper % 10000) / 100);
    $cp = $copper % 100;
    return "$gold <span style='color:#d4af37;'>g</span> $silver <span style='color:#c0c0c0;'>s</span> $cp <span style='color:#b87333;'>c</span>";
}

// 2. Data Fetching
$auctions = [];
if (isset($conn) && !$conn->connect_error) {
    $query = "SELECT it.name, it.Quality, ah.buyoutprice, ah.itemowner 
              FROM auctionhouse ah 
              LEFT JOIN item_template it ON ah.itemguid = it.entry 
              ORDER BY ah.buyoutprice DESC LIMIT 10";
    
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $qualities = [0=>'common', 1=>'common', 2=>'uncommon', 3=>'rare', 4=>'epic', 5=>'legendary'];
            $q_class = $qualities[$row['Quality'] ?? 0] ?? 'common';
            $auctions[] = [
                'item' => $row['name'] ?? 'Unknown Item',
                'quality' => $q_class,
                'price' => $row['buyoutprice'],
                'seller' => 'Owner: ' . $row['itemowner']
            ];
        }
    } else {
        $auctions = [['item' => 'No Auctions Found', 'quality' => 'common', 'price' => 0, 'seller' => 'System']];
    }
} else {
    $auctions = [['item' => 'Database Link Broken', 'quality' => 'common', 'price' => 0, 'seller' => 'System']];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hazardous WoW | Live Market</title>
    <style>
        body { background: #050a14; color: #e0e0e0; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 50px; }
        .market-card { background: rgba(255,255,255,0.02); border: 1px solid #222; border-radius: 10px; padding: 30px; max-width: 900px; margin: auto; }
        .item-row { display: flex; justify-content: space-between; padding: 12px; border-bottom: 1px solid #111; align-items: center; }
        .common { color: #fff; } .rare { color: #0070dd; } .epic { color: #a335ee; } .legendary { color: #ff8000; font-weight: bold; }
        h1 { color: #c4950d; text-align: center; font-variant: small-caps; }
        .realmlist { text-align: center; margin-top: 40px; color: #00ccff; font-family: monospace; }
    </style>
</head>
<body>
    <div class="market-card">
        <h1>Hazardous Market</h1>
        <?php foreach($auctions as $a): ?>
        <div class="item-row">
            <span class="<?php echo $a['quality']; ?>"><?php echo $a['item']; ?></span>
            <span style="font-family: monospace;"><?php echo formatWoWGold($a['price']); ?></span>
        </div>
        <?php endforeach; ?>
        <div class="realmlist">set realmlist hazardouswar.servegame.com</div>
    </div>
</body>
</html>
