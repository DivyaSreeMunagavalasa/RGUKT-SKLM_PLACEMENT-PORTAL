<!DOCTYPE html>
<html>
<head>
  <title>Insert Meeting Details</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .container {
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Insert Meeting Details</h2>
    <?php
    // Retrieve the form data
    include("../config.php");
    $date = $_POST['date'];
    $meetLink = $_POST['meet_link'];
    $batch = $_POST['batch'];
    $course = $_POST['course'];

    // Validate the form data (you can add more validation as per your requirements)
    if (empty($date) || empty($meetLink)) {
        // Handle validation error (e.g., show an error message)
        echo '<div class="alert alert-danger">Please fill in all the fields.</div>';
    } else {
        // Create a database connection

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement
        $sql = "INSERT INTO meetings (date, meet_link, batch, course) VALUES ('$date', '$meetLink', '$batch', '$course')";

        // Execute the SQL statement
        if ($conn->query($sql) === true) {
            // Meeting details inserted successfully
            echo '<div class="alert alert-success">Meeting details inserted successfully.</div>';
        } else {
            // Error occurred while inserting meeting details
            echo '<div class="alert alert-danger">Error: ' . $sql . '<br>' . $conn->error . '</div>';
        }

        // Close the database connection
        $conn->close();
    }
    ?>
    <a href="javascript:history.go(-1)" class="btn btn-primary">Go Back</a>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
