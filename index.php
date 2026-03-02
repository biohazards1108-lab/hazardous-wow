<?php 
include('config.php'); 

// TEST LOGIC
if ($conn->connect_error) {
    echo "<div style='background:red; color:white; padding:10px; text-align:center;'>Darn! Database disconnected. Check config.php</div>";
} else {
    // This will show a small green bar at the top so you know it's working
    echo "<div style='background:green; color:white; padding:5px; text-align:center; font-size:12px;'>Congrats! Database is Connected.</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hazardous WoW</title>
    </head>
<body>
    <h1>Welcome to Hazardous WoW</h1>
    <form action="register.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Create Account</button>
    </form>
</body>
</html>
