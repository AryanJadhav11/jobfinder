<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_username = isset($_POST["email"]) ? $_POST["email"] : "";
    $form_password = isset($_POST["password"]) ? $_POST["password"] : "";

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT id, company, hr, hr_mail, password FROM `hr` WHERE hr_mail=?");
    if ($stmt === false) {
        die("Error preparing query: " . $conn->error);
    }

    $stmt->bind_param("s", $form_username);

    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $stmt->close();

    // Check if user exists
    if ($result->num_rows > 0) {
        $re = $result->fetch_assoc();
        // Verify password
        if ($form_password === $re['password']) { // Comparing plain text passwords
            // Store user data in the session
            $company_data = array(
                'user_id' => $re['id'],
                'company' => $re['company'],
                'hr' => $re['hr'],
                'email' => $re['hr_email'],
            );
            $_SESSION['company_data'] = $company_data;

            // Redirect to the HR panel
            header('Location: hr_panel.php');
            exit();
        } else {
            $_SESSION['error'] = "Invalid Email / Password";
            header('Location: hr_login.php'); // Redirect back to login page
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid Email / Password";
        header('Location: hr_login.php'); // Redirect back to login page
        exit();
    }
}
?>
