// Wait until the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Handle form submission via AJAX
    document.getElementById('doctorForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(this); // Get the form data

        // Send the form data using AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'addDoctor.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText); // Parse the JSON response
                if (response.status === "success") {
                    // Show success message as a popup
                    alert(response.message); // You can customize this with a better popup if needed
                    document.getElementById('doctorForm').reset(); // Reset the form fields
                } else {
                    // Show error message as a popup
                    alert(response.message);
                }
            } else {
                // Show a general error message if the AJAX request fails
                alert("An error occurred. Please try again.");
            }
        };
        xhr.send(formData); // Send the form data
    });
});
