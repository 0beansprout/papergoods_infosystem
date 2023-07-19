<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>JongieeGoods INC. | View Order</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

                <?php
                  session_start();
                  require_once("pjcheck.php");
                  if($_SESSION['UserPosition']=="CEO"){
                    //
                }elseif($_SESSION['UserPosition']=="Salesperson"){
                    //
                }elseif($_SESSION['UserPosition']=="Accountant"){
                    //
                }
                else{
                    //echo "You don't have a permssion to access this page. Please return to the <a href='pjmainmenu.php'>Main menu</a> page and Contact Administrator.";
                    header("Location: http://www.pgsalesmgmt.com/home/error.php"); /* Redirect browser */

                    exit;    
                }
                
                  require_once("pjdbcreds.php");
                  
                # get connected to the DB
                try {
                 $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
                 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
                    }
                catch(PDOException $e) {
                echo "There has been an issue (#33) with the database connection.  Please see your administrator"; // $e->getMessage();
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
          <h1 class="h3 mb-2 text-gray-800"><b>Sales History for Customer</b></h1>
          <p class="mb-4">DataTables is used to generate the specific Order table for the specific customer below.</p>
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <a href="displayorderspdf.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Order Report</a>

          </div>
          <!-- DataTales Customer -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Order Table</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr><th>      </th><th>OrderNo.</th><th>CustID</th><th>Customer</th><th>ProID</th><th>Product</th><th>Brand</th><th>Qty</th><th>Cost($)</th><th>Comment</th></tr>
                </thead><tbody>
                  <?php
                                    
                        # output a table of customer data to the browser in proper HTML table format
                        try {

                         # process an SQL SELECT
                         $stmt = $conn->prepare("SELECT invoiceID, custID, custFname, custLname, invoiceProduct, invoiceBrand, invoiceQty, invoiceTotalCost, invoiceBalance, invoiceComment FROM invoice WHERE invoiceBalance = :pidParam");
                         $stmt->bindParam(':pidParam', $_GET["pid"]);
                         $stmt->execute();

                          // set the array that the fetch() function generates to be an associative array
                             // (in which the column names are the subscript values)
                          $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                         # loop through all rows in the resultset and send them to the browser at HTML rows
                          while($row = $stmt->fetch()) {
                        $invoiceid = $row["invoiceID"];
                        $custid = $row["custID"];
                        $proid = $row["invoiceBalance"];

	                	    $custFullName = $row['custFname'] . " " . $row['custLname'];
                         echo "<tr><td align='center'>&nbsp;&nbsp;" .
                       "<a href='pjedit_order.php?cid=$invoiceid'><span class='far fa-edit' data-toggle='tooltip' data-placement='top' title='Edit Order' aria-hidden='true'></span></a>" . 
                       "&nbsp;&nbsp;&nbsp;<a href='pjorderform_match.php?cid=$invoiceid'><span class='fas fa-cart-plus' data-toggle='tooltip' data-placement='top' title='Order for this Customer' aria-hidden='true'></span></a>" . 
                       "&nbsp;&nbsp;&nbsp;<a href='pjedit_reorder.php?cid=$invoiceid'><span class='fas fa-shopping-cart' data-toggle='tooltip' data-placement='top' title='Re-Order this Item' aria-hidden='true'></span></a>" . 
                       "&nbsp;&nbsp;&nbsp;<a href='pjdelete_order.php?cid=$invoiceid'><span class='far fa-trash-alt' data-toggle='tooltip' data-placement='top' title='Delete Order' aria-hidden='true'></span></a></td>" . 
                       "<td>" . $row['invoiceID'] . "</td>"  .
                       "<td>" . $row['custID'] . "</td>"  .
                       "<td>" . $custFullName . "</td>"  .
                       "<td>" . $row['invoiceBalance'] . "</td>".
                       "<td>" . $row['invoiceProduct'] . "</td>".
                       "<td>" . $row['invoiceBrand'] . "</td>".
                       "<td>" . $row['invoiceQty'] . "</td>".
                       "<td>" . $row['invoiceTotalCost'] . "</td>".
                       "<td>" . $row['invoiceComment'] . "</td></tr>";
                        }

                    }
                    catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                    }
                    ?>
                </tbody>


                </table>
              </div>
              <br>
              <a role="button" class="btn btn-primary"   href="pjviewcustomer.php"><i class="fas fa-users"></i>  Return to Customer List</a>
              <br><br>
              <a role="button" class="btn btn-primary"   href="pjvieworder.php"><i class="fas fa-list-ul"></i> Return to Customer Order List</a>
              <br><br>
              <a role="button" class="btn btn-dark" href="pjmainmenu.php"><i class="fas fa-undo-alt"></i> Return to the Main Menu</a><br><br>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php require_once("pjfooter.php") ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->



  <!-- Scroll to Top Button-->
  <!-- Logout Modal-->  <?php require_once("pjdownbotton.php") ?>


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
