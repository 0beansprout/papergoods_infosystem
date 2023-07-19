<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>JongieeGoods INC. | Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php
session_start();

// check to see if just arriving from thte login form page
if($_POST["femail"]>"") {
  require_once("pjdbcreds.php");
  # get connected to the DB
  try {
  $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  }
  catch(PDOException $e) {
      echo "There has been an issue (#33) with the database connection.  Please see your administrator"; // $e->getMessage();
  }

  # search table for matching customer
  try {
      
      # process an SQL SELECT
      $stmt = $conn->prepare("SELECT * FROM employees WHERE empEmail=:eemail");

      # bind some data values into the named parameters in the prepared statement
      $stmt->bindParam(':eemail', $_POST["femail"]);

      $stmt->execute();

      // set the array that the fetch() function generates to be an associative array
      // (in which the column names are the subscript values)
      $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

      # loop through all rows in the resultset and see if the password value is valid
      while($row = $stmt->fetch()) {
          if (password_verify($_POST["fpassword"], $row['empPassword'])) {
          // echo 'Customer password is verified!<br>';
          $_SESSION['ValidUser'] = true;
          $_SESSION['UserFirstName'] = $row['empFirst'];
          $_SESSION['UserPosition'] = $row['empPosition'];
          } else {
              
          echo 'Invalid password Password.<br>';
          echo "You must <a href='index.html'>login</a> in order to access this site.";
          
          exit;
          }              
      }
  }
  catch(PDOException $e) {
      echo "There has been an issue (#57) with the database.  Please see your administrator"; // $e->getMessage();
      exit;
  }

}
?>

<?php require_once("pjcheck.php"); ?>
<?php require_once("verifyloggedinuser.php"); ?>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php require_once("pjsidebar.php") ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
          <?php require_once("pjtopbar.php") ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Dashboard</b></h1>
          </div>
          <?php
          if($_SESSION['ValidUser'] == true) {
            echo "<h3><center><b>Hello, " . $_SESSION['UserFirstName'] . " " . "(". $_SESSION['UserPosition'] .")" ."<BR></b></center></h3>";
            echo "<center>It's nice to see you again.<br>
           How can we help?</center>";
          } 
          ?><br><br>
          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
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
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
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
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card shadow mb-4">
          <div class="card-body">

            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="mainmenu2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="loginpageimage.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="mainmenu.jpg" class="d-block w-100" alt="...">
                </div>
              </div>
            </div>
            </div>
        </div>
          <!--
          <div class="card shadow mb-4">
          <div class="card-body">

          <img src="mainmenu.jpg" class="img-fluid" alt="Main Menu Image" style="width:1150px;height:600px;" class="center"><br><br>
        </div>
        </div>
        -->

        </div>

      <!-- Footer -->
      <?php require_once("pjfooter.php") ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <!-- Logout Modal--><?php require_once("pjdownbotton.php") ?>
  

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
