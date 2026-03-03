<?php require_once 'config.php'; ?>
<style>
    .content-tab {
        background: var(--panel-bg);
        border: 2px solid #000; /* Main black border */
        padding: 40px;
        max-width: 500px;
        margin: 150px auto;
        text-align: center;
        transition: 0.3s;
    }
    .content-tab:hover {
        border-color: var(--gold); /* Glows gold on hover */
        box-shadow: 0 0 20px rgba(197, 160, 89, 0.4);
    }
    input, select {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        background: #111;
        border: 1px solid #333;
        color: white;
        font-family: 'Montserrat', sans-serif;
    }
    input:focus { border-color: var(--ice-blue); outline: none; }
</style>

<div class="content-tab">
    <h2 style="color: var(--gold); margin-bottom: 20px;">JOIN THE CRUSADE</h2>
    <form action="register_logic.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="class_pref">
            <option value="0">Select Preferred Class</option>
            <option value="1">Warrior</option>
            <option value="2">Paladin</option>
            <option value="6">Death Knight</option>
            <option value="8">Mage</option>
        </select>
        <button type="submit" class="cta-btn" style="width: 100%; margin-top: 20px;">CREATE ACCOUNT</button>
    </form>
</div>
