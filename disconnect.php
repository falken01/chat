<?php
//session_start();
require_once('connect.php');
if(isset($_GET['idRozmowy']))
$idRozmowy = $_GET['idRozmowy'];
$idOsoby = $_GET['id'];
$conn = mysqli_connect($host, $db_user, $db_pass, $db_name);
$query = mysqli_query($conn, "DELETE FROM `wiadomosci` WHERE idOsoby='$idOsoby'");
$res =  mysqli_query($conn, "UPDATE `metadane_rozmowy` SET `IloscOsobWRozmowie` = 0  WHERE `idRozmowy` = '$idRozmowy'");
if($res){
if($query)
{
  $query = mysqli_query($conn, "DELETE FROM `wszyscy_userzy` WHERE id='$idOsoby'");
  if($query){
    $query = mysqli_query($conn, "DELETE FROM `metadane_rozmowy` WHERE idRozmowy='$idRozmowy'");
    if($query)
    {
    //  session_unset();
      header("Location:./index.php");
    }
    else {
    echo "err code: 3";
  //  session_unset();
    header("Location:./index.php");
  }
  }else {
  echo "err code: 2";
//  session_unset();
  header("Location:./index.php");
}
} else {
echo "err code: 1";
echo "err code: 2";
//session_unset();
header("Location:./index.php");
}
}
?>
