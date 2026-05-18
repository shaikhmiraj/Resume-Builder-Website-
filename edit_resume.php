<?php
session_start();
require_once "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: my_resumes.php");
    exit();
}

$resume_id = intval($_GET['id']);
$user_id   = $_SESSION['user_id'];

$query = "SELECT * FROM resume 
          WHERE id = $resume_id 
          AND user_id = $user_id";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0){
    die("Resume not found.");
}

$resume = mysqli_fetch_assoc($result);

$languages = explode(", ", $resume['languages']);
$strengths = explode(", ", $resume['strengths']);
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Resume</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="navbar">
    <a href="dashboard.php">Dashboard</a>
    <a href="../my_resumes.php">My Resumes</a>
    <a href="../login.php">Logout</a>
</div>

<h2 style="text-align:center; margin:30px 0;">Edit Resume</h2>

<div class="container">

<form action="update_resume.php"
      method="POST"
      onsubmit="return validateResume()"
      oninput="updatePreview()">

<input type="hidden" name="resume_id" value="<?= $resume['id']; ?>">

<!-- TEMPLATE -->
<h3>Select Resume Template</h3>

<div class="template-selection">
    <div class="template-card <?= ($resume['template']=='template1')?'active':'' ?>"
         onclick="selectTemplate('template1')">Classic</div>

    <div class="template-card <?= ($resume['template']=='template2')?'active':'' ?>"
         onclick="selectTemplate('template2')">Modern</div>

    <div class="template-card <?= ($resume['template']=='template3')?'active':'' ?>"
         onclick="selectTemplate('template3')">Minimal</div>
</div>

<input type="hidden" id="selectedTemplate"
       name="template"
       value="<?= $resume['template']; ?>">

<!-- NAME -->
<label>Full Name</label>
<input type="text" id="name" name="name"
value="<?= htmlspecialchars($resume['name']); ?>" required>
<small class="error" id="nameError"></small>

<!-- EMAIL -->
<label>Email</label>
<input type="email" id="email" name="email"
value="<?= htmlspecialchars($resume['email']); ?>" required>
<small class="error" id="emailError"></small>

<!-- PHONE -->
<label>Phone</label>
<input type="text" id="phone" name="phone"
value="<?= htmlspecialchars($resume['phone']); ?>"
maxlength="10"
required>
<small class="error" id="phoneError"></small>

<!-- DATE OF BIRTH -->
<label>Date of Birth</label>
<input type="date"
       id="dob"
       name="dob"
       value="<?= htmlspecialchars($resume['dob']); ?>"
       max="<?= date('Y-m-d'); ?>"
       onchange="updatePreview()"
       required>
<small class="error" id="dobError"></small>

<!-- ADDRESS -->
<label>Address</label>
<textarea id="address"
          name="address"
          rows="3"
          oninput="updatePreview()"
          required><?= htmlspecialchars($resume['address']); ?></textarea>
<small class="error" id="addressError"></small>

<!-- GENDER -->
<label>Gender</label>

<div class="radio-group">

    <label class="radio-inline">
        <input type="radio"
               name="gender"
               value="Male"
               <?= ($resume['gender'] == 'Male') ? 'checked' : ''; ?>
               onchange="updatePreview()" required>
        Male
    </label>

    <label class="radio-inline">
        <input type="radio"
               name="gender"
               value="Female"
               <?= ($resume['gender'] == 'Female') ? 'checked' : ''; ?>
               onchange="updatePreview()">
        Female
    </label>

    <label class="radio-inline">
        <input type="radio"
               name="gender"
               value="Other"
               <?= ($resume['gender'] == 'Other') ? 'checked' : ''; ?>
               onchange="updatePreview()">
        Other
    </label>

</div>

<small class="error" id="genderError"></small>

