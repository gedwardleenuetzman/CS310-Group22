// Attach the event listener to the form
document.getElementById('editUserForm').addEventListener('submit', handleFormSubmit);

document.addEventListener("DOMContentLoaded", function() {
    fetch('../php/fetch_admin_users.php') // PHP script that returns user data from the database
    .then(response => response.json())
    .then(users => {
        var usersTable = document.getElementById('usersTable');
        users.forEach(user => {
            var row = usersTable.insertRow();
            row.innerHTML = `
                <td>${user.UIN}</td>
                <td>${user.First_Name}</td>
                <td>${user.M_Initial}</td>
                <td>${user.Last_Name}</td>
                <td>${user.Username}</td>
                <td>${user.Email}</td>
                <td>${user.Discord_Name}</td>
                <td>${user.Can_Access}</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-uid="${user.UIN}">Modify</button>
                    <button class="btn btn-warning btn-sm" data-uid="${user.UIN}">Soft Delete</button>
                    <button class="btn btn-danger btn-sm" data-uid="${user.UIN}">Hard Delete</button>
                </td>
            `;
        });

        // Add event listeners to buttons after they are created
        document.querySelectorAll('.btn-primary').forEach(button => {
            button.addEventListener('click', function(event) {
                var userId = event.target.getAttribute('data-uid')
                modifyUser(userId);
            });
        });

        // Add event listeners for Soft Delete buttons
        document.querySelectorAll('.btn-warning').forEach(button => {
            button.addEventListener('click', function(event) {
                var userId = this.previousElementSibling.getAttribute('data-uid'); // Assuming this is the Modify button with the UIN
                softDeleteUser(userId);
            });
        });

        // Add event listeners for Hard Delete buttons
        document.querySelectorAll('btn-danger').forEach(button => {
            button.addEventListener('click'), function(event) {
                var userId = this.previousElementSibling.getAttribute('data-uid');
                hardDeleteUser(userId);
            }
        });

    })
    .catch(error => {
        console.error('Error fetching users:', error);
    });
});

function modifyUser(userId) {
    fetch('../php/fetch_admin_user_data.php?UIN=' + userId)
    .then(response => response.json())
    .then(user => {
        // Assuming 'user' is the object with the user's data
        document.getElementById('editUIN').value = user.UIN;
        document.getElementById('editFirstName').value = user.First_Name;
        document.getElementById('editMiddleInitial').value = user.M_Initial;
        document.getElementById('editLastName').value = user.Last_Name;
        document.getElementById('editUsername').value = user.Username;
        document.getElementById('editEmail').value = user.Email;
        document.getElementById('editDiscordName').value = user.Discord_Name;
        document.getElementById('editCanAccess').value = user.Can_Access;

        $('#editUserModal').modal('show');
    })
    .catch(error => {
        console.error('Error fetching user details:', error);
    });
}

// Function to handle form submission
function handleFormSubmit(event) {
    event.preventDefault(); // Prevent default form submission

    var formData = new FormData(event.target); // Gather form data

    fetch('../php/modify_admin_user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        // Handle success - e.g., close modal, show a success message, refresh user list...
        $('#editUserModal').modal('hide');
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle error - e.g., show error message to the user
    });
}

function softDeleteUser(userId) {
    if (confirm('Are you sure you want to soft delete this user?')) {
        fetch('../php/admin_user_soft_delete.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'UIN=' + userId
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            // Optionally, update the UI to reflect the change
            location.reload();

        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

function hardDeleteUser(userId) {
    if (confirm('Are you sure you want to hard delete this user?')) {
        fetch('../php/admin_user_hard_delete.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'UIN=' + userId
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            // Optionally, update the UI to reflect the change
            location.reload();

        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}
