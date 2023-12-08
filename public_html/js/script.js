document.addEventListener("DOMContentLoaded", function() {
    fetch('/../php/fetch_admin_users.php') // PHP script that returns user data from the database
    .then(response => response.json())
    .then(users => {
        var usersTable = document.getElementById('usersTable');
        users.forEach(user => {
            var row = usersTable.insertRow();
            row.innerHTML = `
                <td>${user.First_Name}</td>
                <td>${user.M_Initial}</td>
                <td>${user.Last_Name}</td>
                <td>${user.Username}</td>
                <td>${user.Email}</td>
                <td>${user.Discord_Name}</td>
                <td>
                    <button class="btn btn-primary btn-sm">Modify</button>
                    <button class="btn btn-warning btn-sm">Soft Delete</button>
                    <button class="btn btn-danger btn-sm">Hard Delete</button>
                </td>
            `;
        });
    })
    .catch(error => {
        console.error('Error fetching users:', error);
    });
});


document.getElementById('registerBtn').onclick = function(event) {
    event.preventDefault();
    document.getElementById('registerModal').style.display = 'block';
};

document.getElementsByClassName('close')[0].onclick = function() {
    document.getElementById('registerModal').style.display = 'none';
};

window.onclick = function(event) {
    if (event.target == document.getElementById('registerModal')) {
        document.getElementById('registerModal').style.display = 'none';
    }
};

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
        fetch('../php/student_login.php', {
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
                sessionStorage.setItem('username', username);
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