<!-- NATIONALITY -->
<label>Nationality</label>
<select id="nationality"
        name="nationality"
        onchange="updatePreview()"
        required>

    <option value="">Select Nationality</option>

    <option value="Indian"
        <?= ($resume['nationality'] == 'Indian') ? 'selected' : ''; ?>>
        Indian
    </option>

    <option value="American"
        <?= ($resume['nationality'] == 'American') ? 'selected' : ''; ?>>
        American
    </option>

    <option value="British"
        <?= ($resume['nationality'] == 'British') ? 'selected' : ''; ?>>
        British
    </option>

    <option value="Other"
        <?= ($resume['nationality'] == 'Other') ? 'selected' : ''; ?>>
        Other
    </option>

</select>

<small class="error" id="nationalityError"></small>

<?php
$fields = [
"education"=>"Education",
"skills"=>"Skills",
"projects"=>"Projects",
"experience"=>"Experience",
"certifications"=>"Certifications",
"achievements"=>"Achievements",
];

foreach($fields as $key=>$label){
echo "
<label>$label</label>
<textarea id='$key' name='$key' required>".
htmlspecialchars($resume[$key]).
"</textarea>
<small class='error' id='{$key}Error'></small>
";
}
?>

<!-- STRENGTHS -->
<label>Strengths</label>
<div class="checkbox-group">
<?php
$options = ["Leadership","Team Work","Communication","Problem Solving"];

foreach($options as $option){
$checked = in_array($option,$strengths) ? "checked" : "";
echo "<label>
<input type='checkbox' name='strengths[]'
value='$option' $checked onchange='updatePreview()'>
$option
</label>";
}
?>
</div>

<!-- LANGUAGES -->
<label>Languages Known</label>
<div class="checkbox-group">
<?php
$langs = ["English","Hindi","Marathi","Urdu"];

foreach($langs as $lang){
$checked = in_array($lang,$languages) ? "checked" : "";
echo "<label>
<input type='checkbox' name='languages[]'
value='$lang' $checked onchange='updatePreview()'>
$lang
</label>";
}
?>
</div>

<!-- ================= HOBBIES ================= -->

<label>Hobbies / Interests</label>
<textarea id="hobbies" name="hobbies" required>
<?= htmlspecialchars($resume['hobbies']); ?>
</textarea>
<small class="error" id="hobbiesError"></small>

<br>
<button type="submit" class="btn-primary">Update Resume</button>

</form>
</div>

<!-- LIVE PREVIEW -->

<h3 style="text-align:center; margin:50px 0 20px;">
Live Resume Preview
</h3>

<div class="container">

<div id="preview" class="resume-container <?= $resume['template']; ?>">

<h1 id="p-name"><?= htmlspecialchars($resume['name']); ?></h1>

<p><strong>Email:</strong>
<span id="p-email"><?= htmlspecialchars($resume['email']); ?></span>
</p>

<p><strong>Phone:</strong>
<span id="p-phone"><?= htmlspecialchars($resume['phone']); ?></span>
</p>

<p><strong>DOB:</strong> <span id="p-dob"><?= htmlspecialchars($resume['dob']); ?></span></p>
<p><strong>Address:</strong> <span id="p-address"><?= htmlspecialchars($resume['address']); ?></span></p>
<p><strong>Gender:</strong> <span id="p-gender"><?= htmlspecialchars($resume['gender']); ?></span></p>
<p><strong>Nationality:</strong> <span id="p-nationality"><?= htmlspecialchars($resume['nationality']); ?></span></p>

<?php
foreach($fields as $key=>$label){
echo "
<div class='resume-section'>
<div class='resume-title'>$label</div>
<div class='resume-content' id='p-$key'>".
nl2br(htmlspecialchars($resume[$key])).
"</div>
</div>";
}
?>

<div class="resume-section">
<div class="resume-title">Strengths</div>
<div class="resume-content" id="p-strengths">
<?= htmlspecialchars($resume['strengths']); ?>
</div>
</div>

<div class="resume-section">
<div class="resume-title">Languages</div>
<div class="resume-content" id="p-languages">
<?= htmlspecialchars($resume['languages']); ?>
</div>
</div>

</div>
</div>

<script src="../js/script.js"></script>

</body>
</html>