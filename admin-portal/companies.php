<?php
include 'configAdmin.php';
session_start();

$username = $_SESSION['admin_username'];
$email = $_SESSION['admin_email'];
$id = $_SESSION['admin_id'];

// Handle approval/rejection and ban/unban actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $company_id = $_GET['id'];

    // Handle approve/decline actions
    if ($_GET['action'] == 'approve') {
        $query = "UPDATE companies SET is_approved = 1 WHERE company_id = $company_id";
        mysqli_query($conn, $query);
        header("Location: companies.php");
        exit();
    } elseif ($_GET['action'] == 'decline') {
        $query = "UPDATE companies SET is_approved = -1 WHERE company_id = $company_id";
        mysqli_query($conn, $query);
        header("Location: companies.php");
        exit();
    }

    // Handle ban/unban actions
    if ($_GET['action'] == 'ban') {
        $query = "UPDATE companies SET company_recycle_bin = 1 WHERE company_id = $company_id";
        mysqli_query($conn, $query);
        header("Location: companies.php");
        exit();
    } elseif ($_GET['action'] == 'unban') {
        $query = "UPDATE companies SET company_recycle_bin = 0 WHERE company_id = $company_id";
        mysqli_query($conn, $query);
        header("Location: companies.php");
        exit();
    }
}

$query = "SELECT * FROM companies ORDER BY company_id ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.ico">
    <title>JOB HORIZON Admin Panel</title>
    <link href="./css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/colors/blue-dark.css" id="theme" rel="stylesheet">
</head>
<body class="fix-header card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
    </div>

    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">
                        <img src="./images/logo.png" alt="homepage" class="dark-logo" />
                        <img src="./images/logo.png" alt="homepage" class="light-logo" />
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item"><a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a></li>
                        <li class="nav-item m-l-10"><a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="./images/users/profile.png" alt="user" class="profile-pic" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="./images/users/profile.png" alt="user"></div>
                                            <div class="u-text">
                                                <h4><?php echo $username; ?></h4>
                                                <p class="text-muted"><?php echo $email; ?></p>
                                            </div>
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

        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <div class="user-profile">
                    <div class="profile-img"> <img src="./images/users/profile.png" alt="user" /></div>
                    <div class="profile-text">
                        <h5><?php echo $username; ?></h5>
                    </div>
                </div>
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">Admin Panel</li>
                        <li><a class="waves-dark" href="applicants.php"><i class="fa fa-users"></i><span class="hide-menu">Applicants</span></a></li>
                        <li class="active"><a class="waves-dark" href="companies.php"><i class="mdi mdi-hotel"></i><span class="hide-menu">Companies</span></a></li>
                        <li><a class="waves-dark" href="report.php"><i class="fa fa-bar-chart-o"></i><span class="hide-menu">Reports</span></a></li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Companies</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Companies Details</li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Companies Details</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>

                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Company ID</th>
                                                <th>Company Username</th>
                                                <th>Company Name</th>
                                                <th>Company Website</th>
                                                <th>Company Email</th>
                                                <th>Company Registration</th>
                                                <th>Banned Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if ($result) {
                                                while ($data_set = mysqli_fetch_assoc($result)) {
                                                    $company_id = $data_set['company_id'];
                                                    $username = $data_set['company_username'];
                                                    $name = $data_set['company_name'];
                                                    $website = $data_set['company_website'];
                                                    $email = $data_set['company_email'];
                                                    $status = isset($data_set['is_approved']) ? 
                                                        ($data_set['is_approved'] == 1 ? "Approved" : ($data_set['is_approved'] == -1 ? "Declined" : "Pending")) 
                                                        : "Pending";
                                                    $recycle_bin = $data_set['company_recycle_bin'];
                                                    $ban_status = ($recycle_bin == 1) ? "Banned" : "Unbanned";

                                                    // Approve/Decline button
                                                    $approve_decline_btn = ($status == "Pending") ? 
                                                        "<a href='companies.php?action=approve&id=$company_id' class='btn btn-success btn-sm'>Approve</a>
                                                         <a href='companies.php?action=decline&id=$company_id' class='btn btn-danger btn-sm'>Decline</a>"
                                                        : "<span class='text-muted'>$status</span>";

                                                    // Ban/Unban button
                                                    $ban_unban_btn = ($ban_status == "Banned") ?
                                                        "<a href='companies.php?action=unban&id=$company_id' class='btn btn-success btn-sm'>Unban</a>"
                                                        : "<a href='companies.php?action=ban&id=$company_id' class='btn btn-warning btn-sm'>Ban</a>";

                                                    echo "<tr>
                                                        <td>$company_id</td>
                                                        <td>$username</td>
                                                        <td>$name</td>
                                                        <td>$website</td>
                                                        <td>$email</td>
                                                        <td>$approve_decline_btn</td>
                                                        <td>$ban_status</td>
                                                        <td>$ban_unban_btn</td>
                                                    </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='9'>No records found</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            Copyright &copy;
            <script>document.write(new Date().getFullYear());</script> JOB HORIZON Admin Panel. All Rights Reserved.
        </footer>
    </div>
</div>

<script src="./css/plugins/jquery/jquery.min.js"></script>
<script src="./css/plugins/bootstrap/js/popper.min.js"></script>
<script src="./css/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="./js/jquery.slimscroll.js"></script>
<script src="./js/waves.js"></script>
<script src="./js/sidebarmenu.js"></script>
<script src="./css/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="./css/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="./js/custom.min.js"></script>
<script src="./css/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function () {
        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
