<?php include 'config.php';
if(isset($_POST['save'])){
$name=$_POST['name'];
$skills=$_POST['skills'];

mysqli_query($conn,"INSERT INTO resume(name,skills) VALUES('$name','$skills')");
echo "Resume Saved";
}
?>
<form method="post">
Name: <input type="text" name="name"><br>
Skills: <textarea name="skills"></textarea><br>
<button name="save">Save Resume</button>
</form>
