<?php 
  include("databasa.php");

  session_start();
  //dolocimo id 
  $sql = "SELECT * FROM users";
  $result = mysqli_query($conn, $sql); 
  $_SESSION["napaka"] = null;
  $_SESSION["napakaLOGin"] = null;
  $_SESSION["napakaRegister"] = null;
    if(isset($_SESSION["user"])){
        while ($row = mysqli_fetch_assoc($result)) { 
            if($row["username"] == $_SESSION["user"] ){
                $_SESSION["userID"] = $row["id"];
              break;
            }
            continue;
        }
        $id =  $_SESSION["userID"];
        $sql = "SELECT * FROM data WHERE uid = $id ";
        $result = mysqli_query($conn, $sql); 
        $data = [];
        
        $_SESSION["data"] = $data;
    }
    

  

?>



<!DOCTYPE html >
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LYFIO</title>
    <link rel="stylesheet" href="stils.css">
    <link rel="stylesheet" href="stils2.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script> 
        $(function(){
          $("#header").load("header.php"); 
          $("#footer").load("footer.html"); 
          $("#aside").load("aside.html"); 

        });
    </script> 
    <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
    <div id="header"></div>

    <div  class="col-2 col-s-2">
    &nbsp;
    </div>

    <div id="spremembaUI" class="col-7 col-s-7">

    <?php

        $id = $_POST["spremeni"];
        $sql = "SELECT * FROM data where did = $id ";
        $result = mysqli_query($conn, $sql); 
        $row = mysqli_fetch_assoc($result);
        echo "Trenutni datum: ". $row['DATUM'] . "<br>". "Nastavi nov datum: ". "<form method='POST' action='sprememba.php'  style='display:inline'>
        <input type=hidden  name=spremeni    value=".$row["did"]." >
        <input type=date  name=spremeniDatum  value='".date('Y-m-d')."' >
        <input type=submit id='spremeniDatumGumb' value='Spremeni datum' >
        </form>" .'<br>'.'<br>';
        
        echo "Trenutni naslovnik: " .$row['NASLOVNIK'] . "<br>". "Nastavi novega: "."<form method='POST' action='sprememba.php' style='display:inline'>
        <input type=hidden  name=spremeni    value=".$row["did"]." >
        <input type=text  name=spremeniNaslovnik   >
        <input type=submit id='spremeniNaslovnikGumb' value='Spremeni naslovnika' >
        </form>" .'<br>'.'<br>';



        echo "Trenutna vsota: ". $row['VSOTA'] . "<br>". "Nastavi novo vsoto: "."<form method='POST' action='sprememba.php' style='display:inline'>
        <input type=hidden  name=spremeni    value=".$row["did"]." >
        <input type=text  name=spremeniVsota   >
        <input type=submit id='spremeniVsotaGumb' value='Spremeni vsoto' >
        </form>" .'<br>'.'<br>';

        echo "Trenutna opomba: ". $row['OPOMBE'] ."<br>"."Nastavi novo opombo: "."<form method='POST' action='sprememba.php' style='display:inline'>
        <input type=hidden  name=spremeni    value=".$row["did"]." >
        <input type=text  name=spremeniOpombe   >
        <input type=submit id='spremeniOpombeGumb' value='Spremeni opombe' >
        </form>" .'<br>'.'<br>';

        $sql_old = "SELECT * FROM old_data where did = $id ";
        $result2 = mysqli_query($conn, $sql_old); 

        echo "ZGODOVINA SPREMEMB<br> <br>";
        while ($row = mysqli_fetch_assoc($result2)) { 
          echo "Spremenjeno dne: " .$row["datum_spremembe"] ."<br>";
          echo $row["text"];
          echo "<br>";
          echo "<br>";

        }


        if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["spremeniDatum"])) {
            $nov = $_POST["spremeniDatum"];

            if (!preg_match('/^(?:(?:19|20)[0-9]{2})-(?:0[1-9]|1[0-2])-(?:0[1-9]|[12][0-9]|3[01])$/', $nov)) {
                echo "<script>  alert('VNESI PRAVILEN DATUM!') </script>";
                exit;
          
              } 



              $datum = "SELECT DATUM from data where did = $id" ;
              $datum = mysqli_query($conn, $datum); 
              $datum = mysqli_fetch_array($datum);
              $datum =  $datum[0];


              $opombe = "SELECT OPOMBE from data where did = $id" ;
              $opombe = mysqli_query($conn, $opombe); 
              $opombe = mysqli_fetch_array($opombe);
              $opombe = $opombe[0];

              $vsota = "SELECT VSOTA from data where did = $id" ;
              $vsota = mysqli_query($conn, $vsota); 
              $vsota = mysqli_fetch_array($vsota);
              $vsota= $vsota[0];

              $naslovnik = "SELECT NASLOVNIK from data where did = $id" ;
              $naslovnik = mysqli_query($conn, $naslovnik); 
              $naslovnik = mysqli_fetch_array($naslovnik);
              $naslovnik = $naslovnik[0];

              $spremeba =  date("Y/m/d");
              $sql_old =  "INSERT INTO old_data (text, did) VALUES ('$datum  $naslovnik $vsota  $opombe', $id)";

              mysqli_query($conn, $sql_old);


              $id = $_POST["spremeni"];
              $sql = "UPDATE data SET DATUM = '$nov' WHERE  did = $id" ;
              $result = mysqli_query($conn, $sql); 



              echo "<script>  window.location='statistika.php'; </script>";



        }
        else if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["spremeniNaslovnik"])) {
        
             
             
              $datum = "SELECT DATUM from data where did = $id" ;
              $datum = mysqli_query($conn, $datum); 
              $datum = mysqli_fetch_array($datum);
              $datum =  $datum[0];


              $opombe = "SELECT OPOMBE from data where did = $id" ;
              $opombe = mysqli_query($conn, $opombe); 
              $opombe = mysqli_fetch_array($opombe);
              $opombe = $opombe[0];

              $vsota = "SELECT VSOTA from data where did = $id" ;
              $vsota = mysqli_query($conn, $vsota); 
              $vsota = mysqli_fetch_array($vsota);
              $vsota= $vsota[0];

              $naslovnik = "SELECT NASLOVNIK from data where did = $id" ;
              $naslovnik = mysqli_query($conn, $naslovnik); 
              $naslovnik = mysqli_fetch_array($naslovnik);
              $naslovnik = $naslovnik[0];

              $spremeba =  date("Y/m/d");
              $sql_old =  "INSERT INTO old_data (text, did) VALUES ('$datum  $naslovnik $vsota  $opombe', $id)";
              mysqli_query($conn, $sql_old);


              $id = $_POST["spremeni"];
              $nov =filter_input(INPUT_POST, "spremeniNaslovnik", FILTER_SANITIZE_SPECIAL_CHARS);
              $sql = "UPDATE data SET NASLOVNIK = '$nov' WHERE  did = $id" ;
              $result = mysqli_query($conn, $sql); 

              echo "<script>  window.location='statistika.php'; </script>";








            }
        else if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["spremeniVsota"])) {
            $nov =filter_input(INPUT_POST, "spremeniVsota", FILTER_SANITIZE_SPECIAL_CHARS);

               if (!preg_match('/^-?[0-9]+$/', $nov)) {
                echo "<script>  alert('VNESI PRAVILNO VSOTO!') </script>";
                exit;
          
                } 
           
              
              
              $datum = "SELECT DATUM from data where did = $id" ;
              $datum = mysqli_query($conn, $datum); 
              $datum = mysqli_fetch_array($datum);
              $datum =  $datum[0];


              $opombe = "SELECT OPOMBE from data where did = $id" ;
              $opombe = mysqli_query($conn, $opombe); 
              $opombe = mysqli_fetch_array($opombe);
              $opombe = $opombe[0];

              $vsota = "SELECT VSOTA from data where did = $id" ;
              $vsota = mysqli_query($conn, $vsota); 
              $vsota = mysqli_fetch_array($vsota);
              $vsota= $vsota[0];

              $naslovnik = "SELECT NASLOVNIK from data where did = $id" ;
              $naslovnik = mysqli_query($conn, $naslovnik); 
              $naslovnik = mysqli_fetch_array($naslovnik);
              $naslovnik = $naslovnik[0];

              $spremeba =  date("Y/m/d");
              $sql_old =  "INSERT INTO old_data (text, did) VALUES ('$datum  $naslovnik $vsota  $opombe', $id)";
              mysqli_query($conn, $sql_old);

              $id = $_POST["spremeni"];
              $sql = "UPDATE data SET VSOTA = '$nov' WHERE  did = $id" ;
              $result = mysqli_query($conn, $sql); 

              echo "<script>  window.location='statistika.php'; </script>";




              
            }
        else if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["spremeniOpombe"])) {

              
              $datum = "SELECT DATUM from data where did = $id" ;
              $datum = mysqli_query($conn, $datum); 
              $datum = mysqli_fetch_array($datum);
              $datum =  $datum[0];


              $opombe = "SELECT OPOMBE from data where did = $id" ;
              $opombe = mysqli_query($conn, $opombe); 
              $opombe = mysqli_fetch_array($opombe);
              $opombe = $opombe[0];

              $vsota = "SELECT VSOTA from data where did = $id" ;
              $vsota = mysqli_query($conn, $vsota); 
              $vsota = mysqli_fetch_array($vsota);
              $vsota= $vsota[0];

              $naslovnik = "SELECT NASLOVNIK from data where did = $id" ;
              $naslovnik = mysqli_query($conn, $naslovnik); 
              $naslovnik = mysqli_fetch_array($naslovnik);
              $naslovnik = $naslovnik[0];

              $spremeba =  date("Y/m/d");
              $sql_old =  "INSERT INTO old_data (text, did) VALUES ('$datum  $naslovnik $vsota  $opombe', $id)";
              mysqli_query($conn, $sql_old);

              $id = $_POST["spremeni"];
              $nov = $_POST["spremeniOpombe"];
              $sql = "UPDATE data SET OPOMBE = '$nov' WHERE  did = $id" ;
              $result = mysqli_query($conn, $sql); 

              echo "<script>  window.location='statistika.php'; </script>";



        }






?>
    </div>


    <div  class="col-1 col-s-1">
    &nbsp;
    </div>

    <div id="aside"></div>
    <div id="footer"></div>








    
</body>
</html>


<?php
  mysqli_close($conn);
?>