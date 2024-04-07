<?php
include('smtp/PHPMailerAutoload.php');
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
if(isset($_GET['id'])) {
  $blid=$_GET['id'];
  $sql9="SELECT * FROM `job` WHERE id='$blid';";
  $res9=mysqli_query($coni,$sql9);
  $row9=mysqli_fetch_assoc($res9);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $company= isset($_POST['company']) ? $_POST['company'] : ''; 
    $emaill = isset($_POST['emaill']) ? $_POST['emaill'] : ''; 
    $web = isset($_POST['web']) ? $_POST['web'] : ''; 
  
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sendmail'])) {



    // Get form data
    $userid = isset($_SESSION['user_data']['id']) ? $_SESSION['user_data']['id'] : 0;

    $company_name = isset($_POST['company_name']) ? $_POST['company_name'] : ''; 
    $comp_email = isset($_POST['comp_email']) ? $_POST['comp_email'] : ''; 
    $comp_web = isset($_POST['comp_web']) ? $_POST['comp_web'] : ''; 
   
    $company = isset($_POST['company']) ? $_POST['company'] : ''; 
    $title = isset($_POST['title']) ? $_POST['title'] : ''; 
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
    $resumelink = isset($_POST['resumelink']) ? $_POST['resumelink'] : '';
    $resume = isset($_FILES['resume']['name']) ? $_FILES['resume']['name'] : '';

    // Check if all required fields are filled out
    $required_fields = array('firstname', 'lastname', 'email', 'phone_no', 'address', 'city', 'zip', 'qualification', 'techskill', 'gender');
    $missing_fields = array();
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $missing_fields[] = $field;
        }
    }

    // If any required field is missing, display an alert and stop form submission
    if (!empty($missing_fields)) {
        $missing_fields_str = implode(', ', $missing_fields);
        echo "<script>alert('Please fill out all fields before proceeding to submission. Missing fields: $missing_fields_str');</script>";
        return;
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO `applications`(`id`,`company` , `title`, `firstname`, `lastname`, `email`, `address`, `qualification`, `tech_skills`, `resume`, `city`, `zip`, `gender`, `phoneno`, `resumelink`) 
    VALUES ('$userid', '$company', '$title', '$firstname', '$lastname', '$email', '$address', '$qualification', '$techskill', '$resume', '$city', '$zip', '$gender', '$phone_no', '$resumelink')";

    if ($coni->query($sql) === TRUE) {

      function smtp_mailer($to, $subject, $message, $resume) {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Username = "jadhavaryan467@gmail.com";
        $mail->Password = "oozzyqfwnpufjuqi";
        $mail->SetFrom("jadhavaryan467@gmail.com");
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->addAttachment('upload/'. $resume);
        $mail->AddAddress($to);
        $mail->SMTPOptions = array('ssl' => array( 
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => false
        ));
        
        if (!$mail->Send()) {
            return $mail->ErrorInfo;
        } else {
            return 'Sent';
        }
      }
        // Email notification
        $to = ''. $comp_email ; // Change this to your email address
        $subject = 'New Job Application';
        $message = '<p>Dear HR Team,</p>';
        $message .= '<p>A new job application has been submitted. Below are the details of the applicant:</p>';
        $message .= '<ul>';
        $message .= '<li><h4><strong>Compant Name:</strong> ' . $company_name . '</h4></li>';
        $message .= '<li><h4><strong>Company Email:</strong> ' . $comp_email . '</h4></li>';
        $message .= '<li><h4><strong>Company Web:</strong> ' . $comp_web . '</h4></li>';
        $message .= '<hr>'; // Optional: Add a horizontal line for visual separation
        $message .= '<li><strong>First Name:</strong> ' . $firstname . '</li>';
        $message .= '<li><strong>Last Name:</strong> ' . $lastname . '</li>';
        $message .= '<li><strong>Email:</strong> ' . $email . '</li>';
        $message .= '<li><strong>Phone No:</strong> ' . $phone_no . '</li>';
        $message .= '<li><strong>Address:</strong> ' . $address . '</li>';
        $message .= '<li><strong>City:</strong> ' . $city . '</li>';
        $message .= '<li><strong>Zip:</strong> ' . $zip . '</li>';
        $message .= '<li><strong>Qualification:</strong> ' . $qualification . '</li>';
        $message .= '<li><strong>Technical Skills:</strong> ' . $techskill . '</li>';
        $message .= '<li><strong>Gender:</strong> ' . $gender . '</li>';
        $message .= '<li><strong>Resume:</strong> ' . $resume . '</li>';
        $message .= '<li><strong>Resume Link:</strong> ' . $resumelink . '</li>';
        $message .= '</ul>';
        $message .= '<p>Please review the applicant\'s details and take necessary action.</p>';
        $message .= '<p>Regards,<br>JobFinder</p>';
        $message .= '<hr>'; // Optional: Add a horizontal line for visual separation
        $message .= '<p><strong>Company Overview:</strong></p>';
        $message .= '<p>JobFinder is a leading online platform dedicated to helping job seekers find employment opportunities with their favorite companies. Our platform provides a user-friendly interface and powerful search tools to streamline the job search process.</p>';
        $message .= '<p>With JobFinder, users can easily browse through a wide range of job listings, filter by industry, location, and other criteria, and apply directly to positions that match their skills and experience. Whether you re a recent graduate looking for your first job or an experienced professional seeking new career opportunities, JobFinder has something for everyone.</p>';
        $message .= '<p>We partner with top companies across various industries to bring you the latest job openings and career opportunities.  Our goal is to connect talented individuals with reputable employers and facilitate successful job placements.</p>';
        $message .= '<p>Join JobFinder today and take the next step towards your dream job!</p>';
        $message .= '<p><strong>Contact Information:</strong></p>';
        $message .= '<p>jobfinder@gmail.com</p>'; 
    
        $result = smtp_mailer($to, $subject, $message, $resume);

        $usto = 'yashnikam070@gmail.com'; // Change this to your email address
        $subject = 'A Applicant Applied for a Job to --' . $company_name . '-- through JobFinder, Hr mail ' . $comp_email;
        $message = '<p><strong>Dear JobFinder Team,</strong></p>';
        $message .= '<p>A new job application has been submitted through JobFinder. Below are the details of the Company:</p><br>'; // Here's the missing semicolon
        $message .= '<li><h4><strong>Compant Name:</strong> ' . $company_name . '</h4></li>';
        $message .= '<li><h4><strong>Company Email:</strong> ' . $comp_email . '</h4></li>';
        $message .= '<li><h4><strong>Company Web:</strong> ' . $comp_web . '</h4></li>';
        $message .= '<hr>'; // Optional: Add a horizontal line for visual separation
        $message .= "<p>A new job application has been submitted through JobFinder. Below are the details of the applicant:</p>
                    <ul>
                        <li><strong>First Name:</strong> $firstname</li>
                        <li><strong>Last Name:</strong> $lastname</li>
                        <li><strong>Email:</strong> $email</li>
                        <li><strong>Phone No:</strong> $phone_no</li>
                        <li><strong>Address:</strong> $address</li>
                        <li><strong>City:</strong> $city</li>
                        <li><strong>Zip:</strong> $zip</li>
                        <li><strong>Qualification:</strong> $qualification</li>
                        <li><strong>Technical Skills:</strong> $techskill</li>
                        <li><strong>Gender:</strong> $gender</li>
                        <li><strong>Resume Link:</strong> $resumelink</li>
                    </ul>
                    <p>Please review the applicant's details and take necessary action.</p>
                    <p>Regards,<br>JobFinder</p>";     
        $usresult = smtp_mailer($usto, $subject, $message, $resume);

        $applito = ''. $email;
        $subject = 'Mail Send To '. $company_name .' through JobFinder.';
        $message = "<p><strong>Dear $firstname $lastname,</strong></p>
                    <p>Your application for the position at $company_name has been successfully submitted through JobFinder. Here are the details you provided:</p>
                    <hr>
                    <p>We have received your application and will review it shortly. If your qualifications match our requirements, we will contact you for further steps in the recruitment process.</p>
                    <p>Thank you for choosing JobFinder for your job search.</p>
                    <p>Regards,<br>JobFinder Team</p>";
        
        $appliresult = smtp_mailer($applito, $subject, $message, $resume);

        if ($result === 'Sent' && $usresult === 'Sent' && $appliresult === 'Sent') {
            echo "<script> alert('Email sent successfully') </script>.";
        } else {
            echo "<script> alert('Failed to send email:') </script> " . $result;
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
  <!-- fetch data from job_details.php  -->
<input type="hidden" class="form-control" id="company_name" name="company_name" value="<?php echo $company; ?>" readonly>
<input type="hidden" class="form-control" id="comp_email" name="comp_email" value="<?php echo $emaill; ?>" readonly>
<input type="hidden" class="form-control" id="comp_web" name="comp_web" value="<?php echo $web; ?>" readonly>

<div class="form-row">
<div class="form-group col-md-6">
      <label for="firstname">Applying for</label>
      <input type="text" class="form-control" id="company" name="company" value="<?= ucfirst($row9['company']) ?>" readonly>
    </div>
    <div class="form-group col-md-6">
      <label for="firstname">Applying for</label>
      <input type="text" class="form-control" id="title" name="title" value="<?= ucfirst($row9['title']) ?>" readonly>
    </div>
  <div class="form-group col-md-6">
      <label for="firstname">First Name</label>
      <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" require>
    </div>
    <div class="form-group col-md-6">
      <label for="lastname">Last Name</label>
      <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" require>
    </div>
  
    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Email" require>
    </div>
    <div class="form-group col-md-6">
      <label for="phone_no">Phone No</label>
      <input type="number" class="form-control" id="phone_no" name="phone_no" placeholder="Phone No." require>
    </div>
</div>

<div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" id="address" name="address" placeholder="Address" require>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="city">City</label>
      <input type="text" class="form-control" id="city" name="city" placeholder="City" require>
    </div>
    <div class="form-group col-md-2">
      <label for="zip">Zip</label>
      <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip Code" require>
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
      <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Qualification" require>
    </div>
    <div class="form-group col-md-6">
      <label for="techskill">Technical Skills</label>
      <input type="text" class="form-control" id="techskill" name="techskill" placeholder="Technical Skills">
    </div>
    <div class="form-group col-md-4">
    <label for="resume">Upload Resume</label>
    <input type="file" class="form-control-file" id="resume" name="resume">
  </div>
  <div class="form-group col-md-4">
      <label for="resumelink">Resume Link</label>
      <input type="text" class="form-control" id="resumelink" name="resumelink" placeholder="Google Drive Link Resume">
    </div>
</div>

<button type="submit" id="sendmail" name="sendmail" class="btn btn-primary">Submit</button>
</form>
</div>

</body>    