<?php
session_start();
require_once "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if($_SESSION['role'] != 'admin'){
    header("Location: dashboard.php");
    exit();
}

/* ===== TOTAL STATS ===== */
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$total_resumes = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM resume"))['total'];
$total_downloads = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(download_count) as total FROM resume"))['total'];

if(!$total_downloads){
    $total_downloads = 0;
}

/* ===== RESUME COUNT PER USER ===== */
$count_query = "
SELECT users.name, COUNT(resume.id) AS total
FROM users
LEFT JOIN resume ON resume.user_id = users.id
GROUP BY users.id
";

$count_result = mysqli_query($conn, $count_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body{
            margin:0;
            font-family: Arial, sans-serif;
            background:#f4f6f9;
        }

.navbar{
    background:#111827;
    padding:15px 0;
    text-align:center;
}

.navbar a{
    color:white;
    margin:0 25px;
    text-decoration:none;
    font-weight:bold;
    position:relative;
    padding:5px 0;
    transition:0.3s;
}

/* Hover text color */
.navbar a:hover{
    color:#3b82f6;
}

/* Underline animation effect */
.container{
            width:85%;
            margin:40px auto;
        }

        .dashboard-title{
            text-align:center;
            margin-bottom:30px;
        }

        .cards{
            display:flex;
            justify-content:space-between;
            gap:20px;
            margin-bottom:40px;
        }

        .card{
            flex:1;
            padding:25px;
            color:white;
            border-radius:8px;
            text-align:center;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
        }

        .blue{ background:#2563eb; }
        .green{ background:#16a34a; }
        .red{ background:#dc2626; }

        .card h2{
            margin:10px 0 0;
            font-size:28px;
        }

        .card:hover{
    transform:translateY(-5px);
    box-shadow:0 15px 35px rgba(0,0,0,0.15);
}

        table{
            width:100%;
            border-collapse:collapse;
            background:white;
            box-shadow:0 4px 10px rgba(0,0,0,0.05);
        }

        table th{
            background:#111827;
            color:white;
            padding:12px;
        }

        table td{
            padding:10px;
            text-align:center;
            border-bottom:1px solid #ddd;
        }

        table tr:hover{
            background:#f1f5f9;
        }

        .admin-links{
            text-align:center;
            margin-top:30px;
        }

        .btn{
            display:inline-block;
            padding:10px 20px;
            margin:10px;
            background:#111827;
            color:white;
            text-decoration:none;
            border-radius:5px;
        }

        .btn:hover{
            background:#2563eb;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="index.php">Home</a>
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="login.php">Logout</a>
    <a href="admin/change_password.php">Change_password</a>
</div>

<div class="container">

<h2 class="dashboard-title">Admin Panel</h2>
<p style="text-align:center;">Welcome Admin: <b><?= htmlspecialchars($_SESSION['user_name']); ?></b></p>

<div class="cards">
    <div class="card blue">
        <h3>Total Users</h3>
        <h2><?= $total_users ?></h2>
    </div>

    <div class="card green">
        <h3>Total Resumes</h3>
        <h2><?= $total_resumes ?></h2>
    </div>

    <div class="card red">
        <h3>Total Downloads</h3>
        <h2><?= $total_downloads ?></h2>
    </div>
</div>

<h3 style="margin-bottom:15px;">Resume Count Per User</h3>

<table>
<tr>
    <th>User Name</th>
    <th>Total Resumes</th>
</tr>

<?php
if($count_result && mysqli_num_rows($count_result) > 0){
    while($row = mysqli_fetch_assoc($count_result)){
?>
<tr>
    <td><?= htmlspecialchars($row['name']); ?></td>
    <td><?= $row['total']; ?></td>
</tr>
<?php 
    }
}else{
?>
<tr>
    <td colspan="2">No data found</td>
</tr>
<?php } ?>

</table>

<div class="admin-links">
    <a href="manage_users.php" class="btn">Manage Users</a>
    <a href="manage_resumes.php" class="btn">Manage Resumes</a>
</div>

</div>

</body>
</html>