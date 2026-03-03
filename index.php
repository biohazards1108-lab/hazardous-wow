<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LICH KING | Hazardous WoW</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
     :root {
    --ice-blue: #00d4ff;
    --gold: #c5a059;
    --deep-black: #050505;
    --panel-bg: rgba(10, 10, 10, 0.95);
}

body { 
    background-color: var(--deep-black) !important; 
    color: #e0e0e0; 
    margin: 0; 
    padding: 0;
}

/* This is the tab style you asked for */
.content-tab {
    background: var(--panel-bg);
    border: 2px solid #000; /* Black border by default */
    padding: 40px;
    transition: all 0.3s ease;
    margin: 20px;
}

.content-tab:hover {
    border-color: var(--gold); /* Changes to Gold on hover */
    box-shadow: 0 0 20px rgba(197, 160, 89, 0.4); /* Gold glow */
}

        /* Navigation */
        nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 20px 10%; background: rgba(0, 0, 0, 0.9);
            border-bottom: 1px solid var(--gold); position: fixed; width: 100%; top: 0; z-index: 1000;
        }
        .nav-links a { color: #fff; text-decoration: none; margin-left: 30px; font-weight: 600; transition: 0.3s; }
        .nav-links a:hover { color: var(--ice-blue); }

        /* The Custom Border Logic you asked for */
        .content-tab {
            background: var(--panel-bg);
            border: 2px solid #000; /* Default Black Border */
            padding: 40px;
            transition: all 0.3s ease;
        }
        .content-tab:hover {
            border-color: var(--gold); /* Gold on Hover */
            box-shadow: 0 0 20px rgba(197, 160, 89, 0.3);
        }

        .hero {
            height: 100vh; display: flex; flex-direction: column;
            justify-content: center; align-items: center; text-align: center;
            background: linear-gradient(rgba(0,0,0,0.7), var(--deep-black)), url('https://images.unsplash.com/photo-1618336753974-aae8e04506aa?q=80&w=2070');
            background-size: cover;
        }

        .cta-btn {
            padding: 15px 40px; border: 2px solid var(--gold);
            color: var(--gold); text-decoration: none; font-weight: bold; transition: 0.4s;
        }
        .cta-btn:hover { background: var(--gold); color: #000; }
    </style>
</head>
<body>

    <nav>
        <div class="nav-logo" style="color: var(--gold);">HAZARDOUS</div>
        <div class="nav-links">
            <a href="index.php">HOME</a>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="register.php" style="color: var(--gold);">ACCOUNT CREATE</a>
                <a href="login.php">LOGIN</a>
            <?php else: ?>
                <a href="account.php">MY ACCOUNT</a>
                <a href="logout.php" style="color: #ff4d4d;">LOGOUT</a>
            <?php endif; ?>
        </div>
    </nav>

    <header class="hero">
        <div class="content-tab"> <h1 style="font-size: 3.5rem; margin-bottom: 10px;">FROSTMOURNE HUNGERS</h1>
            <p style="margin-bottom: 30px;">The premier WotLK experience. Rewrite history.</p>
            
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="register.php" class="cta-btn">START YOUR JOURNEY</a>
            <?php else: ?>
                <a href="account.php" class="cta-btn">VIEW YOUR CHARACTERS</a>
            <?php endif; ?>
        </div>
    </header>

</body>
</html>
