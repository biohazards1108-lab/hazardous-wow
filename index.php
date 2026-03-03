<?php 
include('header.php'); // This contains your CSS and Nav
include('config.php'); 
?>

<div class="container">
    <div class="sidebar">
        <div class="wow-panel">
            <div class="panel-title">Realmlist</div>
            <code class="realm-code">set realmlist logon.hazardous-wow.com</code>
            
            <div class="status-box">
                <p>Status: <span class="online-text">Online</span></p>
                <p>Players: <?php echo $online_players ?? '0'; ?></p>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="hero-section">
            <h1>HAZARDOUS <span class="gold">WoW</span></h1>
            <p>Experience the Frozen Wastes like never before.</p>
            <div class="button-group">
                <a href="register.php" class="btn-wow main-btn">Create Account</a>
                <a href="https://discord.gg/yourlink" class="btn-wow discord-btn">Join Discord</a>
            </div>
        </div>

        <div class="news-section">
            <div class="wow-panel">
                <div class="panel-title">Latest Updates</div>
                <p>Check out our new <a href="custom_gear.php">Custom Gear</a> sets now available!</p>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
