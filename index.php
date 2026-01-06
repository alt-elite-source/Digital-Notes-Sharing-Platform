<?php 
session_start();
// Error reporting helps find issues like "Not Found" or "Variable undefined"
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php'; 

if(!isset($_SESSION['user'])) { 
    header("Location: login.php"); 
    exit(); 
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home | Upload Note</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark p-3 shadow-sm">
    <div class="container">
        <span class="navbar-brand">Welcome, <b><?php echo htmlspecialchars($_SESSION['user']); ?></b></span>
        <div>
            <a href="view_files.php" class="btn btn-outline-light me-2">View & Search Library</a>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card p-4 shadow-sm border-0">
        <h3 class="mb-4">Upload New Resource</h3>
        <form method="POST" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">File Name</label>
                <input type="text" name="fname" class="form-control" placeholder="e.g. Database Basics" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Author Name</label>
                <input type="text" name="author" class="form-control" placeholder="e.g. John Doe" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Subject</label>
                <input type="text" name="subject" class="form-control" placeholder="e.g. DBMS" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Select File</label>
                <input type="file" name="note" class="form-control" required>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button name="up" class="btn btn-primary w-100">Publish</button>
            </div>
        </form>

        <?php
        if(isset($_POST['up'])){
            // Create uploads directory if it doesn't exist
            if(!is_dir('uploads')) { mkdir('uploads', 0777, true); }

            $original_name = basename($_FILES['note']['name']);
            $safe_filename = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $original_name);
            $path = "uploads/" . $safe_filename;

            if(move_uploaded_file($_FILES['note']['tmp_name'], $path)){
                // Use prepared variables to prevent SQL injection
                $f = mysqli_real_escape_string($conn, $_POST['fname']);
                $a = mysqli_real_escape_string($conn, $_POST['author']);
                $s = mysqli_real_escape_string($conn, $_POST['subject']);
                
                $sql = "INSERT INTO notes (title, author, subject, file_path) VALUES ('$f', '$a', '$s', '$path')";
                
                if(mysqli_query($conn, $sql)) {
                    echo "<div class='alert alert-success mt-3'>Note successfully uploaded and published!</div>";
                } else {
                    echo "<div class='alert alert-danger mt-3'>Database Error: " . mysqli_error($conn) . "</div>";
                }
            } else {
                echo "<div class='alert alert-danger mt-3'>Failed to move uploaded file. Check folder permissions.</div>";
            }
        }
        ?>
    </div>
</div>
</body>
</html>