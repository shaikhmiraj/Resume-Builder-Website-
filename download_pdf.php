<?php
ob_start();
session_start();

require_once __DIR__ . '/../dompdf/autoload.inc.php';
require_once 'config.php';

use Dompdf\Dompdf;
use Dompdf\Options;

/* ================= CHECK LOGIN ================= */
if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

/* ================= GET RESUME ID ================= */
if(!isset($_GET['id'])){
    die("Resume ID not provided.");
}

$id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

/* ================= FETCH RESUME ================= */
$result = mysqli_query($conn,
    "SELECT * FROM resume WHERE id='$id' AND user_id='$user_id'"
);

$data = mysqli_fetch_assoc($result);

if(!$data){
    die("Resume not found.");
}

$template = $data['template'];

/* ================= DOMPDF OPTIONS ================= */
$options = new Options();
$options->set('defaultFont', 'DejaVu Sans');
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);

/* ================= LOAD CSS ================= */
$css = file_get_contents(__DIR__ . '/../css/pdf.css');

/* ================= BUILD HTML ================= */
$html = '
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
'.$css.'
</style>
</head>
<body>

<div class="page-wrapper">
<div class="resume-container '.$template.'">

    <h1 class="resume-name">'.htmlspecialchars($data['name']).'</h1>

    <div class="resume-contact">
        <strong>Email:</strong> '.htmlspecialchars($data['email']).' |
        <strong>Phone:</strong> '.htmlspecialchars($data['phone']).'
    </div>

    <div class="resume-columns">

        <!-- LEFT COLUMN -->
        <div class="left-column">

            <div class="resume-section">
                <div class="resume-title">PERSONAL DETAILS</div>
                <div class="resume-content">
                    <strong>Date of Birth:</strong> '.date("d/m/Y", strtotime($data['dob'])).'<br>
                    <strong>Gender:</strong> '.htmlspecialchars($data['gender']).'<br>
                    <strong>Nationality:</strong> '.htmlspecialchars($data['nationality']).'<br>
                    <strong>Address:</strong><br>
                    '.nl2br(htmlspecialchars($data['address'])).'
                </div>
            </div>

            <div class="resume-section">
                <div class="resume-title">EDUCATION</div>
                <div class="resume-content">
                    '.nl2br(htmlspecialchars($data['education'])).'
                </div>
            </div>

            <div class="resume-section">
                <div class="resume-title">PROJECTS</div>
                <div class="resume-content">
                    '.nl2br(htmlspecialchars($data['projects'])).'
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="right-column">

            <div class="resume-section">
                <div class="resume-title">SKILLS</div>
                <div class="resume-content">
                    '.nl2br(htmlspecialchars($data['skills'])).'
                </div>
            </div>

            <div class="resume-section">
                <div class="resume-title">EXPERIENCE</div>
                <div class="resume-content">
                    '.nl2br(htmlspecialchars($data['experience'])).'
                </div>
            </div>

            <div class="resume-section">
                <div class="resume-title">CERTIFICATIONS</div>
                <div class="resume-content">
                    '.nl2br(htmlspecialchars($data['certifications'])).'
                </div>
            </div>

            <div class="resume-section">
                <div class="resume-title">ACHIEVEMENTS</div>
                <div class="resume-content">
                    '.nl2br(htmlspecialchars($data['achievements'])).'
                </div>
            </div>

            <div class="resume-section">
                <div class="resume-title">STRENGTHS</div>
                <div class="resume-content">
                    '.nl2br(htmlspecialchars($data['strengths'])).'
                </div>
            </div>

            <div class="resume-section">
                <div class="resume-title">LANGUAGES</div>
                <div class="resume-content">
                    '.nl2br(htmlspecialchars($data['languages'])).'
                </div>
            </div>

            <div class="resume-section">
                <div class="resume-title">HOBBIES</div>
                <div class="resume-content">
                    '.nl2br(htmlspecialchars($data['hobbies'])).'
                </div>
            </div>

        </div>

    </div>

</div>
</div>

</body>
</html>
';

/* ================= UPDATE DOWNLOAD COUNT ================= */
mysqli_query($conn,
    "UPDATE resume SET download_count = download_count + 1 WHERE id='$id'"
);

/* ================= GENERATE PDF ================= */
$dompdf->loadHtml($html);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();

/* ================= DOWNLOAD ================= */
ob_end_clean();
$dompdf->stream("Resume.pdf", ["Attachment" => true]);
exit;
?>