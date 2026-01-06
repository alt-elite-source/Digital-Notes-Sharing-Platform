<?php
include 'db.php';
if(isset($_POST['id'])){
    $id = (int)$_POST['id']; $v = (int)$_POST['val'];
    mysqli_query($conn, "UPDATE notes SET author_rating_sum = author_rating_sum + $v, author_rating_count = author_rating_count + 1 WHERE id = $id");
    header("Location: view.php");
}
?>