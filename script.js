// ================= TEMPLATE SELECTION =================
function selectTemplate(templateId) {

    // Remove active class from all templates
    document.querySelectorAll('.template-card').forEach(card => {
        card.classList.remove('active');
    });

    // Add active class to selected
    const selected = document.getElementById(templateId);
    if (selected) {
        selected.classList.add('active');
    }

    // Update hidden input
    const hiddenInput = document.getElementById('selectedTemplate');
    if (hiddenInput) {
        hiddenInput.value = templateId;
    }

    // Update preview
    const preview = document.getElementById('preview');
    if (preview) {
        preview.className = 'resume-container ' + templateId;
    }
}

// ================= LIVE PREVIEW =================
function updatePreview(){

document.getElementById("p-name").innerText =
document.getElementById("name").value;

document.getElementById("p-email").innerText =
document.getElementById("email").value;

document.getElementById("p-phone").innerText =
document.getElementById("phone").value;

// ===== DOB =====
var dobInput = document.getElementById("dob");
if (dobInput && dobInput.value) {
    let parts = dobInput.value.split("-"); // format: YYYY-MM-DD
    let formattedDOB = parts[2] + "/" + parts[1] + "/" + parts[0];
    document.getElementById("p-dob").innerText = formattedDOB;
} else {
    document.getElementById("p-dob").innerText = "";
}

// ===== Address =====
var address = document.querySelector("textarea[name='address']");
if (address) {
    document.getElementById("p-address").innerText = address.value;
}

// ===== Gender =====
var gender = document.querySelector("input[name='gender']:checked");
if (gender) {
    document.getElementById("p-gender").innerText = gender.value;
}

// ===== Nationality =====
var nationality = document.querySelector("select[name='nationality']");
if (nationality) {
    document.getElementById("p-nationality").innerText = nationality.value;
}

let fields = ["education","skills","projects","experience","certifications","achievements","hobbies"];

fields.forEach(function(field){
    document.getElementById("p-"+field).innerText =
    document.getElementById(field).value;
});

/* Strengths */
let strengths = [];
document.querySelectorAll("input[name='strengths[]']:checked")
.forEach(el => strengths.push(el.value));

document.getElementById("p-strengths").innerText =
strengths.join(", ");

/* Languages */
let languages = [];
document.querySelectorAll("input[name='languages[]']:checked")
.forEach(el => languages.push(el.value));

document.getElementById("p-languages").innerText =
languages.join(", ");
}

function toggleDropdown() {
    const list = document.getElementById("languageList");

    if (list.style.display === "block") {
        list.style.display = "none";
    } else {
        list.style.display = "block";
    }
}

/* ================= PHONE VALIDATION ================= */
function validatePhone(input){
    input.value = input.value.replace(/[^0-9]/g,'');
}

