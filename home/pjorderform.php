<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Add Customer Order | JongieeGoods INC.</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!--AnyTime Picker-->
  <link rel="stylesheet" href="//www.ama3.com/anytime/anytime.5.2.0.css">
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="//www.ama3.com/anytime/anytime.5.2.0.js"></script>
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
    //echo "You don't have a permssion to access this page. Please return to the <a href='pjmainmenu.php'>Main menu</a> page and Contact Administrator.";
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
            <h1 class="h3 mb-0 text-gray-800">  <b>Add Customer Order</b></h1>

          </div>


                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Please provide the information listed below.</h6>
                    </div>

          
                                <!-- Content Row -->
                                <div class="card-body">

                                <img src="ordering.jpg" class="img-fluid"  style="width:700px;height:250px;" ><br><br>

                                <form method = "POST" action="pjstore_order.php">

        <div class="form-row mb-3">
				<div class="col-md-8">
				  Customer ID:<br>
				  <input type="text" class="form-control" name="fcid" value="" placeholder="Customer ID">
				  <br>
				</div>
			</div>
			
			<div class="form-row mb-3">

				<div class="col-md-4">
				  First Name:<br>
				  <input type="text" class="form-control" name="ffirstname" value="" placeholder="Customer First Name">
				  <br>
				</div>
				<div class="col-md-4">
				  Last Name:<br>
				  <input type="text" class="form-control" name="flastname" value="" placeholder="Customer Last Name">
				  <br>
				</div>
			</div>
			<div class="form-row mb-3">
			<div class="col-md-3">
    			<label for="exampleFormControlSelect1">Product Type:</label>
    				<select class="form-control" id="exampleFormControlSelect1" name = "fproduct" placeholder="Product Type">
                    <option selected>Choose...</option>
					 <option>Napkins</option>      					
					  <option>Paper Bowls</option>
					  <option>Paper Cups</option>
					  <option>Paper Plates</option>
					  <option>Paper Towels</option>
					  <option>Roll Paper Towels</option>
					  <option>Toilet Paper</option>
					  <option>Tissue</option>


    				</select>
 				 </div>
				  <div class="col-md-3">
    			<label for="exampleFormControlSelect1">Brand Name:</label>
    				<select class="form-control" id="exampleFormControlSelect1" name = "fbrand" placeholder="Product Type">
                    <option selected>Choose...</option>
							<option>Amamzon Basic</option>
      						<option>Bounty</option>
							<option>Dixie</option>
							<option>GBSELL</option>
      						<option>Hefty</option>
							<option>Kimerly-Clark</option>
							<option>Scott</option>
						  <option>Stack Man</option>
						  <option>Viva</option>

    				</select>
 				 </div>
				  <div class="col-md-2">
				  Qty:<br>
				  <input type="number" class="form-control" name="fqty" value="" placeholder="Qty">
				  <br>
				</div>
			</div>
			<br>
			<div class="form-row mb-3">
				<div class="col-md-4">
				  Total Cost:<br>
				  <input type="text" class="form-control" name="ftotalcost" value="" placeholder="Total Cost">
				  <br>
				</div>
				<div class="col-md-4">
				  Product ID:<br>
				  <input type="text" class="form-control" name="fbalance" value="" placeholder="Product ID No.">
				  <br>
                </div>
            </div>
                <div class="form-row mb-3">

				<div class="col-md-6">
				  Description:<br>
				  <input type="text" class="form-control" name="fcomment" value="" placeholder="Leave a Comment ...">
				  <br>
                </div>
				
        <div class="col-md-2">
				  Order Date:<br>
				  <input type="text" id="dateTimeField" class="form-control" name="fdate" placeholder="ex)2020-01-01" >
				  <br>
				</div>
            
				
				
			</div>
			
			
      <button type = "submit" class="btn btn-success" ><i class="fas fa-cart-plus"></i> Add Customer Order</button>
                  <br><br>				  
                  <a role="button" class="btn btn-primary"   href="pjvieworder.php"><i class="fas fa-list-ul"></i> Return to Customer Order List</a>
                  <br><br>				  
				  <a role="button" class="btn btn-dark" href="pjmainmenu.php"><i class="fas fa-undo-alt"></i> Return to the Main Menu</a><br><br>
			</div>

		</form> 
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
  <script>AnyTime.picker('dateTimeField');</script>

</body>

</html>
