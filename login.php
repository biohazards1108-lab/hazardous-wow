<?php require_once 'config.php'; ?>
<div class="content-tab">
    <h2 style="color: var(--ice-blue); margin-bottom: 20px;">RESTORE YOUR SOUL</h2>
    <form action="login_logic.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="cta-btn" style="width: 100%; margin-top: 20px;">LOGIN</button>
    </form>
    <p style="margin-top: 15px; font-size: 0.8rem;">
        New here? <a href="register.php" style="color: var(--gold);">Create an account</a>
    </p>
</div>
