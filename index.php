<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="resources/js/jquery-3.4.1.min.js" charset="utf-8"></script>
    <script src="resources/bootstrap-4/js/bootstrap.js" charset="utf-8"></script>
    <link rel="stylesheet" href="resources/bootstrap-4/css/bootstrap.css">
    <link rel="stylesheet" href="resources/css/master.css">
  </head>
  <body>
    <?php
      session_start();

      if (isset($_SESSION['user_id'])) {
        include 'views/masterpage.php';
      } else {
        include 'views/login.php';
      }
      // echo md5('asdf');
      ?>
  </body>
</html>
