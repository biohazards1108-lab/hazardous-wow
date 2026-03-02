<?php 
include('config.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hazardous WoW | The Frozen North</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #00ccff;
            --dark-gold: #c4950d;
            --blizz-blue: #0066ff;
            --bg-dark: #020712;
        }

        body {
            margin: 0;
            padding: 0;
            background: var(--bg-dark);
            color: #e0e0e0;
            font-family: 'Open Sans', sans-serif;
            overflow-x: hidden;
        }

        /* HD Background with Parallax effect */
        .hero-section {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom, rgba(2,7,18,0.2) 0%, rgba(2,7,18,0.9) 100%), 
                        url('https://images.alphacoders.com/108/1088448.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
        }

        /* Navigation Bar */
        nav {
            position: absolute;
            top: 0;
            width: 100%;
            padding: 20px 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.8), transparent);
            display: flex;
            justify-content: center;
            gap: 30px;
            z-index: 100;
        }

        nav a {
            color: white;
            text-decoration: none;
            text-transform: uppercase;
            font-family: 'Cinzel', serif;
            letter-spacing: 2px;
            font-size: 14px;
            transition: 0.3s;
        }

        nav a:hover { color: var(--primary-blue); text-shadow: 0 0 10px var(--primary-blue); }

        /* Main Registration Card */
        .main-card {
            background: rgba(5, 15, 30, 0.85);
            backdrop-filter: blur(15px);
            padding: 50px;
            border: 1px solid rgba(0, 204, 255, 0.2);
            box-shadow: 0 0 60px rgba(0,0,0,0.8);
            width: 100%;
            max-width: 450px;
            text-align: center;
            position: relative;
            z-index: 10;
        }

        h1 {
            font-family: 'Cinzel', serif;
            font-size: 42px;
            color: #fff;
            margin: 0;
            letter-spacing: 5px;
            text-shadow: 0 0 20px var(--primary-blue);
        }

        .status-indicator {
            display: inline-block;
            padding: 5px 15px;
            background: rgba(0,0,0,0.5);
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-top: 10px;
        }

        /* Form Styling */
        input {
            width: 100%;
            padding: 15px;
            margin: 12px 0;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input:focus {
            border-color: var(--primary-blue);
            outline: none;
            background: rgba(255,255,255,0.1);
        }

        .blizz-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(180deg, #008cff 0%, #0044bb 100%);
            border: 1px solid var(--primary-blue);
            color: white;
            font-family: 'Cinzel', serif;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 20px;
        }

        .blizz-btn:hover {
            filter: brightness(1.2);
            box-shadow: 0 0 30px rgba(0, 204, 255, 0.5);
        }

        /* Feature Section */
        .features {
            padding: 100px 20px;
            background: var(--bg-dark);
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .feature-card {
            width: 300px;
            background: rgba(255,255,255,0.02);
            padding: 30px;
            border: 1px solid rgba(255,255,255,0.05);
            text-align: center;
            transition: 0.3s;
