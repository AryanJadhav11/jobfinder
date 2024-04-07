<?php

$server = 'localhost';
$user = 'root';
$db = 'job_users';
$pass = '';

$coni = mysqli_connect($server, $user, $pass, $db);

if (!$coni) {
    die(mysqli_error($coni));
}
include('smtp/PHPMailerAutoload.php');

function smtp_mailer($to, $subject, $message) {
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    // Retrieve the request ID
    $id = $_POST['id'];

    // Retrieve the specific request from the database
    $sql = "SELECT * FROM applications WHERE id = $id";
    $result = mysqli_query($coni, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $requestData = mysqli_fetch_assoc($result);

        // Insert data into turf_owner table
        $uniquePassword =substr(md5(uniqid()), 0, 8);


        $sqlpro = "INSERT INTO `employee` (`id`, `company` , `firstname`, `lastname`, `email`, `address`, `qualification`, `tech_skills`, `resume`, `city`, `zip`, `gender`, `phoneno`, `resumelink`)  
                   VALUES (NULL, '{$requestData['firstname']}', '{$requestData['lastname']}', '{$requestData['email']}', '{$requestData['address']}', '{$requestData['qualification']}', '{$requestData['tech_skills']}', '{$requestData['resume']}', '{$requestData['city']}', '{$requestData['zip']}', '{$requestData['gender']}', '{$requestData['phoneno']}', '{$requestData['resumelink']}', '{$uniquePassword}')";
        
        $quepro = mysqli_query($coni, $sqlpro);

        if ($quepro) {
            // Send approval email to the owner
            $to = $requestData['email'];
            $subject = 'Your Application has been approved';
            $message = "Hey, {$requestData['firstname']}, your application for {$requestData['title']} in {$requestData['company']} has been approved. ";
            $result = smtp_mailer($to, $subject, $message);
          
        

            // Remove the request from the pending_requests table
            $sqlDelete = "DELETE FROM applications WHERE id = $id";
            $resultDelete = mysqli_query($coni, $sqlDelete);

            if ($resultDelete) {
                // Redirect back to the confirmation page
                header('Location: hr_panel.php');
                exit;
            } else {
                echo "Error.";
            }
        } else {
            echo "Error inserting data into  table: " . mysqli_error($coni);
        }
    } else {
        echo "Invalid request ID or request not found.";
    }
}

mysqli_close($coni);
?>

