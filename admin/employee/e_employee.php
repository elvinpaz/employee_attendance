<?php

session_start();
require '../../connection/connect.php';


// if(isset($_SESSION['access']) && $_SESSION['access'] == "Admin"){

    if (isset($_GET['eemployee'])) {
        $id = $_GET['id'];
    
        $query = "SELECT * FROM employee WHERE id='".$id."'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $fname=$row['name']; 
                $mname=$row['middle_name']; 
                $lname=$row['last_name']; 
                $email=$row['email']; 
                $mobile=$row['mobile_no']; 
                $address=$row['address']; 
                $gender=$row['gender']; 
                $bday=$row['birth_date']; 
                $hdate=$row['hire_date']; 
                $shift=$row['shift_id']; 
                $pos=$row['position_id']; 
                $dep=$row['department_id']; 
                $acad=$row['academic_id']; 
                $pbirth=$row['place_birth']; 
                $typeemp=$row['type_emp']; 
                $rstat=$row['status_emp']; 
                $plantilla=$row['plantilla']; 
                $eligibility=$row['eligibility']; 
                $tin=$row['tin_no']; 
                $gsis=$row['gsis_no']; 
                $pagibig=$row['pagibig_no']; 
                $image= $row['image'];

                $bd=$row['bacherlor_degree']; 
                $bdyear=$row['bs_year']; 
                $bdschool=$row['bs_school']; 
                $master=$row['is_master']; 
                $doctorate=$row['is_doctorate']; 
                $other=$row['is_other_degree']; 
                $md=$row['master']; 
                $mdwith=$row['md_with']; 
                $mdyear=$row['md_year']; 
                $mdschool=$row['md_school']; 
                $dd=$row['doctorate']; 
                $ddwith=$row['dd_with']; 
                $ddyear=$row['dd_year']; 
                $ddschool=$row['dd_school']; 
                $od=$row['other_degree']; 
                $odyear=$row['other_year']; 
                $odschool=$row['other_school'];
                $is_active=$row['is_active'];

            }
        }
    
    }

?>



