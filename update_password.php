<?php
session_start();
require_once "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
$new_password = mysqli_real_escape_string($conn, $_POST['new_password']);

/* ===== GET CURRENT PASSWORD FROM DB ===== */
$result = mysqli_query($conn,
    "SELECT password FROM users WHERE id='$user_id'"
);

$user = mysqli_fetch_assoc($result);

if(!$user){
    die("User not found.");
}

/* ===== VERIFY OLD PASSWORD ===== */
if($old_password != $user['password']){
    echo "<script>
    alert('Old password is incorrect!');
    window.location.href='change_password.php';
    </script>";
    exit();
}

/* ===== UPDATE NEW PASSWORD ===== */
$update = mysqli_query($conn,
    "UPDATE users SET password='$new_password' WHERE id='$user_id'"
);

if($update){
    echo "<script>
    alert('Password changed successfully!');
    window.location.href='dashboard.php';
    </script>";
}else{
    die("Error: " . mysqli_error($conn));
}
?>