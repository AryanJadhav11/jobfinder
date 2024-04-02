<?php

$showalert = false;
$showerr = false;
$showcharerr = false;

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_db";

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
    $exists = false;

    // Reset error messages
    $showalert = false;
    $showerr = false;
    $showcharerr = false;

    // check existing user
    $existque = "SELECT * FROM users WHERE username='$username';";
    $result = mysqli_query($conn, $existque);
    $numrows = mysqli_num_rows($result);

    if ($numrows > 0) {
        $showerr = "Account already exists";
    } else {
        if (validateUsername($username)) {
            if ($password == $cpassword) {
                $sql = "INSERT INTO users (firstname, lastname, username, email, password)
              VALUES ('$firstname', '$lastname', '$username', '$email', '$password')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    // Successfully inserted, set session and redirect
                    $user_data = array($firstname, $lastname, $username, $email);
                    $_SESSION['user_data'] = $user_data;
                    header("Location: index.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
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
	




    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" id="fname" name="fname" class="form-control form-control-lg bg-light fs-6" placeholder="First Name" required>
                            </div>

                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" id="lname" name="lname" class="form-control form-control-lg bg-light fs-6" placeholder="Last Name" required>
                            </div>

                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" id="uname" name="uname" class="form-control form-control-lg bg-light fs-6" placeholder="Select Username" required>
                            </div>


                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" id="mail" name="mail" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" required>
                            </div>

                            


                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" id="password" name="password" class="form-control form-control-lg bg-light fs-6 mb-2" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" id="cpassword" name="cpassword" class="form-control form-control-lg bg-light fs-6" placeholder="Confirm Password" required>
                            </div>
                            

                         
                              <div class="input-group mb-5 d-flex justify-content-between">
                                
                              </div>
                                                        
                            <div class="form-group form-button">
                               
                                <button class="btn btn-lg btn-primary w-100 fs-6" type="submit" onclick="signup()" value="Submit"> Sign Up</button>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="signin1.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

    

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

    
<script>
  function signup1(){
    window.location.href='index.php';
  }
</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>