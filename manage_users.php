<?php
session_start();
include "php/config.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="navbar">
    <a href="index.php">Home</a>
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="login.php">Logout</a>
</div>

<h2 style="text-align:center;">All Registered Users</h2>

<table border="1" cellpadding="10" style="margin:auto; margin-top:30px;">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['role'] ?></td>
    <td>
    <a href="php/delete_users.php?id=<?= $row['id'] ?>" 
       onclick="return confirm('Are you sure?')"
       style="color:red;">Delete</a>
</td>
</tr>
<?php } ?>

</table>

</body>
</html>