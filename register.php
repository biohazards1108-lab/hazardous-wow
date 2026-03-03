<?php 
include('header.php'); 
include('config.php'); 

$msg = "";
// Match the button name: register_btn
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_btn'])) {
    $user = htmlspecialchars($_POST['username'] ?? 'Unknown');
    $email = htmlspecialchars($_POST['email'] ?? 'No Email');
    $class = $_POST['char_class'] ?? 'Not Selected';
    
    $webhook_url = "https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr";

    $data = [
        "content" => "🛡️ **New Hero Alert**",
        "embeds" => [[
            "title" => "Account Registration",
            "description" => "**$user** is preparing to enter the frozen wastes!",
            "color" => 16291328, // Gold color
            "fields" => [
                ["name" => "Email", "value" => $email, "inline" => true],
                ["name" => "Class", "value" => $class, "inline" => true]
            ],
            "footer" => ["text" => "Hazardous WoW Registration System"]
        ]]
    ];

    // Using cURL for better compatibility with free hosting
    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    $msg = "Account Request Successfully Sent!";
}
?>

<div class="container" style="justify-content: center;">
    <div class="wow-panel" style="width: 450px; margin-top: 50px;">
        <div class="panel-title">Registration</div>
        
        <?php if($msg) echo "<p style='color:var(--lich-blue); text-align:center; font-weight:bold;'>$msg</p>"; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="char_class">
                <option value="Warrior">Warrior</option>
                <option value="Paladin">Paladin</option>
                <option value="Death Knight">Death Knight</option>
                <option value="Mage">Mage</option>
            </select>
            <button type="submit" name="register_btn" class="btn-wow gold-btn" style="width: 100%;">JOIN THE CRUSADE</button>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>
