document.addEventListener("DOMContentLoaded", function() {
    fetch('../php/admin_progress.php') // PHP script that returns user data from the database
    .then(response => response.json())
    .then(enrollments => {
        var enrollmentsTable = document.getElementById('enrollmentsTable');
        enrollments.forEach(enrollment => {
            var row = enrollmentsTable.insertRow();
            row.innerHTML = `
                <td>${enrollment.CE_Num}</td>
                <td>${enrollment.UIN}</td>
                <td>${enrollment.Class_ID}</td>
                <td>${enrollment.Status}</td>
                <td>${enrollment.Semester}</td>
                <td>${enrollment.Year}</td>
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
