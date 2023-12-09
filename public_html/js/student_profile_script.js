document.addEventListener("DOMContentLoaded", function() {
    fetchProfileData();
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
