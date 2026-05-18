<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
<a href="index.php">Home</a>
<a href="register.php">Register</a>
<a href="login.php">Login</a>
<a href="services.php">Services</a>
<a href="about.php">About</a>
</div>

<!-- PAGE HEADING -->
<h2 style="text-align:center; margin-top:40px;">
    User Login
</h2>
<?php
if(isset($_GET['error'])){
    echo "<p style='color:red; text-align:center;'>".$_GET['error']."</p>";
}
?>
<!-- FORM CARD -->
<div class="container">

    <form action="php/login_process.php" method="POST" autocomplete="off">


<div class="form-group">
         <input type="email"
               name="email"
               placeholder="Enter your registered email"
               required>


</div>

<div class="form-group password-wrapper">
    <input type="password"
           id="password"
           name="password"
           class="form-control"
           placeholder="Enter password"
           required>

    <span class="toggle-password"
          onclick="togglePassword('password', this)">
        <i class="fa-solid fa-eye-slash"></i>
    </span>
</div>

<button type="submit">Login</button>

    </form>

</div>

<script>
function togglePassword(inputId, element) {

    const input = document.getElementById(inputId);
    const icon = element.querySelector("i");

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
