<?php
session_start();
include "php/config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Profile</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2 style="text-align:center; margin-top:40px;">Edit Profile</h2>

<div class="container">

<form action="update_profile.php" 
      method="POST" 
      enctype="multipart/form-data">

<input type="text" name="name" value="<?= $user['name']; ?>" required>

<input type="email" name="email" value="<?= $user['email']; ?>" required>

<label>Profile Image:</label>
<input type="file" name="profile_image" accept="image/*">

<button type="submit">Update Profile</button>

</form>

</div>

</body>
</html>