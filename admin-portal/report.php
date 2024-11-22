<?php

include 'configAdmin.php';
session_start();

$username = $_SESSION['admin_username'];
$email = $_SESSION['admin_email'];
$id = $_SESSION['admin_id'];

$query = "SELECT (SELECT COUNT(*) FROM companies )AS count_companies";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}

$query1 = "SELECT (SELECT COUNT(*) FROM applicants )AS count_applicants";
$result1 = mysqli_query($conn, $query1);
if (mysqli_num_rows($result1) > 0) {
    $row1 = mysqli_fetch_assoc($result1);
}

$query2 = "SELECT (SELECT COUNT(*) FROM jobs WHERE category = 'Sales and Marketing' )AS sales,
(SELECT COUNT(*) FROM jobs WHERE category = 'Telecommunication' )AS Telecom,
(SELECT COUNT(*) FROM jobs WHERE category = 'Construction' )AS contruct,
(SELECT COUNT(*) FROM jobs WHERE category = 'Accounting and Auditing' )AS account,
(SELECT COUNT(*) FROM jobs WHERE category = 'Information Technology' )AS information,
(SELECT COUNT(*) FROM jobs WHERE category = 'Banking and Insurance' )AS banking,
(SELECT COUNT(*) FROM jobs WHERE category = 'Architecture' )AS architec";

$result2 = mysqli_query($conn, $query2);
if (mysqli_num_rows($result2) > 0) {
    $row2 = mysqli_fetch_assoc($result2);
}

$query3 = "SELECT company_name FROM `companies` ORDER BY `companies`.`company_id` ASC";
$result3 = mysqli_query($conn, $query3);
// while ($data_set = mysqli_fetch_array($result3)) {
//      $row3[] = $data_set["company_name"];  
//     }
$json = mysqli_fetch_all ($result3, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png"> -->
    <title>JOB HORIZON Admin Panel</title>
    <!-- Bootstrap Core CSS -->
    <link href="./css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="./css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here css/colors/blue.css -->
    <link href="./css/colors/blue-dark.css" id="theme" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">
                    <img src="./images/logo.png" alt="homepage" class="dark-logo" />
                        <!-- Light Logo icon -->
                    <img src="./images/logo.png" alt="homepage" class="light-logo" />
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="./images/users/profile.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="./images/users/profile.png" alt="user"></div>
                                            <div class="u-text">
                                                <h4><?php echo $username; ?></h4>
                                                <p class="text-muted"><?php echo $email; ?></p></div>
                                        </div>
                                    </li>
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="./images/users/profile.png" alt="user" /> 
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text"> 
                            <h5>Super Admin</h5>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                         <li class="nav-devider"></li>
                        <li class="nav-small-cap">Admin Panel</li>
                        <li> <a class="waves-dark" href="applicants.php"><i class="fa fa-users"></i><span class="hide-menu">Applicants</span></a>
                        </li>  
                        <li> <a class="waves-dark" href="companies.php"><i class="mdi mdi-hotel"></i><span class="hide-menu">Companies</span></a>
                        </li>  
                        <li class="active"> <a class="waves-dark active" href="report.php"><i class="fa  fa-bar-chart-o"></i><span class="hide-menu">Reports</span></a>
                        </li>  
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Reports</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
            <?php 
            $VAL = json_encode($json);
                $filters = json_decode($VAL);

                foreach($filters as $obj){
                $filter_data[] = $obj->company_name;
                }
                
                //here is your array from that JSON
                $res = json_encode($filter_data);
                // echo $res;
            ?>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <section class="h-100 ">
                    <div class="container py-5 h-100 ">
                        <div class="row d-flex justify-content-center align-items-center h-100 ">
                            <div class="col">
                                <div class="card card-registration border-3 rounded-3">
                                    <div class="row g-0">
                                        <div class="col-12">
                                            <div class="card-body p-md-4 text-black">
                                                <h3 class="mb-5 text-uppercase text-center mt-5">REPORTS</h3>
                                                <div id="myPlot" style="width:100%;"></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body p-md-4 text-black">
                                                <div id="myPlot1" style="width:100%;"></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body p-md-4 text-black">
                                                <div id="myPlot2" style="width:100%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All Rights Reserved.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="./css/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="./css/plugins/bootstrap/js/popper.min.js"></script>

    <script src="./css/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="./js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="./js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="./js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="./css/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="./css/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="./js/custom.min.js"></script>
    
    <script src="./js/dashboard1.js"></script>
    <!-- ============================================================== -->
    <script>
            var xArray = ['<?php echo $row["count_companies"];?>','<?php echo $row1["count_applicants"];?>'];
            var yArray = ["Companies","Applicants" ];

            var data = [{
            x:xArray,
            y:yArray,
            type:"bar",
            orientation:"h",
            marker: {color:"rgba(255,0,0,0.6)"}
            }];

            var layout = {title:"Companies and Applicants Registered Report"};

            Plotly.newPlot("myPlot", data, layout);
    </script>
    <script>
            var xArray = ["Sales and Marketing","Telecommunication","Construction","Accounting and Auditing","Information Technology","Banking and Insurance","Architecture"];
            var yArray = ['<?php echo $row2["sales"];?>','<?php echo $row2["Telecom"];?>','<?php echo $row2["contruct"];?>','<?php echo $row2["account"];?>','<?php echo $row2["information"];?>','<?php echo $row2["banking"];?>','<?php echo $row2["architec"];?>'];
    
            var data = [{
            x:xArray,
            y:yArray,
            type:"bar"
            }];

            var layout = {title:"Most Trending Jobs Categories"};

            Plotly.newPlot("myPlot1", data, layout);
    </script>
<!--     <script>
        var xArray = '<?php echo $res; ?>';
        var yArray = [55, 49, 44, 24, 15, 13, 12];

        var layout = {title:"Companies Jobs Applications"};

        var data = [{labels:xArray, values:yArray, type:"pie"}];

        Plotly.newPlot("myPlot2", data, layout);
    </script> -->
</body>

</html>
