<?php include 'config.php';
if(isset($_POST['submit'])){
$name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['password'];

mysqli_query($conn,"INSERT INTO users(name,email,password) VALUES('$name','$email','$pass')");
echo "Registered Successfully";
}
?>
<form method="post">
Name: <input type="text" name="name"><br>
Email: <input type="email" name="email"><br>
Password: <input type="password" name="password"><br>
<button name="submit">Register</button>
</form>
