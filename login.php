<!-- Php for login modal and database -->
<?php

session_start();

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

$showerr = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $err = "";

    // Check if the keys are set before using them
    $form_username = isset($_POST["uname"]) ? $_POST["uname"] : "";
    $form_password = isset($_POST["password"]) ? $_POST["password"] : "";

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE username=? AND password=?");
    $stmt->bind_param("ss", $form_username, $form_password);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $num = $result->num_rows;

    if ($num) {
        $re = $result->fetch_assoc();
        $user_data = array(
            'user_id' => $re['id'],
            'firstname' => $re['firstname'],
            'lastname' => $re['lastname'],
            'username' => $re['username'],
            'email' => $re['email'],
            'phone' => $re['phone'],
            'instagram' => $re['instagram'],
            'twitter' => $re['twitter'],
            'linkedin' => $re['linkedin']
        );
        $_SESSION['user_data'] = $user_data;

        // Redirect to turf.php after successful login
        header('Location:index.php');
        exit();
    } else {
        $showerr = "Invalid Email / Password";
        $_SESSION['error'] = "Invalid Email / Password";
       
    }
}
?>
<?php
function getInitials($name) {
    $nameParts = explode(' ', $name);
    $initials = '';

    foreach ($nameParts as $part) {
        $initials .= strtoupper(substr($part, 0, 1));
    }
    return $initials;
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign_in.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Job Finder | Login In</title>
</head>

    <body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">

<!----------------------- Login Container -------------------------->

   <div class="row border rounded-5 p-3 bg-white shadow box-area">

<!--------------------------- Left Box ----------------------------->

   <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
      
       <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">JobFinder.</p>
       <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Find Your Dream Job</small>
   </div> 

<!-------------------- ------ Right Box ---------------------------->


   <div class="col-md-6 right-box">
      <div class="row align-items-center">
            <div class="header-text mb-4">
                 <h2>Welcome Back Mate!</h2>
                 <p>We are happy to see you again.</p>
            </div>
            <form method="post" >
              <div class="input-group mb-3">
                <input type="text" id="uname" name="uname" class="form-control form-control-lg bg-light fs-6" placeholder="Username" required>
              </div>
              
              <div class="input-group mb-1">
              <input type="password" id="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" required>
              </div>
              <div class="input-group mb-5 d-flex justify-content-between">
                
              </div>
              <div class="input-group mb-3">
                <button class="btn btn-lg btn-primary w-100 fs-6" type="submit" value="Submit">Sign Up</button>
              </div>
               
          </form>


            <div class="row">
                <small>Dont have a account ?<a href="register.php">Register here</a></small>
            </div>
         
      </div>
   </div> 
   

  </div>
</div>
</body>
    </html>