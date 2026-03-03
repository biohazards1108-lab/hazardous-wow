<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Hazardous Market</title>
    <style>
        body { background: #050a14; color: #e0e0e0; font-family: 'Segoe UI', sans-serif; margin: 0; }
        .market-container { padding: 40px; }
        .card { background: rgba(255,255,255,0.02); border: 1px solid #222; padding: 20px; border-radius: 10px; max-width: 900px; margin: auto; }
        .row { display: flex; justify-content: space-between; padding: 12px; border-bottom: 1px solid #111; align-items: center; }
        
        /* WoW Rarity Colors & Glows */
        .common { color: #ffffff; }
        .uncommon { color: #1eff00; }
        .rare { color: #0070dd; text-shadow: 0 0 5px #0070dd; }
        .epic { color: #a335ee; text-shadow: 0 0 8px #a335ee; }
        .legendary { color: #ff8000; text-shadow: 0 0 12px #ff8000; font-weight: bold; }
        
        .price { font-family: monospace; font-size: 16px; }
    </style>
</head>
<body>

<?php include('header.php'); // This adds the tabs to the top! ?>

<div class="market-container">
    <div class="card">
        <h1 style="color:#c4950d; text-align:center;">LIVE AUCTION HOUSE</h1>
        <?php
        // Fetching data
        $query = "SELECT it.name, it.Quality, ah.buyoutprice FROM auctionhouse ah 
                  LEFT JOIN item_template it ON ah.itemguid = it.entry 
                  ORDER BY ah.buyoutprice DESC LIMIT 15";
        $result = $conn->query($query);
        
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $q_classes = [0=>'common', 1=>'common', 2=>'uncommon', 3=>'rare', 4=>'epic', 5=>'legendary'];
                $class = $q_classes[$row['Quality']] ?? 'common';
                $name = $row['name'] ?? 'Unknown Item';
                
                echo "<div class='row'>";
                echo "<span class='$class'>" . strtoupper($name) . "</span>";
                echo "<span class='price'>" . formatWoWGold($row['buyoutprice']) . "</span>";
                echo "</div>";
            }
        }
        ?>
    </div>
</div>
</body>
</html>
