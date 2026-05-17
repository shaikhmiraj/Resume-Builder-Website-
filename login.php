<?php include 'config.php';
if(isset($_POST['login'])){
$email=$_POST['email'];
$pass=$_POST['password'];

$res=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND password='$pass'");
if(mysqli_num_rows($res)>0){
echo "Login Success";
}else{
echo "Invalid Login";
}
}
?>
<form method="post">
Email: <input type="email" name="email"><br>
Password: <input type="password" name="password"><br>
<button name="login">Login</button>
</form>
