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
                sessionStorage.setItem('uin', data.UIN)
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
});
