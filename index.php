<?php
    require_once('connect.php');
    $conn = mysqli_connect($host, $db_user, $db_pass, $db_name);
  //  session_id("sesjaNr".uniqid());
    session_start();
 ?>

<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="index.css" type="text/css" >
  </head>
  <body>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12" id="enterNick">
          <h2>Witaj. Wprowadź swój nick</h2>
          <form action="wpis.php" method="post">
            <input id="nickname" type="text" name="nick">
            <input id="subNazwa" type="submit">
          </form>
        </div>
      </div>
              <?php
                  if(isset($_SESSION['blad']))
                  {
                    echo "<div class='row align-items-center'>
                            <div class='col-12'>
                              <div class='alert alert-danger' role='alert'>";
                                echo $_SESSION['blad'];
                                unset($_SESSION['blad']);
                        echo "</div>
                          </div>
                        </div>";
                  }
               ?>
            </div>
          </div>
      </div>
  </body>
</html>
