<?php 
require_once 'config.php'; 

// Handle Logout
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    </head>
<body>
    <nav>
        <div class="nav-logo">HAZARDOUS</div>
        <div class="nav-links">
            <a href="index.php">HOME</a>
            
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="register.php" class="gold-nav">ACCOUNT CREATE</a>
                <a href="login.php" class="gold-nav">LOGIN</a>
            <?php else: ?>
                <a href="account.php">MY ACCOUNT</a>
                <a href="index.php?action=logout" class="gold-nav">LOGOUT</a>
            <?php endif; ?>

            <a href="index.php?action=join">JOIN DISCORD</a>
        </div>
    </nav>

    <header class="hero">
        <h1>FROSTMOURNE HUNGERS</h1>
        <p>The premier WotLK Private Server experience.</p>
        
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="register.php" class="cta-btn">START YOUR JOURNEY</a>
        <?php else: ?>
            <a href="download.php" class="cta-btn">DOWNLOAD CLIENT</a>
        <?php endif; ?>
    </header>

    </body>
</html>
