<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpMailer/src/Exception.php';
require './phpMailer/src/PHPMailer.php';
require './phpMailer/src/SMTP.php';

include('header.php');

// Database connection
$server = 'localhost';
$user = 'root';
$db = 'job_users';
$pass = '';

$coni = mysqli_connect($server, $user, $pass, $db);

if (!$coni) {
    die(mysqli_error($coni));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $userid = isset($_SESSION['user_data']['id']) ? $_SESSION['user_data']['id'] : 0;
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : ''; 
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone_no = isset($_POST['phone_no']) ? $_POST['phone_no'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $zip = isset($_POST['zip']) ? $_POST['zip'] : '';
    $qualification = isset($_POST['qualification']) ? $_POST['qualification'] : '';
    $techskill = isset($_POST['techskill']) ? $_POST['techskill'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $resume = isset($_FILES['resume']['tmp_name']) ? $_FILES['resume']['tmp_name'] : '';

    // Check if the uploaded file is a PDF
    $file_type = $_FILES['resume']['type'];
    if ($file_type != 'application/pdf') {
        echo "Only PDF files are allowed.";
        exit;
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO `applications`(`id`, `firstname`, `lastname`, `email`, `address`, `qualification`, `tech_skills`, `resume`, `city`, `zip`, `gender`, `phoneno`) 
    VALUES ('$userid', '$firstname', '$lastname', '$email', '$address', '$qualification', '$techskill', '$resume', '$city', '$zip', '$gender', '$phone_no')";

    if ($coni->query($sql) === TRUE) {
        // Email sending
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jadhavaryan467@gmail.com'; // SMTP username
            $mail->Password   = 'oozzyqfwnpufjuqi'; // SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('jadhavaryan467@gmail.com', 'yash');
            $mail->addAddress($email); // Add a recipient

            // Attachments
            $mail->addAttachment($resume); // Add attachment

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Job Application';
            $mail->Body    = 'Thank you for your application.';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($coni);
    }

    // Close the database connection
    mysqli_close($coni);
}
?>



<html class="no-js" lang="zxx">
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
         <title>Job Finder</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

		<!-- CSS here -->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="assets/css/flaticon.css">
            <link rel="stylesheet" href="assets/css/price_rangs.css">
            <link rel="stylesheet" href="assets/css/slicknav.css">
            <link rel="stylesheet" href="assets/css/animate.min.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/themify-icons.css">
            <link rel="stylesheet" href="assets/css/slick.css">
            <link rel="stylesheet" href="assets/css/nice-select.css">
            <link rel="stylesheet" href="assets/css/style.css">

<body>

<div class="container p-5 pt-5 mt-10">
<h2>Job Application Form</h2>
<form id="appliform" method="post" enctype="multipart/form-data">
<div class="form-row">
  <div class="form-group col-md-6">
      <label for="firstname">First Name</label>
      <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
    </div>
    <div class="form-group col-md-6">
      <label for="lastname">Last Name</label>
      <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
    </div>
  
    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="phone_no">Phone No</label>
      <input type="number" class="form-control" id="phone_no" name="phone_no" placeholder="Phone No.">
    </div>
</div>

<div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
</div>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="city">City</label>
      <input type="text" class="form-control" id="city" name="city" placeholder="City">
    </div>
    <div class="form-group col-md-2">
      <label for="zip">Zip</label>
      <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip Code">
    </div> 
    <div class="form-group col-md-4">
      <label for="gender">Gender</label>
      <select id="gender" name="gender" class="form-control">
        <option selected>Male</option>
        <option>Female</option>
        <option>Other</option>
      </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="qualification">Qualification</label>
      <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Qualification">
    </div>
    <div class="form-group col-md-6">
      <label for="techskill">Technical Skills</label>
      <input type="text" class="form-control" id="techskill" name="techskill" placeholder="Technical Skills">
    </div>
    <div class="form-group col-md-4">
    <label for="resume">Upload Resume</label>
    <input type="file" class="form-control-file" id="resume" name="resume">
  </div>
</div>

<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>    