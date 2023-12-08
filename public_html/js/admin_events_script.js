document.addEventListener("DOMContentLoaded", function() {
    fetch('../php/fetch_admin_events.php') // PHP script that returns user data from the database
    .then(response => response.json())
    .then(events => {
        var eventsTable = document.getElementById('usersTable');
        users.forEach(user => {
            var row = eventsTable.insertRow();
            row.innerHTML = `
                <td>${user.Event_Type}</td>
                <td>${user.Location}</td>
                <td>${user.Start_Date}</td>
                <td>${user.Start_Time}</td>
                <td>${user.Event_ID}</td>
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
