<?php
include("../connection.php"); // Make sure to provide the correct path to your connection.php file

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the DELETE query
    $query = "DELETE FROM news WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            // Deletion successful, redirect to the page where the record list is displayed
            header("Location: newsview.php"); // Replace 'record_list.php' with the page where you list all records
            exit();
        } else {
            // Error occurred during deletion
            echo "Error: Unable to delete the record.";
        }
    } else {
        // Error in preparing the query
        echo "Error: Unable to prepare the DELETE query.";
    }

    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Record</title>
    <!-- Add Bootstrap CSS link here -->
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Delete Record</h2>
                <p>Are you sure you want to delete this record?</p>
                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    <a href="record_list.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Bootstrap JS and jQuery scripts here -->
</body>
</html>
