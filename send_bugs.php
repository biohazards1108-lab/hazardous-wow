<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['bug_desc'])) {
    $msg = "👾 **New Bug Report:**\n" . htmlspecialchars($_POST['bug_desc']);
    sendToDiscord($msg);
    echo "<script>alert('Report sent to the Frozen Throne developers!'); window.location='index.php';</script>";
}
?>
