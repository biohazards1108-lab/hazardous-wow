<?php
@include('config.php');

// --- CONFIGURATION ---
// Replace this with your actual Discord Webhook URL if it changes
$webhook_url = "https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr"; 

// --- DISCORD REGISTER LOGIC ---
$msg = "";
if (isset($_POST['register'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password']; // Note: For a live server, you'd hash this before saving to a Database
    $class = $_POST['char_class'];

    $data = [
        "content" => "🛡️ **New Account Created!**",
        "embeds" => [[
            "title" => "New Hero Arrived",
            "description" => "A new soul has joined the frozen wastes of Hazardous.",
            "color" => 3447003,
            "fields" => [
                ["name" => "Username", "value" => $username, "inline" => true],
                ["name" => "Email", "value" => $email, "inline" => true],
                ["name" => "Class", "value" => $class, "inline" => true],
                ["name" => "Password Set", "value" => "********", "inline" => true]
            ],
            "footer" => ["text" => "Hazardous Account System"]
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
    @file_get_contents($webhook_url, false, $context);
    $msg = "Account Request Sent to Discord!";
}

// Stats Placeholders (These will update if your config.php logic is set up)
$status = (isset($status_data)) ? $status_data : "OFFLINE"; 
$online_count = (isset($online_players)) ? $online_players : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAZARDOUS WoW | Wrath of the Lich King</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ice: #adebff;
            --gold: #c4a35a;
            --panel-bg: rgba(5, 10, 20, 0.95);
            --border-color: #2a3f5a;
        }

        body {
            margin: 0; background: #000; color: #ddd;
            font-family: 'Lora', serif; overflow-x: hidden;
        }

        /* Background - Higher brightness so you can see the art */
        .master-bg {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: url('https://wallpaperaccess.com/full/1154546.jpg') no-repeat center center fixed;
            background-size: cover; z-index: -1; filter: brightness(0.5) contrast(1.1);
        }

        .container {
            display: grid; grid-template-columns: 320px 1fr; gap: 40px;
            max-width: 1400px; margin: 0 auto; padding: 60px 20px;
        }

        /* ORNATE PANELS */
        .wow-panel {
            background: var(--panel-bg);
            border: 2px solid var(--border-color);
            border-image: linear-gradient(to bottom, #4a6a8a, #0d1626) 1;
            padding: 25px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.9), inset 0 0 20px rgba(0,0,0,0.5);
            margin-bottom: 25px;
        }

        .panel-title {
            font-family: 'Cinzel'; color: var(--gold);
            font-size: 1.1rem; text-align: center;
            border-bottom: 2px solid #333; margin-bottom: 20px;
            padding-bottom: 10px; text-shadow: 1px 1px 2px #000;
            letter-spacing: 2px;
        }

        /* INPUTS & FORM ELEMENTS */
        input, select, textarea {
            width: 100%; padding: 12px; margin-bottom: 15px;
            background: #050a14; border: 1px solid #1a2e38;
            color: #fff; box-sizing: border-box; font-family: 'Lora';
            font-size: 0.9rem;
        }

        input:focus { border-color: var(--ice); outline: none; box-shadow: 0 0 8px var(--ice); }

        /* BUTTONS - HIGH DETAIL */
        .btn-wow {
            width: 100%; padding: 14px; 
            background: linear-gradient(to bottom, #c4a35a 0%, #8a6d2b 100%);
            border: 1px solid #eee; color: #000; font-family: 'Cinzel';
            font-weight: bold; cursor: pointer; text-transform: uppercase;
            text-decoration: none; display: block; text-align: center;
            transition: 0.3s; margin-bottom: 12px;
            box-sizing: border-box;
        }

        .btn-wow:hover { 
            filter: brightness(1.2); 
            box-shadow: 0 0 20px var(--gold);
            transform: translateY(-2px);
        }

        /* MAIN CENTER CONTENT */
        .hero-section {
