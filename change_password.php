<?php
session_start();
require_once "../config.php"; // adjust path if needed

// Check admin login
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin - Change Password</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="../css/style.css">  <!-- use main styling -->

</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <a href="../admin_dashboard.php">Dashboard</a>
    <a href="../login.php">Logout</a>
</div>

<h2 style="text-align:center; margin-top:40px;">Change Password</h2>

<div class="container">

<form action="update_password.php" method="POST">

<div class="form-group">
    <div class="password-wrapper">
        <input type="password"
               id="old_password"
               name="old_password"
               class="form-control"
               placeholder="Enter old password"
               required>

        <span class="toggle-password"
              onclick="togglePassword('old_password', this)">
            <i class="fa-solid fa-eye-slash"></i>
        </span>
    </div>
</div>

<div class="form-group">
    <div class="password-wrapper">
        <input type="password"
               id="new_password"
               name="new_password"
               class="form-control"
               placeholder="Enter new password"
               required>

        <span class="toggle-password"
              onclick="togglePassword('new_password', this)">
            <i class="fa-solid fa-eye-slash"></i>
        </span>
    </div>
</div>

<div class="form-group">
    <div class="password-wrapper">
        <input type="password"
               id="confirm_password"
               name="confirm_password"
               class="form-control"
               placeholder="Confirm new password"
               required>

        <span class="toggle-password"
              onclick="togglePassword('confirm_password', this)">
            <i class="fa-solid fa-eye-slash"></i>
        </span>
    </div>
</div>

<button type="submit" class="btn-primary">
    Update Password
</button>

</form>

</div>

<script>
function togglePassword(fieldId, element) {

    var input = document.getElementById(fieldId);
    var icon = element.querySelector("i");

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
}
</script>

</body>
</html>