<header>
    <div class="header-area header-transparrent">
        <div class="headder-top header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-2">
                        <div class="logo">
                            <a href="home.php">
                                <img src="../client-side-web/assets/images/logo/logo.png" alt="logo" style="margin-left: -260px;">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-9">
                        <div class="menu-wrapper">
                            <div class="main-menu">
                                <nav class="d-none d-lg-block">
                                    <ul id="navigation">
                                        <li><a href="home.php">Home</a></li>
                                        <li><a href="#category">Categories</a></li>
                                        <?php if (isset($_SESSION['applicant_id'])) { ?>
                                            <li><a href="#find">Find Jobs</a></li>
                                        <?php } ?>
                                        <?php if (isset($_SESSION['company_id'])) { ?>
                                            <li><a href="#post">Post Job</a></li>
                                        <?php } ?>
                                        <li><a href="#recent">Recent Jobs</a></li>
                                        <li><a href="#about">About</a></li>
                                    </ul>
                                </nav>
                            </div>

                            <?php if (isset($_SESSION['applicant_id'])) { ?>
                                <div class="notification-icon d-none f-right d-lg-block" style="margin-left: 60px;">
                                    <div class="notify">
                                        <?php 
                                        $id = $_SESSION['applicant_id'];
                                        // Count unread notifications for the applicant
                                        $sqlCount = "SELECT COUNT(*) as total FROM `applications` WHERE `applicant_id` = '$id' AND `is_approved`= '1' AND `read_status_a` = 0";
                                        $resCount = mysqli_query($connection, $sqlCount);
                                        $notificationCount = ($resCount && $row = mysqli_fetch_assoc($resCount)) ? $row['total'] : 0;
                                        echo $notificationCount;
                                        ?>
                                    </div>
                                    <a id="applicantNotificationToggle" style="cursor: pointer;">
                                        <i class="fas fa-bell"></i>
                                    </a>
                                    <div id="applicantNotificationPanel" style="display: none;" class="notification-panel">
                                        <h3>Notifications</h3>
                                        <ul>
                                            <?php 
                                            // Fetch notifications for the applicant
                                            $sqlnot = "SELECT a.*, c.company_name FROM `applications` a 
                                                    JOIN `companies` c ON a.company_id = c.company_id
                                                    WHERE a.`applicant_id` = '$id' AND a.`is_approved` = '1' AND a.`read_status_a` = 0";
                                            $res = mysqli_query($connection, $sqlnot);
                                            if (mysqli_num_rows($res) > 0) {
                                                while ($row = mysqli_fetch_assoc($res)) {
                                                    $companyName = htmlspecialchars($row['company_name'], ENT_QUOTES, 'UTF-8');
                                                    $approvedDescription = htmlspecialchars($row['approved_description'], ENT_QUOTES, 'UTF-8');
                                                    $approvedLink = htmlspecialchars($row['approved_link'], ENT_QUOTES, 'UTF-8');
                                                    echo "<div class='notification-item' data-id='{$row['application_id']}'>
                                                            <h4>{$companyName}</h4>
                                                            <p>{$approvedDescription}</p>
                                                            <a href='applicant_applications.php?application_id={$row['application_id']}' class='view-application-link'>View Details</a>
                                                        </div>";
                                                }
                                            } else {
                                                echo "<li>No notifications available</li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if (isset($_SESSION['company_id'])) { ?>
                                <div class="notification-icon d-none f-right d-lg-block" style="margin-left: 60px;">
                                    <div class="notify">
                                        <?php
                                        $company_id = $_SESSION['company_id'];
                                        $sqlCountCompany = "SELECT COUNT(*) as total FROM `applications` WHERE `company_id` = '$company_id' AND `read_status` = 0";
                                        $resCountCompany = mysqli_query($connection, $sqlCountCompany);
                                        $notificationCount = ($resCountCompany && $rowCount = mysqli_fetch_assoc($resCountCompany)) ? $rowCount['total'] : 0;
                                        echo $notificationCount;
                                        ?>
                                    </div>
                                    <a id="companyNotificationToggle" style="cursor: pointer;">
                                        <i class="fas fa-bell"></i>
                                    </a>
                                    <div id="companyNotificationPanel" style="display: none;" class="notification-panel">
                                        <h3>Notifications</h3>
                                        <ul>
                                            <?php
                                            $sqlCompanyNot = "SELECT * FROM `applications` WHERE `company_id` = '$company_id' AND `read_status` = 0";
                                            $resCompanyNot = mysqli_query($connection, $sqlCompanyNot);
                                            if ($resCompanyNot && mysqli_num_rows($resCompanyNot) > 0) {
                                                while ($row = mysqli_fetch_assoc($resCompanyNot)) {
                                                    echo "<div class='notification-item' data-id='{$row['application_id']}'>
                                                            <h4>Application Received</h4>
                                                            <p>{$row['applicant_full_name']} applied for your job posting.</p>
                                                            <a href='company_applicants.php?application_id={$row['application_id']}' class='view-application-link'>View Details</a>
                                                        </div>";
                                                }
                                            } else {
                                                echo "<li>No notifications available</li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>

                            <?php } ?>

                            <div class="dropdown header-btn d-none f-right d-lg-block" style="margin-right: -260px;">
                                <?php if (isset($_SESSION['applicant_id'])) { ?>
                                    <a href="#" class="btn btn-secondary dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-user"></i> Applicant
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="profile.php">Profile</a>
                                        <a class="dropdown-item" href="./login and register/logout.php">Logout</a>
                                    </div>
                                <?php } elseif (isset($_SESSION['company_id'])) { ?>
                                    <a href="#" class="btn btn-secondary dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-user"></i> Company
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="profile.php">Profile</a>
                                        <a class="dropdown-item" href="./login and register/logout.php">Logout</a>
                                    </div>
                                <?php } else { ?>
                                    <a href="#" class="btn btn-secondary dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-user"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="./login and register/applicant_login.php">Applicant</a>
                                        <a class="dropdown-item" href="./login and register/company_login.php">Company</a>
                                    </div>
                                <?php } ?>
                            </div>
                        </d>
                    </div>

                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="../client-side-web/css/header.css">

</header>

<script src="../client-side-web/components/js/applicantNotifications.js"></script>
<script src="../client-side-web/components/js/companyNotifications.js"></script>