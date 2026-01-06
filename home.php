<?php include 'db.php'; if(!isset($_SESSION['user'])) header("Location: login.php"); ?>
<!DOCTYPE html>
<html>
<head><title>Home | Upload</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body>
<nav class="navbar navbar-dark bg-dark p-3"><span class="navbar-brand">Welcome, <?php echo $_SESSION['user']; ?></span>
<div class="d-flex"><a href="view.php" class="btn btn-outline-light me-2">View & Search</a><a href="login.php" class="btn btn-danger">Logout</a></div></nav>
<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3>Upload New Note</h3>
        <form method="POST" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-3"><input type="text" name="fname" class="form-control" placeholder="File Name" required></div>
            <div class="col-md-3"><input type="text" name="author" class="form-control" placeholder="Author Name" required></div>
            <div class="col-md-2"><input type="text" name="subject" class="form-control" placeholder="Subject" required></div>
            <div class="col-md-3"><input type="file" name="note" class="form-control" required></div>
            <div class="col-md-1"><button name="up" class="btn btn-primary">Publish</button></div>
        </form>
        <?php
        if(isset($_POST['up'])){
            $path = "uploads/".time()."_".$_FILES['note']['name'];
            if(move_uploaded_file($_FILES['note']['tmp_name'], $path)){
                mysqli_query($conn, "INSERT INTO notes (title, author, subject, file_path) VALUES ('{$_POST['fname']}', '{$_POST['author']}', '{$_POST['subject']}', '$path')");
                echo "<p class='text-success mt-2'>Successfully Published!</p>";
            }
        }
        ?>
    </div>
</div>
</body>
</html>