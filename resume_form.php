<!DOCTYPE html>
<html>
<head>
<title>Resume Form</title>
<link rel="stylesheet" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
<a href="index.php">Home</a>
<a href="register.php">Register</a>
<a href="login.php">Login</a>
<a href="services.php">Services</a>
<a href="about.php">About</a>
<a href="login.php">Logout</a>
</div>

<h2 style="text-align:center; margin:40px 0 20px;">
Enter Resume Details
</h2>

<div class="container">

<form action="php/save_resume.php"
      method="POST"
      onsubmit="return validateResume()">

<!-- TEMPLATE SELECTION -->
<h3>Select Resume Template</h3>

<div class="template-selection">

<div class="template-card active"
     id="template1"
     onclick="selectTemplate('template1')">
     Classic
</div>

<div class="template-card"
     id="template2"
     onclick="selectTemplate('template2')">
     Modern
</div>

<div class="template-card"
     id="template3"
     onclick="selectTemplate('template3')">
     Minimal
</div>

</div>

<input type="hidden" id="selectedTemplate"
       name="template" value="template1">


<!-- BASIC DETAILS -->
<label>Full Name</label>
<input type="text" name="name"
       placeholder="Enter your full name"
       oninput="updatePreview()" required>

<label>Email</label>
<input type="email" name="email"
       placeholder="Enter your email"
       oninput="updatePreview()" required>

<label>Phone Number</label>
<input type="tel" name="phone"
       pattern="[0-9]{10}"
       placeholder="10 digit mobile number"
       oninput="updatePreview()" required>

       <!-- DATE OF BIRTH -->
<label>Date of Birth</label>
<input type="date"
       id="dob"
       name="dob"
       max="<?php echo date('Y-m-d'); ?>"
       onchange="updatePreview()"
       required>

<!-- ADDRESS -->
<label>Address</label>
<textarea name="address"
          placeholder="Enter your full address"
          minlength="10"
          oninput="updatePreview()"
          required></textarea>

<!-- GENDER -->
<label>Gender</label>

<div class="radio-group">
    <label class="radio-item">
        <input type="radio" name="gender" value="Male" onchange="updatePreview()" required>
        Male
    </label>

    <label class="radio-item">
        <input type="radio" name="gender" value="Female" onchange="updatePreview()">
        Female
    </label>

    <label class="radio-item">
        <input type="radio" name="gender" value="Other" onchange="updatePreview()">
        Other
    </label>
</div>

<!-- NATIONALITY -->
<label>Nationality</label>

<select name="nationality"
        onchange="updatePreview()"
        required>

<option value="">Select Nationality</option>
<option value="Indian">Indian</option>
<option value="American">American</option>
<option value="British">British</option>
<option value="Canadian">Canadian</option>
<option value="Other">Other</option>

</select>

<!-- EDUCATION -->
<label>Education</label>
<textarea name="education" rows="4"
          placeholder="Degree, College, Year, Percentage"
          oninput="updatePreview()" required></textarea>


<!-- SKILLS -->
<label>Skills</label>
<input type="text" name="skills"
       placeholder="HTML, CSS, Java, Python"
       oninput="updatePreview()" required>


<!-- PROJECTS -->
<label>Projects</label>
<textarea name="projects" rows="4"
          placeholder="Describe your projects"
          oninput="updatePreview()" required></textarea>


<!-- EXPERIENCE -->
<label>Internship / Work Experience</label>
<textarea name="experience" rows="4"
          placeholder="Company, Role, Duration"
          oninput="updatePreview()" required></textarea>


<!-- CERTIFICATIONS -->
<label>Certifications</label>
<textarea name="certifications" rows="3"
          placeholder="Any certifications"
          oninput="updatePreview()" required></textarea>


<!-- ACHIEVEMENTS -->
<label>Achievements</label>
<textarea name="achievements" rows="3"
          placeholder="Your achievements"
          oninput="updatePreview()" required></textarea>


<!-- STRENGTHS (Checkbox) -->
<label>Strengths</label>

<div class="checkbox-group">
    <label><input type="checkbox" name="strengths[]" value="Leadership"> Leadership</label>
    <label><input type="checkbox" name="strengths[]" value="Team Work"> Team Work</label>
    <label><input type="checkbox" name="strengths[]" value="Communication"> Communication</label>
    <label><input type="checkbox" name="strengths[]" value="Problem Solving"> Problem Solving</label>
</div>

<!-- LANGUAGES (Multi Select) -->
<label>Languages Known</label>

<div class="languages-group">
    <label class="checkbox-item">
        <input type="checkbox" name="languages[]" value="English">
        English
    </label>

    <label class="checkbox-item">
        <input type="checkbox" name="languages[]" value="Hindi">
        Hindi
    </label>

    <label class="checkbox-item">
        <input type="checkbox" name="languages[]" value="Marathi">
        Marathi
    </label>

    <label class="checkbox-item">
        <input type="checkbox" name="languages[]" value="Urdu">
        Urdu
    </label>
</div>

<!-- HOBBIES -->
<lalel>Hobbies / Interests</lalel>
<textarea name="hobbies" rows="3"
          placeholder="Reading, Coding, Sports"
          oninput="updatePreview()" required></textarea>


<button type="submit">Generate Resume</button>

</form>
</div>


<!-- ================= PREVIEW SECTION ================= -->

<h3 style="text-align:center; margin:40px 0 20px;">
Live Resume Preview
</h3>

<div class="container">

<div id="preview" class="resume-container template1">

<h1 id="p-name">Your Name</h1>

<p><strong>Email:</strong>
<span id="p-email">example@gmail.com</span>
</p>

<p><strong>Phone:</strong>
<span id="p-phone">XXXXXXXXXX</span>
</p>

<p><strong>DOB:</strong> <span id="p-dob"></span></p>

<p><strong>Address:</strong> <span id="p-address"></span></p>

<p><strong>Gender:</strong> <span id="p-gender"></span></p>

<p><strong>Nationality:</strong> <span id="p-nationality"></span></p>

<div class="resume-section">
<div class="resume-title">Education</div>
<div class="resume-content" id="p-education">
Your education details
</div>
</div>

<div class="resume-section">
<div class="resume-title">Skills</div>
<div class="resume-content" id="p-skills">
Your skills
</div>
</div>

<div class="resume-section">
<div class="resume-title">Projects</div>
<div class="resume-content" id="p-projects">
Your projects
</div>
</div>

<div class="resume-section">
<div class="resume-title">Experience</div>
<div class="resume-content" id="p-experience">
Your experience
</div>
</div>

<div class="resume-section">
<div class="resume-title">Certifications</div>
<div class="resume-content" id="p-certifications">
Your certifications
</div>
</div>

<div class="resume-section">
<div class="resume-title">Achievements</div>
<div class="resume-content" id="p-achievements">
Your achievements
</div>
</div>

<div class="resume-section">
<div class="resume-title">Strengths</div>
<div class="resume-content" id="p-strengths">
Your strengths
</div>
</div>

<div class="resume-section">
<div class="resume-title">Languages</div>
<div class="resume-content" id="p-languages">
English, Hindi
</div>
</div>

<div class="resume-section">
<div class="resume-title">Hobbies</div>
<div class="resume-content" id="p-hobbies">
Your hobbies
</div>
</div>

</div>
</div>

<script src="js/script.js"></script>

</body>
</html>