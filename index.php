<?php
require_once "php/config.php";

// Total Users
$user_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
$user_data = mysqli_fetch_assoc($user_query);
$total_users = $user_data['total'];

// Total Resumes
$resume_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM resume");
$resume_data = mysqli_fetch_assoc($resume_query);
$total_resumes = $resume_data['total'];

// Total Templates (if you have table)
$template_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM templates");
$total_templates = 0;
if($template_query){
    $template_data = mysqli_fetch_assoc($template_query);
    $total_templates = $template_data['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Web-Based Smart Resume Builder System</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<div class="navbar">
<a href="index.php">Home</a>
<a href="register.php">Register</a>
<a href="login.php">Login</a>
<a href="services.php">Services</a>
<a href="about.php">About</a>
</div>

<!-- HERO SECTION -->
<div class="hero">
    <h1>Create Professional Resume in Minutes</h1>
    <p>Smart, Fast and Easy Resume Builder for Students & Professionals</p>
    <a href="register.php" class="btn-primary">Create Resume Now</a>
</div>

<section style="
    padding:60px 20px;
    text-align:center;
    background:#f9fafb;
">

    <h2 style="
        margin-bottom:25px;
        font-size:26px;
        color:#111827;
    ">
        🎥 Project Demo Video
    </h2>

    <p style="
        max-width:700px;
        margin:0 auto 30px;
        color:#555;
        font-size:15px;
    ">
        Watch how our system helps users create professional resumes step-by-step.
    </p>

    <div style="
        max-width:900px;
        margin:0 auto;
        display:flex;
        justify-content:center;
    ">
        <iframe 
            width="100%" 
            height="500"
            src="https://www.youtube.com/embed/-NEwHuGjScU"
            style="
                border:none;
                border-radius:12px;
                box-shadow:0 10px 25px rgba(0,0,0,0.2);
            "
            allowfullscreen>
        </iframe>
    </div>

</section>

<!-- FEATURES SECTION -->
<div class="features">

    <div class="feature-card">
        <h3>Multiple Templates</h3>
        <p>Choose from professional resume templates designed for job success.</p>
    </div>

    <div class="feature-card">
        <h3>Instant PDF Download</h3>
        <p>Download your resume instantly in professional A4 PDF format.</p>
    </div>

    <div class="feature-card">
        <h3>Easy to Use</h3>
        <p>User-friendly interface designed for smooth experience.</p>
    </div>

</div>
<section class="stats-section">
    <div class="stats-container">
        <div class="stat-box">
<h2><?= $total_resumes ?>+</h2>
            <p>Resumes Created</p>
        </div>

        <div class="stat-box">
<h2><?= $total_users ?>+</h2>
            <p>Active Users</p>
        </div>

        <div class="stat-box">
            <h2>3</h2>
            <p>Resume Templates</p>
        </div>

        <div class="stat-box">
            <h2>98%</h2>
            <p>User Satisfaction</p>
        </div>
    </div>
</section>


<div class="footer">
    © 2026 Web-Based Smart Resume Builder System | All Rights Reserved
</div>

</body>
</html>
