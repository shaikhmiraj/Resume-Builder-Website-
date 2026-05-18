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

/* Profile Image Logic */
$image = !empty($user['profile_image']) 
         ? 'uploads/' . $user['profile_image'] 
         : 'uploads/default.png';
?>

<!DOCTYPE html>
<html>
<head>
<title>My Profile</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
<a href="php/dashboard.php">Dashboard</a>
<a href="my_resumes.php">My Resumes</a>
<a href="profile.php">Profile</a>
<a href="login.php">Logout</a>
</div>

<h2 style="text-align:center; margin-top:40px;">My Profile</h2>

<div class="container" style="text-align:center;">

<!-- PROFILE IMAGE -->
<img src="<?php echo $image; ?>" 
     style="width:150px;
            height:150px;
            border-radius:50%;
            object-fit:cover;
            object-position:50% 15%;
            border:3px solid #2563eb;">
            
<p><strong>Name:</strong> <?= htmlspecialchars($user['name']); ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
<p><strong>Role:</strong> <?= htmlspecialchars($user['role']); ?></p>

<br><br>

<a href="edit_profile.php">
    <button style="padding:10px 20px;">Edit Profile</button>
</a>

<br><br>

<a href="change_password.php">
    <button style="background:#dc2626; padding:10px 20px;">
        Change Password
    </button>
</a>

</div>

</body>
</html>