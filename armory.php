<?php 
include('config.php'); 
// Replace these with the actual Entry IDs from your Trinity Creator items
$custom_items = [90000, 90001, 90002,90003,90004,90005,90006,90007,90008]; 
$item_list = implode(',', $custom_items);

$query = "SELECT entry, name, description FROM world.item_template WHERE entry IN ($item_list)";
$result = $conn->query($query);
?>

<div class="main-content">
    <h2>Legendary Customs</h2>
    <table border="1" width="100%">
        <tr><th>Item</th><th>Description</th><th>Price</th><th>Action</th></tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>50 Vote / $5.00</td>
            <td><button>Buy with Points</button> <button style="background:gold; color:black;">Donate via PayPal</button></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
