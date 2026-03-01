<?php
include('config.php');

if(isset($_POST['bug'])) {
    $report = $_POST['bug'];
    $user = $_SESSION['username'] ?? "Guest";
    
    $msg = "--- NEW BUG REPORT ---\nUser: $user\nIssue: $report";
    sendToDiscord($msg);
    
    echo "<script>alert('Report sent to the developers!'); window.location='index.php';</script>";
}
?>
