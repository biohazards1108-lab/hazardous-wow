<?php 
include('header.php'); 
include('config.php'); 

$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['do_reg'])) {
    // Logic for Discord Webhook here (from your previous code)
    $msg = "Account Request Submitted!";
}
?>

<div class="container" style="display: block; max-width: 600px;">
    <div class="wow-panel">
        <div class="panel-title">Join the Frozen Wastes</div>
        
        <?php if($msg) echo "<p style='color:var(--ice-blue); text-align:center;'>$msg</p>"; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" required style="width:100%; padding:10px; margin-bottom:10px; background:#111; border:1px solid #333; color:white;">
            <input type="email" name="email" placeholder="Email" required style="width:100%; padding:10px; margin-bottom:10px; background:#111; border:1px solid #333; color:white;">
            <input type="password" name="password" placeholder="Password" required style="width:100%; padding:10px; margin-bottom:10px; background:#111; border:1px solid #333; color:white;">
            
            <select name="char_class" style="width:100%; padding:10px; margin-bottom:20px; background:#111; border:1px solid #333; color:white;">
                <option value="Warrior">Warrior</option>
                <option value="Paladin">Paladin</option>
                <option value="Death Knight">Death Knight</option>
                <option value="Mage">Mage</option>
                <option value="Warlock">Warlock</option>
            </select>

            <button type="submit" name="do_reg" class="btn-wow" style="width:100%;">Create My Account</button>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>
