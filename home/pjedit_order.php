<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Edit Customer Order | JongieeGoods INC.</title>

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

# locate the customer data based on cid value
try {
    
    # process an SQL SELECT
    $stmt = $conn->prepare("SELECT invoiceID, custID, custFname, custLname, invoiceProduct, invoiceBrand, invoiceQty, invoiceTotalCost, invoiceBalance, invoiceComment, invoiceDate FROM invoice WHERE invoiceID=:cidParam");
    $stmt->bindParam(':cidParam', $_GET["cid"]);
    $stmt->execute();

    // set the array that the fetch() function generates to be an associative array
    // (in which the column names are the subscript values)
    $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    # fetch the matching row and create some temp vars with its cust info values
    if($row = $stmt->fetch()) {
        $invoiceid  = $row["invoiceID"];
        $custid      = $row["custID"];
        $custfname    = $row["custFname"];
        $custlname   = $row["custLname"];
        $invoiceproduct   = $row["invoiceProduct"];
        $invoicebrand   = $row["invoiceBrand"];
        $invoiceqty   = $row["invoiceQty"];
        $invoicetotal   = $row["invoiceTotalCost"];
        $invoicebalance   = $row["invoiceBalance"];
        $invoicecomment   = $row["invoiceComment"];
        $invoicedate   = $row["invoiceDate"];


    } else {
        echo "invoice EDIT Error #888 -- please contact support";
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
            <h1 class="h3 mb-0 text-gray-800">  <b>Edit Customer Order</b></h1>

          </div>


                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">If you click the "Edit Order" button, the form-data will be saved.</h6>
                    </div>

          
                    <!-- Content Row -->
                    <div class="card-body">

                    <img src="ordering.jpg" class="img-fluid"  style="width:700px;height:250px;" ><br><br>

                        <form method="POST" action="pjstore_edited_order.php">


<div class="form-row mb-3">
				<div class="col-md-8">
				  Customer ID:<br>
          <input type="hidden" name="fiid" value="<?php echo $invoiceid; ?>">

				  <input type="text" class="form-control" name="fcid" value="<?php echo $custid; ?>">
				  <br>
				</div>
			</div>
			
			<div class="form-row mb-3">

				<div class="col-md-4">
				  First Name:<br>
				  <input type="text" class="form-control" name="ffirstname" value="<?php echo $custfname; ?>" >
				  <br>
				</div>
				<div class="col-md-4">
				  Last Name:<br>
				  <input type="text" class="form-control" name="flastname" value="<?php echo $custlname; ?>" >
				  <br>
				</div>
			</div>

			<div class="form-row mb-3">
      <div class="col-md-3">
				  Product Type:<br>
				  <input type="text" class="form-control" name="fproduct" value="<?php echo $invoiceproduct; ?>" >
				  <br>
				</div>
        <div class="col-md-3">
				  Brand Name:<br>
				  <input type="text" class="form-control" name="fbrand" value="<?php echo $invoicebrand; ?>" >
				  <br>
				</div>
          <div class="col-md-2">
				  Qty:<br>
				  <input type="text" class="form-control" name="fqty" value="<?php echo $invoiceqty; ?>">
				  <br>
                </div>
            </div>
			<div class="form-row mb-3">
				<div class="col-md-4">
				  Total Cost:<br>
				  <input type="text" class="form-control" name="ftotalcost" value="<?php echo $invoicetotal; ?>" >
				  <br>
				</div>
				<div class="col-md-4">
				  Product ID:<br>
				  <input type="text" class="form-control" name="fbalance" value="<?php echo $invoicebalance; ?>">
				  <br>
                </div>
            </div>
                <div class="form-row mb-3">

				<div class="col-md-6">
				  Description:<br>
				  <input type="text" class="form-control" name="fcomment" value="<?php echo $invoicecomment; ?>">
				  <br>
          </div>
          <div class="col-md-2">
				  Order Date:<br>
				  <input type="text" class="form-control" id="dateTimeField" name="fdate" value="<?php echo $invoicedate; ?>">
				  <br>
				</div>
			</div>

      <button type = "submit" class="btn btn-success" ><i class="far fa-credit-card"></i> Edit Order</button>
				  <br><br>				  
          <a role="button" class="btn btn-primary"   href="pjvieworder.php"><i class="fas fa-list-ul"></i> Return to Customer Order List</a>
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
  <script>AnyTime.picker('dateTimeField');</script>

</body>

</html>
