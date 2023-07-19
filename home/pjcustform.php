<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>JongieeGoods INC. | Add Customer</title>

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

<?php 
require_once("pjcheck.php"); 
if($_SESSION['UserPosition']=="CEO"){
    //
  }elseif($_SESSION['UserPosition']=="Salesperson"){
    //
  }else{
    header("Location: http://www.pgsalesmgmt.com/home/error.php"); /* Redirect browser */
    exit;
  }

?>

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
            <h1 class="h3 mb-0 text-gray-800">  <b>Add New Customer</b></h1>

          </div>


                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Please provide the information listed below.</h6>
                    </div>

          
                    <!-- Content Row -->
                    <div class="card-body">

                        <img src="registration.jpg" class="img-fluid"  style="width:500px;height:200px;" ><br><br>

                        <form method = "POST" action="pjstore_customer.php">
    
                            <div class="form-row mb-3">
                                <div class="col-md-4">
                                 First name:<br>
                                <input type="text" class="form-control" name="ffirstname" value="" placeholder="Customer First Name">
                                <br>
                                </div>
                                <div class="col-md-4">
                                 Last name:<br>
                                <input type="text" class="form-control" name="flastname" value="" placeholder="Customer Last Name">
                                <br>
                            </div>
                        </div>
                            <div class="form-row mb-3">
                                <div class="col-md-8">
                                Email Address:<br>
                                <input type="email" class="form-control" name="femail" value="" placeholder="Customer's Email Address">
                                <br>
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-md-3">
                                Street Address:<br>
                                <input type="text" class="form-control" name="faddress" value="" placeholder="Street Address">
                                <br>
                                </div>
                                <div class="col-md-3">
                                City:<br>
                                <input type="text" class="form-control" name="fcity" value="" placeholder="City">
                                <br>
                                </div>
                                <div class="col-md-2">
                                State:<br>
                                <input type="text" class="form-control" name="fstate" value="" placeholder="State">
                                <br>
                                </div>
                            </div>
    
                                        <!--
                                        <div class="form-row mb-3">
                                         <div class="col-md-4">
                                              Customer Bank:<br>
                                               <input type="text" class="form-control" name="fbank" value="" placeholder="Customer's Bank">
                                                <br>
                                                  </div>
                                        <div class="col-md-4">
                                                Bank Account:<br>
                                                 <input type="text" class="form-control" name="faccountnum" value="" placeholder="Customer's Bank Account Number">
                                                <br>
                                         </div>
                                         </div>	
                                         -->
                                <br>
                                <button type = "submit" class="btn btn-success"  href="pjstore_customer.php"><i class="fas fa-user-plus"></i> Add Customer</button>
                                <br><br>				  
                                <a role="button" class="btn btn-primary"   href="pjviewcustomer.php"><i class="fas fa-list-ul"></i> Return to Customer List</a>
                                <br><br>				  
                                <a role="button" class="btn btn-dark" href="pjmainmenu.php"><i class="fas fa-undo-alt"></i> Return to the Main Menu</a><br><br>
                        </form> 
                    </div>
                </div>




            

           

            <!-- Pending Requests Card Example -->
            
        </div>
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
