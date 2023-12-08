document.addEventListener("DOMContentLoaded", function() {
    fetch('../php/fetch_student_applications.php') // PHP script that returns user data from the database
    .then(response => response.json())
    .then(apps => {
        var appsTable = document.getElementById('appsTable');
        apps.forEach(app => {
            var row = appsTable.insertRow();
            row.innerHTML = `
                <td>${app.App_Num}</td>
                <td>${app.Program_Num}</td>
                <td>${app.UIN}</td>
                <td>${app.Uncom_Cert}</td>
                <td>${app.Com_Cert}</td>
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