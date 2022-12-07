

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

  $query = "SELECT COUNT(*) AS newpost FROM fileupload WHERE status = 0 AND notif = 0 AND employee_id = '".$_SESSION['emp_id']."'";
  $result = mysqli_query($connection, $query);
  if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
          
          $adminpost = $row['newpost'];
      }
  }

  $query = "SELECT COUNT(*) AS newsubmit FROM filesubmit WHERE status = 0 AND notif = 0 AND employee_id = '".$_SESSION['emp_id']."'";
  $result = mysqli_query($connection, $query);
  if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
          
          $adminsubmit = $row['newsubmit'];
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
          <span class="badge badge-success navbar-badge" style="<?=($adminpost + $adminsubmit) == 0 ? 'display:none':''?>"><?=$adminpost + $adminsubmit?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?=$adminpost + $adminsubmit?> Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="../../ajaxemp/ajaxemp.php?updateadminpostnotif" class="dropdown-item">
           <b> <?=$adminpost?> New admin post </b>
          </a>
          <div class="dropdown-divider"></div>
          <a href="../../ajaxemp/ajaxemp.php?updateadminsubmitnotif" class="dropdown-item">
           <b> <?=$adminsubmit?> New files received </b>
          </a>
        </div>
      </li>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$name?></span>
            <img class="img-profile rounded-circle" src="../../upload/<?=$profilepic?>">
            </a>

            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="../cpass/e_users.php?eusers&id=<?=$empid?>" >
                <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                Change Password
            </a>
            <a class="dropdown-item" href="../../logout.php">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->