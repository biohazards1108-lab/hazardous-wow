<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LICH KING | Hazardous WoW</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --ice-blue: #00d4ff;
            --gold: #c5a059;
            --deep-black: #050505;
        }

        /* FORCE BLACK BACKGROUND */
        html, body {
            background-color: var(--deep-black) !important;
            color: #e0e0e0;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }

        nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 20px 10%; background: rgba(0, 0, 0, 0.9);
            border-bottom: 1px solid var(--gold); position: fixed; width: 100%; top: 0; z-index: 1000;
        }

        .nav-logo { font-family: 'Cinzel'; color: var(--gold); font-size: 1.5rem; }

        /* THE BORDER LOGIC: Black border -> Gold on Hover */
        .content-tab {
            background: rgba(10, 10, 10, 0.9);
            border: 2px solid #000; 
            padding: 50px;
            text-align: center;
            transition: 0.3s ease;
            max-width: 600px;
        }
        .content-tab:hover {
            border-color: var(--gold);
            box-shadow: 0 0 20px rgba(197, 160, 89, 0.3);
        }

        .hero {
            height: 100vh;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(rgba(0,0,0,0.7), var(--deep-black)), url('https://images.unsplash.com/photo-1618336753974-aae8e04506aa?q=80&w=2070');
            background-size: cover;
        }

        .cta-btn {
            display: inline-block; margin-top: 20px; padding: 12px 35px;
            border: 2px solid var(--gold); color: var(--gold);
            text-decoration: none; font-weight: bold; transition: 0.4s;
        }
        .cta-btn:hover { background: var(--gold); color: #000; }
    </style>
</head>
<body>
    <nav>
        <div class="nav-logo">HAZARDOUS</div>
        <div class="nav-links">
            <a href="index.php" style="color:white; text-decoration:none; margin-left:20px;">HOME</a>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="register.php" style="color:var(--gold); text-decoration:none; margin-left:20px;">CREATE ACCOUNT</a>
            <?php else: ?>
                <a href="account.php" style="color:var(--gold); text-decoration:none; margin-left:20px;">MY ACCOUNT</a>
                <a href="logout.php" style="color:red; text-decoration:none; margin-left:20px;">LOGOUT</a>
            <?php endif; ?>
        </div>
    </nav>

    <header class="hero">
        <div class="content-tab">
            <h1 style="font-family:'Cinzel'; font-size: 3rem; color:white;">FROSTMOURNE HUNGERS</h1>
            <p>The premier WotLK Private Server experience.</p>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="register.php" class="cta-btn">JOIN THE CRUSADE</a>
            <?php else: ?>
                <a href="account.php" class="cta-btn">ENTER DASHBOARD</a>
            <?php endif; ?>
        </div>
    </header>
</body>
</html>
