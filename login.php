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
