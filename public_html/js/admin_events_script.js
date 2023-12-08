document.addEventListener("DOMContentLoaded", function() {
    fetch('../php/fetch_admin_events.php') // PHP script that returns user data from the database
    .then(response => response.json())
    .then(events => {
        var eventsTable = document.getElementById('usersTable');
        events.forEach(user => {
            var row = eventsTable.insertRow();
            row.innerHTML = `
                <td>${event.Event_Type}</td>
                <td>${event.Location}</td>
                <td>${event.Start_Date}</td>
                <td>${event.Start_Time}</td>
                <td>${event.Event_ID}</td>
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
