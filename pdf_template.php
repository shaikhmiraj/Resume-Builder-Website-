<?php
include "config.php";

$result = mysqli_query($conn, "SELECT * FROM resume ORDER BY id DESC LIMIT 1");
$data = mysqli_fetch_assoc($result);

$template = $data['template'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<style>

/* ===== PAGE ===== */
@page {
    size: A4;
    margin: 20mm;
}

body {
    font-family: DejaVu Sans, sans-serif;
    background: #ffffff;
    margin: 0;
    padding: 0;
}

/* ===== RESUME BASE ===== */
.resume-container {
    width: 100%;
    padding: 30px;
    border-radius: 10px;
}

/* ===== COMMON TEXT ===== */
.resume-name {
    text-align: center;
    font-size: 28px;
    margin-bottom: 10px;
}

.resume-contact {
    text-align: center;
    font-size: 14px;
    margin-bottom: 25px;
}

.resume-section {
    margin-top: 20px;
}

.resume-title {
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    padding-bottom: 5px;
    margin-bottom: 6px;
    border-bottom: 2px solid #ccc;
}

.resume-content {
    font-size: 14px;
    line-height: 1.6;
}

/* ===== TEMPLATE 1 (CLASSIC) ===== */
.resume-container.template1 {
    background: #ffffff;
    border-left: 6px solid #2563eb;
}

.resume-container.template1 .resume-title {
    color: #2563eb;
}

/* ===== TEMPLATE 2 (MODERN DARK) ===== */
.resume-container.template2 {
    background: #1f2933;
    color: #f9fafb;
}

.resume-container.template2 .resume-title {
    color: #38bdf8;
    border-bottom: 2px solid #475569;
}

.resume-container.template2 .resume-content,
.resume-container.template2 .resume-contact,
.resume-container.template2 .resume-name {
    color: #f9fafb;
}

/* ===== TEMPLATE 3 (MINIMAL) ===== */
.resume-container.template3 {
    background: #f9fafb;
    border-top: 5px solid #16a34a;
    font-family: Georgia, serif;
}

.resume-container.template3 .resume-title {
    color: #16a34a;
}

</style>

</head>
<body>

<div class="resume-container <?= $template ?>">

    <div class="resume-name"><?= $data['name'] ?></div>

    <div class="resume-contact">
        Email: <?= $data['email'] ?> |
        Phone: <?= $data['phone'] ?>
    </div>

    <div class="resume-section">
        <div class="resume-title">Education</div>
        <div class="resume-content"><?= nl2br($data['education']) ?></div>
    </div>

    <div class="resume-section">
        <div class="resume-title">Skills</div>
        <div class="resume-content"><?= nl2br($data['skills']) ?></div>
    </div>

    <div class="resume-section">
        <div class="resume-title">Projects</div>
        <div class="resume-content"><?= nl2br($data['projects']) ?></div>
    </div>

</div>

</body>
</html>
