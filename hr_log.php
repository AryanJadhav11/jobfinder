<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_users";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_username = isset($_POST["email"]) ? $_POST["email"] : "";
    $form_password = isset($_POST["password"]) ? $_POST["password"] : "";

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM `hr` WHERE hr_mail=? AND password=?");

    if ($stmt === false) {
        die("Error preparing query: " . $conn->error);
    }

    $stmt->bind_param("ss", $form_username, $form_password);

    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $stmt->close();

    $num = $result->num_rows;

    if ($num > 0) {
        // Fetch the first row of the result as an associative array
        $re = $result->fetch_assoc();

        // Print the fetched data for debugging
        print_r($re);

        // Store user data in the session
        $company_data = array(
            'user_id' => $re['id'],
            'company' => $re['company'],
            'hr' => $re['hr'],
            'email' => $re['hr_email'],
        );
        $_SESSION['company_data'] = $company_data;

        // Redirect to the dashboard or another page
        header('Location: hr_panel.php');
        exit();
    } else {
        $_SESSION['error'] = "Invalid Email / Password";
        echo "<script>alert('Invalid Email / Password')</script>";
    }
}
?>
