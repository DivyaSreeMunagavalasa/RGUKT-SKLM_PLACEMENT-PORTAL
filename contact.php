<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f7f7f7;
    }

    .contact-section {
      background-color: maroon;
      padding: 80px 0;
      color: #fff;
    }

    .contact-section h1 {
      font-size: 42px;
      margin-bottom: 40px;
    }

    .contact-section p {
      font-size: 18px;
      margin-bottom: 40px;
    }

    .contact-details {
      background-color: #fff;
      padding: 40px;
      border-radius: 5px;
      animation-name: fade;
      animation-duration: 1s;
      animation-timing-function: ease-in-out;
      animation-iteration-count: infinite;
      color: #000000;
    }

    .contact-details p {
      margin-bottom: 20px;

    }

    .logo {
      text-align: center;
      margin-bottom: 40px;
      animation-name: slide-up;
      animation-duration: 1s;
      animation-timing-function: ease-in-out;
    }

    .logo img {
      max-width: 200px;
      height: auto;
    }

    @keyframes fade {
      0% {
        opacity: 1;
      }
      50% {
        opacity: 0.5;
      }
      100% {
        opacity: 1;
      }
    }

    @keyframes slide-up {
      0% {
        transform: translateY(50px);
      }
      100% {
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand" href="./index.php">Rgukt Placement Cell</a>
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
  <div class="contact-section">
    <div class="container">
      <div class="logo">
        <img src="img/rgukt.jpg" alt="Logo">
      </div>
      <h1>Contact Us</h1>
      <p>Please feel free to get in touch with us. We'll be glad to assist you.</p>
      <div class="row">
        <div class="col-md-6">
          <div class="contact-details">
            <h3>Address</h3>
            <p>Training and Placement Office</p>
            <p>RGUKT Srikakulam, SM Puram</p>
            <p>Etcherla, Srikakulam</p>
            <p>Pincode: 532410</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="contact-details">
            <h3>Contact</h3>
            <p>Mail: <a href="mailto:tnpsi@rguktsklm.ac.in">tnpsi@rguktsklm.ac.in</a></p>
            <p>Phone Number: <a href="tel:+919030224486">+91 9030224486</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Optionally, you can use jQuery to add the animation classes dynamically after the page loads
    $(document).ready(function() {
      $('.contact-details').addClass('animated-element');
      $('.logo').addClass('animated-element');
    });
  </script>
</body>
</html>
