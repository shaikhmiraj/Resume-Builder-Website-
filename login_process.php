<?php
session_start();
include "config.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users 
        WHERE email='$email' AND password='$password'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){

    $row = mysqli_fetch_assoc($result);

    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['name'];
    $_SESSION['role'] = $row['role'];   // Save role

    // Role Based Redirect
    if($row['role'] == 'admin'){
        header("Location: ../admin_dashboard.php");
    } else {
        header("Location: dashboard.php");
    }

    exit();

} 
else {
    header("Location: ../login.php?error=Invalid Email or Password");
    exit();
}
?>