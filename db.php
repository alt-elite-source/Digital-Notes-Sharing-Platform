<?php
$conn = mysqli_connect("localhost", "root", "", "notes_db");
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }
// Note: No session_start here to avoid the error you saw earlier.
?>