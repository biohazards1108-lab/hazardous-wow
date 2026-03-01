<?php 
include('config.php'); 
session_start();

// Custom Entry IDs from your Trinity Creator
$custom_items = [90000, 90001, 90002, 90003, 90004, 90005, 90006, 90007, 90008]; 
$item_list = implode(',', $custom_items);

// Querying your world database for item details
$query = "SELECT entry, name, description FROM world.item_template WHERE entry IN ($item_list)";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hazardous Armory | Legendary Artifacts</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

<canvas id="canvas" style="position: fixed; top: 0; left: 0; pointer-events: none; z-index: 0;"></canvas>

<div class="wrapper" style="position: relative; z-index: 1;">
    <header class="main-header">
        <h1 class="main-title">VAULT OF THE LICH KING</h1>
        <p style="text-align:center; color: #00d2ff; font-family: 'Cinzel';">Hover over items to reveal their power</p>
    </header>

    <div class="grid-layout" style="grid-template-columns: 1fr;">
        <main class="shard content-shard">
            <div class="shard-header">CUSTOM ARTIFACTS</div>
            
            <table class="armory-table">
                <thead>
                    <tr>
                        <th>ITEM</th>
                        <th>COST</th>
                        <th>PURCHASE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <span class="item-link legendary" 
                                  data-name="<?php echo htmlspecialchars($row['name']); ?>" 
                                  data-desc="<?php echo htmlspecialchars($row['description']); ?>" 
                                  data-quality="Legendary">
                                [<?php echo $row['name']; ?>]
                            </span>
                        </td>
                        <td class="gold-text">50 Vote Points</td>
                        <td>
                            <a href="purchase.php?item_id=<?php echo $row['entry']; ?>">
                                <button class="btn-summon" style="width: auto; padding: 5px 20px;">BUY</button>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

<script src="flare.js"></script>
<script src="tooltip.js"></script>
</body>
</html>
