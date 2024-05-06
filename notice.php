<?php
session_start();

include("../connection.php");
include("functions.php");
$user_data = check_loogin($con); 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $firstname = $_POST['title'];
  $role = $_POST['role'];
$description = $_POST['description'];





  // Profile Picture handling
  if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
    $target_dir = "notice/";
    $temp_file = $_FILES['profilePicture']['tmp_name'];
    $ext = pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION);
    $profile_picture = $target_dir . $firstname . "." . $ext;

    // Check if the file is an image


    // Check file size (limit it to 2 MB)
    if ($_FILES["profilePicture"]["size"] > 2 * 1024 * 1024) {
      echo "Sorry, your file is too large.";
      exit();
    }

 
    $allowed_extensions = array("jpg", "jpeg", "png", "gif", "pdf");
    if (!in_array(strtolower($ext), $allowed_extensions)) {
      echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
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


  $query = "INSERT INTO notice (`title`, `description`, `doc`,  `role`) VALUES ('$firstname',  '$description' ,  '$profile_picture' ,  '$role')";
  $result = mysqli_query($con, $query);

  if ($result) {
    header("Location: noticeupload.php");
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
            <li class="nav-item ">
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
            <li class="nav-item  ">
                <a class="nav-link" href="comdrive.php">
                <i class="fas fa-fw fa-comment"></i>
                    <span>Completed /Inactive Drives</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="notice.php">
                <i class="fas fa-fw fa-shapes"></i>
                    <span>Post Notice</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="news.php">
                <i class="fas fa-fw fa-newspaper"></i>
                    <span>Post News</span></a>
            </li>
            <li class="nav-item ">
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
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

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
           
<h2>Post Notice </h2>
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                    <div class="form-group col-6">
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control" id="title" required>
      </div>
      <div class="form-group col-6">
        <label for="description">Document:</label>
       <input name="profilePicture" type="file" class="form-control" required>
      </div>
      
                    </div>
                    <div class="form-group col-12">
  <label for="description">Description:</label>
  <textarea class="form-control" id="description" name="description" rows="4"></textarea>
</div>
<div class="form-group col-12">
  <label for="role">To Whom you want to send Notice:</label>
  <select class="form-control" id="role" name="role">
    <option value="1">Student</option>
    <option value="2">Recruiters</option>
  </select>
</div>
   
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Rgukt Sklm placement cell</span>
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