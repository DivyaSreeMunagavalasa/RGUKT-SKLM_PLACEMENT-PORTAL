<?php 
session_start();

include("../connection.php");
include("functions.php");

	$user_data = check_loogin($con); 

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
            <li class="nav-item active ">
                <a class="nav-link" href="comdrive.php">
                <i class="fas fa-fw fa-comment"></i>
                    <span>Completed /Inactive Drives</span></a>
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
           

                <?php
// Include the config.php file
include '../connection.php';

// Retrieve data from the "users" table
$sql = "SELECT * FROM drives WHERE status= 'inactive' ORDER BY id DESC";
$result = mysqli_query($con, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Drives  Data Management</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>Company Name</th>
                                        <th>Job Role</th>
                    <th>Job Description</th>
                    <th>Ctc</th>
                  
                    
                   
                    <th>Action</th>
                
                                          
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Company Name</th>
                                        <th>Job Role</th>
                    <th>Job Description</th>
                    <th>Ctc</th>
                    <th>Action</th>
             
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                // Output the data
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr style="background-color: <?php if($row['approve']==0){
                        echo "red; color: #fff;";
                    }
                    else{
                        echo "";
                    } ?>">
                        <td><?php echo $row['company_name']; ?></td>
                        <td><?php echo $row['job_role']; ?></td>
                        <td><?php echo $row['job_description']; ?></td>
                        <td><?php echo $row['ctc']; ?></td>
                      
                     <td><div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Actions
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <a class="dropdown-item" href="editdrive.php?id=<?php echo $row['id']; ?>">Approve</a>
    <a class="dropdown-item" href="driveover.php?id=<?php echo $row['id']; ?>">View</a>
    <a class="dropdown-item" href="drivedelete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
  </div>
</div>
</td>

                    </tr>
                    <?php
                }
                ?>
                                    
                                    </tbody>
                                    <?php
} else {
    // No rows found in the "users" table
    echo "No users found.";
}

// Close the database connection
mysqli_close($con);
?>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Rgukt Sklm PlaceMent Cell </span>
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