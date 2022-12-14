<?php

  $empid = $_SESSION['emp_id'];
  
  $query = "SELECT * FROM `employee` WHERE id ='".$empid."'";
  $result = mysqli_query($connection, $query);
  if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
          $name = $row['name']." ".$row['last_name'];
          $profilepic = $row['image'];
      }
  }

  $query = "SELECT COUNT(*) AS newpost FROM e_uploadfile WHERE status = 0 AND notif = 0";
  $result = mysqli_query($connection, $query);
  if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
          
          $emppost = $row['newpost'];
      }
  }

  $query = "SELECT COUNT(*) AS newsubmit FROM e_requestfile WHERE status = 0 AND notif = 0";
  $result = mysqli_query($connection, $query);
  if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
          
          $empsubmit = $row['newsubmit'];
      }
  }


?>




<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
    </button>

    

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Alerts -->
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-success navbar-badge" style="<?=($emppost + $empsubmit) == 0 ? 'display:none':''?>"><?=$emppost + $empsubmit?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?=$emppost + $empsubmit?> Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="../../ajaxadmin/ajaxadmin.php?updatefilesreceived" class="dropdown-item">
           <b> <?=$emppost?> files received </b>
          </a>
          <div class="dropdown-divider"></div>
          <a href="../../ajaxadmin/ajaxadmin.php?updatefilesrequest" class="dropdown-item">
           <b> <?=$empsubmit?> Files request </b> 
          </a>
        </div>
      </li>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$name?></span>
            <img class="img-profile rounded-circle" src="../../upload/default.png">
            </a>

            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="../../logout.php">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->