<?php 
include 'db.php'; 
?>
<!DOCTYPE html>
<html>
<head><title>Register | Digital Notes</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-primary d-flex align-items-center justify-content-center vh-100">
    <div class="card p-4 shadow" style="width: 350px;">
        <h4 class="text-center">Create Account</h4>
        <form method="POST">
            <input type="text" name="user" class="form-control mb-3" placeholder="Choose Username" required>
            <input type="password" name="pass" class="form-control mb-3" placeholder="Choose Password" required>
            <button name="reg" class="btn btn-dark w-100 mb-2">Register</button>
            <a href="login.php" class="btn btn-link w-100 text-center text-decoration-none">Already have an account? Login</a>
        </form>
        <?php
        if(isset($_POST['reg'])){
            $u = mysqli_real_escape_string($conn, $_POST['user']);
            $p = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Secure password storage
            $sql = "INSERT INTO users (username, password) VALUES ('$u', '$p')";
            if(mysqli_query($conn, $sql)) { 
                echo "<p class='text-success text-center mt-2'>Success! <a href='login.php'>Login now</a></p>"; 
            }
        }
        ?>
    </div>
</body>
</html>