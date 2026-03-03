<?php 
// Standard includes - ensure these files exist in your directory!
include('header.php'); 
include('config.php'); 

// Fallback data if config.php fails
$status = $status_data ?? "ONLINE"; 
$players = $online_players ?? "124";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        /* THE BLACK ICY BLUE THEME */
        :root {
            --ice-blue: #00d4ff;
            --deep-blue: #001a2e;
            --black: #050505;
            --frost: #e0f7fa;
            --panel-tint: rgba(0, 10, 20, 0.8);
        }

        body {
            background: radial-gradient(circle at center, var(--deep-blue) 0%, var(--black) 100%);
            background-attachment: fixed;
            color: var(--frost);
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Essential Layout */
        .container {
            display: flex;
            max-width: 1100px;
            margin: 50px auto;
            gap: 25px;
            padding: 0 20px;
        }

        /* Sidebar Styling */
        .sidebar { width: 300px; }

        /* The WoW Panel Look */
        .wow-panel {
            background: var(--panel-tint);
            border: 1px solid #1a3a5a;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
        }

        .panel-title {
            color: var(--ice-blue);
            text-transform: uppercase;
            font-weight: bold;
            border-bottom: 1px solid #1a3a5a;
            padding-bottom: 8px;
            margin-bottom: 15px;
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
        }

        /* Text and Link Visibility Fixes */
        h1, h2, h3 { color: var(--ice-blue); margin-top: 0; }
        
        a { 
            color: var(--ice-blue) !important; 
            text-decoration: none; 
            transition: 0.3s;
        }
        
        a:hover { color: #fff !important; text-shadow: 0 0 10px var(--ice-blue); }

        /* Main Content & Hero */
        .main-content { flex: 1; }

        .hero-banner {
            background: linear-gradient(45deg, rgba(0,0,0,0.9), rgba(0,43,54,0.4));
            padding: 50px;
            border-radius: 8px;
            border: 1px solid #1a3a5a;
            margin-bottom:
