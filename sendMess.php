<?php

//  if(isset($_POST['message']));
  //{
    session_start();
    require_once('connect.php');
    $conn = mysqli_connect($host, $db_user, $db_pass, $db_name);
    $messageFromUser = $_POST['message'];
    $messageFromUser = mysqli_real_escape_string($conn, trim($messageFromUser));
    $idRozmowy = $_GET['idRozmowy'];
    $idOsoby = $_GET['id'];
    $messageFromUser = htmlentities($messageFromUser, ENT_QUOTES);
    $stmt = mysqli_stmt_init($conn);
    $sql = "INSERT INTO `wiadomosci` (`idWiadomosci`, `idRozmowy`, `idOsoby`, `wiadomosc`) VALUES( NULL, ?, ?, ?)";
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "zjebało się :/";
    } else {
      mysqli_stmt_bind_param($stmt, "sss", $idRozmowy, $idOsoby,$messageFromUser);
      mysqli_stmt_execute($stmt);
    }
//} else {
//  header("Location: czat.php");
//}
  //$result = mysqli_query($conn, "INSERT INTO `wiadomosci` (`idWiadomosci`, `idRozmowy`, `idOsoby`, `wiadomosc`) VALUES (NULL, '$idRozmowy', '$idOsoby', '$messageFromUser');");
 ?>
