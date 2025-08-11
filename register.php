<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staff_id = $_POST['staff_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $mobile_number = $_POST['mobile_number'];

    // Check if username already exists
    $check_query = $conn->prepare("SELECT * FROM staff WHERE username = ?");
    $check_query->bind_param("s", $username);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        echo "Username already exists. Please try logging in.";
    } else {
        // Insert new user
        $query = $conn->prepare("INSERT INTO staff (Staff_id, username, password, mobile_number) VALUES (?, ?, ?, ?)");
        $query->bind_param("isss", $staff_id, $username, $password, $mobile_number);

        if ($query->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $query->error;
        }
    }

    $check_query->close();
    $conn->close();
}
?>

<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $query = $conn->prepare("SELECT * FROM staff WHERE username = ? AND password = ?");
    $query->bind_param("ss", $username, $password);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        echo "Login successful! Redirecting to homepage...";
        // Redirect to homepage
        header("Location: home.html");
    } else {
        echo "Invalid username or password.";
    }

    $query->close();
    $conn->close();
}
?>
