document.addEventListener("DOMContentLoaded", function() {
    fetchProfileData();

    document.getElementById('deactivateBtn').addEventListener('click', function() {
        const UIN = sessionStorage.getItem('uin');
        if (!UIN) {
            alert('No UIN found in session storage.');
            return;
        }
    
        if (confirm('Are you sure you want to deactivate your account?')) {
            fetch('../php/deactivate_student_account.php', { 
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ UIN: UIN })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert('Account successfully deactivated.');
                    window.location.href = "../index.html";
                } else {
                    alert('Failed to deactivate the account.');
                }
            })
            .catch(error => {
                console.error('Error: ', error);
                alert('An error occurred.');
            });
        }
    });

});

function fetchProfileData() {
    // Assuming the session storage has the UIN
    const UIN = sessionStorage.getItem('uin');

    // Call PHP script to get profile data
    fetch(`../php/access_student_profile.php?UIN=${UIN}`)
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // Extracting data from response
            const userData = data.Users;
            const studentData = data.College_Student;

            // Displaying the data
            document.getElementById('firstName').textContent = userData.first_name;
            document.getElementById('lastName').textContent = userData.last_name;
            document.getElementById('grade').textContent = studentData.grade;
            document.getElementById('major').textContent = studentData.major;
        } else {
            console.error('Failed to fetch profile data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
