document.addEventListener('DOMContentLoaded', function () {
    // Attach an event listener to the form
    document.getElementById('adminRegistrationForm').addEventListener('submit', function (e) {
        // Prevent the default form submission
        e.preventDefault();

        // Create FormData object from the form
        var formData = new FormData(this);
        var storedUIN = sessionStorage.getItem("uin");

        if (storedUIN) {
            formData.append('existingUIN', storedUIN);
        }

        // Send the data using fetch to the student_register.php
        fetch('../php/admin_register.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Log the response data
            // Handle success - redirect the user
            alert(data.message)
            window.location.href = './admin_login_page.html'
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle errors here, such as displaying a message to the user
        });
    });
});
