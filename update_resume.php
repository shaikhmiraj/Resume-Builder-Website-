<?php
session_start();
require_once "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

if(!isset($_POST['resume_id'])){
    header("Location: ../my_resumes.php");
    exit();
}

$resume_id = intval($_POST['resume_id']);
$user_id   = $_SESSION['user_id'];

/* ✅ GET TEMPLATE (THIS WAS MISSING) */
$template = mysqli_real_escape_string($conn, $_POST['template']);

/* ================= GET FORM DATA ================= */

$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$dob = mysqli_real_escape_string($conn, $_POST['dob']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
$education = mysqli_real_escape_string($conn, $_POST['education']);
$skills = mysqli_real_escape_string($conn, $_POST['skills']);
$projects = mysqli_real_escape_string($conn, $_POST['projects']);
$experience = mysqli_real_escape_string($conn, $_POST['experience']);
$certifications = mysqli_real_escape_string($conn, $_POST['certifications']);
$achievements = mysqli_real_escape_string($conn, $_POST['achievements']);
$hobbies = mysqli_real_escape_string($conn, $_POST['hobbies']);

$strengths = isset($_POST['strengths']) 
    ? implode(", ", $_POST['strengths']) 
    : "";

$languages = isset($_POST['languages']) 
    ? implode(", ", $_POST['languages']) 
    : "";

/* ================= UPDATE QUERY ================= */

$sql = "UPDATE resume SET
template='$template',   /* ✅ THIS LINE ADDED */
name='$name',
email='$email',
phone='$phone',
dob='$dob',
address='$address',
gender='$gender',
nationality='$nationality',
education='$education',
skills='$skills',
projects='$projects',
experience='$experience',
certifications='$certifications',
achievements='$achievements',
strengths='$strengths',
languages='$languages',
hobbies='$hobbies'
WHERE id=$resume_id AND user_id=$user_id";

if(mysqli_query($conn, $sql)){
    header("Location: ../my_resumes.php");
    exit();
}else{
    die("Error: " . mysqli_error($conn));
}
?>