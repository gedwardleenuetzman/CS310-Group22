// for student login
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('studentLoginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var username = document.getElementById('inputUsername').value;
        var password = document.getElementById('inputPassword').value;
        console.log('username', username);
        console.log('password', password);

        // Prepare form data using URLSearchParams
        var formData = new URLSearchParams();
        formData.append('inputUsername', username);
        formData.append('inputPassword', password);

        // AJAX request to backend
        fetch('../php/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Check response data for login success
            if (data.success) {
                // Store username in sessionStorage and redirect
                sessionStorage.setItem('username', data.username);
                sessionStorage.setItem('uin', data.uin)
                window.location.href = './student_landing.html';
            } else {
                // If login failed, display the error message
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // Event listener for the registration form
    document.getElementById('studentRegistrationForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Collect form data
        var formData = new URLSearchParams(new FormData(this)); // 'this' refers to the registration form

        // AJAX request to backend for registration
        fetch('../php/registerStudent.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Handle success (e.g., redirecting to login page or displaying a success message)
                console.log(data.message);
                // Optionally redirect to login page or show success message
            } else {
                // Handle error
                console.error(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    document.getElementById('registerButton').addEventListener('click', function() {
        window.open('../components/student_register.html', '_blank'); // Open registration form in a new tab or window
    });
});