<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
      
        <link rel='shortcut icon' type='image/x-icon' href='../../assets/img/logocvsu.png'/>
        <title>Employee | Admin</title>
      
        <!-- Custom fonts for this template-->
        <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      
        <!-- Custom styles for this template-->
        <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
      
        <!-- Page level plugins -->
    </head>

    <body>
        <!-- Page Wrapper -->
        <div id="wrapper">

            <?php include '../includes/sidenav.php'; ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <?php include '../includes/topnav.php'; ?>

                    <!-- Main Content -->
                    <div id="content">
            
                       
                                <!-- Begin Page Content -->
                                <div class="container-fluid">

                                    <!-- Page Heading -->
                                    <h1 class="h3 mb-4 text-gray-800">Edit Employee Details</h1>

                                    <a href="employee.php" class="btn btn-secondary btn-icon-split mb-4">
                                    <span class="icon text-white">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                    <span class="text">Back</span>
                                    </a>

                                    <section class="content">

                                        <div class="box">
                                            <div class="box-body">
                                                <div class="row" style="background-color: #f0f0f0; margin: 0px !important;">
                                                    <div class="col-md-3">
                                                        <div class="card" style="width: 100%; height: 100%">
                                                        <img src="../../upload/<?=$image?>" class="card-img-top w-75 mx-auto pt-3">
                                                            <div class="card-body mt-3">
                                                                <label for="image">Change Employee Image</label>
                                                                <input type="file" name="image" id="image" class="mt-2">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-9">

                                                        <div class="card card-outline card-outline-tabs">

                                                            <h5 class="card-header" >Employee Master Data</h5>
                                                            
                                                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Basic Information</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Educational Information</a>
                                                                    </li>
                                                                </ul>
                                                            
                                                        

                                                        
                                                            <div class="card-body ">
                                                            <form action="../../ajaxadmin/ajaxadmin.php?submitEditEmployee" method="POST" enctype="multipart/form-data">
                                                                    <div class="tab-content" id="custom-tabs-one-tabContent">

                                                                        <!-- ^Basic Information tab^ -->
                                                                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                                                            <div class="row">
                                                                                <div class="form-group col-sm-4">
                                                                                    <label>First Name</label>
                                                                                    <input type="text" required class="form-control" value="<?=$fname?>" id="e_fname" name="e_fname" autocomplete="off" autofocus >
                                                                                    
                                                                                </div>

                                                                                <div class="form-group col-sm-4">
                                                                                    <label>Midlle Name</label>
                                                                                    <input type="text" required class="form-control" value="<?=$mname?>" id="e_ne_mnameame" name="e_mname" autocomplete="off" autofocus >
                                                                                </div>

                                                                                <div class="form-group col-sm-4">
                                                                                    <label>Last Name</label>
                                                                                    <input type="text" required class="form-control" value="<?=$lname?>" id="e_lname" name="e_lname" autocomplete="off" autofocus >
                                                                                    
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">

                                                                                <div class="form-group col-sm-4">
                                                                                    <label>Gender</label>
                                                                                    <select class="form-control" id="e_gender" name="e_gender" required>
                                                                                        <option></option>
                                                                                        <option value="Male" <?=$gender == "M" ? "selected": ""?>>Male</option>
                                                                                        <option value="Female" <?=$gender == "F" ? "selected": ""?>>Female</option>
                                                                                    </select>
                                                                                    
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="form-group col-sm-4">
                                                                                    <label>Email Address</label>
                                                                                    <input type="text" disabled autocomplete="off" class="form-control col-lg" value="<?=$email?>" name="email" id="email">
                                                                                    
                                                                                </div>

                                                                                <div class="form-group col-sm-3">
                                                                                    <label>Status</label>
                                                                                    <select class="form-control" value="<?=$rstat?>" id="emp_status" name="emp_status" required>
                                                                                        <option></option>
                                                                                        <option value="Single" <?=$rstat == "Single" ? "selected": ""?>>Single</option>
                                                                                        <option value="Married" <?=$rstat == "Married" ? "selected": ""?>>Married</option>
                                                                                        <option value="Widowed" <?=$rstat == "Widowed" ? "selected": ""?>>Widowed</option>
                                                                                        <option value="Divorced" <?=$rstat == "Divorced" ? "selected": ""?>>Divorced</option>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="form-group col-sm-5">
                                                                                    <label>Mobile Number</label>
                                                                                    <input required type="tel" placeholder="Phone Number: 09XXXXXXXXX"  pattern="[0-0]{1}[9-9]{1}[0-9]{9}" name="mobile" id="mobile" class="form-control" value="<?=$mobile?>">   
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="form-group col-sm-12">
                                                                                    <label>Address</label>
                                                                                    <input type="text" class="form-control" value="<?=$address?>" id="e_address" name="e_address" autocomplete="off" required >
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="form-group col-sm-8">
                                                                                    <label>Place of birth</label>
                                                                                    <input type="text" class="form-control" value="<?=$pbirth?>" id="place_birth" name="place_birth" autocomplete="off" >
                                                                                </div>

                                                                                <div class="form-group col-sm-4">
                                                                                    <label>Date of Birth</label>
                                                                                    <input type="date" class="form-control" value="<?=$bday?>" id="e_birth_date" name="e_birth_date" >       
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="form-group col-sm-4">
                                                                                    <label>Designation</label>
                                                                                    <select class="form-control" value="<?=$pos?>" id="e_position" name="e_position" required>
                                                                                        <option></option>
                                                                                        <?php
                                                                                            $query = "SELECT * FROM position where status =1";
                                                                                            $result = mysqli_query($connection, $query);
                                                                                            if (mysqli_num_rows($result) > 0) {
                                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                                        ?>
                                                                                            <option value="<?=$row['position_id'] ?>" <?=$pos == $row['position_id'] ? "selected": ""?>><?= $row['position_name'];?></option>

                                                                                        <?php 
                                                                                                } 
                                                                                            }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                                
                                                                                <div class="form-group col-sm-4">
                                                                                    <label>Department</label>
                                                                                    <select class="form-control" name="d_id" id="d_id">
                                                                                        <option></option>
                                                                                        <?php
                                                                                            $query = "SELECT * FROM department where status=1";
                                                                                            $result = mysqli_query($connection, $query);
                                                                                            if (mysqli_num_rows($result) > 0) {
                                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                                        ?>

                                                                                        <option value="<?= $row['dept_id'] ?>" <?=$dep == $row['dept_id'] ? "selected": ""?>><?= $row['name']; ?></option>

                                                                                        <?php 
                                                                                                } 
                                                                                            }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="form-group col-sm-4">
                                                                                    <label>Academic Rank</label>
                                                                                    <select class="form-control" value="<?=$acad?>" name="e_academic" id="e_academic" required>
                                                                                        <option></option>
                                                                                        <?php
                                                                                            $query = "SELECT * FROM academics";
                                                                                            $result = mysqli_query($connection, $query);
                                                                                            if (mysqli_num_rows($result) > 0) {
                                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                                        ?>
                                                                                            <option value="<?= $row['academic_id'] ?>" <?=$acad == $row['academic_id'] ? "selected": ""?>><?= $row['academic_name']; ?></option>

                                                                                        <?php 
                                                                                                } 
                                                                                            }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="form-group col-sm-4">
                                                                                    <label>Type of Employment</label>
                                                                                    <select class="form-control" id="type_emp" name="type_emp" >
                                                                                        <option></option>
                                                                                        <option value="Full-time" <?=$typeemp == "Full-time" ? "selected": ""?>>Full-time</option>
                                                                                        <option value="Part-time" <?=$typeemp == "Part-time" ? "selected": ""?>>Part-time</option>
                                                                                        <option value="Contractual" <?=$typeemp == "Contractual" ? "selected": ""?>>Contractual</option>
                                                                                    </select>
                                                                                </div>
                                                                                            
                                                                                <div class="form-group col-sm-4">
                                                                                    <label>Employee Status</label>
                                                                                    <select class="form-control"  name="e_status" id="e_status" required>
                                                                                        <option></option>
                                                                                        <option value="0" <?=$is_active == "0" ? "selected": ""?>>Active</option>
                                                                                        <option value="1" <?=$is_active == "1" ? "selected": ""?>>Inactive</option>
                                                                                    </select>
                                                                                </div>
                                                                                
                                                                                <div class="form-group col-sm-4">
                                                                                    <label>Date of Appointment</label>
                                                                                    <input type="date" class="form-control" value="<?=$hdate?>" name="e_hire_date" id="e_hire_date"> 
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="form-group col-sm-4">
                                                                                    <label>Plantilla Number</label>
                                                                                    <input type="text" class="form-control" value="<?=$plantilla?>" id="plantilla" name="plantilla" autocomplete="off" > 
                                                                                </div>

                                                                                <div class="form-group col-sm-4">
                                                                                    <label>Eligibility</label>
                                                                                    <input type="text" class="form-control" value="<?=$eligibility?>" id="eligibility" name="eligibility" autocomplete="off" > 
                                                                                </div>
                                                                                
                                                                                <div class="form-group col-sm-4">
                                                                                    <label>TIN No.</label>
                                                                                    <input type="text" class="form-control" value="<?=$tin?>" id="tin_no" name="tin_no" autocomplete="off" > 
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="form-group col-sm-4">
                                                                                    <label>GSIS BP No.</label>
                                                                                    <input type="text" class="form-control" value="<?=$gsis?>" id="gsis_no" name="gsis_no" autocomplete="off" > 
                                                                                </div>

                                                                                <div class="form-group col-sm-4">
                                                                                    <label>Pag-Ibig No.</label>
                                                                                    <input type="text" class="form-control" value="<?=$pagibig?>" id="pagibig_no" name="pagibig_no" autocomplete="off" > 
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- ^end of Basic Information tab^ -->

                                                                        <!-- ^Educational Information^ -->
                                                                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                                                            <div class="row">
                                                                                <div class="form-group col-sm-6">
                                                                                    <label>Bachelor's Degree</label>
                                                                                    <input type="text" class="form-control" value="<?=$bd?>" id="bd" name="bd" autocomplete="off" required >
                                                                                </div>

                                                                                <div class="form-group col-sm-4">
                                                                                    <label>Year</label>
                                                                                    <input type="text" class="form-control" value="<?=$bdyear?>" id="bd_year" name="bd_year" autocomplete="off" required >
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="form-group col-sm-8">
                                                                                    <label>School</label>
                                                                                    <input type="text" class="form-control" value="<?=$bdschool?>" id="bd_school" name="bd_school" autocomplete="off" required >
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="form-group col-sm-12">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" type="checkbox" id="is_master" name="is_master" value="<?=$master?>" <?=$master == "1" ? "selected": ""?>>
                                                                                        <label class="form-check-label" for="is_master"> Enable Master's Degree</label>
                                                                                    </div>

                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" type="checkbox" id="is_doctorate" name="is_doctorate" value="<?=$doctorate?>" <?=$doctorate == "1" ? "selected": ""?>>
                                                                                        <label class="form-check-label" for="is_doctorate"> Enable Doctorate</label>
                                                                                    </div>

                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" type="checkbox" id="is_other_degree" name="is_other_degree" value="<?=$other?>" <?=$other == "1" ? "selected": ""?>>
                                                                                        <label class="form-check-label" for="other_degree"> Enable Other Degree</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <div id="master_div" style="<?php if(!empty($input)) { if($input['is_master'] !== "true") { echo "display:none"; } } else { echo 'display:none';  } ?>" >
                                                                                <div class="row">
                                                                                    <div class="form-group col-sm-6">
                                                                                        <label>Master's Degree</label>
                                                                                        <input type="text" class="form-control" value="<?=$md?>" id="md" name="md" autocomplete="off" >
                                                                                    </div>
                                                                                    
                                                                                    <div class="form-group col-sm-3">
                                                                                        <label>With</label>
                                                                                        <input type="text" class="form-control" value="<?=$mdwith?>" id="md_with" name="md_with" autocomplete="off" >
                                                                                    </div>

                                                                                    <div class="form-group col-sm-3">
                                                                                        <label>Year</label>
                                                                                        <input type="text" class="form-control" value="<?=$mdyear?>" id="md_year" name="md_year" autocomplete="off">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="form-group col-sm-8">
                                                                                        <label>School</label>
                                                                                        <input type="text" class="form-control" value="<?=$mdschool?>" id="md_school" name="md_school" autocomplete="off">
                                                                                    </div>
                                                                                </div>
                                                                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                                                            </div>

                                                                            <div id="doctorate_div" style="<?php if(!empty($input)) { if($input['is_doctorate'] !== "true") { echo "display:none"; } } else { echo 'display:none';  } ?>" >
                                                                                <div class="row">
                                                                                    <div class="form-group col-sm-6">
                                                                                        <label>Doctorate Degree</label>
                                                                                        <input type="text" class="form-control" value="<?=$dd?>" id="dd" name="dd" autocomplete="off" >
                                                                                    </div>
                                                                                    
                                                                                    <div class="form-group col-sm-3">
                                                                                        <label>With</label>
                                                                                        <input type="text" class="form-control" value="<?=$ddwith?>" id="dd_with" name="dd_with" autocomplete="off" >
                                                                                    </div>

                                                                                    <div class="form-group col-sm-3">
                                                                                        <label>Year</label>
                                                                                        <input type="text" class="form-control" value="<?=$ddyear?>" id="dd_year" name="dd_year" autocomplete="off">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="form-group col-sm-8">
                                                                                        <label>School</label>
                                                                                        <input type="text" class="form-control" value="<?=$ddschool?>" id="dd_school" name="dd_school" autocomplete="off">
                                                                                    </div>
                                                                                </div>
                                                                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                                                            </div>

                                                                            <div id="other_div" style="<?php if(!empty($input)) { if($input['is_other_degree'] !== "true") { echo "display:none"; } } else { echo 'display:none';  } ?>" >
                                                                                <div class="row">
                                                                                    <div class="form-group col-sm-6">
                                                                                        <label>Other Degree</label>
                                                                                        <input type="text" class="form-control" value="<?=$od?>" id="other" name="other" autocomplete="off">
                                                                                    </div>

                                                                                    <div class="form-group col-sm-4">
                                                                                        <label>Year</label>
                                                                                        <input type="text" class="form-control" value="<?=$odyear?>" id="other_year" name="other_year" autocomplete="off">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="form-group col-sm-8">
                                                                                        <label>School</label>
                                                                                        <input type="text" class="form-control" value="<?=$odschool?>" id="other_school" name="other_school" autocomplete="off">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                                        
                                                                        </div>
                                                                        <!-- ^end of Educational Information^ -->


                                                                    </div>

                                                                    <button type="submit" class="btn btn-success btn-icon-split mt-4 float-right">
                                                                        <span class="icon text-white">
                                                                        <i class="fas fa-plus-circle"></i>
                                                                        </span>
                                                                        <span class="text">Add to system</span>
                                                                    </button>

                                                                    <input type="hidden" name="id" value="<?=$id?>">
                                                                </form>
                                                            </div>
                                                        </div>

                                                            
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </section>

                                </div>
                                <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->

                
                <?php include '../includes/footer.php'; ?>
                

            </div>
            <!-- End of Content Wrapper -->

            

        </div>
        <!-- End of Page Wrapper -->

        <?php include '../includes/modal.php'; ?>

        <!-- Bootstrap core JavaScript-->
        <script src="../../assets/vendor/jquery/jquery.min.js"></script>
        <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../../assets/js/sb-admin-2.min.js"></script>

        <script>
            $(document).ready(function() {

                    
                $("#is_master").click(function() {
                    if($(this).is(":checked")) {
                        $('#md').attr('required', true);
                        $('#md_with').attr('required', true);
                        $('#md_year').attr('required', true);
                        $('#md_school').attr('required', true);
                        $('#master_div').show();
                    } else {
                        $('#md').attr('required', false);
                        $('#md_with').attr('required', false);
                        $('#md_year').attr('required', false);
                        $('#md_school').attr('required', false);
                        $('#master_div').hide();
                    }
                });

                if($("#is_master").is(":checked")) {
                    $('#md').attr('required', true);
                    $('#md_with').attr('required', true);
                    $('#md_year').attr('required', true);
                    $('#md_school').attr('required', true);
                    $('#master_div').show();
                } else {
                    $('#md').attr('required', false);
                    $('#md_with').attr('required', false);
                    $('#md_year').attr('required', false);
                    $('#md_school').attr('required', false);
                    $('#master_div').hide();
                }

            
                $("#is_doctorate").click(function() {
                    if($(this).is(":checked")) {
                        $('#doctorate').attr('required', true);
                        $('#md_with').attr('required', true);
                        $('#md_year').attr('required', true);
                        $('#md_school').attr('required', true);
                        $('#doctorate_div').show();
                    } else {
                        $('#doctorate').attr('required', false);
                        $('#md_with').attr('required', false);
                        $('#md_year').attr('required', false);
                        $('#md_school').attr('required', false);
                        $('#doctorate_div').hide();
                    }
                });

                if($("#is_doctorate").is(":checked")) {
                    $('#doctorate').attr('required', true);
                    $('#md_with').attr('required', true);
                    $('#md_year').attr('required', true);
                    $('#md_school').attr('required', true);
                    $('#doctorate_div').show();
                } else {
                    $('#doctorate').attr('required', false);
                    $('#md_with').attr('required', false);
                    $('#md_year').attr('required', false);
                    $('#md_school').attr('required', false);
                    $('#doctorate_div').hide();
                }

                $("#is_other_degree").click(function() {
                    if($(this).is(":checked")) {
                        $('#other').attr('required', true);
                        $('#other_year').attr('required', true);
                        $('#other_school').attr('required', true);
                        $('#other_div').show();
                    } else {
                        $('#other').attr('required', false);
                        $('#other_year').attr('required', false);
                        $('#other_school').attr('required', false);
                        $('#other_div').hide();
                    }
                });
                
                if($("#is_other_degree").is(":checked")) {
                    $('#other').attr('required', true);
                    $('#other_year').attr('required', true);
                    $('#other_school').attr('required', true);
                    $('#other_div').show();
                } else {
                    $('#other').attr('required', false);
                    $('#other_year').attr('required', false);
                    $('#other_school').attr('required', false);
                    $('#other_div').hide();
                }

            });

        </script>

    </body>

</html>