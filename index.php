<?php 
include('header.php'); 
include('config.php'); 

// Fallback status if config isn't loaded
$status = $status_data ?? "OFFLINE";
$players = $online_players ?? "0";
?>

<div class="container">
    <aside class="sidebar">
        <div class="wow-panel status-panel">
            <div class="panel-title">Realm Status</div>
            <div class="status-row">
                <span class="indicator <?php echo ($status == 'ONLINE') ? 'online' : 'offline'; ?>"></span>
                <span class="realm-name">Hazardous Realm</span>
            </div>
            <div class="player-count">
                <strong><?php echo $players; ?></strong> Heroes Online
            </div>
            <code class="realmlist">set realmlist hazardouswar.servegame.com</code>
        </div>

        <div class="wow-panel discord-widget">
            <div class="panel-title">Community</div>
            <a href="#" class="btn-wow discord-btn">Join Discord</a>
        </div>
    </aside>

    <main class="main-content">
        <div class="hero-banner">
            <div class="hero-text">
                <h1>WRATH OF THE <br><span class="lich-blue">LICH KING</span></h1>
                <p>The Frozen Throne awaits. Will you serve, or will you fall?</p>
                <div class="hero-buttons">
                    <a href="register.php" class="btn-wow gold-btn">Create Account</a>
                    <a href="armory.php" class="btn-wow silver-btn">View Armory</a>
                </div>
            </div>
        </div>

        <div class="wow-panel news-section">
            <div class="panel-title">Latest Updates</div>
            <div class="news-item">
                <h3>Welcome to the Frozen North</h3>
                <p>Hazardous WoW is officially live! Experience 1x rates, custom bug fixes, and a stable WotLK environment.</p>
                <span class="news-date">March 2026</span>
            </div>
        </div>
    </main>
</div>

<?php include('footer.php'); ?>
