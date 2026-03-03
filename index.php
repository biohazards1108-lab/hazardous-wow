<?php 
@include('config.php'); 

// --- CONFIGURATION ---
$webhook_url = "https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr";

// --- DISCORD REGISTER LOGIC ---
$msg = ""; 

// The fix: We only process this IF the register button was clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = htmlspecialchars($_POST['username'] ?? 'Unknown');
    $email = htmlspecialchars($_POST['email'] ?? 'No Email');
    $password = $_POST['password'] ?? ''; // This solves your Undefined Array Key error
    $class = $_POST['char_class'] ?? 'No Class Selected';

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

// Stats Placeholders
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
        :root { --ice: #adebff; --gold: #c4a35a; --panel-bg: rgba(5, 10, 20, 0.95); --border-color: #2a3f5a; }
        body { margin: 0; background: #000; color: #ddd; font-family: 'Lora', serif; overflow-x: hidden; }
        .master-bg { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: url('https://wallpaperaccess.com/full/1154546.jpg') no-repeat center center fixed; background-size: cover; z-index: -1; filter: brightness(0.5) contrast(1.1); }
        .container { display: grid; grid-template-columns: 320px 1fr; gap: 40px; max-width: 1400px; margin: 0 auto; padding: 60px 20px; }
        .wow-panel { background: var(--panel-bg); border: 2px solid var(--border-color); border-image: linear-gradient(to bottom, #4a6a8a, #0d1626) 1; padding: 25px; box-shadow: 0 15px 40px rgba(0,0,0,0.9); margin-bottom: 25px; }
        .panel-title { font-family: 'Cinzel'; color: var(--gold); font-size: 1.1rem; text-align: center; border-bottom: 2px solid #333; margin-bottom: 20px; padding-bottom: 10px; letter-spacing: 2px; }
        input, select { width: 100%; padding: 12px; margin-bottom: 15px; background: #050a14; border: 1px solid #1a2e38; color: #fff; box-sizing: border-box; }
        .btn-wow { width: 100%; padding: 14px; background: linear-gradient(to bottom, #c4a35a 0%, #8a6d2b 100%); border: 1px solid #eee; color: #000; font-family: 'Cinzel'; font-weight: bold; cursor: pointer; text-transform: uppercase; transition: 0.3s; }
        .btn-wow:hover { filter: brightness(1.2); transform: translateY(-2px); }
        .status-dot { color: #0f0; font-weight: bold; }
    </style>
</head>
<body>
    <div class="master-bg"></div>
    <div class="container">
        <div class="sidebar">
            <div class="wow-panel">
                <div class="panel-title">Server Status</div>
                <p>Status: <span class="status-dot"><?php echo $status; ?></span></p>
                <p>Players Online: <?php echo $online_count; ?></p>
            </div>
        </div>

        <div class="main">
            <div class="wow-panel">
                <div class="panel-title">Account Registration</div>
                
                <?php if($msg): ?>
                    <div style="background: rgba(0,255,0,0.1); padding: 10px; border: 1px solid var(--ice); margin-bottom: 20px; text-align: center; color: var(--ice);">
                        <?php echo $msg; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    
                    <select name="char_class" required>
                        <option value="" disabled selected>Select Your Class</option>
                        <option value="Warrior">Warrior</option>
                        <option value="Paladin">Paladin</option>
                        <option value="Death Knight">Death Knight</option>
                        <option value="Mage">Mage</option>
                    </select>

                    <button type="submit" name="register" class="btn-wow">Create Account</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
