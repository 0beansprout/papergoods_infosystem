<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Delete Product | JongieeGoods INC.</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php
session_start();
require_once("pjcheck.php");
if($_SESSION['UserPosition']=="CEO"){
    //
    }elseif($_SESSION['UserPosition']=="Clerk"){
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
    $stmt = $conn->prepare("SELECT proID, proName, proBrand, proQty, proPrice FROM product WHERE proID=:pidParam");
    $stmt->bindParam(':pidParam', $_GET["pid"]);
    $stmt->execute();

    // set the array that the fetch() function generates to be an associative array
    // (in which the column names are the subscript values)
    $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    # fetch the matching row and create some temp vars with its cust info values
    if($row = $stmt->fetch()) {
        $productid  = $row["proID"];
        $proname      = $row["proName"];
        $probrand    = $row["proBrand"];
        $proqty   = $row["proQty"];
        $proprice   = $row["proPrice"];

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
            <h1 class="h3 mb-0 text-gray-800">  <b>Delete Product</b></h1>

          </div>


                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">If you click the "Confirm Delete" button, the product will be removed.</h6>
                    </div>

          
                    <!-- Content Row -->
                    <div class="card-body">

                    <img src="ordering2.png" class="img-fluid"  style="width:700px;height:250px;" ><br><br>

                    <form method = "POST" action="pjstore_deleted_product.php">
<input type="hidden" name="fpid" value="<?php echo $productid; ?>">

			<div class="form-row mb-3">
			<div class="col-md-4">
				  Prduct Type:<br>
				  <input type="text" class="form-control" name="fproduct" disabled value="<?php echo $proname; ?>">
				  <br>
				</div>
				  <div class="col-md-4">
				  Prduct Brand:<br>
				  <input type="text" class="form-control" name="fbrand" disabled value="<?php echo $probrand; ?>">
				  <br>
				</div>
			</div>
			<div class="form-row mb-3">
				<div class="col-md-2">
				  Qty:<br>
				  <input type="number" class="form-control" name="fqty" disabled value="<?php echo $proqty; ?>">
				  <br>
				</div>
			
			
				<div class="col-md-6">
				  Price ($):<br>
				  <input type="text" class="form-control" name="fprice" disabled value="<?php echo $proprice; ?>" >
				  <br>
				</div>
				
            </div>
            
			<ul class="nav"><br>  
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal2"><i class="far fa-trash-alt"></i>
  Delete Product
</button>
<!-- Modal --> 
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Delete Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure delete this Product?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" value="Confirm Delete" class="btn btn-danger"> 
      </div>
    </div>
  </div>
</div>
</ul>
                  <br>
                  <a role="button" class="btn btn-primary"   href="pjviewproduct.php"><i class="fas fa-list-ul"></i> Return to Product List</a>
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

</body>

</html>
