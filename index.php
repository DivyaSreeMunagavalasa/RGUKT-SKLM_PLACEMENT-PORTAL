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
            <li class="nav-item active">
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
            <div id="content"  >

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
           
                <div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Students</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $query = "SELECT COUNT(*) as total FROM users";

// Execute the query
$result = mysqli_query($con, $query);

// Check if the query was successful
if ($result) {
    // Fetch the count value
    $row = mysqli_fetch_assoc($result);
    $count = $row['total'];
    
    // Display the count
    echo "Total count: " . $count;
} else {
    echo "Error: " . mysqli_error($con);
} ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-secondary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                        Recruiters</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $query = "SELECT COUNT(*) as total FROM company";

// Execute the query
$result = mysqli_query($con, $query);

// Check if the query was successful
if ($result) {
    // Fetch the count value
    $row = mysqli_fetch_assoc($result);
    $count = $row['total'];
    
    // Display the count
    echo "Total count: " . $count;
} else {
    echo "Error: " . mysqli_error($con);
} ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Placed Students</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $query = "SELECT COUNT(*) as total FROM placed";

// Execute the query
$result = mysqli_query($con, $query);

// Check if the query was successful
if ($result) {
    // Fetch the count value
    $row = mysqli_fetch_assoc($result);
    $count = $row['total'];
    
    // Display the count
    echo "Placed Students: " . $count;
} else {
    echo "Error: " . mysqli_error($con);
} ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                        Total Applications</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $query = "SELECT COUNT(*) as total FROM job_applications";

// Execute the query
$result = mysqli_query($con, $query);

// Check if the query was successful
if ($result) {
    // Fetch the count value
    $row = mysqli_fetch_assoc($result);
    $count = $row['total'];
    
    // Display the count
    echo "Total Applications: " . $count;
} else {
    echo "Error: " . mysqli_error($con);
} ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>




















<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Total Drives</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $query = "SELECT COUNT(*) as total FROM drives";

// Execute the query
$result = mysqli_query($con, $query);

// Check if the query was successful
if ($result) {
    // Fetch the count value
    $row = mysqli_fetch_assoc($result);
    $count = $row['total'];
    
    // Display the count
    echo "Total Drives: " . $count;
} else {
    echo "Error: " . mysqli_error($con);
} ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Active Drives</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $query = "SELECT COUNT(*) as total FROM drives WHERE status = 'active'";

// Execute the query
$result = mysqli_query($con, $query);

// Check if the query was successful
if ($result) {
    // Fetch the count value
    $row = mysqli_fetch_assoc($result);
    $count = $row['total'];
    
    // Display the count
    echo "Active Drives: " . $count;
} else {
    echo "Error: " . mysqli_error($con);
} ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                        Completed Drives</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $query = "SELECT COUNT(*) as total FROM drives WHERE status = 'inactive'";

// Execute the query
$result = mysqli_query($con, $query);

// Check if the query was successful
if ($result) {
    // Fetch the count value
    $row = mysqli_fetch_assoc($result);
    $count = $row['total'];
    
    // Display the count
    echo "Completed Drives: " . $count;
} else {
    echo "Error: " . mysqli_error($con);
} ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pending Requests Card Example -->

</div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Rgukt Sklm Placement cell </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content any dpubts contavt heeltech.in Wrapper -->

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