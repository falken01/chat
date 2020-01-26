<?php
session_start();
require_once('connect.php');
$conn = mysqli_connect($host, $db_user, $db_pass, $db_name);
$idRozmowy = $_SESSION['idRozmowy'];
$myId = $_SESSION['id'];
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
if($row['idPierwszejOsoby'] == $myId) {
    $res = mysqli_query($conn, "UPDATE `metadane_rozmowy` SET `ifFirstPersonIsTyping` = 1 WHERE `idRozmowy` = '$idRozmowy'");

} else if($row['idDrugiejOsoby'] == $myId) {
    $res = mysqli_query($conn, "UPDATE `metadane_rozmowy` SET `ifSecondPersonIsTyping` = 1 WHERE `idRozmowy` = '$idRozmowy'");
  }
}
 ?>
