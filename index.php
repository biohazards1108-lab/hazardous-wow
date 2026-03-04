<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HAZARDOUS WoW | Wrath of the Lich King</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --ice-blue: #00d4ff;
            --gold: #c5a059;
            --deep-black: #050505;
            --panel-bg: rgba(10, 10, 10, 0.9);
        }

        body {
            background-color: var(--deep-black);
            color: #e0e0e0;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            overflow-x: hidden;
        }

        /* Fixed Navigation */
        nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 10%; background: rgba(0, 0, 0, 0.95);
            border-bottom: 2px solid var(--gold); position: fixed; width: 100%; top: 0; z-index: 1000;
        }
        .nav-logo { font-family: 'Cinzel'; color: var(--gold); font-size: 1.8rem; letter-spacing: 2px; }
        .nav-links a { color: white; text-decoration: none; margin-left: 25px; font-weight: 600; transition: 0.3s; }
        .nav-links a:hover { color: var(--ice-blue); }

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            background: linear-gradient(rgba(0,0,0,0.5), var(--deep-black)), 
                        url('https://images.unsplash.com/photo-1618336753974-aae8e04506aa?q=80&w=2070');
            background-size: cover; background-attachment: fixed;
            text-align: center;
        }

        .hero h1 { font-family: 'Cinzel'; font-size: 4rem; color: #fff; text-shadow: 0 0 20px var(--ice-blue); margin: 0; }
        
        /* Status Bar */
        .status-bar {
            background: rgba(0, 212, 255, 0.1);
            border: 1px solid var(--ice-blue);
            padding: 10px 30px; border-radius: 50px;
            margin-top: 20px; font-weight: bold; color: var(--ice-blue);
        }

        /* Content Sections */
        .section { padding: 80px 15%; text-align: center; }
        .features { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; margin-top: 50px; }
        
        .feature-card {
            background: var(--panel-bg);
            border: 1px solid #222;
            padding: 40px;
            transition: 0.4s;
        }
        .feature-card:hover { border-color: var(--gold); transform: translateY(-10px); }
        .feature-card h3 { color: var(--gold); font-family: 'Cinzel'; }

        .cta-btn {
            display: inline-block; margin-top: 30px; padding: 15px 45px;
            border: 2px solid var(--gold); color: var(--gold);
            text-decoration: none; font-weight: bold; font-size: 1.1rem;
            transition: 0.4s; background: transparent;
        }
        .cta-btn:hover { background: var(--gold); color: #000; box-shadow: 0 0 20px var(--gold); }

        footer { padding: 40px; background: #000; border-top: 1px solid #222; text-align: center; color: #555; }
    </style>
</head>
<body>

    <nav>
        <div class="nav-logo">HAZARDOUS</div>
        <div class="nav-links">
            <a href="index.php">HOME</a>
            <a href="#">FORUMS</a>
            <a href="register.php" style="color: var(--gold);">JOIN NOW</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="account.php">MY ACCOUNT</a>
            <?php endif; ?>
        </div>
    </nav>

    <header class="hero">
        <h1>FROSTMOURNE HUNGERS</h1>
        <div class="status-bar">SERVER STATUS: <span style="color: #00ff00;">ONLINE</span> | 422 PLAYERS</div>
        <a href="register.php" class="cta-btn">CREATE YOUR LEGACY</a>
    </header>

    <section class="section">
        <h2 style="font-family: 'Cinzel'; font-size: 2.5rem; color: var(--gold);">SERVER FEATURES</h2>
        <div class="features">
            <div class="feature-card">
                <h3>X5 RATES</h3>
                <p>Blizzlike leveling experience with a slight boost to get you into the action faster.</p>
            </div>
            <div class="feature-card">
                <h3>STABLE REALM</h3>
                <p>99.9% Uptime hosted on high-performance dedicated hardware.</p>
            </div>
            <div class="feature-card">
                <h3>ACTIVE STAFF</h3>
                <p>Dedicated GM team ensuring a fair and toxic-free environment for all players.</p>
            </div>
        </div>
    </section>

    <section class="section" style="background: #080808;">
        <h2 style="font-family: 'Cinzel'; color: white;">LATEST NEWS</h2>
        <div style="max-width: 800px; margin: 40px auto; background: #111; padding: 20px; border-left: 4px solid var(--ice-blue); text-align: left;">
            <h4 style="color: var(--ice-blue); margin: 0;">Patch 3.3.5 Release – The Citadel Falls</h4>
            <p style="font-size: 0.9rem; color: #888;">Posted on March 3, 2026</p>
            <p>Icecrown Citadel is now fully open. Face the Lich King and claim your glory!</p>
        </div>
    </section>

    <footer>
        <p>&copy; 2026 Hazardous WoW. Not affiliated with Blizzard Entertainment.</p>
    </footer>

</body>
</html>
