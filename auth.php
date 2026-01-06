<?php
include 'db.php';
session_start();

if (isset($_POST['register'])) {
    $u = mysqli_real_escape_string($conn, $_POST['user']);
    $p = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$u', '$p')");
    $msg = "Account created! You can now login.";
}

if (isset($_POST['login'])) {
    $u = mysqli_real_escape_string($conn, $_POST['user']);
    $res = mysqli_query($conn, "SELECT * FROM users WHERE username='$u'");
    $row = mysqli_fetch_assoc($res);
    if ($row && password_verify($_POST['pass'], $row['password'])) {
        $_SESSION['user'] = $u;
        header("Location: index.php");
    } else { $err = "Invalid username or password!"; }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login/Register | Digital Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #6f42c1; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { width: 400px; border-radius: 20px; border: none; }
    </style>
</head>
<body>
    <div class="card p-4 shadow">
        <h3 class="text-center mb-4">Digital Notes Portal</h3>
        <?php if(isset($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>
        <?php if(isset($err)) echo "<div class='alert alert-danger'>$err</div>"; ?>
        <form method="POST">
            <input type="text" name="user" class="form-control mb-3" placeholder="Username" required>
            <input type="password" name="pass" class="form-control mb-3" placeholder="Password" required>
            <button name="login" class="btn btn-primary w-100 mb-2">Login</button>
            <button name="register" class="btn btn-outline-secondary w-100">Register</button>
        </form>
    </div>
</body>
</html>