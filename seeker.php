<?php

  session_start();

  require_once('connect.php');
  $conn = mysqli_connect($host, $db_user, $db_pass, $db_name);
  $idRozmowy = $_GET['idRozmowy'];
  $resUser = mysqli_query($conn, "SELECT * FROM `metadane_rozmowy` WHERE idRozmowy = '$idRozmowy'");
  $row = $resUser -> fetch_assoc();
  $idDrugiejOsoby = $row['idDrugiejOsoby'];
  $amountOfPplinConv  = $row['IloscOsobWRozmowie'];
  if($idDrugiejOsoby != 0 )
  {
      if($row['IloscOsobWRozmowie'] == 0)
      {
        echo "<p class='lead'>Rozmówca się rozłączył</p><script>$('#sendMess, #message').attr('disabled');</script>";
      }  else {
      echo "<h5>Połączono z rozmówcą. Przywitaj się!<br /></h5><script>$('#sendMess, #message, #disconnect').removeAttr('disabled');</script>";
      $result = mysqli_query($conn,"SELECT wiadomosci.wiadomosc, wszyscy_userzy.nickname FROM `wiadomosci`, `wszyscy_userzy` WHERE wiadomosci.idRozmowy ='$idRozmowy' AND wiadomosci.idOsoby = wszyscy_userzy.id ");
      while(list($mess,$nick)=mysqli_fetch_row($result))
      {
        echo "<b>".$nick.": </b>".$mess."<br />";
      }
    }
  } else {
    //zwróć nic
    if($row['IloscOsobWRozmowie'] == 0)
    {
      echo "<p class='lead'>Rozmówca się rozłączył</p><script>$('#sendMess, #message, #disconnect').removeAttr('disabled');</script>";

    } else {
    echo "Oczekiwanie na wolnego rozmówcę";
    }

  //  echo json_encode($i);
  }

 ?>
