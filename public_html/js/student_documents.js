// Get student UIN from cache
var studentUIN = sessionStorage.getItem('uin');

document.addEventListener("DOMContentLoaded", function() {
  fetch(`/../php/fetch_student_documents.php?uin=${studentUIN}`)
    .then(response => response.json())
    .then(data => {
      var documentDiv = document.getElementById('documents');

      data.forEach(program => {
        // Create an h2 element for the program name
        var programHeading = document.createElement('h2');
        programHeading.textContent = program;

        // Create a table for documents
        var table = document.createElement('table');
        table.border = '1';

        // Create table header row
        var headerRow = table.insertRow();
        var typeHeader = headerRow.insertCell(0);
        var linkHeader = headerRow.insertCell(1);
        var editHeader = headerRow.insertCell(2);
        var deleteHeader = headerRow.insertCell(3);

        typeHeader.textContent = 'Document Type';
        linkHeader.textContent = 'Link';
        editHeader.textContent = 'Edit';
        deleteHeader.textContent = 'Delete';

        // Iterate through documents and populate the table
        programDocs.forEach(doc => {
          var row = table.insertRow();
          var typeCell = row.insertCell(0);
          var linkCell = row.insertCell(1);
          var editCell = row.insertCell(2);
          var deleteCell = row.insertCell(3);

          typeCell.textContent = doc.Doc_Type;
          linkCell.innerHTML = `<a href="${doc.Link}" target="_blank">${doc.Link}</a>`;
          
          // Edit button
          var editButton = document.createElement('button');
          editButton.textContent = 'Edit';
          editButton.addEventListener('click', function() {
            console.log('Edit clicked for Doc_Num:', doc.Doc_Num);

            let newLink = prompt('Enter new link:', doc.Link);
            if (newLink == null || newLink == '') return;
            
            fetch(`/update_document.php?uin=${studentUIN}&id=${doc.Doc_Num}&link=${encodeURIComponent(newLink)}`)
            .then(response => {
              if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
              }
            })
            .then(data => {
              location.reload();
            })
            .catch(error => {
              console.error('Error:', error);
            });
          });
          editCell.appendChild(editButton);

          // Delete button
          var deleteButton = document.createElement('button');
          deleteButton.textContent = 'Delete';
          deleteButton.addEventListener('click', function() {
            console.log('Delete clicked for Doc_Num:', doc.Doc_Num);

            // Delete the document from the database
            fetch(`/../php/delete_student_documents.php?uin=${studentUIN}&id=${doc.Doc_Num}`)
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
          deleteCell.appendChild(deleteButton);
        });

        // Append program heading and table to the documents div
        documentDiv.appendChild(programHeading);
        documentDiv.appendChild(table);
      });
    })
    .catch(error => {
      console.error('Error fetching documents:', error);
    });
});