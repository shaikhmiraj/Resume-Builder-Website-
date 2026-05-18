<?php
session_start();
require_once "../config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

if($_SESSION['role'] != 'admin'){
    header("Location: ../dashboard.php");
    exit();
}

if(isset($_POST['old_password'])){

    $admin_id = $_SESSION['user_id'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch current password
    $query = mysqli_query($conn, "SELECT password FROM users WHERE id='$admin_id'");
    $row = mysqli_fetch_assoc($query);

    if($row){

        if($row['password'] == $old_password){

            if($new_password == $confirm_password){

                $update = mysqli_query($conn, 
                    "UPDATE users SET password='$new_password' WHERE id='$admin_id'"
                );

                if($update){
                    echo "<script>
                        alert('Password Updated Successfully!');
                        window.location.href='../admin_dashboard.php';
                    </script>";
                }else{
                    echo "<script>alert('Something went wrong!');</script>";
                }

            }else{
                echo "<script>alert('New passwords do not match!'); history.back();</script>";
            }

        }else{
            echo "<script>alert('Old password is incorrect!'); history.back();</script>";
        }

    }else{
        echo "<script>alert('Admin not found!'); history.back();</script>";
    }
}
?>