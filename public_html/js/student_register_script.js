document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('studentRegistrationForm').addEventListener('submit', function(event) {
        event.preventDefault();
        // Fetch values from the form
        var username = document.getElementById('registerUsername').value;
        var password = document.getElementById('registerPassword').value;

        // Prepare data for sending to the server
        var formData = new URLSearchParams();
        formData.append('registerUsername', username);
        formData.append('registerPassword', password);

        // AJAX request to insert new user into the database
        fetch('../php/register.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response (e.g., account creation success or failure)
            // Redirect or display messages as necessary
            alert(data.message);
            window.location.href = './student_login_page.html';
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