/* ================= MAIN FORM VALIDATION ================= */
function validateResume(){

    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let phone = document.getElementById("phone").value.trim();

    let education = document.getElementById("education").value.trim();
    let skills = document.getElementById("skills").value.trim();
    let projects = document.getElementById("projects").value.trim();
    let experience = document.getElementById("experience").value.trim();
    let certifications = document.getElementById("certifications").value.trim();
    let achievements = document.getElementById("achievements").value.trim();
    let hobbies = document.getElementById("hobbies").value.trim();

    /* ===== NAME VALIDATION ===== */
    if(name.length < 3){
        alert("Full Name must be at least 3 characters.");
        return false;
    }

    /* ===== EMAIL VALIDATION ===== */
    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if(!email.match(emailPattern)){
        alert("Please enter a valid email address.");
        return false;
    }

    /* ===== PHONE VALIDATION ===== */
    if(phone.length !== 10){
        alert("Phone number must be exactly 10 digits.");
        return false;
    }

    /* ===== TEXT AREA VALIDATION ===== */
    if(education.length < 10){
        alert("Education details must be at least 10 characters.");
        return false;
    }

    if(skills.length < 5){
        alert("Skills must be at least 5 characters.");
        return false;
    }

    if(projects.length < 10){
        alert("Projects must be at least 10 characters.");
        return false;
    }

    if(experience.length < 5){
        alert("Experience must be at least 5 characters.");
        return false;
    }

    if(certifications.length < 3){
        alert("Certifications must be at least 3 characters.");
        return false;
    }

    if(achievements.length < 5){
        alert("Achievements must be at least 5 characters.");
        return false;
    }

    if(hobbies.length < 3){
        alert("Hobbies must be at least 3 characters.");
        return false;
    }

    /* ===== STRENGTHS CHECK ===== */
    let strengths = document.querySelectorAll("input[name='strengths[]']:checked");
    if(strengths.length === 0){
        alert("Please select at least one Strength.");
        return false;
    }

    /* ===== LANGUAGES CHECK ===== */
    let languages = document.querySelectorAll("input[name='languages[]']:checked");
    if(languages.length === 0){
        alert("Please select at least one Language.");
        return false;
    }

    return true;
}
function validateResume(){

    let isValid = true;

    function setError(id, message){
        document.getElementById(id+"Error").innerText = message;
        document.getElementById(id).classList.add("error-border");
        isValid = false;
    }

    function clearError(id){
        document.getElementById(id+"Error").innerText = "";
        document.getElementById(id).classList.remove("error-border");
    }

    /* ===== NAME ===== */
    let name = document.getElementById("name").value.trim();
    if(name.length < 3){
        setError("name","Name must be at least 3 characters");
    } else {
        clearError("name");
    }

    /* ===== EMAIL ===== */
    let email = document.getElementById("email").value.trim();
    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if(!email.match(emailPattern)){
        setError("email","Enter valid email address");
    } else {
        clearError("email");
    }

    /* ===== PHONE ===== */
    let phone = document.getElementById("phone").value.trim();
    if(!/^[0-9]{10}$/.test(phone)){
        setError("phone","Phone must be exactly 10 digits");
    } else {
        clearError("phone");
    }

    /* ===== TEXTAREAS ===== */
    let textFields = ["education","skills","projects","experience","certifications","achievements","hobbies"];

    textFields.forEach(function(field){
        let value = document.getElementById(field).value.trim();
        if(value.length < 5){
            setError(field,"This field must contain at least 5 characters");
        } else {
            clearError(field);
        }
    });

    /* ===== CHECKBOX VALIDATION ===== */

    let strengths = document.querySelectorAll("input[name='strengths[]']:checked");
    if(strengths.length === 0){
        alert("Please select at least one strength");
        isValid = false;
    }

    let languages = document.querySelectorAll("input[name='languages[]']:checked");
    if(languages.length === 0){
        alert("Please select at least one language");
        isValid = false;
    }

    return isValid;
}

function togglePassword(iconElement) {

    let input = iconElement.parentElement.querySelector("input");
    let icon = iconElement.querySelector("i");

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
}
function togglePassword(fieldId, icon) {
    const input = document.getElementById(fieldId);
    const eyeIcon = icon.querySelector("i");

    if (input.type === "password") {
        input.type = "text";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    } else {
        input.type = "password";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    }
}

function togglePassword(fieldId, icon) {
    const input = document.getElementById(fieldId);
    const eyeIcon = icon.querySelector("i");

    if (input.type === "password") {
        input.type = "text";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    } else {
        input.type = "password";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    }
}
function updatePreview() {

    // DOB
    var dob = document.getElementById("dob");
    if(dob && dob.value){
        let parts = dob.value.split("-");
        let formatted = parts[2] + "/" + parts[1] + "/" + parts[0];
        document.getElementById("p-dob").innerText = formatted;
    }

    // Address
    var address = document.getElementById("address");
    if(address){
        document.getElementById("p-address").innerText = address.value;
    }

    // Gender
    var gender = document.querySelector("input[name='gender']:checked");
    if(gender){
        document.getElementById("p-gender").innerText = gender.value;
    }

    // Nationality
    var nationality = document.getElementById("nationality");
    if(nationality){
        document.getElementById("p-nationality").innerText = nationality.value;
    }
}