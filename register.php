<?php 
include('header.php'); 
include('config.php'); 

$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $user = htmlspecialchars($_POST['username'] ?? 'Unknown');
    // Your Webhook Logic Here...
    $msg = "Account registration request sent!";
}
?>

<div class="container" style="justify-content: center;">
    <div class="main-content" style="max-width: 500px;">
        <div class="wow-panel">
            <div class="panel-title">Account Creation</div>
            
            <?php if($msg): ?>
                <div style="color: var(--lich-blue); text-align: center; margin-bottom: 15px;"><?php echo $msg; ?></div>
            <?php endif; ?>

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

                <button type="submit" name="register" class="btn-wow gold-btn" style="width: 100%;">Complete Registration</button>
            </form>
            <a href="index.php" style="display: block; text-align: center; color: #777; margin-top: 15px; text-decoration: none;">Return Home</a>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
