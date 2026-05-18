<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
    User Registration
</h2>

<!-- FORM CARD -->
<div class="container">

    <form action="php/register.php" method="POST" autocomplete="off">

        <input type="text"
               name="name"
               placeholder="Enter your full name"
               required>

        <input type="email"
               name="email"
               placeholder="Enter your email address"
               required>

<div class="form-group">
    <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>

    <span class="toggle-password" onclick="togglePassword('password', this)">
        <i class="fa-solid fa-eye-slash"></i>
    </span>
</div>

<div class="form-group">
    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>

    <span class="toggle-password" onclick="togglePassword('confirm_password', this)">
        <i class="fa-solid fa-eye-slash"></i>
    </span>
</div>

<button type="submit">Register</button>

    </form>

</div>
<script>
function togglePassword(fieldId, iconElement) {

    var input = document.getElementById(fieldId);
    var icon = iconElement.querySelector("i");

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
