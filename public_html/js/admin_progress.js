document.addEventListener("DOMContentLoaded", function() {
    // Fetch Class Enrollments
    fetch('../php/admin_progress.php?entity=class_enrollment')
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
                `;
            });
        })
        .catch(error => {
            console.error('Error fetching class enrollments:', error);
        });

    // Fetch Cert Enrollments
    fetch('../php/admin_progress.php?entity=cert_enrollment')
        .then(response => response.json())
        .then(certEnrollments => {
            var certEnrollmentsTable = document.getElementById('certEnrollmentsTable');
            certEnrollments.forEach(certEnrollment => {
                var row = certEnrollmentsTable.insertRow();
                row.innerHTML = `
                    <td>${certEnrollment.CertE_Num}</td>
                    <td>${certEnrollment.UIN}</td>
                    <td>${certEnrollment.Cert_ID}</td>
                    <td>${certEnrollment.Status}</td>
                    <td>${certEnrollment.Training_Status}</td>
                    <td>${certEnrollment.Program_Num}</td>
                    <td>${certEnrollment.Semester}</td>
                    <td>${certEnrollment.YEAR}</td>
                `;
            });
        })
        .catch(error => {
            console.error('Error fetching cert enrollments:', error);
        });

    // Fetch Intern Apps
    fetch('../php/admin_progress.php?entity=intern_app')
        .then(response => response.json())
        .then(internApps => {
            var internAppsTable = document.getElementById('internAppsTable');
            internApps.forEach(internApp => {
                var row = internAppsTable.insertRow();
                row.innerHTML = `
                    <td>${internApp.IA_Num}</td>
                    <td>${internApp.UIN}</td>
                    <td>${internApp.Intern_ID}</td>
                    <td>${internApp.Status}</td>
                    <td>${internApp.Year}</td>
                `;
            });
        })
        .catch(error => {
            console.error('Error fetching intern apps:', error);
        });
});
