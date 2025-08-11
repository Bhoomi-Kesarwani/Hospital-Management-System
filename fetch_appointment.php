<?php
if (isset($_GET['appointment_id'])) {
    $appointmentId = intval($_GET['appointment_id']);

    
    $conn = new mysqli('localhost', 'root', '', 'hospital_management');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $sql = "SELECT * FROM appointments WHERE appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointmentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $appointment = $result->fetch_assoc();
        echo "<h3>Appointment Detail</h3>";
        echo "<p><strong>Appointment ID:</strong> " . $appointment['appointment_id'] . "</p>";
        echo "<p><strong>Patient Name:</strong> " . $appointment['patient_name'] . "</p>";
        echo "<p><strong>Patient Phone Number:</strong> " . $appointment['phone_number'] . "</p>";
        echo "<p><strong>Patient Age:</strong> " . $appointment['age'] . "</p>";
        echo "<p><strong>Patient Address:</strong> " . $appointment['address'] . "</p>";
        echo "<p><strong>Doctor ID:</strong> " . $appointment['doctor_id'] . "</p>";
        echo "<p><strong>Doctor Name:</strong> " . $appointment['doctor_name'] . "</p>";
        echo "<p><strong>Category:</strong> " . $appointment['category'] . "</p>";
        echo "<p><strong>Subcategory:</strong> " . $appointment['subcategory'] . "</p>";
        echo "<p><strong>Appointment Date:</strong> " . $appointment['appointment_date'] . "</p>";
        echo "<p><strong>Appointment Time:</strong> " . $appointment['appointment_time'] . "</p>";
        echo "<p><strong> Appointment Created At:</strong> " . $appointment['created_at'] . "</p>";
    } else {
        echo "<p>No appointment found with ID $appointmentId</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
