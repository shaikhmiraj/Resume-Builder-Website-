<?php
include "config.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO users (name, email, password, role)
        VALUES ('$name', '$email', '$password', 'user')";

if(mysqli_query($conn, $sql)){
    header("Location: ../login.php?success=Registered Successfully");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>