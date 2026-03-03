<?php
@include('config.php');

// --- CONFIGURATION ---
$webhook_url = "https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr"; 

// --- DISCORD REGISTER LOGIC ---
$msg = "";
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $class = $_POST['char_class'];

    $data = [
        "content" => "🛡️ **New Account Created!**",
        "embeds" => [[
            "title" => "New Hero Arrived",
            "color" => 3447003,
            "fields" => [
                ["name" => "Username", "value" => $username, "inline" => true],
                ["name" => "Email", "value" => $email, "inline" => true],
                ["name" => "Intended Class", "value" => $class, "inline" => true]
            ]
        ]]
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];
    $context  = stream_context_create($options);
    file_get_contents($webhook_url, false, $context);
    $msg = "Account Request Sent to Discord!";
}

// Fetching Status Data
$status = (file_exists('status.txt')) ? trim(file_get_contents('status.txt')) : 'OFFLINE';
$online = (file_exists('online.txt')) ? trim(file_get_contents('online.txt')) : '0';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HAZARDOUS WoW | Wrath of the Lich King</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ice: #adebff;
            --gold: #c4a35a;
            --panel-bg: rgba(10, 15, 25, 0.95);
            --border: 2px solid #2a3f5a;
        }

        body {
            margin: 0; background: #000; color: #ddd;
            font-family: 'Lora', serif; overflow-x: hidden;
        }

        .master-bg {
            position: fixed; top: 0; width: 100%; height: 100%;
            background: url('https://wallpaperaccess.com/full/1154546.jpg') no-repeat center center fixed;
            background-size: cover; z-index: -1; filter: brightness(0.3);
        }

        .container {
            display: grid; grid-template-columns: 300px 1fr; gap: 30px;
            max-width: 1400px; margin: 0 auto; padding: 40px;
        }

        /* SIDEBAR */
        .sidebar { display: flex; flex-direction: column; gap: 20px; }
        
        .wow-panel {
            background: var(--panel-bg);
            border: var(--border);
            border-image: linear-gradient(to bottom, #4a6a8a, #1a2e38) 1;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
        }

        .panel-title {
            font-family: 'Cinzel'; color: var(--gold);
            font-size: 1rem; text-align: center;
            border-bottom: 1px solid #333; margin-bottom: 15px;
        }

        /* FORMS & INPUTS */
        input, select, textarea {
            width: 100%; padding: 10px; margin-bottom: 10px;
            background: #050a14; border: 1px solid #2a3f5a;
            color: #fff; box-sizing: border-box;
        }

        .btn-wow {
            width: 100%; padding: 12px; background: linear-gradient(#c4a35a, #8a6d2b);
            border: 1px solid #fff; color: #000; font-family: 'Cinzel';
            font-weight: bold; cursor: pointer; text-transform: uppercase;
        }

        .btn-wow:hover { filter: brightness(1.2); }

        /* GEAR GALLERY */
        .gear-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 15px; margin-top: 20px;
        }

        .gear-slot {
            aspect-ratio: 1; background: #050a14;
            border: 2px solid #333; position: relative;
            display: flex; align-items: center; justify-content: center;
            transition: 0.3s;
        }

        .gear-slot:hover { border-color: var(--ice); box-shadow: 0 0 15px var(--ice); }
        
        .gear-slot::after {
            content: "Epic Item"; position: absolute; bottom: 5px;
            font-size: 10px; color: #a335ee; font-weight: bold;
        }

        .hero-section { text-align: center; margin-bottom: 40px; }
        .hero-section h1 { 
            font-family: 'Cinzel'; font-size: 5rem; color: #fff; 
            text-shadow: 0 0 30px var(--ice); margin: 0;
        }

    </style>
</head>
<body>

<div class="master-bg"></div>

<div class="container">
    <div class="sidebar">
        <div class="wow-panel">
            <div class="panel-title">CREATE ACCOUNT</div>
            <?php if($msg) echo "<p style='color:var(--ice); font-size:12px;'>$msg</p>"; ?>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <select name="char_class">
                    <option value="Death Knight">Death Knight</option>
                    <option value="Paladin">Paladin</option>
                    <option value="Warrior">Warrior</option>
                </select>
                <button type="submit" name="register" class="btn-wow">Join the Scourge</button>
            </form>
        </div>

        <div class="wow-panel">
            <div class="panel-title">MENU</div>
            <button class="btn-wow" onclick="location.href='armory.php'" style="margin-bottom:5px;">Armory</button>
            <button class="btn-wow" onclick="location.href='auction.php'"
