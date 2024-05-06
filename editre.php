<?php
// Include the config.php file
include("../connection.php");
// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    // Retrieve the user ID from the URL
    $userId = $_GET['id'];

    // Retrieve the user data from the database based on the ID
    $sql = "SELECT * FROM company WHERE id = '$userId'";
    $result = mysqli_query($con, $sql);

    // Check if the user record exists
    if (mysqli_num_rows($result) === 1) {
        // Fetch the user data
        $row = mysqli_fetch_assoc($result);

        // Process the form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve the updated payment and batch values
            $payment = $_POST['approve'];


            // Update the payment and batch values in the database
            $updateSql = "UPDATE company SET approve = '$payment' WHERE id = '$userId'";
            $updateResult = mysqli_query($con, $updateSql);

            if ($updateResult) {
                // Update successful
                $successMessage = "User Approved.";
                
                // Fetch the updated user data
                $updatedUserData = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($updatedUserData);
            } else {
                // Update failed
                $errorMessage = "Failed to update .";
            }
        }
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Edit User</title>
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
                    <div class="col-md-6">
                        <div class="form-container">
                            <h2>Edit User</h2>
                            <?php if (isset($successMessage)): ?>
                                <div class="alert alert-success"><?php echo $successMessage; ?></div>
                                <div class="user-info-container">
                                    <h3>Updated User Information</h3>
                                    <p><strong>Approve :</strong> <?php if(($row['approve']==0)){
                                        echo "Not Approved ";
                                    }
                                    else{
                                        echo "Approved";
                                    }echo $row['name']; ?></p>
                                  
                                </div>
                                <a href="recruites.php" class="btn btn-danger go-back-btn">Go Back</a>
                            <?php elseif (isset($errorMessage)): ?>
                                <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
                            <?php else: ?>
                                <form method="POST">
                                <div class="form-group col-4">
        <label for="branchSelect">Approve User</label>
        <select class="form-control" id="branchSelect" name="approve" required>
          <option value="">Select</option>
          <option value="1">Approve</option>
          <option value="0">Reject</option>
        </select>
      
      </div>
                                    <div class="form-group">
                                        <label for="batch">password :</label>
                                        <input type="text" readonly class="form-control" name="batch" value="<?php echo $row['password']; ?> ">
                                    </div>
                                   
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </form>
                            <?php endif; ?>
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
