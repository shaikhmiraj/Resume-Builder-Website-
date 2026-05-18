<?php
include "config.php";

$result = mysqli_query($conn, "SELECT * FROM resume ORDER BY id DESC LIMIT 1");
$data = mysqli_fetch_assoc($result);

$allowed = ['template1','template2','template3'];
$template = in_array($data['template'], $allowed) ? $data['template'] : 'template1';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Generated Resume</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="navbar">
    <a href="../index.html">Home</a>
    <a href="../services.html">Services</a>
    <a href="../about.html">About</a>
</div>

<div class="resume-wrapper">
    <div class="resume-container <?= $template ?>">

        <h1 class="resume-name"><?= htmlspecialchars($data['name']) ?></h1>

<div class="resume-contact">
    <span><strong>Email:</strong> <?= htmlspecialchars($data['email']) ?></span>
    &nbsp;&nbsp;|&nbsp;&nbsp;
    <span><strong>Phone:</strong> <?= htmlspecialchars($data['phone']) ?></span>
</div>
        <div class="resume-section">
            <div class="resume-title">Education</div>
            <div class="resume-content"><?= nl2br(htmlspecialchars($data['education'])) ?></div>
        </div>

        <div class="resume-section">
            <div class="resume-title">Skills</div>
            <div class="resume-content"><?= nl2br(htmlspecialchars($data['skills'])) ?></div>
        </div>

        <div class="resume-section">
            <div class="resume-title">Projects</div>
            <div class="resume-content"><?= nl2br(htmlspecialchars($data['projects'])) ?></div>
        </div>

        <!-- EXPERIENCE -->
<div class="resume-section">
    <div class="resume-title">Experience</div>
    <div class="resume-content">
        <?= nl2br(htmlspecialchars($data['experience'])) ?>
    </div>
</div>

<!-- CERTIFICATIONS -->
<div class="resume-section">
    <div class="resume-title">Certifications</div>
    <div class="resume-content">
        <?= nl2br(htmlspecialchars($data['certifications'])) ?>
    </div>
</div>

<!-- ACHIEVEMENTS -->
<div class="resume-section">
    <div class="resume-title">Achievements</div>
    <div class="resume-content">
        <?= nl2br(htmlspecialchars($data['achievements'])) ?>
    </div>
</div>

<!-- STRENGTHS -->
<div class="resume-section">
    <div class="resume-title">Strengths</div>
    <div class="resume-content">
        <?= nl2br(htmlspecialchars($data['strengths'])) ?>
    </div>
</div>

<!-- LANGUAGES -->
<div class="resume-section">
    <div class="resume-title">Languages</div>
    <div class="resume-content">
        <?= nl2br(htmlspecialchars($data['languages'])) ?>
    </div>
</div>

<!-- HOBBIES -->
<div class="resume-section">
    <div class="resume-title">Hobbies</div>
    <div class="resume-content">
        <?= nl2br(htmlspecialchars($data['hobbies'])) ?>
    </div>
</div>


    </div>
<a href="download_pdf.php">
    <button style="width:200px;margin:20px auto;display:block;">
        Download Resume PDF
    </button>
</a>

</div>

</body>
</html>
