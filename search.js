function searchDoctors() {
    const category = document.getElementById("doctorCategory").value;
    const subcategory = document.getElementById("doctorSubCategory").value; // Corrected: Added subcategory input field
    let timing = document.getElementById("doctorTiming").value;
    const resultDiv = document.getElementById("searchResult");

    // Check if both fields are filled
    if (!category || !timing) {
        resultDiv.textContent = "Please select a category and enter the timing.";
        return;
    }

    // Ensure that the timing input ends with :00 (seconds)
    if (timing.length === 5) { // e.g., 10:30 (HH:MM format)
        timing = timing + ":00"; // Add the seconds part
    }

    // AJAX request to fetch doctor data from PHP backend
    fetch(`searchDoctor.php?category=${category}&subcategory=${subcategory}&timing=${encodeURIComponent(timing)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.length > 0) {
                const doctorNames = data.map(doc => `${doc.name}: ${doc.timing}`).join('<br>');
                resultDiv.innerHTML = `Doctors Available:<br>${doctorNames}`;
            } else {
                resultDiv.textContent = "No doctors found for the selected category and timing.";
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            resultDiv.textContent = "An error occurred while fetching the data.";
        });
}
