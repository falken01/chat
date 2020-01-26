<?php
session_start();
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="czat.css" type="text/css">
  </head>
  <body>
    <script>
      $('document').ready(function(){
        var c = 0;
        $('#sendMess').click(function(){
          var message = $("#message").val();
          if(message == "")
          {
            alert("Napisz coś");
            return false;
          } else {
              $.ajax ({
                url:"sendMess.php",
                method:"POST",
                data: {message:message},
                success: function (res) {
                  c--;
                  console.log(c);
                  $('#message').val("");
                }
            });
          }
        });

        $("#message").keydown(function(){
          if(c == 0) {
          $.ajax ({
            url:"pisze.php",
            method:"POST",
            success: function (res) {
                c++;
              }
            });
          } else {
            console.log("EEe");
          }
          });

        window.addEventListener("beforeunload", function (e) {
              $.ajax ({
                url:"disconnect.php",
                method:"POST",
                success: function (res) {

                }
            });
          });
          $('input[type=text]').on('keydown', function(key) {
            if (key.which == 13) {
              var message = $("#message").val();
              if(message == "")
              {
                alert("Napisz coś");
                return false;
              } else {
                  $.ajax ({
                    url:"sendMess.php",
                    method:"POST",
                    data: {message:message},
                    success: function (res) {
                      c--;
                      console.log(c);
                      $('#message').val("");
                    }
                });
              }
            }
          });
        });
    </script>
    <div class="container">
        <div class="card">
          <div class="card-header">
            Czat app ;D
          </div>
          <div id="data1" class="card-body">

          </div>
          <i></i>
      </div>
      <div class="row">
          <div id="butts" class="col-12">
            <input disabled type="text" class="form-control" id="message" placeholder="Wprowadź wiadomość">
            <input disabled type="submit" value="Prześlij" id="sendMess" class="btn btn-success">
            <form method="post" action="disconnect.php">
              <input  type="submit" id="disconnect" value="Rozłącz" class="btn btn-danger">
            </form>
          </div>
        </div>
      </div>
    <script>
      setInterval(function() {
          $('#data1').load("seeker.php");
        }, 500);
    </script>
  </body>
</html>
