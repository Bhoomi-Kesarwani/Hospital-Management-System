<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'hospital_management');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect form data
    $patient_name = $_POST['patient_name'];
    $age = $_POST['age'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];

    // Fetch doctor's appointment times
    $sql = "SELECT start_timing_for_appointment, end_timing_for_appointment FROM Doctor WHERE doctor_id = '$doctor_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $start_time = $row['start_timing_for_appointment'];
        $end_time = $row['end_timing_for_appointment'];

        // Check for the next available time slot
        $check_sql = "SELECT MAX(appointment_time) AS last_time FROM appointments 
                      WHERE doctor_id = '$doctor_id' AND appointment_date = '$appointment_date'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            $check_row = $check_result->fetch_assoc();
            $last_time = $check_row['last_time'];

            // Determine next available slot
            $next_time = $last_time ? date('H:i:s', strtotime('+15 minutes', strtotime($last_time))) : $start_time;

            if ($next_time <= $end_time) {
                // Book the appointment
                $sql = "INSERT INTO appointments 
                        (patient_name, age, phone_number, address, email, doctor_id, doctor_name, category, subcategory, appointment_date, appointment_time)
                        VALUES 
                        ('$patient_name', '$age', '$phone_number', '$address', '$email', '$doctor_id', 
                        (SELECT doctor_name FROM Doctor WHERE doctor_id = '$doctor_id'), 
                        (SELECT category FROM Doctor WHERE doctor_id = '$doctor_id'), 
                        (SELECT subcategory FROM Doctor WHERE doctor_id = '$doctor_id'), 
                        '$appointment_date', '$next_time')";

                if ($conn->query($sql) === TRUE) {
                    echo "Appointment booked successfully! Appointment ID: " . $conn->insert_id . ", Time: $next_time";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                // No available slots
                echo "No appointment slots are empty, please select another time.";
            }
        }
    } else {
        echo "Doctor not found!";
    }

    $conn->close();
}
?>