<?php 
include('config.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hazardous WoW | The Frozen North</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #050a14;
            color: white;
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://wallpaperaccess.com/full/1154030.jpg');
            background-size: cover;
            background-attachment: fixed;
        }
        .register-box {
            background: rgba(10, 20, 35, 0.9);
            padding: 40px;
            border-radius: 5px;
            border: 1px solid #00ccff;
            box-shadow: 0 0 25px rgba(0, 204, 255, 0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h1 { color: #00ccff; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 5px; }
        .status-bar { font-size: 12px; margin-bottom: 20px; }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background: rgba(0,0,0,0.5);
            border: 1px solid #333;
            color: white;
            box-sizing: border-box;
        }
        input:focus { border-color: #00ccff; outline: none; }
        button {
            width: 100%;
            padding: 15px;
            background: #0066cc;
            border: none;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }
        button:hover { background: #00ccff; box-shadow: 0 0 10px #00ccff; }
    </style>
</head>
<body>

    <div class="register-box">
        <h1>Hazardous WoW</h1>
        <div class="status-bar">
            <?php
            if ($conn->connect_error) {
                echo "<span style='color:#ff4444;'>DARN! Database Disconnected</span>";
            } else {
                echo "<span style='color:#00ff00;'>CONGRATS! Database is Online</span>";
            }
            ?>
        </div>

        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="ACCOUNT NAME" required>
            <input type="email" name="email" placeholder="EMAIL ADDRESS" required>
            <input type="password" name="password" placeholder="PASSWORD" required>
            <button type="submit">Create Account</button>
        </form>
        
        <p style="font-size: 11px; color: #666; margin-top: 20px;">
            Set Realmlist: <span style="color: #00ccff;">set realmlist hazardous.gamer.gd</span>
        </p>
    </div>

</body>
</html>
