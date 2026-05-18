<?php
session_start();
include "../config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Delete only if resume belongs to logged-in user
    mysqli_query($conn, "DELETE FROM resume WHERE id='$id' AND user_id='$user_id'");

    header("Location: ../my_resumes.php");
    exit();
}
?>