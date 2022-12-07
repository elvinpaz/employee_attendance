<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="CVSU HR Management System"/>
        <meta name="keywords" content="Best Marketplace, Online Ecommerce, Ecommerce" />
        <meta name="author" content="ATOZ" />
        <link rel='shortcut icon' type='image/x-icon' href='assets/img/logocvsu.png'/>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" href="assets/dist/css/login/all.css"/>
        <link rel="stylesheet" href="assets/dist/css/login/animate.min.css"/>
        <link rel="stylesheet" href="assets/dist/assets/styles/style.css" />
        <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
        <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>

        <title>Log in</title>

    </head>
    <body style="overflow: hidden;">
        <main class="main">
            <div class="main__left" style="background:#FFFFFF">
                <div class="main__left--wrapper" style="padding: 3rem 5rem 1rem 5rem">
                    <div class="" style="margin-top: 50px">
                        <img class="main__left--titlebar--img" src="assets/dist/assets/cvsu_bacoor.png" alt="logo" style="width: 520px;margin-left: -60px" />
                        <h2 class="main__left--titlebar--subHeading">
                            Login Here!
                        </h2>
                    </div>

                        <?php
                            
                            if (isset($_GET['usermsg'])){

                                $erromsg="";

                                if($_GET['usermsg'] == 'Sorry! Wrong email or password.'){

                                    $erromsg = $_GET['usermsg'];

                                    
                                ?>
                                    
                                    <div class="alert alert-danger" style="margin-top: 20px;">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                        <?php echo $erromsg;?>
                                    </div>
                                    
                                <?php                       
                                        
                                } 
                            }
                        ?>

                            
                        
                        
                        
                    

                    
                    <form action="login.php" class="user" method="POST"  style="margin-bottom: 70px">
                        <div class="form-group mt-4">
                            <input type="email" class="form-control form-control-user" name="email" placeholder="Email (example: youremail@domain.com)" style="height: 45px; border-radius: 40px; margin-bottom: -20px;">
                            <!-- <small class="text-danger pl-3">test</small> -->
                        </div>
                        <div class="form-group mt-4 mb-4">
                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password" style="height: 45px; border-radius: 40px; margin-bottom: -20px;">
                            <!-- <small class="text-danger pl-3">test</small> -->
                        </div>
                        <input type="submit" name="submit" class="btn btn-info btn-user btn-block mt-4" style="background:linear-gradient(4deg, #32CD32, #006400, #32CD32); height: 40px; border-radius: 40px;" >
                            
                    </form>
                </div>
            </div>
            <div class="main__right" style="background: #008000;">
                <div>
                    <h1 class="main__right--heading animate__animated animate__fadeInDown" style="padding-top: 1rem;font-size: 45px; ">
                        University Vision
                    </h1>
                    <p class="main__right--subHeading animate__animated animate__fadeInUp" style="margin-top: 1rem;font-size: 20px; ">
                        The Premier University in historic Cavite recognized for excellence in the development of globally and morally upright individuals.
                    </p>
                    <br><br>
                    <h1 class="main__right--heading animate__animated animate__fadeInDown" style="padding-top: 1rem;font-size: 45px;">
                        University Mission
                    </h1>
                    <p class="main__right--subHeading animate__animated animate__fadeInUp" style="margin-top: 1rem;font-size: 20px; ">
                        Cavite State University shall provide excellent, equitable, and relevant educational opportunities in the arts, sciences and technology through quality instruction and responsive research and development activities.

                        It shall produce professional, skilled and morally upright individuals for global competitiveness.
                    </p>

                    
                </div>

                <p>
                    Facebook: <a style="color: #fff" href="https://www.facebook.com/CvSUBacoorCityCampus/">Cavite State University - Bacoor</a><br>
                    Website: <a style="color: #fff" href="https://cvsu.edu.ph/bacoor/">https://cvsu.edu.ph/bacoor/</a>
                </p>
                <p class="main__right--copyright">
                    &copy; Copyright 2022 CVSU BACOOR Campus. All Rights Reserved. Designed by - <a style='color: #fff' href='https://github.com/elvinpaz'>EPAZ</a>
                </p>
            </div>
        </main>
    </body>

    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
