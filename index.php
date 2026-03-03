<?php 
include('config.php'); 

function formatWoWGold($copper) {
    $gold = floor($copper / 10000);
    $silver = floor(($copper % 10000) / 100);
    $cp = $copper % 100;
    return "$gold <span style='color:#d4af37;'>g</span> $silver <span style='color:#c0c0c0;'>s</span> $cp <span style='color:#b87333;'>c</span>";
}

$auctions = [];
if (isset($conn) && !$conn->connect_error) {
    // We check if item_template exists first to prevent the Fatal Error
    $tableCheck = $conn->query("SHOW TABLES LIKE 'item_template'");
    
    if($tableCheck->num_rows > 0) {
        // Table exists, run the full JOIN
        $query = "SELECT it.name, it.Quality, ah.buyoutprice, ah.itemowner 
                  FROM auctionhouse ah 
                  LEFT JOIN item_template it ON ah.itemguid = it.entry 
                  ORDER BY ah.buyoutprice DESC LIMIT 10";
    } else {
        // Table missing, run a safe query without the JOIN
        $query = "SELECT 'Unknown Item' as name, 0 as Quality, buyoutprice, itemowner 
                  FROM auctionhouse 
                  ORDER BY buyoutprice DESC LIMIT 10";
    }

    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $qualities = [0=>'common', 1=>'common', 2=>'uncommon', 3=>'rare', 4=>'epic', 5=>'legendary'];
            $auctions[] = [
                'item' => $row['name'],
                'quality' => $qualities[$row['Quality'] ?? 0] ?? 'common',
                'price' => $row['buyoutprice'],
                'seller' => 'Owner ID: ' . $row['itemowner']
            ];
        }
    } else {
        $auctions = [['item' => 'No Auctions Found', 'quality' => 'common', 'price' => 0, 'seller' => 'Market']];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hazardous Market</title>
    <style>
        body { background: #050a14; color: #e0e0e0; font-family: sans-serif; padding: 40px; }
        .card { background: rgba(255,255,255,0.02); border: 1px solid #222; padding: 20px; border-radius: 10px; max-width: 700px; margin: auto; }
        .row { display: flex; justify-content: space-between; padding: 10px; border-bottom: 1px solid #111; }
        .legendary { color: #ff8000; } .epic { color: #a335ee; } .rare { color: #0070dd; }
    </style>
</head>
<body>
    <div class="card">
        <h1 style="color:#c4950d; text-align:center;">HAZARDOUS MARKET</h1>
        <?php foreach($auctions as $a): ?>
        <div class="row">
            <span class="<?php echo $a['quality']; ?>"><strong><?php echo $a['item']; ?></strong></span>
            <span><?php echo formatWoWGold($a['price']); ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
