document.addEventListener("DOMContentLoaded", function() {
    // Hardcoded user data
    var users = [
        {
            name: "John Doe",
            email: "johndoe@example.com",
            role: "Administrator",
            address: "1234 Street, City",
            phoneNumber: "123-456-7890"
        }
        // More hardcoded users can be added here
    ];

    var usersTable = document.getElementById('usersTable');
    users.forEach(user => {
        var row = usersTable.insertRow();
        row.innerHTML = `
            <td>${user.name}</td>
            <td>${user.email}</td>
            <td>${user.role}</td>
            <td>${user.address}</td>
            <td>${user.phoneNumber}</td>
            <td>
                <button class="btn btn-primary btn-sm">Modify</button>
                <button class="btn btn-warning btn-sm">Soft Delete</button>
                <button class="btn btn-danger btn-sm">Hard Delete</button>
            </td>
        `;
    });

    // Event listener for Add User button
    document.getElementById('addUserBtn').addEventListener('click', function() {
        // Logic to add a new user
    });

    // Add event listeners for Modify, Soft Delete, Hard Delete buttons
    // ...
});
