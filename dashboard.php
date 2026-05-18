<?php
session_start();
include "../config.php";  

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['user_name'];

/* COUNT USER RESUMES */

$query = "SELECT COUNT(*) AS total FROM resume WHERE user_id='$user_id'";

$resume_count_query = mysqli_query($conn, $query);

if (!$resume_count_query) {
    die("SQL Error: " . mysqli_error($conn));
}

$resume_count = mysqli_fetch_assoc($resume_count_query)['total'];

/* COUNT DOWNLOADS */
$download_query = mysqli_query($conn,
    "SELECT SUM(download_count) AS total_downloads 
     FROM resume 
     WHERE user_id='$user_id'"
);

$download_data = mysqli_fetch_assoc($download_query);
$download_total = $download_data['total_downloads'] ?? 0;

/* TEMPLATE COUNT (Manual) */
$template_count = 3;

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .dashboard-container {
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background: #1f2d3d;
            color: white;
            min-height: 100vh;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #3c8dbc;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
        }

        .top-bar {
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .welcome {
            font-size: 22px;
            font-weight: bold;
        }

        /* Stats Cards */
        .card-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            flex: 1;
            min-width: 200px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .card h3 {
            margin: 10px 0;
            font-size: 28px;
            color: #3c8dbc;
        }

        .btn-create {
            margin-top: 25px;
            display: inline-block;
            padding: 12px 25px;
            background: #3c8dbc;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-create:hover {
            background: #2c6fa3;
        }
    </style>
</head>

<body>

<div class="dashboard-container">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Resume Builder</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="../resume_form.php">Create Resume</a>
        <a href="../my_resumes.php">My Resumes</a>
        <a href="../profile.php">Profile</a>
        <a href="../change_password.php">Change Password</a>
        <a href="../login.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <div class="top-bar">
            <div class="welcome">
                Welcome, <?php echo $username; ?> 
            </div>
        </div>

        <!-- Stats Section -->
        <div class="card-container">
            <div class="card">
                <h3><?= $resume_count ?></h3>
                <p>Total Resumes</p>
            </div>

            <div class="card">
                <h3><?= $template_count ?></h3>
                <p>Templates Available</p>
            </div>

           <div class="card">
              <h3><?php echo $download_total; ?></h3>
              <p>Total Downloads</p>
           </div>       
         </div>

        <a href="../resume_form.php" class="btn-create">
            + Create New Resume
        </a>

    </div>

</div>

</body>
</html>