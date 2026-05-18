<?php
session_start();
include "php/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$name  = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

$imageName = "";

/* ================= IMAGE UPLOAD ================= */

if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {

    $allowed = ['jpg', 'jpeg', 'png'];
    $fileName = $_FILES['profile_image']['name'];
    $fileTmp  = $_FILES['profile_image']['tmp_name'];
    $fileSize = $_FILES['profile_image']['size'];

    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (in_array($ext, $allowed)) {

        if ($fileSize <= 2 * 1024 * 1024) {

            $imageName = time() . "_" . $fileName;

            $uploadPath = "uploads/" . $imageName;

            move_uploaded_file($fileTmp, $uploadPath);

            $sql = "UPDATE users 
                    SET name='$name', 
                        email='$email', 
                        profile_image='$imageName' 
                    WHERE id='$user_id'";

        } else {
            die("File too large (Max 2MB).");
        }

    } else {
        die("Only JPG, JPEG, PNG allowed.");
    }

} else {

    $sql = "UPDATE users 
            SET name='$name', 
                email='$email' 
            WHERE id='$user_id'";
}

if (mysqli_query($conn, $sql)) {
    header("Location: profile.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>