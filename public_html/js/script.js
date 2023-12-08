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
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var username = document.getElementById('inputUsername').value;
        var password = document.getElementById('inputPassword').value;
        
        // AJAX request to backend
        
        fetch('../php/student_login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.json())
        .then(data => {
            // Handle response here (e.g., redirect or show error)
            sessionStorage.setItem('username', username);
            window.location.href = './student_landing.html';
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    fetch('/../php/fetch_events.php') // PHP script that returns user data from the database
    .then(response => response.json())
    .then(users => {
        var eventsTable = document.getElementById('eventsTable');
        events.forEach(event => {
            var row = eventsTable.insertRow();
            row.innerHTML = `
                <td>${event.Event_ID}</td>
                <td>${event.Program_Num}</td>
                <td>${event.Start_Date}</td>
                <td>${event.Location}</td>
                <td>${event.Event_Type}</td>
                <td>
                    <button class="btn btn-primary btn-sm">Modify</button>
                    <button class="btn btn-warning btn-sm">Soft Delete</button>
                    <button class="btn btn-danger btn-sm">Hard Delete</button>
                </td>
            `;
        });
    })
    .catch(error => {
        console.error('Error fetching events:', error);
    });
});
