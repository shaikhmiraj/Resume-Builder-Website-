<?php
session_start();
include "php/config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM resume WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Resumes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="navbar">
    <a href="php/dashboard.php">Dashboard</a>
    <a href="resume_form.php">Create Resume</a>
    <a href="login.php">Logout</a>
</div>

<h2 style="text-align:center; margin-top:30px;">My Resumes</h2>

<table border="1" width="80%" align="center" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Template</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['template'] ?></td>
<td>
    <a href="php/edit_resume.php?id=<?= $row['id'] ?>">Edit</a> |
    <a href="php/delete_resume.php?id=<?= $row['id'] ?>">Delete</a> |
    <a href="php/download_pdf.php?id=<?php echo $row['id']; ?>">Download</a></td>

</tr>
<?php } ?>

</table>

</body>
</html>