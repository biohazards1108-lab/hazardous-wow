<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LICH KING | The Ultimate WoW Private Server</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --ice-blue: #00d4ff;
            --gold: #c5a059;
            --deep-black: #050505;
            --panel-bg: rgba(15, 15, 15, 0.9);
            --border-glow: rgba(0, 212, 255, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--deep-black);
            color: #e0e0e0;
            font-family: 'Montserrat', sans-serif;
            overflow-x: hidden;
        }

        h1, h2, h3, .nav-logo {
            font-family: 'Cinzel', serif;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Navigation */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 10%;
            background: rgba(0, 0, 0, 0.8);
            border-bottom: 1px solid var(--gold);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .nav-logo {
            color: var(--gold);
            font-size: 1.5rem;
            font-weight: 700;
            text-shadow: 0 0 10px rgba(197, 160, 89, 0.5);
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            margin-left: 30px;
            font-size: 0.9rem;
            transition: 0.3s;
            font-weight: 600;
        }

        .nav-links a:hover {
            color: var(--ice-blue);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.6), var(--deep-black)), 
                        url('https://images.unsplash.com/photo-1618336753974-aae8e04506aa?q=80&w=2070'); /* Placeholder Dark Fantasy Background */
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 20px;
        }

        .hero h1 {
            font-size: 4rem;
            color: #fff;
            margin-bottom: 10px;
            text-shadow: 0 0 20px var(--ice-blue);
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin-bottom: 30px;
            color: #ccc;
        }

        /* Buttons */
        .cta-btn {
            padding: 15px 40px;
            background: transparent;
            color: var(--gold);
            border: 2px solid var(--gold);
            text-decoration: none;
            font-weight: bold;
            transition: 0.4s;
            position: relative;
            overflow: hidden;
        }

        .cta-btn:hover {
            background: var(--gold);
            color: #000;
            box-shadow: 0 0 20px var(--gold);
        }

        /* Features Section */
        .features {
            padding: 100px 10%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            background: radial-gradient(circle at top, #111, var(--deep-black));
        }

        .feature-card {
            background: var(--panel-bg);
            padding: 40px;
            border: 1px solid #222;
            text-align: center;
            transition: 0.3s;
            position: relative;
        }

        .feature-card:hover {
            border-color: var(--ice-blue);
            transform: translateY(-10px);
            box-shadow: 0 10px 30px var(--border-glow);
        }

        .feature-card h3 {
            color: var(--gold);
            margin-bottom: 15px;
        }

        .feature-card p {
            font-size: 0.95rem;
            color: #aaa;
        }

        /* Frostmourne Highlight Section */
        .weapon-section {
            padding: 100px 10%;
            text-align: center;
            border-top: 1px solid #1a1a1a;
        }

        .weapon-section h2 {
            font-size: 2.5rem;
            color: var(--ice-blue);
            margin-bottom: 20px;
        }

        /* Footer */
        footer {
            padding: 50px;
            text-align: center;
            background: #000;
            border-top: 1px solid var(--gold);
        }

        .footer-text {
            color: #555;
            font-size: 0.8rem;
        }

    </style>
</head>
<body>

    <nav>
        <div class="nav-logo">LICH KING</div>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#features">Features</a>
            <a href="#">Armory</a>
            <a href="#">Join Discord</a>
        </div>
    </nav>

    <header class="hero">
        <h1>FROSTMOURNE HUNGERS</h1>
        <p>The premier <strong>WoW Private Server</strong> experience. Command the undead, claim custom gear, and rewrite the history of Azeroth.</p>
        <a href="#" class="cta-btn">DOWNLOAD LAUNCHER</a>
    </header>

    <section id="features" class="features">
        <div class="feature-card">
            <h3>Custom Quests</h3>
            <p>Go beyond the standard lore. Participate in unique storylines and narrative arcs forged specifically for our champions.</p>
        </div>
        <div class="feature-card">
            <h3>Custom Mounts</h3>
            <p>From spectral drakes to mechanical terrors, ride into battle on exclusive mounts found nowhere else in the realm.</p>
        </div>
        <div class="feature-card">
            <h3>Friendly GMs</h3>
            <p>Our staff is online 24/7. Whether you need technical help or quest guidance, our Game Masters are dedicated to your experience.</p>
        </div>
    </section>

    <section class="weapon-section">
        <h2>Wield Frostmourne</h2>
        <p>Participate in the legendary questline to claim the blade that shattered kingdoms. Our high-fidelity script ensures every soul-chilling detail is preserved.</p>
    </section>

    <footer>
        <p style="color: var(--gold); margin-bottom: 10px;">FORGED BY HAZARDOUS STUDIOS</p>
        <p class="footer-text">Lich King WoW Private Server &copy; 2026. All trademarks belong to their respective owners.</p>
    </footer>

</body>
</html>
