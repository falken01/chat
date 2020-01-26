<?php

//  if(isset($_POST['message']));
  //{
    session_start();
    require_once('connect.php');
    $conn = mysqli_connect($host, $db_user, $db_pass, $db_name);
    $messageFromUser = $_POST['message'];
    $messageFromUser = mysqli_real_escape_string($conn, trim($messageFromUser));
    $idRozmowy = $_SESSION['idRozmowy'];
    $idOsoby = $_SESSION['id'];
    $messageFromUser = htmlentities($messageFromUser, ENT_QUOTES);
    $stmt = mysqli_stmt_init($conn);
    $sql = "INSERT INTO `wiadomosci` (`idWiadomosci`, `idRozmowy`, `idOsoby`, `wiadomosc`) VALUES( NULL, ?, ?, ?)";
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "zjebało się :/";
    } else {
      mysqli_stmt_bind_param($stmt, "sss", $idRozmowy, $idOsoby,$messageFromUser);
      mysqli_stmt_execute($stmt);
      $sql = "SELECT * FROM `metadane_rozmowy` WHERE idRozmowy = ?";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql))
      {
        echo "Sql stmt fail";
      } else {
        mysqli_stmt_bind_param($stmt, "i", $idRozmowy);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
      //$result = mysqli_query($conn,"SELECT * FROM `metadane_rozmowy` WHERE idRozmowy = '$idRozmowy'");
        $row = $result -> fetch_assoc();
        if($idOsoby == $row['idPierwszejOsoby'])
        {
          $res = mysqli_query($conn, "UPDATE `metadane_rozmowy` SET `ifFirstPersonIsTyping` = 0 WHERE `idRozmowy` = '$idRozmowy'");
        } else if ( $idOsoby == $row['idDrugiejOsoby'])
        {
          $res = mysqli_query($conn, "UPDATE `metadane_rozmowy` SET `ifSecondPersonIsTyping` = 0 WHERE `idRozmowy` = '$idRozmowy'");
        }
      }

    }
//} else {
//  header("Location: czat.php");
//}
  //$result = mysqli_query($conn, "INSERT INTO `wiadomosci` (`idWiadomosci`, `idRozmowy`, `idOsoby`, `wiadomosc`) VALUES (NULL, '$idRozmowy', '$idOsoby', '$messageFromUser');");
 ?>
