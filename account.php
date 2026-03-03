<?php 
require_once 'config.php'; 
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
?>
<div class="content-tab">
    <h2 style="color: var(--gold);">CHARACTER DASHBOARD</h2>
    <p style="color: var(--ice-blue); margin: 10px 0;">Welcome, <?php echo $_SESSION['username']; ?>!</p>
    <hr style="border: 0; border-top: 1px solid #333; margin: 20px 0;">
    
    <div style="text-align: left; font-size: 0.9rem;">
        <p><strong>Account Status:</strong> <span style="color: #0f0;">Active</span></p>
        <p><strong>Security:</strong> SHA1 Protected</p>
    </div>

    <a href="download_launcher.exe" class="cta-btn" style="display: block; margin-top: 30px;">DOWNLOAD CLIENT</a>
    <a href="logout.php" style="display: block; margin-top: 20px; color: #ff4d4d; text-decoration: none; font-size: 0.8rem;">SIGN OUT</a>
</div>
