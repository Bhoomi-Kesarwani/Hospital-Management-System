<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'hospital_management');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $doctor_id = $_POST['doctor_id'];

    $sql = "SELECT doctor_name, category, subcategory FROM doctor WHERE doctor_id = '$doctor_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'doctor_name' => $row['doctor_name'],
            'category' => $row['category'],
            'subcategory' => $row['subcategory']
        ]);
    } else {
        echo json_encode(['success' => false]);
    }

    $conn->close();
}
?>
