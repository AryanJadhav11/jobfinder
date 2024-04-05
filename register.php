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
                    header("Location:index.php");
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
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/registrations/registration-4/assets/css/registration-4.css">
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
<!-- Registration 4 - Bootstrap Brain Component -->
<section class="p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="card border-light-subtle shadow-sm">
      <div class="row g-0">
        <div class="col-12 col-md-6">
          <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="https://img.freepik.com/free-photo/people-working-late-their-office_23-2149006079.jpg?w=360" alt="BootstrapBrain Logo">
        </div>
        <div class="col-12 col-md-6">
          <div class="card-body p-3 p-md-4 p-xl-5">
            <div class="row">
              <div class="col-12">
                <div class="mb-5">
                  <h2 class="h3">Registration</h2>
                  <h3 class="fs-6 fw-normal text-secondary m-0">Enter your details to register</h3>
                </div>
              </div>
            </div>
            <form method="post">
              <div class="row gy-3 gy-md-4 overflow-hidden">
                <div class="col-12">
                  <label for="fname" class="form-label">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" required>
                </div>
                <div class="col-12">
                  <label for="lname" class="form-label">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" required>
                </div>
                <div class="col-12">
                  <label for="uname" class="form-label">Username <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="uname" id="uname" placeholder="Username" required>
                </div>
                <div class="col-12">
                  <label for="mail" class="form-label">Email <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" name="mail" id="mail"  placeholder="name@gmail.com" value="" required>
                </div>
                <div class="col-12">
                  <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" name="phone" id="phone" value="" required>
                </div>
                <div class="col-12">
                  <label for="insta" class="form-label">Instagram Handle<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="insta" id="insta" value="" required>
                </div>
                <div class="col-12">
                  <label for="twitter" class="form-label">Twitter Handle<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="twitter" id="twitter" value="" required>
                </div>
                <div class="col-12">
                  <label for="linkedin" class="form-label">Linked In Handle<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="linkedin" id="linkedin" value="" required>
                </div>
                <div class="col-12">
                  <label for="password" class="form-label">Set Password<span class="text-danger">*</span></label>
                  <input type="password" class="form-control" name="password" id="twitter" value="" required>
                </div>
                <div class="col-12">
                  <label for="cpassword" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                  <input type="password" class="form-control" name="cpassword" id="cpassword" value="" required>
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" name="iAgree" id="iAgree" required>
                    <label class="form-check-label text-secondary" for="iAgree">
                      I agree to the <a href="#!" class="link-primary text-decoration-none">terms and conditions</a>
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn bsb-btn-xl btn-primary" type="submit" value="submit">Sign up</button>
                  </div>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-12">
                <hr class="mt-5 mb-4 border-secondary-subtle">
                <p class="m-0 text-secondary text-center">Already have an account? <a href="login.php" class="link-primary text-decoration-none">Log in</a></p>
              </div>
            </div>
           
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

   
</body>
</html>
