<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_management";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST request has doctor_id
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['doctor_id'])) {
    $doctor_id = intval($_POST['doctor_id']); // Sanitize input

    // Query to fetch doctor details and appointments
    $sql = "SELECT doctor_name, subcategory, patient_name, appointment_date 
            FROM appointments 
            WHERE doctor_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch doctor details
        $details = $result->fetch_assoc();
        $doctor_name = $details['doctor_name'];
        $subcategory = $details['subcategory'];

        echo "<h3>Doctor Name: $doctor_name</h3>";
        echo "<h4>Subcategory: $subcategory</h4>";
        echo "<h4>Appointments:</h4><ul>";

        // Reset result pointer and loop through all patients
        $result->data_seek(0);
        $patient_count = 0;

        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row['patient_name'] . " - " . $row['appointment_date'] . "</li>";
            $patient_count++;
        }

        echo "</ul>";
        echo "<h4>Total Patients: $patient_count</h4>";
    } else {
        // No records found for the given doctor_id
        echo "<p>No appointments found for Doctor ID $doctor_id.</p>";
    }

    $stmt->close();
} else {
    echo "<p>Invalid request. Please provide a valid Doctor ID.</p>";
}


$conn->close();
?>
