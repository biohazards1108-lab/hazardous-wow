<?php @include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Custom Gear Request | HAZARDOUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Quicksand:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root { --frost: #a3e4ff; --dk-bg: #010409; --panel: rgba(13, 22, 38, 0.95); --accent: #d4af37; }
        body { margin: 0; background: var(--dk-bg); color: #e0e0e0; font-family: 'Quicksand', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .bg-wrap { position: fixed; width: 100%; height: 100%; background: url('https://wallpaperaccess.com/full/1154546.jpg') center/cover; z-index: -2; filter: brightness(0.15); }
        
        .request-card { background: var(--panel); border: 1px solid var(--frost); padding: 40px; border-radius: 12px; width: 100%; max-width: 500px; box-shadow: 0 20px 50px rgba(0,0,0,0.8); }
        h1 { font-family: 'Cinzel'; color: var(--frost); text-align: center; margin-top: 0; font-size: 24px; }
        
        label { display: block; margin: 15px 0 5px; font-size: 12px; color: var(--frost); text-transform: uppercase; }
        input, select, textarea { width: 100%; background: rgba(0,0,0,0.5); border: 1px solid #333; color: #fff; padding: 10px; border-radius: 4px; box-sizing: border-box; }
        input:focus { border-color: var(--frost); outline: none; }
        
        .price-tag { background: rgba(212, 175, 55, 0.1); border: 1px solid var(--accent); color: var(--accent); padding: 10px; text-align: center; margin-top: 20px; font-weight: bold; }
        .submit-btn { width: 100%; padding: 15px; background: var(--frost); color: #000; border: none; font-family: 'Cinzel'; font-weight: bold; margin-top: 20px; cursor: pointer; transition: 0.3s; }
        .submit-btn:hover { box-shadow: 0 0 20px var(--frost); transform: translateY(-2px); }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none; font-size: 12px; }
    </style>
</head>
<body>
    <div class="bg-wrap"></div>
    <div class="request-card">
        <h1>Forge Custom Gear</h1>
        <p style="font-size: 13px; text-align: center; color: #888;">Submit your request to the GMs. Real-world currency (USD) is required for custom forging.</p>
        
        <form action="sync.php" method="POST">
            <input type="hidden" name="type" value="gear_request">
            
            <label>Character Name</label>
            <input type="text" name="char_name" placeholder="Enter ingame name" required>
            
            <label>Gear Type</label>
            <select name="gear_type">
                <option value="Weapon">Custom Weapon ($15.00)</option>
                <option value="Armor Set">Custom Armor Set ($25.00)</option>
                <option value="Trinket/Ring">Custom Accessory ($10.00)</option>
                <option value="Full Tier Set">Full Tier Forging ($50.00)</option>
            </select>
            
            <label>Desired Stats / Abilities</label>
            <textarea name="details" rows="4" placeholder="e.g. +500 Strength, Frost Damage proc..." required></textarea>
            
            <div class="price-tag">Payment will be handled via Discord DM</div>
            
            <button type="submit" class="submit-btn">Submit Request to GMs</button>
            <a href="index.php" class="back-link">← Return to Dashboard</a>
        </form>
    </div>
</body>
</html>
