<?php

     //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_POST['send']))
    {
        $des = $_POST['description'];
        $email =$_POST['email'];

       

//Load Composer's autoloader
require 'phpMailer/Exception.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'bajujadhav18@gmail.com';                     //SMTP username
    $mail->Password   = 'azxm ynxd ayht czyd';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('bajujadhav17@gmail.com', 'Mailer');
    $mail->addAddress('bajujadhav18@gmail.com', 'website');     //Add a recipient
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'contact form';
    $mail->Body    = "from email - $email <br> Massage - $des";
    
    $mail->send();
    echo "<p class='sended'>Massage sended to portals email</p>";
} catch (Exception $e) {
    echo "<p class='alert'>Massage couldn't send</p>";
}
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>help_center</title>
    <link rel="stylesheet" href="Doc/css/help_center.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <form action="" method="Post">
    <div class="wrapper">
        <div class="container">
            <div class="background">
                <img src="Doc/Img/istockphoto-1093553650-612x612.jpg">
            </div>

            <div class="content">
                <h1>Help <span class="span1">Centre</span></h1>

                <div class="logos">
                    <span>
                        <a href="">
                            <img src="Doc/Img/email.ico" alt="" id="logo1" height="45px">
                        </a>
                    </span>
                    <span>
                        <a href="">
                            <img src="Doc/Img/phone.ico" alt="" id="logo2" height="45px">
                        </a>
                    </span>
                </div>

                <p>What issues are you experiencing...?</p>

                <div class="name">
                    <input class="email" name="email" placeholder="your email." required></input>
                </div>

                <div class="name">
                    <textarea class="text-area" name="description" id="" cols="40" rows="10" placeholder="Tell us about your issues..."></textarea>
                </div>

                <div class="button">
                    <button name="send">SUBMIT</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    
</body>
</html>

