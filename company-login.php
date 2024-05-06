<?php
session_start();




include("connection.php");
include("functions.php");


	
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from company where email = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result); 
					
					if($user_data['password'] === $password)
					{
            if($user_data['approve']==1){
              $_SESSION['email'] = $user_data['email'];
              header("Location: company/index.php");
              die;
            }
            else{
              echo "Admin Not Approved or may be ";
            }

						
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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
    <div class="container mt-5">
    <h2 style="color:brown; text-align: center;"> Recruiter Account Login</h2>
        <h5 style="text-align: center;">Sign in to RGUKT-SKLM Placement Portal</h5>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Login</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" >
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <a href="mailto:dillidonka@gmail.com?subject=I%20have%20forgotten%20my%20password%2C%20please%20send%20it%20to%20me">
 Forgot password ?
</a>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            <a href="company-register.php">No Account ? Register Here</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Bootstrap JS and jQuery scripts here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

