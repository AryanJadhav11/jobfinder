<?php
session_start();
function getInitials($name) {
    $nameParts = explode(' ', $name);
    $initials = '';

    foreach ($nameParts as $part) {
        $initials .= strtoupper(substr($part, 0, 1));
    }
    return $initials;
}
?>
<style>
                .avatar {
        width: 30px;
        height: 30px;
        background-color: #fb246a;
        color: #ffffff;
        font-size: 20px;
        font-weight: bold;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }
            </style>
<header>
        <!-- Header Start -->
       <div class="header-area header-transparrent">
           <div class="headder-top header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-2">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>  
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="menu-wrapper">
                                <!-- Main-menu -->
                                <div class="main-menu">
                                    <nav class="d-none d-lg-block">
                                        <ul id="navigation">
                                            <li><a href="index.html">Home</a></li>
                                            <li><a href="job_listing.php">Find Jobs</a></li>
                                            <li><a href="about.html">About</a></li>
                                            <li><a href="#">Page</a>
                                                <ul class="submenu">
                                                    <li><a href="blog.html">Blog</a></li>
                                                    <li><a href="job_details.html">job Details</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contact.html">Contact</a></li>
                                            <li><a href="register_hr.php">Register your company</a></li>
                                        </ul>
                                    </nav>
                                </div>          
                                <!-- Header-btn -->
                                
                                <li class="dropdown pt-4" style="color: #fb246a;">
    <?php
    if (isset($_SESSION['user_data'])) {
        $userName = $_SESSION['user_data']['username'];
        $userInitials = getInitials($userName);
        
        echo '<a href="profile.php" class="dropdown-toggle " id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>';
        echo '<div class="avatar">' . $userInitials . '</div>';
        echo '</a>';
        echo '<div class="dropdown-menu" aria-labelledby="profileDropdown">';
        echo '<a class="dropdown-item" href="profile.php">View Profile</a>';
        
        // Now you can directly access 'Rolee' without additional checks
        if ($_SESSION['user_data']['username'] =="heydude") {  
            echo '<a class="dropdown-item" href="admin.php">Admin Panel</a>';
        }
        echo '</div>';
    } else {
        // Fallback for users who are not logged in
        echo '<ul>';
        echo '<li>';
        echo '<div class="header-btn d-none f-right d-lg-block">';
        echo '<a href="register.php" class="btn head-btn1 p-3">Register</a>';
        echo '<a href="login.php" class="btn head-btn2 p-3">Login</a>';
        echo '</div>';
        echo '</li>';
        echo '</ul>';
    }
    ?>
</li>

                            </div>


                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
           </div>
       </div>
        <!-- Header End -->
    </header>