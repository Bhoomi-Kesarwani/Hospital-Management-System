<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "hospital_management";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctorCategory = $_POST['doctorCategory'];
    $doctorSubCategory = $_POST['doctorSubCategory'];

    
    if (empty($doctorCategory) || empty($doctorSubCategory)) {
        echo "<p style='color:red;'>Please select both category and subcategory.</p>";
    } else {
        
        $sql = "SELECT doctor_id, doctor_name, category, subcategory, preferable_fees, start_timing_for_appointment, end_timing_for_appointment 
                FROM doctor 
                WHERE category = ? AND subcategory = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $doctorCategory, $doctorSubCategory);
        $stmt->execute();
        $result = $stmt->get_result();

        
        if ($result->num_rows > 0) {
            
            echo "<table border='1' style='width:100%; margin-top:20px; text-align:center;'>";
            echo "<tr>
                    <th>Doctor ID</th>
                    <th>Doctor Name</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Preferable Fees</th>
                    <th> Appointment Start Timing </th>
                    <th>Appointment End Timing</th>
                  </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['doctor_id']}</td>
                        <td>{$row['doctor_name']}</td>
                        <td>{$row['category']}</td>
                        <td>{$row['subcategory']}</td>
                        <td>{$row['preferable_fees']}</td>
                        <td>{$row['start_timing_for_appointment']}</td>
                        <td>{$row['end_timing_for_appointment']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='color:red;'>No doctors found matching your criteria.</p>";
        }
    }
}


$conn->close();
?>