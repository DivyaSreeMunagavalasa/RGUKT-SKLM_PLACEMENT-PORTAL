<?php
session_start();




include("../connection.php");
include("functions.php");


	
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from admin where email = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result); 
					
					if($user_data['password'] === $password)
					{

						$_SESSION['email'] = $user_data['email'];
						header("Location: index.php");
						die;
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
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    body {
   
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-container {
      max-width: 400px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    .message-container {
      margin-bottom: 20px;
    }
    .message-container p {
      margin: 0;
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
<body >
<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand" href="../index.php">Rgukt Placement Cell</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item ">
          <a class="nav-link" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../contact.php">Contact</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="../student/index.php">Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../company/index.php">Recruiter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../admin/index.php">Admin</a>
        </li>
      </ul>
    </div>
  </nav><br><br>
  <div class="container login-container">
    
    <h2 class="text-center">Admin Login</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
   
                     
    </form>
    <div class="message-container">
  
    </div>
  </div>
</body>
</html>
