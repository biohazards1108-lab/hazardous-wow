<?php include('header.php'); ?>

<div class="container" style="justify-content: center; align-items: center; min-height: 70vh;">
    <div class="wow-panel" style="width: 400px; border: 2px solid var(--wow-gold); box-shadow: 0 0 20px #000;">
        <div class="panel-title" style="background: #000; padding: 15px; margin: -25px -25px 20px -25px; border-bottom: 2px solid var(--wow-gold);">
            <span style="color: var(--wow-gold); font-size: 1.4rem;">MEMBER LOGIN</span>
        </div>

        <form method="POST" action="process_login.php">
            <div style="margin-bottom: 20px;">
                <label style="color: var(--wow-gold); font-family: 'Cinzel'; display: block; margin-bottom: 5px;">ACCOUNT NAME</label>
                <input type="text" name="username" required style="background: #000; border: 1px solid #333; color: #fff; width: 100%; padding: 10px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="color: var(--wow-gold); font-family: 'Cinzel'; display: block; margin-bottom: 5px;">PASSWORD</label>
                <input type="password" name="password" required style="background: #000; border: 1px solid #333; color: #fff; width: 100%; padding: 10px;">
            </div>

            <button type="submit" name="login_btn" class="btn-wow gold-btn" style="width: 100%; letter-spacing: 2px;">
                ENTER WORLD
            </button>
        </form>
        
        <div style="text-align: center; margin-top: 20px; font-size: 0.8rem;">
            <a href="register.php" style="color: #666; text-decoration: none;">Create New Account</a> | 
            <a href="#" style="color: #666; text-decoration: none;">Forgot Password?</a>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
