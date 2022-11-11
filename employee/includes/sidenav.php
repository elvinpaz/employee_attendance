<?php $f=basename($_SERVER['PHP_SELF']); ?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" style="background:linear-gradient(4deg, #008000, #006400); margin-bottom: -101%; padding-bottom: 101%;" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
<div class="sidebar-brand-icon">
    <i class="fas fa-user-check"></i>
</div>
<div class="sidebar-brand-text mx-3">CVSU - BACOOR</div>
</a>


<!-- Query Menu -->
<div class="sidebar-heading">
    EMPLOYEE
</div>

    <li class="nav-item <?=($f=='dashboard.php'?'active':'')?>">
        <a class="nav-link pb-0" href="../dashboard/dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span><strong>Daily Time Record</strong></span>
        </a>
    </li>
    <hr class="sidebar-divider mt-3">

    <div class="sidebar-heading">
        FILES
    </div>
    <li class="nav-item <?=($f=='adminpostedfile.php'?'active':'')?>">
        <a class="nav-link pb-0" href="../adminpostedfile/adminpostedfile.php">
        <i class="fas fa-file-upload"></i>
            <span>Admin Posted Files</span>
        </a>
    </li>
    <li class="nav-item <?=($f=='uploadfile.php'?'active':'')?>">
        <a class="nav-link pb-0" href="../uploadfile/uploadfile.php">
        <i class="fas fa-file-upload"></i>
            <span>Upload Files</span>
        </a>
    </li>
    <li class="nav-item <?=($f=='receivedfile.php'?'active':'')?>">
        <a class="nav-link pb-0" href="../receivedfile/receivedfile.php">
        <i class="fas fa-file-download"></i>
            <span>Received Files</span>
        </a>
    </li>

    <hr class="sidebar-divider mt-3">
    



    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->