document.addEventListener("DOMContentLoaded", function() {
  fetch(`/../php/fetch_programs.php`)
    .then(response => response.json())
    .then(data => {
      var programDiv = document.getElementById('programs');

      // Create a table element
      var table = document.createElement('table');
      table.classList.add('program-table');

      // Create table header row
      var headerRow = table.insertRow(0);
      headerRow.innerHTML = '<th>Name</th><th>Description</th><th>Edit</th><th>Delete</th><th>Delete For Real</th><th>Report</th>';

      // Populate the table with program data
      data.forEach(program => {
        var row = table.insertRow();
        var cell1 = row.insertCell(0);
        cell1.innerHTML = program.Name;

        var cell2 = row.insertCell(1);
        cell2.innerHTML = program.Description;

        var cell3 = row.insertCell(2);
        var editButton = document.createElement('button');
        editButton.innerText = 'Edit';
        editButton.addEventListener('click', function() {
          // Edit stuff
        });
        cell3.appendChild(editButton);

        var cell4 = row.insertCell(3);
        var deleteButton = document.createElement('button');
        deleteButton.innerText = 'Delete';
        deleteButton.addEventListener('click', function() {
          fetch(`/../php/delete_program.php?id=${program.Program_Num}`, {
            method: 'DELETE', // Use the DELETE method for deleting records
          })
          .then(response => {
              if (!response.ok) {
                  throw new Error(`HTTP error! Status: ${response.status}`);
              }
              return response.json(); // Assuming your PHP script returns JSON
          })
          .then(data => {
              console.log(data); // Handle the response data as needed
              location.reload();
            })
          .catch(error => {
              console.error('Error:', error);
          });
        });
        cell4.appendChild(deleteButton);

        var cell5 = row.insertCell(4);
        var deletefrfr = document.createElement('button');
        deletefrfr.innerText = 'Delete For Real';
        deletefrfr.addEventListener('click', function() {
          // Delete frfr
        });
        cell5.appendChild(deletefrfr);

        var cell6 = row.insertCell(5);
        var reportButton = document.createElement('button');
        reportButton.innerText = 'View Report';
        reportButton.addEventListener('click', function() {
          // Redirect to report page
        });
        cell6.appendChild(reportButton);
      });

      // Append the table to the programDiv
      programDiv.appendChild(table);
    })
    .catch(error => {
      console.error('Error fetching documents:', error);
    });
});