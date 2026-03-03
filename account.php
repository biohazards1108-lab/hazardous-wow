<?php 
require_once 'config.php'; 
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$account_id = $_SESSION['user_id'];
// Fetch real characters from the DB
$query = $char_conn->prepare("SELECT name, race, class, level FROM characters WHERE account = ?");
$query->bind_param("i", $account_id);
$query->execute();
$result = $query->get_result();
?>

<style>
    .account-container {
        max-width: 900px;
        margin: 120px auto;
        padding: 20px;
    }
    
    /* The requested Black border -> Gold hover glow */
    .content-tab {
        background: var(--panel-bg);
        border: 2px solid #000; 
        padding: 30px;
        margin-bottom: 20px;
        transition: all 0.3s ease-in-out;
    }
    .content-tab:hover {
        border-color: var(--gold);
        box-shadow: 0 0 15px var(--gold);
        transform: translateY(-5px);
    }

    .char-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .char-card {
        background: rgba(0, 0, 0, 0.5);
        padding: 15px;
        border-left: 3px solid var(--ice-blue);
    }
</style>

<div class="account-container">
    <div class="content-tab">
        <h2 style="color: var(--gold);">COMMAND CENTER</h2>
        <p>Logged in as: <span style="color: var(--ice-blue);"><?php echo $_SESSION['username']; ?></span></p>
        <p>Account ID: #<?php echo $account_id; ?></p>
    </div>

    <div class="content-tab">
        <h3 style="color: var(--ice-blue);">YOUR CHAMPIONS</h3>
        <div class="char-grid">
            <?php if ($result->num_rows > 0): ?>
                <?php while($char = $result->fetch_assoc()): ?>
                    <div class="char-card">
                        <h4 style="color: var(--gold);"><?php echo $char['name']; ?></h4>
                        <p>Level <?php echo $char['level']; ?></p>
                        <p style="font-size: 0.8rem; color: #888;">Race ID: <?php echo $char['race']; ?> | Class ID: <?php echo $char['class']; ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No characters found. Time to enter the realm!</p>
            <?php endif; ?>
        </div>
    </div>

    <div style="text-align: center;">
        <a href="logout.php" class="cta-btn">LOGOUT</a>
    </div>
</div>
