<?php
// Include the config.php file
include("../connection.php");
// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    // Retrieve the user ID from the URL
    $userId = $_GET['id'];

    // Retrieve the user data from the database based on the ID
    $sql = "SELECT * FROM users WHERE id = '$userId'";
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
                            <h2>View <?php echo $row['firstname']; ?> Data <img src="../<?php echo $row['photo']; ?>" width="100px" style="border-radius:100%;" height="100px"></h2>
                           
                                <form>
                              <div class="row">
                              <div class="form-group col-6">
                                        <label for="batch">First Name :</label>
                                        <input type="text" readonly class="form-control"  value="<?php echo $row['firstname']; ?> ">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="batch">Last Name :</label>
                                        <input type="text" readonly class="form-control"  value="<?php echo $row['lastname']; ?> ">
                                    </div>
                              </div>
                              <div class="row">
                              <div class="form-group col-6">
                                        <label for="batch">College Id :</label>
                                        <input type="text" readonly class="form-control"  value="<?php echo $row['collegeid']; ?> ">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="batch">Branch :</label>
                                        <input type="text" readonly class="form-control"  value="<?php echo $row['branch']; ?> ">
                                    </div>
                              </div>
                              <div class="row">
                              <div class="form-group col-6">
                                        <label for="batch">Phone No :</label>
                                        <input  readonly class="form-control"  value="<?php echo $row['phoneno']; ?> ">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="batch">Email :</label>
                                        <input  readonly class="form-control"  value="<?php echo $row['email']; ?> ">
                                    </div>
                              </div>
                              <div class="row">
                              <div class="form-group col-4">
                                        <label for="batch">10th :</label>
                                        <input type="text" readonly class="form-control"  value="<?php echo $row['tenth']; ?> ">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="batch">Inter :</label>
                                        <input type="text" readonly class="form-control"  value="<?php echo $row['inter']; ?> ">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="batch">Btech Percentage upto Last Sem :</label>
                                        <input type="text" readonly class="form-control"  value="<?php echo $row['lastbtech']; ?> ">
                                    </div>
                              </div>
                              <div class="form-group col-12">
                                        <label for="batch">Skills :</label>
                                        <input type="text" readonly class="form-control" name="batch" value="<?php echo $row['skills']; ?> ">
                                    </div>
                              <div class="row">
                                    <div class="form-group col-6">
                                        <label for="batch">password :</label>
                                        <input type="text" readonly class="form-control" name="batch" value="<?php echo $row['password']; ?> ">
                                    </div>
                                    <div class="form-group col-6"><br>
                                        <label for="batch">View Resume :</label>
                                        <a href="../student/<?php echo $row['resume']; ?>" class="btn btn-danger">View Resume</a>
                                    </div>
                                    </div> 
                                    <div class="row">
                                       <p style="text-align:center;"> <a href="students.php" class="btn btn-primary">Go Back</a></p>
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
