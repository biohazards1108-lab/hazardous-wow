<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = strtoupper($_POST['username']);
    $pass = strtoupper($_POST['password']);
    $hash = sha1($user . ':' . $pass);

    $stmt = $conn->prepare("SELECT id FROM account WHERE username = ? AND sha_pass_hash = ?");
    $stmt->bind_param("ss", $user, $hash);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($data = $res->fetch_assoc()) {
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['username'] = $user;
        header("Location: index.php");
    }
}
?>
<div class="form-container">
    <h2>Login</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" class="cta-btn">LOGIN</button>
    </form>
</div>
