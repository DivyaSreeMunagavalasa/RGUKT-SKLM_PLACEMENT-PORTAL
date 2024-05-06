<?php
// Include the config.php file
include("../connection.php");
// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    // Retrieve the user ID from the URL
    $userId = $_GET['id'];

    // Retrieve the user data from the database based on the ID
    $sql = "SELECT * FROM job_applications WHERE id = '$userId'";
    $result = mysqli_query($con, $sql);

    // Check if the user record exists
    if (mysqli_num_rows($result) === 1) {
        // Fetch the user data
        $row = mysqli_fetch_assoc($result);

        // Process the form submission
       
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>View User</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>
                body {
                    background-color: #ebeff9;
                }
                .container {
                    margin-top: 50px;
                }
                .form-container {
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                }
                .form-container h2 {
                    color: #5c7cfa;
                    margin-bottom: 20px;
                }
                .btn-primary {
                    background-color: #5c7cfa;
                    border-color: #5c7cfa;
                }
                .btn-primary:hover {
                    background-color: #4263eb;
                    border-color: #4263eb;
                }
                .user-info-container {
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                    text-align: center;
                    margin-top: 20px;
                }
                .go-back-btn {
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="form-container">
                            <h2>View <?php echo $row['company_name']; ?> Applications </h2>
                           
                                <form>
                              <div class="row">
                              <div class="form-group col-6">
                                        <label for="batch">Company Name:</label>
                                        <input type="text" readonly class="form-control"  value="<?php echo $row['company_name']; ?> ">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="batch">Job Role :</label>
                                        <input type="text" readonly class="form-control"  value="<?php echo $row['job_role']; ?> ">
                                    </div>
                              </div>
                              <div class="row">
                              <div class="form-group col-4">
                                        <label for="batch">First name :</label>
                                        <input type="text" readonly class="form-control"  value="<?php echo $row['first_name']; ?> ">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="batch">last Name :</label>
                                        <input  readonly class="form-control"  value="<?php echo $row['last_name']; ?> ">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="batch">Branch :</label>
                                        <input type="text" readonly class="form-control"  value="<?php echo $row['branch']; ?> ">
                                    </div>
                              </div>
                         
                              
                              <div class="row">
                                   
                              <div class="form-group col-12">
  <label for="description">Why he applied :</label>
  <textarea readonly class="form-control" rows="4"><?php echo $row['description']; ?></textarea>
</div>
<div class="form-group col-12">
                                        <label for="batch">Skills :</label>
                                        <input type="text" readonly class="form-control"  value="<?php echo $row['skills']; ?> ">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="batch">10th :</label>
                                        <input  readonly class="form-control"  value="<?php echo $row['tenth']; ?> ">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="batch">Inter :</label>
                                        <input  readonly class="form-control"  value="<?php echo $row['inter']; ?> ">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="batch">Btech :</label>
                                        <input type="text" readonly class="form-control"  value="<?php echo $row['btech']; ?> ">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="batch">View Resume :</label>
                                        <a target="_blank" href="../student/<?php echo $row['resume']; ?>" class="btn btn-primary">View resume</a>
                                    </div>

                                    </div> 
                                    <div class="row">
                                       <p style="text-align:center;"> <a href="applicat.php" class="btn btn-primary">Go Back</a></p><p></p>
                                          </div>
                                  
                                </form>
                    
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        // User record not found
        echo "User not found.";
    }
} else {
    // No user ID provided in the URL
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($con);
?>
