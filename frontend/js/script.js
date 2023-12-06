document.addEventListener("DOMContentLoaded", function() {
    fetch('fetch_users.php') // PHP script that returns user data from the database
    .then(response => response.json())
    .then(users => {
        var usersTable = document.getElementById('usersTable');
        users.forEach(user => {
            var row = usersTable.insertRow();
            row.innerHTML = `
                <td>${user.First_Name}</td>
                <td>${user.M_Initial}</td>
                <td>${user.Last_Name}</td>
                <td>${user.Username}</td>
                <td>${user.Email}</td>
                <td>${user.Discord_Name}</td>
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

document.getElementById('registerBtn').onclick = function() {
    document.getElementById('registerModal').style.display = 'block';
};

document.getElementsByClassName('close')[0].onclick = function() {
    document.getElementById('registerModal').style.display = 'none';
};

window.onclick = function(event) {
    if (event.target == document.getElementById('registerModal')) {
        document.getElementById('registerModal').style.display = 'none';
    }
};
