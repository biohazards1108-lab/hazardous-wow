<?php 
include('header.php'); 
include('config.php'); 

$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_btn'])) {
    $user = htmlspecialchars($_POST['username'] ?? 'Unknown');
    $email = htmlspecialchars($_POST['email'] ?? 'No Email');
    
    $webhook_url = "https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr";

    $data = json_encode([
        "content" => "⚡ **NEW ACCOUNT CREATED**",
        "embeds" => [[
            "title" => "Hero: " . $user,
            "color" => 16291328,
            "description" => "A new player has registered for Hazardous WoW."
        ]]
    ]);

    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // CRITICAL FOR SOME HOSTS
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
    ]);

    $result = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        $msg = "Connection Error: " . $error;
    } else {
        $msg = "Success! Check Discord.";
    }
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
