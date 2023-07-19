<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Reset Password | JongieeGoods INC.</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php
//session_start();
//require_once("pjcheck.php");
// Lookup the cid value that was passed as a query string
require_once("pjdbcreds.php");

# get connected to the DB
try {
  $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
}
catch(PDOException $e) {
    echo "There has been an issue (#33) with the database connection.  Please see your administrator"; // $e->getMessage();
}

# locate the customer data based on eid value
try {
    
    # process an SQL SELECT
    $stmt = $conn->prepare("SELECT empID, empFirst, empLast, empEmail, empPassword, empDOB, empPhone, empPosition FROM employees WHERE empID=:eidParam");
    $stmt->bindParam(':eidParam', $_GET["eid"]);
    $stmt->execute();

    // set the array that the fetch() function generates to be an associative array
    // (in which the column names are the subscript values)
    $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    # fetch the matching row and create some temp vars with its cust info values
    if($row = $stmt->fetch()) {
        $empid      = $row["empID"];
        $empfname    = $row["empFirst"];
        $emplname   = $row["empLast"];
        $empemail   = $row["empEmail"];
        $emppassword   = $row["empPassword"];
        $empdob   = $row["empDOB"];
        $empphone   = $row["empPhone"];
        $empposition = $row["empPosition"];

    } else {
        echo "Employee EDIT Error #888 -- please contact support";
        exit;
    }


}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
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
            <h1 class="h3 mb-0 text-gray-800">  <b>Edit Employee</b></h1>

          </div>


                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">If you click the "Update" button, the form-data will be saved.</h6>
                    </div>

          
                    <!-- Content Row -->
                    <div class="card-body">

                        <img src="registration.jpg" class="img-fluid"  style="width:500px;height:200px;" ><br><br>

                        <form method="POST" action="pjstore_edited_employee.php">
    
                            <div class="form-row mb-3">
                            <input type="hidden" name="feid" value="<?php echo $empid; ?>">

                                <div class="col-md-4">
                                 First name:<br>
                                 <input type="text" class="form-control" name="fempfname" value="<?php echo $empfname; ?>">
                                <br>
                                </div>
                                <div class="col-md-4">
                                 Last name:<br>
                                 <input type="text" class="form-control" name="femplname" value="<?php echo $emplname; ?>">
                                <br>
                            </div>
                        </div>
                            <div class="form-row mb-3">
                                <div class="col-md-8">
                                Email Address:<br>
                                <input type="email" class="form-control" name="fempemail" value="<?php echo $empemail; ?>">
                                <br>
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                    <div class="col-md-8">
                                    Password:<br>
                                    <input type="password" class="form-control" name="femppassword" placeholder ="You Must reset your Password !!!">
                                    <br>
                                    </div>
                            </div>
                            <div class="form-row mb-3">
                                    <div class="col-md-4">
                                    Date of Birth:<br>
                                    <input type="text" class="form-control" name="fempdob" value="<?php echo $empdob; ?>">
                                    <br>
                                    </div>
                                    
                                    <div class="col-md-4">
                                    Phone Number:<br>
                                    <input type="text" class="form-control" name="fempphone" value="<?php echo $empphone; ?>">
                                    <br>
                                    </div>
                            </div>
                            <div class="form-row mb-3">
                                    <div class="col-md-3">
                                    Previous Employee Position:<br>
                                    <input type="text" class="form-control" name="fposition" disabled value="<?php echo $empposition; ?>">


                                    </div>
                            </div>

                            <div class="form-row mb-3">

                                    <div class="col-md-3">
                                        <label for="exampleFormControlSelect1">Employee Position:</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name = "fposition" placeholder="">
                                        <option selected>Choose...</option>
                                        <option>Salesperson</option>
                                        <option>Clerk</option>
                                        <option>Accountant</option>
                                        <option>CEO</option>
                                        </select>
                                    </div>

                            </div>
                            <br><br>
    
    
                            <button type = "submit" class="btn btn-success" ><i class="fas fa-user-edit"></i> Update Employee</button>
                                <br><br>
                                <a role="button" class="btn btn-primary"   href="pjviewemployee.php"><i class="fas fa-list-ul"></i> Return to Employee List</a>
                                <br><br>				  
                                <a role="button" class="btn btn-dark" href="pjmainmenu.php"><i class="fas fa-undo-alt"></i> Return to the Main Menu</a>
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
