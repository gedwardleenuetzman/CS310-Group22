document.addEventListener("DOMContentLoaded", function() {
    // Fetch Classes
    fetch('../php/admin_progress.php?entity=classes')
        .then(response => response.json())
        .then(classes => {
            var classesTable = document.getElementById('classesTable');
            classes.forEach(classItem => {
                var row = classesTable.insertRow();
                row.innerHTML = `
                    <td>${classItem.Class_ID}</td>
                    <td>${classItem.Name}</td>
                    <td>${classItem.Description}</td>
                    <td>${classItem.Type}</td>
                `;
            });
        })
        .catch(error => {
            console.error('Error fetching classes:', error);
        });

    // Fetch Certifications
    fetch('../php/admin_progress.php?entity=certifications')
        .then(response => response.json())
        .then(certifications => {
            var certificationsTable = document.getElementById('certificationsTable');
            certifications.forEach(certification => {
                var row = certificationsTable.insertRow();
                row.innerHTML = `
                    <td>${certification.Cert_ID}</td>
                    <td>${certification.Level}</td>
                    <td>${certification.Name}</td>
                    <td>${certification.Description}</td>
                `;
            });
        })
        .catch(error => {
            console.error('Error fetching certifications:', error);
        });

    // Fetch Internships
    fetch('../php/admin_progress.php?entity=internships')
        .then(response => response.json())
        .then(internships => {
            var internshipsTable = document.getElementById('internshipsTable');
            internships.forEach(internship => {
                var row = internshipsTable.insertRow();
                row.innerHTML = `
                    <td>${internship.Intern_ID}</td>
                    <td>${internship.Name}</td>
                    <td>${internship.Description}</td>
                    <td>${internship.Is_Gov}</td>
                `;
            });
        })
        .catch(error => {
            console.error('Error fetching internships:', error);
        });
});