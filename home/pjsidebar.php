    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="pjmainmenu.php">
        <div class="sidebar-brand-icon rotate-n-0">
        <i class="far fa-paper-plane"></i>
        </div>
        <div class="sidebar-brand-text mx-2"><b> JongieeGoods</b><sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="pjmainmenu.php">
          <i class="fas fa-columns"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        People
      </div>

      <!-- Nav Item - Employee Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmp" aria-expanded="true" aria-controls="collapseEmp">
          <i class="fas fa-user-tie"></i>
          <span>Employee</span>
        </a>
        <div id="collapseEmp" class="collapse" aria-labelledby="headingEmp" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Customize Employee:</h6>
            <a class="collapse-item" href="pjviewemployee.php">Employee List</a>
            <a class="collapse-item" href="pjempform.php">Add New Employee</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Customer Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-users"></i>
          <span>Customer</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Customize Customer:</h6>
            <a class="collapse-item" href="pjviewcustomer.php">Customer List</a>
            <a class="collapse-item" href="pjcustform.php">Add New Customer</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Sales
      </div>

      <!-- Nav Item - Custoemr Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-truck"></i>
          <span>Order</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Customer Order:</h6>
            <a class="collapse-item" href="pjvieworder.php">Customer Order List</a>
            <a class="collapse-item" href="pjorderform.php">Add New Customer Order</a>
           
          </div>
        </div>
      </li>

        <!-- Nav Item - Inventory Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
             <i class="fas fa-boxes"></i>
             <span>Inventory</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Customize Inventory:</h6>
                <a class="collapse-item" href="pjviewproduct.php">Product List</a>
                <a class="collapse-item" href="pjproductform.php">Order Product</a>
                </div>
            </div>
        </li>



      <!-- Nav Item - Charts 
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>-->

      <!-- Nav Item - Tables
      <li class="nav-item active">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li> -->


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>