<?php
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $password = $_POST['password'];
  $comname = $_POST['name'];
  $hrname = $_POST['hrname'];
  $phone = $_POST['mobile'];
  $email = $_POST['email'];
  $web = $_POST['web'];



  $query_check_email = "SELECT * FROM company WHERE email = '$email'";
  $result_check_email = mysqli_query($con, $query_check_email);

  if (mysqli_num_rows($result_check_email) > 0) {
    // Email already exists
    echo "This email is already registered.";
    exit();
  }
  // Profile Picture handling
  if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
    $target_dir = "comlogo/";
    $temp_file = $_FILES['profilePicture']['tmp_name'];
    $ext = pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION);
    $profile_picture = $target_dir . $comname . "." . $ext;

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


  $query = "INSERT INTO company (`name`, `hrname`, `phoneno`, `email`, `password`, `photo`, `website`) VALUES ('$comname', '$hrname', '$phone', '$email', '$password', '$profile_picture', '$web')";
  $result = mysqli_query($con, $query);

  if ($result) {
    header("Location: comregistered.php");
  } else {
    echo "Error occurred. Please try again later.";
  }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
     .navbar-custom {
      background-color: maroon;
    }
    .nav-link {
        color: #fff;
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
  <div class="container">
    <h1 style="text-align: center;">Company Registration From</h1>
  <br><br>
    <form method="post" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-6">
        <label for="companyName">Company Name:</label>
        <input type="text" class="form-control" id="companyName" name="name" required>
      </div>
      <div class="form-group col-6">
        <label for="officialEmail">Official Mail Address:</label>
        <input type="email" class="form-control" id="officialEmail" name="email" required>
      </div>
</div>
<div class="row">
<div class="form-group col-6">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" name="password" required>
        <small class="form-text text-muted">Password must contain at least one letter, one number, and be at least 8 characters long.</small>
      </div>
      <div class="form-group col-6">
        <label for="logo">Company Logo:</label>
        <input type="file" class="form-control-file" name="profilePicture" id="logo">
      </div>
</div>
      
     <div class="row">
     <div class="form-group col-4">
        <label for="hrName">HR Name:</label>
        <input type="text" class="form-control" id="hrName" name="hrname" required>
      </div>
      <div class="form-group col-4">
        <label for="hrPhone">HR Phone Number:</label>
        <input type="tel" class="form-control" id="hrPhone" name="mobile" required>
      </div>
      <div class="form-group col-4">
        <label for="website">Website Link:</label>
        <input type="url" class="form-control" id="website" name="web" required>
      </div>
     </div>
    
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
  </div>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
