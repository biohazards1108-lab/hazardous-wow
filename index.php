<?php
// DISCORD ROUTING FUNCTION
function send_to_discord($message, $channel_type = 'updates') {
    $webhooks = [
        'register'  => 'https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr',
        'bugs'      => 'YOUR_BUG_WEBHOOK',
        'updates'   => 'YOUR_UPDATES_WEBHOOK',
        'donations' => 'YOUR_DONATIONS_WEBHOOK'
    ];

    $url = $webhooks[$channel_type] ?? $webhooks['updates'];

    $data = json_encode([
        "username" => "Hazardous Bot",
        "embeds" => [[
            "title" => "Website Activity",
            "description" => $message,
            "color" => 16291328 // Gold
        ]]
    ]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    curl_exec($ch);
    curl_close($ch);
}

// Check if someone clicked a specific action
if (isset($_GET['action']) && $_GET['action'] == 'join') {
    send_to_discord("A user just clicked the Discord Invite link!", 'updates');
    header("Location: https://discord.gg/YOUR_INVITE_LINK"); // Replace with your actual invite
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LICH KING | The Ultimate WoW Private Server</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --ice-blue: #00d4ff;
            --gold: #c5a059;
            --deep-black: #050505;
            --panel-bg: rgba(15, 15, 15, 0.9);
            --border-glow: rgba(0, 212, 255, 0.2);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: var(--deep-black);
            color: #e0e0e0;
            font-family: 'Montserrat', sans-serif;
            overflow-x: hidden;
        }

        h1, h2, h3, .nav-logo {
            font-family: 'Cinzel', serif;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Navigation
