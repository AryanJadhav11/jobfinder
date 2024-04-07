<!-- <?php 
session_start();
$server='localhost';
$user='root';
$db='job_users';
$pass='';

$coni=mysqli_connect($server,$user,$pass,$db);

if(!$coni)
{
 die(mysqli_error($coni));
}
echo '<pre>';
print_r($_SESSION['company_data']);
echo '</pre>';
if (!isset($_SESSION['company_data']) || !isset($_SESSION['company_data']['company'])) {
    header('Location: hr_login.php'); // Redirect to the login page if not logged in or if venue_name is not set
    exit();
}

$hr_data = $_SESSION['company_data'];
$com = $hr_data['company'];

// Fetch data from the database based on the current turf owner
$sql = "SELECT * FROM `applications` WHERE company='$com' ORDER BY applications.id DESC";
$result = mysqli_query($coni, $sql);

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Get booking information from the form
//     $name = isset($_POST['turfname']) ? $_POST['turfname'] : '';
//     $date = isset($_POST['date']) ? $_POST['date'] : '';
//     $startTime = isset($_POST['startTime']) ? $_POST['startTime'] : '';
//     $endTime = isset($_POST['endTime']) ? $_POST['endTime'] : '';
//     $userName = isset($_POST['userName']) ? $_POST['userName'] : '';
//     $userEmail = isset($_POST['userEmail']) ? $_POST['userEmail'] : '';

//     // Combine start and end time
//     $time = $startTime . " - " . $endTime;

//     // Convert date and time to timestamps
//     $selectedTimestamp = strtotime($date . ' ' . $startTime);
//     $currentTimestamp = time();

//     if ($selectedTimestamp < $currentTimestamp) {
//         echo "<script>alert('Please select a valid future date and time.')</script>";
//         exit;
//     }

//     // Check if the chosen date and time slot is already booked for the specific turf
//     $checkSql = "SELECT * FROM booking WHERE turfname = '$name' AND date = '$date' AND time = '$time'";
//     $result = $coni->query($checkSql);

//     if ($result && $result->num_rows > 0) {
//         // Turf is already booked for the selected date and time
//         echo "<script>alert('This slot is already booked')</script>";
//         $response['success'] = false;
//         $response['error'] = 'The selected turf is already booked on the specified date and time. Please choose a different date and time.';
//     } else {
//         $user_id = isset($_SESSION['user_data']['user_id']) ? $_SESSION['user_data']['user_id'] : 0;
//         $insertSql = "INSERT INTO booking (userid, turfname, date, time, userName, userEmail) 
//                         VALUES ('$user_id', '$name', '$date', '$time', '$userName', '$userEmail')";
//         if ($coni->query($insertSql) === TRUE) {
//             echo "Booking added";
//         } else {
//             echo "Error: " . $insertSql . "<br>" . $coni->error;
//         }
//     }
// }
?> -->



