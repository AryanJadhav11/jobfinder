<?php

if(isset($_POST['btn']))
{
    
    // job Details
    $jobtitle = $_POST['jobtitle'];                
    $company_name = $_POST['company_name'];
    $num_of_people = $_POST['num_of_people'];
    $adLocation = $_POST['adLocation'];
    $jobtype = $_POST['jobtype'];
    $jobdes = $_POST['jobdes'];

    // setting
    $appmethod = $_POST['appmethod'];
    $require_cv = $_POST['require_cv'];
    $appUpdate = $_POST['appUpdate'];
    $app_daedline = $_POST['app_daedline'];
    $rqtimeline = $_POST['rqtimeline'];
    $Exdate = date('Y-m-d', strtotime($_POST['Exdate']));

    // account
    $contact_name = $_POST['contact_name'];
    $contact_num = $_POST['contact_num'];
    $num_of_emp = $_POST['num_of_emp'];

    // Location
    $city_name = $_POST['city_name'];
    $area = $_POST['area'];
    $pincode = $_POST['pincode'];
    $address = $_POST['address'];

    // Database connection
    $conn = new mysqli('localhost','root','','posting');
    if($conn->connection_error){
        die('Connection Fialed : ',$conn->connection_error);
    }else{
        $stmt = $conn->prepare("insert into jobposting(jobtitle, company_name, num_of_people, adLocation, jobtype, jobdes, appmethod, require_cv, appUpdate, app_daedline, rqtimeline, Exdate, contact_name, contact_num, num_of_emp, city_name,area,pincode,address)
            values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssss ssssss sis ssis", $jobtitle,$company_name,$num_of_people,$adLocation,$jobtype,$jobdes,$appmethod,$require_cv,$appUpdate,$app_daedline,$rqtimeline,$Exdate,$contact_name,$contact_num,$num_of_emp,$city_name,$area,$pincode,$address);
        $stmt->execute();
        echo "saved to database...";
        $stmt->close();
        $conn->close();
    }

}
?>