<?php 
include('header.php'); 
include('config.php'); 
?>

<div class="container" style="justify-content: center;">
    <div class="wow-panel" style="width: 400px; margin-top: 50px; border: 2px solid var(--wow-gold);">
        <div class="panel-title" style="background: #000; margin: -25px -25px 20px -25px; padding: 15px; border-bottom: 2px solid var(--wow-gold);">
            MEMBER LOGIN
        </div>
        
        <form method="POST" action="process_login.php">
            <label style="color: var(--wow-gold); font-family: 'Cinzel'; font-size: 0.8rem;">ACCOUNT NAME</label>
            <input type="text" name="username" required style="border: 1px solid #444; margin-top: 5px;">
            
            <label style="color: var(--wow-gold); font-family: 'Cinzel'; font-size: 0.8rem;">PASSWORD</label>
            <input type="password" name="password" required style="border: 1px solid #444; margin-top: 5px;">
            
            <button type="submit" name="login_btn" class="btn-wow gold-btn" style="width: 100%; margin-top: 10px;">
                ENTER WORLD
            </button>
        </form>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="register.php" style="color: #666; text-decoration: none; font-size: 0.8rem;">Create New Account</a>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
