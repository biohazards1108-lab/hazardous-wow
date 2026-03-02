<?php 
include('config.php'); 
// Database connection check
if ($conn->connect_error) {
    echo "<div style='background:red; color:white; padding:10px; text-align:center; position:fixed; width:100%; z-index:999;'>Darn! Database Disconnected. Check config.php</div>";
} else {
    echo "<div style='background:rgba(0, 255, 0, 0.2); color:#00ff00; padding:5px; text-align:center; font-size:12px; position:fixed; width:100%; z-index:999;'>Congrats! Database is Connected.</div>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hazardous WoW | Icecrown Awaits</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #0b0e14; /* Dark blue/black */
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.9)), url('https://images.alphacoders.com/204/204172.jpg');
            background-size: cover;
            background-position: center;
        }
        .container {
            background: rgba(10, 25, 40, 0.85);
            padding: 40px;
            border-radius: 10px;
            border: 2px solid #00ccff;
            box-shadow: 0 0 20px #0066ff;
            text-align: center;
            width: 350px;
        }
        h1 { color: #00ccff; text-shadow: 0 0 10px #00ccff; margin-bottom: 25px; }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background: #111;
            border: 1px solid #0066ff;
            color: white;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #0066ff;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
            transition: 0.3s;
        }
        button:hover { background: #00ccff; box-shadow: 0 0 15px #00ccff; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hazardous WoW</h1>
        <p>Join the Frozen North</p>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="USERNAME" required>
            <input type="email" name="email" placeholder="EMAIL" required>
            <input type="password" name="password" placeholder="PASSWORD" required>
            <button type="submit">CREATE ACCOUNT</button>
        </form>
    </div>
</body>
</html>
