<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connection credentials
$host = 'sql213.infinityfree.com'; 
$db_user = 'if0_41282500'; 
$db_pass = 'Xanderkai0421'; 
$db_name = 'if0_41282500_wow';

echo "<h3>Attempting Database Connection...</h3>";

// Create connection
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("<b style='color:red'>Connection Failed:</b> " . $conn->connect_error);
} else {
    echo "<b style='color:green'>Success!</b> Connected to the database.<br>";
    
    // Check if the 'account' table exists
    $result = $conn->query("SHOW TABLES LIKE 'account'");
    if($result->num_rows > 0) {
        echo "<b style='color:green'>Success!</b> The 'account' table was found.";
    } else {
        echo "<b style='color:orange'>Warning:</b> Connection worked, but the 'account' table is missing. Did you run the SQL script in phpMyAdmin?";
    }
}
?>
