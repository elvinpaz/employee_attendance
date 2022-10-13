<?php $f=basename($_SERVER['PHP_SELF']); ?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" style="background:linear-gradient(4deg, #008000, #006400);" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
<div class="sidebar-brand-icon">
    <i class="fas fa-user-check"></i>
</div>
<div class="sidebar-brand-text mx-3">CVSU - BACOOR</div>
</a>


<!-- Query Menu -->
<div class="sidebar-heading">
    ADMIN
</div>

    <li class="nav-item <?=($f=='dashboard.php'?'active':'')?>">
        <a class="nav-link pb-0" href="../dashboard/dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span><strong>Dashboard</strong></span>
        </a>
    </li>
    <hr class="sidebar-divider mt-3">

    <div class="sidebar-heading">
        MASTER
    </div>
    <li class="nav-item <?=($f=='department.php'?'active':'')?>">
        <a class="nav-link pb-0 " href="../department/department.php">
            <i class="fas fa-fw fa-building"></i>
            <span>Department</span>
        </a>
    </li>
    <li class="nav-item <?=($f=='schedule.php'?'active':'')?>">
        <a class="nav-link pb-0" href="../schedule/schedule.php">
            <i class="fas fa-fw fa-exchange-alt"></i>
            <span>Schedule</span>
        </a>
    </li>
    <li class="nav-item <?=($f=='employee.php'?'active':'')?>">
        <a class="nav-link pb-0" href="../employee/employee.php">
            <i class="fas fa-fw fa-id-badge"></i>
            <span>Employee</span>
        </a>
    </li>
    <li class="nav-item <?=($f=='location.php'?'active':'')?>">
        <a class="nav-link pb-0" href="../location/location.php">
            <i class="fas fa-fw fa-map-marker-alt"></i>
            <span>Location</span>
        </a>
    </li>
    <li class="nav-item <?=($f=='designation.php'?'active':'')?>">
        <a class="nav-link pb-0" href="../designation/designation.php">
            <i class="fa fa-suitcase"></i>
            <span>Designation</span>
        </a>
    </li>
    <li class="nav-item <?=($f=='users.php'?'active':'')?>">
        <a class="nav-link pb-0" href="../users/users.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
    </li>
    <li class="nav-item <?=($f=='academicrank.php'?'active':'')?>">
        <a class="nav-link pb-0" href="../academicrank/academicrank.php">
            <i class="fa fa-industry"></i>
            <span>Academic Rank</span>
        </a>
    </li>

    <hr class="sidebar-divider mt-3">

    <div class="sidebar-heading">
        REPORT
    </div>
    <li class="nav-item">
        <a class="nav-link pb-0" href="">
            <i class="fa fa-file"></i>
            <span>Files</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="">
            <i class="fas fa-fw fa-paste"></i>
            <span>Print</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="">
            <i class="fa fa-database"></i>
            <span>Database Backup</span>
        </a>
    </li>

    <hr class="sidebar-divider mt-3">

    <div class="sidebar-heading">
        ANNOUNCEMENT
    </div>
    <li class="nav-item">
        <a class="nav-link pb-0" href="">
            <i class="fa fa-bullhorn"></i>
            <span>Announcement</span>
        </a>
    </li>

    <hr class="sidebar-divider mt-3">



    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->