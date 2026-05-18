<?php
session_start();
require_once "config.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){
    $id = intval($_GET['id']);

    $delete = "DELETE FROM resume WHERE id = $id";

    if(mysqli_query($conn, $delete)){
        header("Location: manage_resumes.php");
        exit();
    } else {
        echo "Delete Error: " . mysqli_error($conn);
    }
}
?>