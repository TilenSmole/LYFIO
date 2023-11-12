<?php 
  include("databasa.php");
  session_start();
 

  if($_SERVER["REQUEST_METHOD"] == "POST" and  !(isset($_POST["delete_confirmation"]) )){

    $trgovec =$_POST['trgovec'];
    $vsota =$_POST['vsota'];
    $datum = $_POST['datum'];
    $opombe =$_POST['opombe'];
    $odhoPrih = $_POST['check'];

    $userID = $_SESSION["userID"];

    if (!preg_match('/^[0-9]+$/', $vsota)) {
      $_SESSION["napaka"] = "VNESI PRAVILNO VSOTO!";
      echo "<script>  window.location='statistika.php'; </script>";
     exit;
    } 
    if (!preg_match('/^(?:(?:19|20)[0-9]{2})-(?:0[1-9]|1[0-2])-(?:0[1-9]|[12][0-9]|3[01])$/', $datum)) {
      $_SESSION["napaka"] = "VNESI PRAVILEN DATUM!";
      echo "<script>  window.location='statistika.php'; </script>";
      exit;

    } 




    echo $trgovec . $vsota . $datum . $opombe . $odhoPrih;

    if($odhoPrih == "minus")
        $vsota *=-1;
    
    $sql =  "INSERT INTO data (uid ,DATUM,NASLOVNIK, VSOTA, OPOMBE, odhoPrih) VALUES ('$userID','$datum', '$trgovec',  '$vsota',  '$opombe', '$odhoPrih')";
    mysqli_query($conn, $sql);
    include 'info.php';
    echo calculate() ;
    echo "<script>  window.location='statistika.php'; </script>";

   
}
else if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["delete_confirmation"]) ){
  
  $brisan = $_POST["id"];
  $sql = "DELETE FROM data WHERE $brisan = did";  
  $result = mysqli_query($conn, $sql); 
  echo "<script>  window.location='statistika.php'; </script>";






 
}







?>