<!DOCTYPE html>
<html>
  <head>
    <title>Admin Redirect</title>
    <style>
      .button {
        width: 200px;
        height: 100px;
        font-size: 20px;
        margin: 10px;
      }
    </style>
  </head>
  <body>
    <?php include('../components/admin_navbar.php'); ?>
    <!-- Include the navbar component -->
    <div style="text-align: center; margin-top: 50px">
      <a href="/admin_events.php">
        <button class="button">Events</button>
      </a>
      <a href="/admin_login_page.php">
        <button class="button">Login</button>
      </a>
      <a href="/admin_programs.php">
        <button class="button">Programs</button>
      </a>
      <a href="/admin_progress.php">
        <button class="button">Progress</button>
      </a>
      <a href="/admin_users.php">
        <button class="button">Users</button>
      </a>
    </div>
  </body>
</html>