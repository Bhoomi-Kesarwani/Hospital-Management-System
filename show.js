
document.getElementById('show-button').addEventListener('click', function () {
    const appointmentId = document.getElementById('appointment-id').value;

    if (!appointmentId) {
        alert('Please enter an appointment ID');
        return;
    }

    fetch(`fetch_appointment.php?appointment_id=${appointmentId}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('result').innerHTML = data;
        })
        .catch(error => {
            console.error('Error fetching appointment details:', error);
        });
});
