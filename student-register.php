<?php
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $password = $_POST['password'];
  $firstname = $_POST['fname'];
  $lastname = $_POST['lname'];
  $phone = $_POST['mobile'];
  $email = $_POST['email'];
  $year = $_POST['year'];
  $branch = $_POST['branch'];
  $id = $_POST['id'];
  $collegeid = $year.$id;


  $query_check_email = "SELECT * FROM users WHERE email = '$email'";
  $result_check_email = mysqli_query($con, $query_check_email);

  if (mysqli_num_rows($result_check_email) > 0) {
    // Email already exists
    echo "This email is already registered.";
    exit();
  }
  // Profile Picture handling
  if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
    $target_dir = "profile/";
    $temp_file = $_FILES['profilePicture']['tmp_name'];
    $ext = pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION);
    $profile_picture = $target_dir . $firstname . "." . $ext;

    // Check if the file is an image
    $check = getimagesize($temp_file);
    if ($check === false) {
      echo "The uploaded file is not an image.";
      exit();
    }

    // Check file size (limit it to 2 MB)
    if ($_FILES["profilePicture"]["size"] > 2 * 1024 * 1024) {
      echo "Sorry, your file is too large.";
      exit();
    }

 
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array(strtolower($ext), $allowed_extensions)) {
      echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
      exit();
    }

    // Move the uploaded file to the target directory
    if (!move_uploaded_file($temp_file, $profile_picture)) {
      echo "Failed to upload the file.";
      exit();
    }
  } else {
   
    $profile_picture = "default.jpg"; // Change 'default.jpg' to the default image path you want to use
  }


  $query = "INSERT INTO users (`firstname`, `lastname`, `phoneno`, `email`, `password`, `photo`, `collegeid`, `branch`) VALUES ('$firstname', '$lastname', '$phone', '$email', '$password', '$profile_picture', '$collegeid', '$branch')";
  $result = mysqli_query($con, $query);

  if ($result) {
    header("Location: registered.php");
  } else {
    echo "Error occurred. Please try again later.";
  }
}
?>




<!DOCTYPE html>
<html>
<head>
  <title>Registration Form with Bootstrap 4</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">

  <style>
      .profile-picture {
      position: relative;
      width: 150px;
      height: 150px;
      border-radius: 50%;
      overflow: hidden;
    }

    .profile-picture img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .profile-picture img:hover{
        border: 2px solid black;
    }

    .custom-file-input {
      opacity: 0;
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      cursor: pointer;
    }
    .custom-file-input:hover{
        border: 3px solid red !important;
    }
    span{
        color: red;
    }
    .navbar-custom {
      background-color: maroon;
    }
    .nav-link {
        color: #fff;
    }
    .active{
        color: green;
    }
 
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand" href="./index.php">RGUKT SKLM Placement Cell</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item ">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="student/index.php">Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="company/index.php">Recruiter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin/index.php">Admin</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container mt-4 hello">
    <h2 class="mb-4" style="text-align:center;">Student Registration Form</h2>
    <form id="registrationForm" onsubmit="return validateForm()" novalidate enctype="multipart/form-data" method="post">
      <div class="form-group">
  <div class="row">
            <div class="col-6">
                <label for="name">First Name:</label>
                <input type="text" class="form-control" id="name" name="fname" required placeholder="Enter First name *">
                <span class="error" id="nameError"></span>
            </div>
            <div class="col-6">
                <label for="name">Last Name:</label>
                <input type="text" class="form-control" id="name" name="lname" required placeholder="Enter Last name *">
                <span class="error" id="nameError"></span>
            </div>
  </div>
