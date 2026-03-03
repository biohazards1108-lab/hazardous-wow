<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LICH KING | The Ultimate WoW Private Server</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* [KEEP ALL YOUR CSS FROM THE PROMPT HERE] */
        :root { --ice-blue: #00d4ff; --gold: #c5a059; --deep-black: #050505; --panel-bg: rgba(15, 15, 15, 0.9); --border-glow: rgba(0, 212, 255, 0.2); }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background-color: var(--deep-black); color: #e0e0e0; font-family: 'Montserrat', sans-serif; overflow-x: hidden; }
        h1, h2, h3, .nav-logo { font-family: 'Cinzel', serif; text-transform: uppercase; letter-spacing: 2px; }
        nav { display: flex; justify-content: space-between; align-items: center; padding: 20px 10%; background: rgba(0, 0, 0, 0.8); border-bottom: 1px solid var(--gold); position: fixed; width: 100%; top: 0; z-index: 1000; backdrop-filter: blur(10px); }
        .nav-logo { color: var(--gold); font-size: 1.5rem; font-weight: 700; text-shadow: 0 0 10px rgba(197, 160, 89, 0.5); }
        .nav-links a { color: #fff; text-decoration: none; margin-left: 30px; font-size: 0.9rem; transition: 0.3s; font-weight: 600; }
        .nav-links a:hover { color: var(--ice-blue); }
        .hero { height: 100vh; background: linear-gradient(rgba(0,0,0,0.6), var(--deep-black)), url('https://images.unsplash.com/photo-1618336753974-aae8e04506aa?q=80&w=2070'); background-size: cover; background-position: center; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 0 20px; }
        .hero h1 { font-size: 4rem; color: #fff; margin-bottom: 10px; text-shadow: 0 0 20px var(--ice-blue); }
        .hero p { font-size: 1.2rem; max-width: 700px; margin-bottom: 30px; color: #ccc; }
        .cta-btn { padding: 15px 40px; background: transparent; color: var(--gold); border: 2px solid var(--gold); text-decoration: none; font-weight: bold; transition: 0.4s; }
        .cta-btn:hover { background: var(--gold); color: #000; box-shadow: 0 0 20px var(--gold); }
        .features { padding: 100px 10%; display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; background: radial-gradient(circle at top, #111, var(--deep-black)); }
        .feature-card { background: var(--panel-bg); padding: 40px; border: 1px solid #222; text-align: center; transition: 0.3s; }
        .feature-card:hover { border-color: var(--ice-blue); transform: translateY(-10px); box-shadow: 0 10px 30px var(--border-glow); }
        .feature-card h3 { color: var(--gold); margin-bottom: 15px; }
        .weapon-section { padding: 100px 10%; text-align: center; border-top: 1px solid #1a1a1a; }
        .weapon-section h2 { font-size: 2.5rem; color: var(--ice-blue); margin-bottom: 20px; }
        footer { padding: 50px; text-align: center; background: #000; border-top: 1px solid var(--gold); }
        .footer-text { color: #555; font-size: 0.8rem; }
        
        /* New Style for Form spacing */
        .form-container { padding-top: 150px; text-align: center; min-height: 80vh; }
        input { background: #111; border: 1px solid var(--gold); color: white; padding: 10px; margin: 5px; width: 250px; }
    </style>
</head>
<body>

    <nav>
        <div class="nav-logo">HAZARDOUS</div>
        <div class="nav-links">
            <a href="index.php">HOME</a>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="register.php" style="color: var(--gold);">CREATE ACCOUNT</a>
                <a href="login.php">LOGIN</a>
            <?php else: ?>
                <a href="account.php">MY ACCOUNT</a>
                <a href="logout.php" style="color: #ff4d4d;">LOGOUT</a>
            <?php endif; ?>
            <a href="#">DISCORD</a>
        </div>
    </nav>

    <header class="hero">
        <h1>FROSTMOURNE HUNGERS</h1>
        <p>The premier <strong>WoW Private Server</strong> experience.</p>
        
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="register.php" class="cta-btn">JOIN THE CRUSADE</a>
        <?php else: ?>
            <p style="color: var(--ice-blue);">Welcome back, <?php echo $_SESSION['username']; ?>!</p>
            <a href="#" class="cta-btn">DOWNLOAD LAUNCHER</a>
        <?php endif; ?>
    </header>

    </body>
</html>
