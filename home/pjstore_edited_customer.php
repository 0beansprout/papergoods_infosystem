<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Update Customer | JongieeGoods INC.</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php
session_start();

// put this code block at the top of all secure pages in the site
// to make sure the current browser is logged in 

require_once("pjcheck.php");
if($_SESSION['UserPosition']=="CEO"){
  //
}elseif($_SESSION['UserPosition']=="Salesperson"){
  //
}else{
  echo "You don't have a permssion to access this page. Please return to the <a href='pjmainmenu.php'>Main menu</a> page and Contact Administrator.";
  exit;
}
require_once("pjdbcreds.php");

# get connected to the DB
try {
  $custDBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
 
}
catch(PDOException $e) {
    echo "There has been an issue (#33) with the database connection.  Please see your administrator"; // $e->getMessage();
}

# process an SQL INSERT
try {
    # prepare the SQL shortcut!
    $custSQL = $custDBH->prepare("UPDATE customers 
    SET custFname=:cfname, custLname=:clname, custEmail=:cemail, custAddress=:caddress, custCity=:ccity, custState=:cstate 
    WHERE custID=:custid");

    # bind some data values into the named parameters in the prepared statement
    $custSQL->bindParam(':custid', $_POST["fcid"]);
    $custSQL->bindParam(':cfname', $_POST["fcustfname"]);
    $custSQL->bindParam(':clname', $_POST["fcustlname"]);
    $custSQL->bindParam(':cemail', $_POST["fcustemail"]);
    $custSQL->bindParam(':caddress', $_POST["fcustaddress"]);
    $custSQL->bindParam(':ccity', $_POST["fcustcity"]);
    $custSQL->bindParam(':cstate', $_POST["fcuststate"]);

    # submit the SQL statement to MySQL for processing
    $custSQL->execute();
   
  }
  catch(PDOException $e) {
      echo "There has been an issue (#39) with the database connection.  Please see your administrator"; // $e->getMessage();
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

          


                <div class="card shadow mb-4">
                    

          
                    <!-- Content Row -->
                    <div class="card-body">

                    <br>
                    <div class="alert alert-success" role="alert">
                    <div class="card-body">

                     <h4><b>System Message:</b> Customer has been updated.</h4>
                     </div>                   

                     </div>                   
                    <br>		  
                     <a role="button" class="btn btn-primary"   href="pjviewcustomer.php"><i class="fas fa-list-ul"></i> Return to Customer List</a>
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
