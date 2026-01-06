<?php 
session_start();
include 'db.php'; 
?>
<!DOCTYPE html>
<html>
<head><title>Login</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-primary d-flex align-items-center justify-content-center vh-100">
    <div class="card p-4 shadow" style="width: 350px;">
        <h4 class="text-center">Notes Login</h4>
        <form method="POST">
            <input type="text" name="user" class="form-control mb-3" placeholder="Username" required>
            <input type="password" name="pass" class="form-control mb-3" placeholder="Password" required>
            <button name="log" class="btn btn-success w-100">Login</button>
            <a href="register.php" class="btn btn-link w-100 text-center">New? Register</a>
        </form>
        <?php
        if(isset($_POST['log'])){
            $u = mysqli_real_escape_string($conn, $_POST['user']);
            $res = mysqli_query($conn, "SELECT * FROM users WHERE username='$u'");
            $row = mysqli_fetch_assoc($res);
            if($row && password_verify($_POST['pass'], $row['password'])){
                $_SESSION['user'] = $u;
                header("Location: index.php");
            } else { echo "<p class='text-danger mt-2'>Invalid Login</p>"; }
        }
        ?>
    </div>
</body>
</html>