<?php 
include('config.php'); 
session_start();

// Custom Entry IDs from your Trinity Creator
$custom_items = [90000, 90001, 90002, 90003, 90004, 90005, 90006, 90007, 90008]; 
$item_list = implode(',', $custom_items);

// Querying your world database for item details
$query = "SELECT entry, name, description, displayid FROM world.item_template WHERE entry IN ($item_list)";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Hazardous Armory</title>
</head>
<body>

<div class="container">
    <div class="main-content">
        <h2><img src="https://render.worldofwarcraft.com/us/icons/56/inv_sword_39.jpg" style="vertical-align: middle; height: 30px;"> Legendary Customs</h2>
        <p>Forge your destiny with custom-made artifacts. Use Vote Points or Donate to support the server.</p>
        
        <table>
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Stats / Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td style="color: #a335ee; font-weight: bold;">
                        <?php echo $row['name']; ?>
                    </td>
                    <td style="font-style: italic; color: #ffd100;">
                        "<?php echo $row['description'] ?: 'A powerful relic from the frozen wastes.'; ?>"
                    </td>
                    <td>50 Points / $5.00</td>
                    <td>
                        <a href="purchase.php?item_id=<?php echo $row['entry']; ?>">
                            <button class="btn-wow">Buy with Points</button>
                        </a>
                        
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="display:inline;">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="business" value="YOUR_PAYPAL_EMAIL@GMAIL.COM">
                            <input type="hidden" name="item_name" value="Purchase: <?php echo $row['name']; ?>">
                            <input type="hidden" name="amount" value="5.00">
                            <input type="hidden" name="currency_code" value="USD">
                            <button type="submit" class="btn-wow" style="background: linear-gradient(to bottom, #7a5d1e, #2a1f0a); border-color: gold;">Donate $5</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <br>
        <a href="index.php"><button class="btn-wow">Back to Home</button></a>
    </div>
</div>

</body>
</html>
