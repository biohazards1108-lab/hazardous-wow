<?php 
include('config.php'); 

$custom_items = [90000, 90001, 90002, 90003, 90004, 90005, 90006, 90007, 90008]; 
$item_list = implode(',', $custom_items);
$query = "SELECT entry, name, description FROM world.item_template WHERE entry IN ($item_list)";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hazardous Armory</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<canvas id="canvas"></canvas>

<div class="wrapper">
    <div class="grid-layout" style="grid-template-columns: 1fr;">
        <main class="shard content-shard">
            <div class="shard-header">ARTIFACT VAULT</div>
            <table class="armory-table">
                <thead>
                    <tr>
                        <th>ITEM</th>
                        <th>PRICE</th>
                        <th>ACTION</th>
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
                        <td class="gold-text">50 Points</td>
                        <td>
                            <a href="purchase.php?item_id=<?php echo $row['entry']; ?>">
                                <button class="btn-summon" style="width: auto; padding: 5px 15px;">BUY</button>
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
