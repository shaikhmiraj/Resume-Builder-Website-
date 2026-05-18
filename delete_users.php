<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
}

header("Location: ../manage_users.php");
exit();
?>