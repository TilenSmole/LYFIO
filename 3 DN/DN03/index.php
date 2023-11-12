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
    <div id="notranjost">
        <div id="okoli"  class="col-5 col-s-6" >
            <article id = "uvod" >
                <h1 style="text-align: center;">LYFIO</h1>
                <p id="st" >Pred vami je aplikacija za merjenje porabe stroškov.
                    Aplikacija je zelo preprosta za uporabo; v zaznamku "PODATKI" lahko dodajate stroške oz prihodke, spremljate porabo skozi graf
                    iščete po vaših podatkih ter uredite tebelo po vašem izboru. V zadnjem 
                    zavihku pa najdete še več informacij o projektu. Vaše aktualno stanje pa lahko kadarkoli vidite tudi na desni.
                    Prijetno uporabo!
                </p>  
            </article >
        </div>

    <?php if(  isset($_SESSION["userLogged"])  and  $_SESSION["userLogged"] = true): 
        include 'info.php';
       echo calculate() ;

    ?><div class="col-5 col-s-6">
        <div id="stanjeSplosno" >
                    <p id="povprecje">Povprečje: <?php echo $_SESSION["avg"] ?></p>
                    <p id="max">Max: <?php echo $_SESSION["max"] ?></p>
                    <p id="min">Min: <?php echo $_SESSION["min"] ?></p>
                    <p id="stanje">STANJE: <?php echo $_SESSION["stanje"] ?></p>
                </div>
            </div>
    <?php else: ?>
        <div  class="col-1 col-s-12">&nbsp;</div>
        <div class="col-3 col-s-12" >
            <p id="BlockedViewIndex">Please <a href="logIN.php">log in</a> or  <a href="register.php">register</a> to view this </p>
        </div>  
        <div  class="col-1 col-s-12">&nbsp;</div>
    <?php endif; ?>


        
        


    </div>   
    
    <div id="aside"></div>
    <div id="footer"></div>








    
</body>
</html>


<?php
  mysqli_close($conn);
?>