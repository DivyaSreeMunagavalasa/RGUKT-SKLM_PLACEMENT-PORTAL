<?php
// Include the config.php file
include("../connection.php");
// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    // Retrieve the user ID from the URL
    $userId = $_GET['id'];

    // Retrieve the user data from the database based on the ID
    $sql = "SELECT * FROM drives WHERE id = '$userId'";
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
                            <h2>View <?php echo $row['company_name']; ?> Drive </h2>
                           
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
                                        <label for="batch">CTC :</label>
                                        <input type="text" readonly class="form-control"  value="<?php echo $row['ctc']; ?> ">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="batch">Status :</label>
                                        <input  readonly class="form-control"  value="<?php echo $row['status']; ?> ">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="batch">Elegibility Percentage :</label>
                                        <input type="text" readonly class="form-control"  value="<?php echo $row['eligibility_percentage']; ?> ">
                                    </div>
                              </div>
                         
                              
                              <div class="row">
                                   
                              <div class="form-group col-12">
  <label for="description">Description:</label>
  <textarea readonly class="form-control" rows="4"><?php echo $row['job_description']; ?></textarea>
</div>

                                    </div> 
                                    <div class="row">
                                       <p style="text-align:center;"> <a href="viewdrive.php" class="btn btn-primary">Go Back</a></p>
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
