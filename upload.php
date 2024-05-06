<!DOCTYPE html>
<html>
<head>
  <title>File Upload Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .container {
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <div class="container">
    <?php
    include('../config.php');
    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Retrieve other form field values
      $date = $_POST['date'];
      $day = $_POST['day'];
      $course = $_POST['course'];
      $batch = $_POST['batch'];

      // Process the uploaded file
      $fileName = $_FILES['file']['name'];
      $fileTmpPath = $_FILES['file']['tmp_name'];
      $fileDestination = 'uploads/' . $fileName; // Define the desired file destination

      // Move the uploaded file to the destination folder
      move_uploaded_file($fileTmpPath, $fileDestination);

      // Store the file information in the database
      $sql = "INSERT INTO form_submissions (date, day, course, batch, file_name, file_path) VALUES ('$date', '$day', '$course', '$batch', '$fileName', '$fileDestination')";
      $result = mysqli_query($conn, $sql);

      // Check if the insertion was successful
      if ($result) {
        // Insertion successful
        $message = "Form submitted successfully.";
        $alertClass = "alert-success";
      } else {
        // Insertion failed
        $message = "Failed to submit the form.";
        $alertClass = "alert-danger";
      }
      ?>
      <div class="alert <?php echo $alertClass; ?> text-center"><?php echo $message; ?></div>
      <?php
    }
    ?>
    <h2>Heel Tech Solutions</h2>
    <form method="POST" enctype="multipart/form-data">
     <a href="content.php"><button type="button" class="btn btn-primary">Go Back</button></a>
    </form>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