<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>HR - Dashboard</title>

      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
      <!-- Custom fonts for this template-->
      <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="vendor/css/sb-admin-2.css" rel="stylesheet">
   </head>
   <style>
     .avatar {
        width: 30px;
        height: 30px;
        background-color: #007bff;
        color: #ffffff;
        font-size: 20px;
        font-weight: bold;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }
   

       
        body {
	color: #566787;
	background: #f5f5f5;
	
	font-size: 13px;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
	background: #fff;
	padding: 20px 25px;
	border-radius: 3px;
	min-width: 1000px;
	box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {        
	padding-bottom: 15px;
	background: #435d7d;
	color: #fff;
	padding: 16px 30px;
	min-width: 100%;
	margin: -20px -25px 10px;
	border-radius: 3px 3px 0 0;
}
.table-title h2 {
	margin: 5px 0 0;
	font-size: 24px;
}
.table-title .btn-group {
	float: right;
}
.table-title .btn {
	color: #fff;
	float: right;
	font-size: 13px;
	border: none;
	min-width: 50px;
	border-radius: 2px;
	border: none;
	outline: none !important;
	margin-left: 10px;
}
.table-title .btn i {
	float: left;
	font-size: 21px;
	margin-right: 5px;
}
.table-title .btn span {
	float: left;
	margin-top: 2px;
}
table.table tr th, table.table tr td {
	border-color: #e9e9e9;
	padding: 12px 15px;
	vertical-align: middle;
}
table.table tr th:first-child {
	width: 60px;
}
table.table tr th:last-child {
	width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
	background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
	background: #f5f5f5;
}
table.table th i {
	font-size: 13px;
	margin: 0 5px;
	cursor: pointer;
}	
table.table td:last-child i {
	opacity: 0.9;
	font-size: 22px;
	margin: 0 5px;
}
table.table td a {
	font-weight: bold;
	color: #566787;
	display: inline-block;
	text-decoration: none;
	outline: none !important;
}
table.table td a:hover {
	color: #2196F3;
}
table.table td a.edit {
	color: #FFC107;
}
table.table td a.delete {
	color: #F44336;
}
table.table td i {
	font-size: 19px;
}
table.table .avatar {
	border-radius: 50%;
	vertical-align: middle;
	margin-right: 10px;
}

.hint-text {
	float: left;
	margin-top: 10px;
	font-size: 13px;
}    



/* Modal styles */
.modal .modal-dialog {
	max-width: 400px;
}
.modal .modal-header, .modal .modal-body, .modal .modal-footer {
	padding: 20px 30px;
}
.modal .modal-content {
	border-radius: 3px;
	font-size: 14px;
}
.modal .modal-footer {
	background: #ecf0f1;
	border-radius: 0 0 3px 3px;
}
.modal .modal-title {
	display: inline-block;
}
.modal .form-control {
	border-radius: 2px;
	box-shadow: none;
	border-color: #dddddd;
}
.modal textarea.form-control {
	resize: vertical;
}
.modal .btn {
	border-radius: 2px;
	min-width: 100px;
}	
.modal form label {
	font-weight: normal;
}	
/*
    DEMO STYLE
*/

@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
body {
    font-family: 'Poppins', sans-serif;
    background: #fafafa;
}

p {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1.7em;
    color: #999;
}

a,
a:hover,
a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

.navbar {
    padding: 15px 10px;
    background: #f8f9fa;
    border: none;
    border-radius: 0;
    margin-bottom: 40px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}

.navbar-btn {
    box-shadow: none;
    outline: none !important;
    border: none;
}

.line {
    width: 100%;
    height: 1px;
    border-bottom: 1px dashed #ddd;
    margin: 40px 0;
}

/* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */

</style>
    
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <body id="page-top">
      <!-- Page Wrapper -->
      <div id="wrapper">
         <!-- Sidebar -->
         <div class="wrapper">
        <!-- Sidebar  -->
       
<?php include('owner_panel_bar.php'); ?>
        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light " style="background:#d8ebfe;">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        
                        <span>Collapse Sidebar</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        
                    </div>
                </div>
            </nav>
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
               <!-- Topbar -->
                  <!-- Sidebar Toggle (Topbar) -->
                  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"> <i class="fa fa-bars"></i> </button>
                  <!-- Topbar Navbar -->
                  <ul class="navbar-nav ml-auto" >
                     <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                     <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-search fa-fw"></i> </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow +animated--grow-in" aria-labelledby="searchDropdown">
                           
                        </div>
                     </li>
                     <!-- Nav Item - User Information -->
                     
                        </span><!-- <img class="img-profile rounded-circle" src="vendor/img/undraw_profile.svg"> -->
                        <!-- Dropdown - User Information -->
                        
                     </li>
                  </ul>
               </nav>
<?php
               if (isset($_GET['deleteid'])) {
  // Get the turf ID to be deleted
  $deleteid = $_GET['deleteid'];

  // Perform the DELETE query
  $deleteSql = "DELETE FROM `` WHERE `boid` = '$deleteid'";
  $deleteResult = mysqli_query($coni, $deleteSql);

  // Check if the DELETE query was successful
  if ($deleteResult === false) {
      die("Deletion failed: " . mysqli_error($coni));
  } else {
      
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<!-- ... (your HTML content) ... -->
</html>


               <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                <div class="col-sm-6">
    <h2>applications for <b><?php echo $com; ?></b></h2>
</div>

                  
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Company</th>
                        <th>Title</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Qualification</th>
                        <th>Techical Skills</th>
                        <th>Resume</th>
                        <th>Resume Link</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
$sql = "SELECT * FROM `applications` WHERE company='$com' ORDER BY applications.id DESC";
$result = mysqli_query($coni, $sql);

if ($result === false) {
    die("Query failed: " . mysqli_error($coni));
}

$rowCount = mysqli_num_rows($result);

if ($rowCount > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $jid = $row['id'];
        $cn = $row['company'];
        $tit= $row['title'];
        $en = $row['firstname'];
        $em = $row['lastname'];
        $ep = $row['email'];
        $ad = $row['address'];
        $r = $row['qualification'];
        $ts = $row['tech_skills'];
        $res = $row['resume'];
        $ci = $row['city'];
        $gen = $row['gender'];
        $ph = $row['phoneno'];
        $rl = $row['resumelink'];

        echo '<tr>
        <td scope="row">' . $jid . '</td>
        <td>' . $cn . '</td>
        <td>' . $tit . '</td>
        <td>' . $en . '</td>
        <td>' . $em . '</td>
        <td>' . $ep . '</td>
        <td>' . $ad . '</td>
        <td>' . $r . '</td>
        <td>' . $ts . '</td>
        <td>' . $res . '</td>
        <td>' . $rl . '</td>
        <td>
            <form action="approve_job.php" method="post">
                <input type="hidden" name="id" value="' . $row["id"] . '">
                <input type="submit" name="approve" value="Approve Application">
            </form>
        </td>
    </tr>';

    }
} else {
    echo "<tr><td colspan='6'>No rows found.</td></tr>";
}
?>

                </tbody>
            </table>
        </div>
    </div>

    <div id="addjob" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
        <form action="job_add.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">                        
                    <h4 class="modal-title">Add a New Job</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
  <label >Add Company Logo</label>
   <input type="file" name="image" class="form-control">
  </div>
                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" name="cname" class="form-control" placeholder="Name of Company" style="width:220px;" required>
                    </div>
                    <div class="form-group">
                        <label>HR Name</label>
                        <input type="text" name="hr" class="form-control" placeholder="Name of HR" style="width:220px;" required>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Job Title" style="width:220px;" required>
                    </div>
                    <div class="mb-3">
                        <label>Add Details</label>
                        <textarea required class="form-control" name="detail" id="bl"></textarea>
                        <script>
                            CKEDITOR.replace('bl');
                        </script>
                    </div>
                   
                    
                    <div class="form-group">
                        <label>Salary</label>
                        <input type="text" name="salary" class="form-control" placeholder="Salary To be given" style="width:220px;" required>
                    </div>
                    <div class="form-group">
                        <label>web</label>
                        <input type="text" name="web" class="form-control" placeholder="Add website link" style="width:220px;" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Add company email" style="width:220px;" required>
                    </div>
                    <div class="mb-3">
                        <label>Company description</label>
                        <textarea required class="form-control" name="cdes" id="bl"></textarea>
                        <script>
                            CKEDITOR.replace('bl');
                        </script>
                    </div>
                    <div class="form-group">
                        <label>Requirement</label>
                        <input type="text" name="req" class="form-control" placeholder="Add requirements for job" style="width:220px;" required>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="loc" class="form-control" placeholder="Add Job location" style="width:220px;" required>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Add Job">
                </div>
            </form>
        </div>
</div>
               
</body>
</html>