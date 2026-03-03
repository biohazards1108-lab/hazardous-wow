<?php
// Password to prevent random people from changing your player count
$secret_key = "YourSecretPassword123"; 

if (isset($_GET['key']) && $_GET['key'] === $secret_key && isset($_GET['count'])) {
    $count = (int)$_GET['count'];
    
    // Save the number to online.txt
    file_put_contents('online.txt', $count);
    
    echo "Update successful: " . $count;
} else {
    echo "Invalid request.";
}
?>
