<?php 
session_start();

include("../connection.php");
include("functions.php");

	$user_data = check_loogin($con); 


    
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  
    $comname = $_POST['name'];
    $job = $_POST['job'];
    $ctc = $_POST['ctc'];
    $nos = $_POST['nos'];
 
  
  
  

    // Profile Picture handling
    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
      $target_dir = "place/";
      $temp_file = $_FILES['profilePicture']['tmp_name'];
      $ext = pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION);
      $profile_picture = $target_dir . $comname . "." . $ext;
  
      // Check if the file is an image
      $check = getimagesize($temp_file);
      if ($check === false) {
        echo "The uploaded file is not an image.";
        exit();
      }
  
      // Check file size (limit it to 2 MB)
      if ($_FILES["profilePicture"]["size"] > 10 * 1024 * 1024) {
        echo "Sorry, your file is too large.";
        exit();
      }
  
   
      $allowed_extensions = array("jpg", "jpeg", "png", "gif");
      if (!in_array(strtolower($ext), $allowed_extensions)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        exit();
      }
  
      // Move the uploaded file to the target directory
      if (!move_uploaded_file($temp_file, $profile_picture)) {
        echo "Failed to upload the file.";
        exit();
      }
    } else {
     
      $profile_picture = "default.jpg"; // Change 'default.jpg' to the default image path you want to use
    }
  
  
    $query = "INSERT INTO placed (`company_name`, `job_role`, `ctc`, `num_students_selected`, `image_document`) VALUES ('$comname', '$job', '$ctc', '$nos', '$profile_picture')";
    $result = mysqli_query($con, $query);
  
    if ($result) {
      header("Location: rg.php");
    } else {
      echo "Error occurred. Please try again later.";
    }
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<?php include("header.php"); ?>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
         
           
            <li class="nav-item ">
                <a class="nav-link" href="../index.php">
                <i class="fas fa-fw fa-home"></i>
                    <span>Main Home</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-money-bill"></i>
                    <span>DashBoard</span></a>
            </li>
            <li class="nav-item  ">
                <a class="nav-link" href="students.php">
                <i class="fas fa-fw fa-school"></i>
                    <span>Students</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="recruites.php">
                <i class="fas fa-fw fa-eye"></i>
                    <span>Recruiters</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="viewdrive.php">
                <i class="fas fa-fw fa-award"></i>
                    <span>Active Drives</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="comdrive.php">
                <i class="fas fa-fw fa-comment"></i>
                    <span>Completed Drives</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="notice.php">
                <i class="fas fa-fw fa-shapes"></i>
                    <span>Post Notice</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="news.php">
                <i class="fas fa-fw fa-newspaper"></i>
                    <span>Post News</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="placed.php">
                <i class="fas fa-fw fa-atom"></i>
                    <span>Post Placement Results</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="applicat.php">
                <i class="fas fa-fw fa-check"></i>
                    <span>Drive Applications</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="viewplaced.php">
                <i class="fas fa-fw fa-bars"></i>
                    <span>View Placed Students</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="noticeview.php">
                <i class="fas fa-fw fa-shapes"></i>
                    <span>Edit Notices</span></a>
            </li>
            
            <li class="nav-item ">
                <a class="nav-link" href="newsview.php">
                <i class="fas fa-fw fa-atom"></i>
                    <span>Edit News</span></a>
            </li>
              
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-fw fa-bolt"></i>
                    <span>Logout</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
          

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" >

            <!-- Main Content -->
            <div id="content" >

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                       
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                      
                        <!-- Nav Item - Alerts -->
                     
                        <!-- Nav Item - Messages -->
                
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
           
    <form method="post" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-6">
        <label for="companyName">Company Name:</label>
        <input type="text" class="form-control" id="companyName" name="name" required>
      </div>
      <div class="form-group col-6">
        <label for="officialEmail">Job Role:</label>
        <input type="text" class="form-control" id="officialEmail" name="job" required>
      </div>
</div>
<div class="row">
<div class="form-group col-4">
        <label for="hrName">CTC:</label>
        <input type="text" class="form-control" id="hrName" name="ctc" required>
      </div>
      <div class="form-group col-4">
        <label for="hrName">No of students Selected:</label>
        <input type="text" class="form-control" id="hrName" name="nos" required>
      </div>
      <div class="form-group col-4">
        <label for="logo">Image:</label>
        <input type="file" class="form-control-file" name="profilePicture" id="logo">
      </div>
</div>
      
   
    
      <button type="submit" class="btn btn-success">Submit</button>
    </form>


            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; RguktSKlm Placement cell </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>