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
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/registrations/registration-5/assets/css/registration-5.css">
    <title>Job Finder | Login In</title>
</head>

    <body>
     

    <section class="p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="card border-light-subtle shadow-sm">
      <div class="row g-0">
        <div class="col-12 col-md-6 text-bg-primary">
          <div class="d-flex align-items-center justify-content-center h-100">
            <div class="col-10 col-xl-8 py-3">
              <img class="img-fluid rounded mb-4" loading="lazy" src="https://img.freepik.com/free-vector/telecommuting-home-concept_23-2148496608.jpg?w=740" width="245" height="80" alt="BootstrapBrain Logo">
              <hr class="border-primary-subtle mb-4">
              <h2 class="h1 mb-4">Unlock Your Career Potential</h2>
              <p class="lead m-0">Welcome to JobFinder, where opportunities meet ambition. Log in to explore a world of job possibilities tailored just for you. Your dream career awaits!</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="card-body p-3 p-md-4 p-xl-5">
            <div class="row">
              <div class="col-12">
                <div class="mb-5">
                  <h2 class="h3">Welcome Back Mate !</h2>
                  <h3 class="fs-6 fw-normal text-secondary m-0">Enter your credentials</h3>
                </div>
              </div>
            </div>
            <form method="post">
              <div class="row gy-3 gy-md-4 overflow-hidden">
                <div class="col-12">
                  <label for="firstName" class="form-label">Username<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="uname" id="uname" placeholder="Username" required>
                </div>
                <div class="col-12">
                  <label for="lastName" class="form-label">Password<span class="text-danger">*</span></label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                </div>
              
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn bsb-btn-xl btn-primary" type="submit">Sign up</button>
                  </div>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-12">
                <hr class="mt-5 mb-4 border-secondary-subtle">
                <p class="m-0 text-secondary text-center">Already have an account? <a href="#!" class="link-primary text-decoration-none">Sign in</a></p>
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
