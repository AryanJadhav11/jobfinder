<?php
$server = 'localhost';
$user = 'root';
$db = 'job_users';
$pass = '';

// Establishing connection to the database
$con = mysqli_connect($server, $user, $pass, $db);

// Checking if the connection was successful
if (!$con) {
    die(mysqli_error($con)); // If connection fails, terminate with an error message
}

$showsuc = false;
$showerrr = false;

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $company = $_POST['cname'];
    $hr = $_POST['hr'];
    $title = $_POST['title'];
    $detail = $_POST['detail'];
    $salary = $_POST['salary'];
    $web = $_POST['web'];
    $email = $_POST['email'];
    $cdes = $_POST['cdes'];
    $edu = $_POST['edu'];
    $req = $_POST['req'];
    $loc = $_POST['loc'];
    
    // File upload handling
    $filename = $_FILES['image']['name'];
    $tmpname = $_FILES['image']['tmp_name'];
    $size = $_FILES['image']['size'];
    $destination = "upload/" . $filename;

    // Checking file size
    if ($size <= 2000000) { // Limiting file size to 2MB
        move_uploaded_file($tmpname, $destination); // Moving the uploaded file to the destination folder
        
        // Constructing the SQL query with proper column names
        $sql = "INSERT INTO `job`(`company`, `hr`, `title`, `salary`, `web`, `email`, `description`, `com_description`, `requirement`, `education`, `location`, `img`) 
                VALUES ('$company', '$hr', '$title', '$salary', '$web', '$email', '$detail', '$cdes', '$req', '$edu', '$loc', '$filename')";
        
        // Executing the SQL query
        $res = mysqli_query($con, $sql);

        // Checking if the query was executed successfully
        if ($res) {
            $showsuc = "You just published a new job";
        } else {
            $showerrr = "Something went wrong, sorry buddy: " . mysqli_error($con);
            // Displaying an alert using JavaScript
            echo "<script>alert('$showerrr');</script>";
        }
    } else {
        $showerrr = "Image size should be less than or equal to 2MB.";
        // Displaying an alert using JavaScript
        echo "<script>alert('$showerrr');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Success</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<style>
body {
	font-family: 'Varela Round', sans-serif;
}
.modal-confirm {		
	color: #434e65;
	width: 525px;
}
.modal-confirm .modal-content {
	padding: 20px;
	font-size: 16px;
	border-radius: 5px;
	border: none;
}
.modal-confirm .modal-header {
	background: #47c9a2;
	border-bottom: none;   
	position: relative;
	text-align: center;
	margin: -20px -20px 0;
	border-radius: 5px 5px 0 0;
	padding: 35px;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 36px;
	margin: 10px 0;
}
.modal-confirm .form-control, .modal-confirm .btn {
	min-height: 40px;
	border-radius: 3px; 
}
.modal-confirm .close {
	position: absolute;
	top: 15px;
	right: 15px;
	color: #fff;
	text-shadow: none;
	opacity: 0.5;
}
.modal-confirm .close:hover {
	opacity: 0.8;
}
.modal-confirm .icon-box {
	color: #fff;		
	width: 95px;
	height: 95px;
	display: inline-block;
	border-radius: 50%;
	z-index: 9;
	border: 5px solid #fff;
	padding: 15px;
	text-align: center;
}
.modal-confirm .icon-box i {
	font-size: 64px;
	margin: -4px 0 0 -4px;
}
.modal-confirm.modal-dialog {
	margin-top: 80px;
}
.modal-confirm .btn, .modal-confirm .btn:active {
	color: #fff;
	border-radius: 4px;
	background: #eeb711 !important;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	border-radius: 30px;
	margin-top: 10px;
	padding: 6px 20px;
	border: none;
}
.modal-confirm .btn:hover, .modal-confirm .btn:focus {
	background: #eda645 !important;
	outline: none;
}
.modal-confirm .btn span {
	margin: 1px 3px 0;
	float: left;
}
.modal-confirm .btn i {
	margin-left: 1px;
	font-size: 20px;
	float: right;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
</style>
</head>
<body>
<?php if ($showsuc): ?>
<script>
    // Show the modal when the page loads
    window.onload = function () {
        $('#myModal').modal('show');
    };
</script>
<?php endif; ?>

<!-- Modal HTML -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header justify-content-center">
				<div class="icon-box">
					<i class="material-icons">&#xE876;</i>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body text-center">
				<h4>Great!</h4>	
				<p>Job has been listed succssfully !</p>
				<a href="add_job.php"><button class="btn btn-success"><span>Go Back</span> <i class="material-icons">&#xE5C8;</i></button></a>
			</div>
		</div>
	</div>
</div>     
</body>
</html>