<div class="row">
    <div class="col-4">
        <div class="form-group">
            <label for="profilePicture">Profile Picture:</label>
            <div class="profile-picture">
              <img id="preview" src="pic.png" alt="Profile Picture">
              <input type="file" class="custom-file-input" id="profilePicture" name="profilePicture" onchange="showPreview(event)">
            </div>
          </div>
    </div>
    <div class="form-group col-4">
        <label for="branchSelect">Year:</label>
        <select class="form-control" id="branchSelect" name="year" required>
          <option value="">Select Year</option>
          <option value="S19">E3</option>
          <option value="S18">E4</option>
        </select>
        <small class="form-text text-muted">Please select the year.</small>
      </div>
      <div class="form-group col-4">
        <label for="idInput">ID:</label>
        <input type="text" class="form-control" id="idInput" pattern="\d{4}" name="id" required placeholder="Enter Last 4 Numbers of your ID*">
        <small class="form-text text-muted">Please enter a four-digit ID number.</small>
      </div>
</div>
    <div class="row">
        <div class="col-6">
        <label for="name">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required placeholder="Enter email(only college email is accepted*">
        <span class="error" id="emailError"></span>
        </div>
        <div class="form-group col-6">
        <label for="branchSelect">Branch:</label>
        <select class="form-control" id="branchSelect" name="branch" required>
          <option value="">Select Branch</option>
          <option value="ECE">ECE</option>
          <option value="CSE">CSE</option>
          <option value="MECH">MECH</option>
          <option value="CIVIL">CIVIL</option>
          <option value="EEE">EEE</option>
        
        </select>
        <small class="form-text text-muted">Please select the branch.</small>
      </div>
       
    
</div>
       
  


      <div class="form-group">
        <div class="row">
            <div class="col-2">
        <label for="countryCode">Country Code:</label>
        <select class="form-control" id="countryCode" name="countryCode" required>
          <option value="+91">India (+91)</option>
        </select>
    </div>
    <div class="col-5">
        <label for="mobile">Mobile Number:</label>
        <input type="tel" class="form-control" id="mobile" name="mobile" required>
        <span class="error" id="mobileError"></span>
    </div>
    </div>
      </div>
      

      <div class="form-group">
        <label for="password">Password (8 characters,Small letters, Capital letters, numbers, and symbols):</label>
        <input type="password" class="form-control" id="password" name="password" required>
        <span class="error" id="passwordError"></span>
      </div>

      <button type="submit" class="btn btn-primary">Register</button>

      <br>
      <h6>Have an Account? <a href="student-login.php">Login Here</a></h6>
    </form>
  </div>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

  <script>
     function showPreview(event) {
      
      const input = event.target;
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById("preview").src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#mobile").intlTelInput({
      preferredCountries: ["in"],
      separateDialCode: true,
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
       function validateForm() {
      const name = document.getElementById('name').value;
      const mobile = document.getElementById('mobile').value;
      const password = document.getElementById('password').value;

      // Name validation
      if (!name.trim()) {
        document.getElementById('nameError').textContent = 'Name is required.';
        return false;
      }

      // Mobile number validation
      const mobileRegex = /^[+91]?[6-9][0-9]{9}$/;
      if (!mobileRegex.test(mobile)) {
        document.getElementById('mobileError').textContent = 'Please enter a valid Indian mobile number (10 digits only).';
        return false;
      }

      // Password validation
      const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
      if (!passwordRegex.test(password)) {
        document.getElementById('passwordError').textContent = 'Password must be 8 characters long and contain at least one capital letter, one small letter, one number, and one symbol (@ $ ! % * ? &).';
        return false;
      }

      // Clear any previous error messages
      document.getElementById('nameError').textContent = '';
      document.getElementById('mobileError').textContent = '';
      document.getElementById('passwordError').textContent = '';
      const email = document.getElementById('email').value;
    const emailRegex = /^[A-Za-z0-9._%+-]+@rguktsklm\.ac.in$/i;
    if (!emailRegex.test(email)) {
      document.getElementById('emailError').textContent = 'Please Enter a valid RGUKT SKLM email address.';
      return false;
    }
      // Form is valid
      return true;
    }
  </script>
</body>
</html>