<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_management";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the Appointment ID from the form
    $appointment_id = intval($_POST["appointment_id"]);

    // SQL query to delete the appointment
    $sql = "DELETE FROM appointments WHERE appointment_id = ?";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_id);

    // Execute the statement
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Appointment deleted successfully!'); window.location.href='delete_appointment.html';</script>";
        } else {
            echo "<script>alert('Appointment ID not found!'); window.location.href='delete_appointment.html';</script>";
        }
    } else {
        echo "<script>alert('Error deleting appointment!'); window.location.href='delete_appointment.html';</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

