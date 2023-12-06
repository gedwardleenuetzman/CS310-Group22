<!DOCTYPE html>
<html>
  <head>
    <title>Admin Users Page</title>
    <!-- Include Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
  </head>
  <body>
    <?php include('../components/admin_navbar.php'); ?> <!-- Include the navbar component -->

    <div class="container mt-5">
      <div class="row mb-3">
        <div class="col">
          <button id="addUserBtn" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add New User
          </button>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <table class="table">
            <thead>
              <tr>
                <th>First Name</th>
                <th>Middle Initial</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Discord Username</th>
              </tr>
            </thead>
            <tbody id="usersTable">
              <!-- User data will be inserted here -->
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Include Bootstrap JS and FontAwesome for icons -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../js/script.js"></script>
    <!-- Your custom JavaScript -->
  </body>
</html>