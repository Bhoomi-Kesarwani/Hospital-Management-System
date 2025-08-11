<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "hospital_management"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //  get form data
    $doctorName = $conn->real_escape_string($_POST['doctorName']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $qualification = $conn->real_escape_string($_POST['qualification']);
    $preferableFees = $conn->real_escape_string($_POST['Fees']);
    $category = $conn->real_escape_string($_POST['category']);
    $subcategory = $conn->real_escape_string($_POST['subcategory']);
    $start_timing = $conn->real_escape_string($_POST['start_timing']);
    $end_timing = $conn->real_escape_string($_POST['end_timing']);

    // Insert data into the database
    $sql = "INSERT INTO doctor (doctor_name, category, subcategory, phone_no, qualification, preferable_fees, start_timing_for_appointment,  end_timing_for_appointment)
            VALUES ('$doctorName', '$category', '$subcategory', '$phone', '$qualification', '$preferableFees', '$start_timing','$end_timing')";


     if($conn->query($sql)===TRUE){
        echo "New Doctor Details Added Successfully ";

     }
     else{
     echo "Error :".$sql."<br>".$conn->error;
}
}

$conn->close();
?>
