<?php

  session_start();
  if(isset($_POST['nick']))
  {
    require_once('connect.php');
    $conn = mysqli_connect($host, $db_user, $db_pass, $db_name);
    $nick = $_POST['nick'];
    $nick = mysqli_real_escape_string($conn, trim($nick));
    $nick  = htmlentities($nick, ENT_QUOTES);
    if($nick == "" || $nick == " ")
    {
      $_SESSION['blad'] = "Wprowadź prawidłowy nick";
      header("Location:index.php");
    }
    if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
    }
    $sql = "SELECT `nickname` FROM `wszyscy_userzy` WHERE `nickname` = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
      echo "Sql stmt fail";
    } else {
      mysqli_stmt_bind_param($stmt, "s", $nick);
      mysqli_stmt_execute($stmt);
      $res1 = mysqli_stmt_get_result($stmt);
    }
      if(mysqli_num_rows($res1) > 0)
      {
        $_SESSION['blad'] = "Taki nick już istnieje w bazie (ale tylko tymczasowo)";
        header("Location: ./index.php");
      } else {
      //$res = mysqli_query($conn, "INSERT INTO `wszyscy_userzy` VALUES (NULL, '$nick')");
      $stmt = mysqli_stmt_init($conn);
      $sql = "INSERT INTO `wszyscy_userzy` (`id`, `nickname`) VALUES( NULL, ?)";
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "zjebało się :/";
      } else {
        mysqli_stmt_bind_param($stmt, "s", $nick);
        mysqli_stmt_execute($stmt);
    }
      $sql = "SELECT * FROM `wszyscy_userzy` WHERE `nickname` = ?;";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql))
      {
        echo "Sql stejtment fail";
      } else {
        mysqli_stmt_bind_param($stmt, "s", $nick);
        mysqli_stmt_execute($stmt);
        $resUser = mysqli_stmt_get_result($stmt);
      }
      $wiersz = $resUser -> fetch_assoc();
      $id = $wiersz['id'];
      $nickname1 = $wiersz['nickname'];
        if($id % 2 == 1)
        {
          $stmt = mysqli_stmt_init($conn);
          $sql = "INSERT INTO `metadane_rozmowy` (`idRozmowy`, `idPierwszejOsoby`, `idDrugiejOsoby`, `IloscOsobWRozmowie`) VALUES( NULL, ?, 0, 1)";
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "zjebało się :/";
          } else {
            mysqli_stmt_bind_param($stmt, "s", $id);

        }
        //  $res = mysqli_query($conn, "INSERT INTO `metadane_rozmowy` VALUES(NULL, '$id',0, 0)");
          if(mysqli_stmt_execute($stmt))
          {
            $sql = "SELECT * FROM `metadane_rozmowy` WHERE `idPierwszejOsoby` = ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql))
            {
              echo "Sql stmt fail";
            } else {
              mysqli_stmt_bind_param($stmt, "s", $id);
              mysqli_stmt_execute($stmt);
              $res1 = mysqli_stmt_get_result($stmt);
            }
        //    $resUser = mysqli_query($conn, "SELECT * FROM `metadane_rozmowy` WHERE idPierwszejOsoby = '$id' ");
            $row = $res1 -> fetch_assoc();
            $_SESSION['idRozmowy'] = $row['idRozmowy'];
            $_SESSION['id'] = $id;
            header("Location: ./czat.php");
          }
        } else if ($id % 2 == 0) {
            $resultOfLastRowInRozmowyTbl = mysqli_query($conn,"SELECT `idRozmowy` FROM `metadane_rozmowy` ORDER BY `idRozmowy` DESC LIMIT 1");
            $LastIdOfRozmowa = $resultOfLastRowInRozmowyTbl -> fetch_assoc();
            $LastestID = $LastIdOfRozmowa['idRozmowy'];
            $res =  mysqli_query($conn, "UPDATE `metadane_rozmowy` SET `idDrugiejOsoby` = $id  WHERE `idRozmowy` = $LastestID");
            if($res){
              $resUser = mysqli_query($conn, "SELECT * FROM `metadane_rozmowy` WHERE idDrugiejOsoby = '$id' ");
              $row = $resUser -> fetch_assoc();
              $_SESSION['idRozmowy'] = $row['idRozmowy'];
              $_SESSION['id'] = $id;
              header("Location: ./czat.php");
          }
        }
      }
    } else {
  //echo session_id();
  header("location:index.php");
  }
?>
