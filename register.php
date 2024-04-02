<?php

$showalert = false;
$showerr = false;
$showcharerr = false;

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_users";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function validateUsername($username)
{
    return preg_match('/^[a-zA-Z]+$/', $username);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $err = "";

    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $username = $_POST["uname"];
    $email = $_POST["mail"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $phone= $_POST["phone"];
    $insta=$_POST["insta"];
    $twitter=$_POST["twitter"];
    $linkedin=$_POST["linkedin"];
    $exists = false;

    // Reset error messages
    $showalert = false;
    $showerr = false;
    $showcharerr = false;

    // check existing user
    $existque = "SELECT * FROM `users` WHERE username='$username';";
    $result = mysqli_query($conn, $existque);
    $numrows = mysqli_num_rows($result);

    if ($numrows > 0) {
        $showerr = "Account already exists";
    } else {
        if (validateUsername($username)) {
            if ($password == $cpassword) {
                $sql = "INSERT INTO `users` (`firstname`, `lastname`, `username`, `email`, `password`, `phone`, `instagram`, `twitter`, `linkedin`)
              VALUES ('$firstname', '$lastname', '$username', '$email', '$password', '$phone', '$insta', '$twitter', '$linkedin')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    // Successfully inserted, set session and redirect
                    $user_data = array($firstname, $lastname, $username, $email);
                    $_SESSION['user_data'] = $user_data;
                    header("Location:login.php");
                    exit();
                } else {
                    $showerr = "Error: " . $sql . "<br>" . $conn->error;
                    
                }
            } else {
                $showerr = "Passwords do not match";
            }
        } else {
            $showcharerr = "Username invalid! Your username should consist only of letters.";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign_in.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Job Finder | Sign Up</title>
</head>


<body>


<?php 
	
	if($showcharerr)
	{
		echo '
	<div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
  <strong>Oops!</strong>'.$showcharerr.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
  </div>';
		
	}
	
	
	elseif($showalert)
	{
	echo '
	<div class="alert alert-success" role="alert">
  Success ! <a href="user.php" class="alert-link">Now you can log in</a>.
</div>
	';
	}
	
	elseif($showerr)
	{
	echo '
	<div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
  <strong>Went Wrong</strong>'.$showerr.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
  </div>';
	}
  ?>
	



    <!----------------------- Main Container -------------------------->

     <div class="container d-flex justify-content-center align-items-center min-vh-100">

    <!----------------------- Login Container -------------------------->

       <div class="row border rounded-5 p-3 bg-white shadow box-area">

    <!--------------------------- Left Box ----------------------------->

       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
           <div class="featured-image mb-3">
            <img src="" class="img-fluid" style="width: 250px;">
           </div>
           <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">JobFinder.</p>
           <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Find Your Dream Job</small>
       </div> 

    <!-------------------- ------ Right Box ---------------------------->

    
       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-4">
                     <h2>Hello!</h2>
                     <p>We are happy to have you with us.</p>
                </div>
                <form method="post" >
                  <div class="input-group mb-3">
                    <input type="text" id="fname" name="fname" class="form-control form-control-lg bg-light fs-6" placeholder="First Name" required>
                  </div>
                  <div class="input-group mb-3">
                  <input type="text" id="lname" name="lname" class="form-control form-control-lg bg-light fs-6" placeholder="Last Name" required>
                  </div>
                  <div class="input-group mb-3">
                  <input type="text" id="uname" name="uname" class="form-control form-control-lg bg-light fs-6" placeholder="Select Username" required>
                  </div>
                  <div class="input-group mb-3">
                  <input type="email" id="mail" name="mail" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" required>
                  </div>
                  <div class="input-group mb-3">
                  <input type="number" id="phone" name="phone" class="form-control form-control-lg bg-light fs-6" placeholder="Phone Number" required>
                  </div>
                  <div class="input-group mb-3">
                  <input type="text" id="insta" name="insta" class="form-control form-control-lg bg-light fs-6" placeholder="insta" required>
                  </div>
                  <div class="input-group mb-3">
                  <input type="text" id="twitter" name="twitter" class="form-control form-control-lg bg-light fs-6" placeholder="twitter" required>
                  </div>
                  <div class="input-group mb-1">
                  <input type="text" id="linkedin" name="linkedin" class="form-control form-control-lg bg-light fs-6 mb-2" placeholder="linkedin" required>
                  </div>
                  <div class="input-group mb-1">
                  <input type="password" id="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Enter Password" required>
                  </div>
                  <div class="input-group mb-1">
                  <input type="password" id="cpassword" name="cpassword" class="form-control form-control-lg bg-light fs-6" placeholder="Confirm Password" required>
                  </div>
                  <div class="input-group mb-5 d-flex justify-content-between">
                    
                  </div>
                  <div class="input-group mb-3">
                    <button class="btn btn-lg btn-primary w-100 fs-6" type="submit" value="Submit">Sign Up</button>
                  </div>
                   
              </form>


                <div class="row">
                    <small>Already have an account? <a href="login.php">Log In</a></small>
                </div>
             
          </div>
       </div> 
       

      </div>
    </div>

</body>
</html>
