<?php
session_start();
require_once "config.php";

/* ================= LOGIN CHECK ================= */
if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* ================= SAFE FORM DATA ================= */
$name          = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
$email         = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
$phone         = mysqli_real_escape_string($conn, $_POST['phone'] ?? '');
$dob           = mysqli_real_escape_string($conn, $_POST['dob']);
$address       = mysqli_real_escape_string($conn, $_POST['address']);
$gender        = mysqli_real_escape_string($conn, $_POST['gender']);
$nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
$education     = mysqli_real_escape_string($conn, $_POST['education'] ?? '');
$skills        = mysqli_real_escape_string($conn, $_POST['skills'] ?? '');
$projects      = mysqli_real_escape_string($conn, $_POST['projects'] ?? '');
$experience    = mysqli_real_escape_string($conn, $_POST['experience'] ?? '');
$certifications= mysqli_real_escape_string($conn, $_POST['certifications'] ?? '');
$achievements  = mysqli_real_escape_string($conn, $_POST['achievements'] ?? '');
$hobbies       = mysqli_real_escape_string($conn, $_POST['hobbies'] ?? '');
$template      = mysqli_real_escape_string($conn, $_POST['template'] ?? 'template1');

/* ================= CHECKBOX (ARRAY) HANDLING ================= */
$strengths = '';
if(isset($_POST['strengths']) && is_array($_POST['strengths'])){
    $strengths = mysqli_real_escape_string(
        $conn,
        implode(", ", $_POST['strengths'])
    );
}

/* ================= MULTI SELECT HANDLING ================= */
$languages = isset($_POST['languages']) 
    ? implode(", ", $_POST['languages']) 
    : '';

$strengths = isset($_POST['strengths']) 
    ? implode(", ", $_POST['strengths']) 
    : '';
    
/* ================= INSERT QUERY ================= */
$sql = "INSERT INTO resume (
    user_id,
    name,
    email,
    phone,
    dob,
    address,
    gender,
    nationality,
    education,
    skills,
    projects,
    experience,
    certifications,
    achievements,
    strengths,
    languages,
    hobbies,
    template,
    download_count
) VALUES (
    '$user_id',
    '$name',
    '$email',
    '$phone',
    '$dob',
    '$address',
    '$gender',
    '$nationality',
    '$education',
    '$skills',
    '$projects',
    '$experience',
    '$certifications',
    '$achievements',
    '$strengths',
    '$languages',
    '$hobbies',
    '$template',
    0
)";

/* ================= EXECUTE ================= */
if(mysqli_query($conn, $sql)){
    header("Location: ../my_resumes.php?success=Resume Created Successfully");
    exit();
}else{
    die("Database Error: " . mysqli_error($conn));
}
?>