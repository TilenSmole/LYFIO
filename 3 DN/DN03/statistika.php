<?php 
  include("databasa.php");
  session_start();
  if(isset($_SESSION["user"])){
    include("info.php");
    calculate();
  }


?>


<!DOCTYPE html>
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
<body >
    <div id="header"></div>

   
<?php if(  isset($_SESSION["userLogged"])  and  $_SESSION["userLogged"] = true): ?>

    <div id="notranjost" >
        <div class="col-10 col-s-12">
        <form method="post" action="obdelavaPodatkov.php">
        <div id="vprasalnik">
                <p style="font-size: 40px;">DODAJ NOV VNOS</p>
            <label for="datum">
                DATUM: 
                <input type="date" id="datum" name="datum" value="<?php echo date('Y-m-d'); ?>" >
              </label>
              <p></p>
            <label for="trgovec">
                NASLOVNIK:  
            <input type="text" id="trgovec" name="trgovec" placeholder="naslovnik" >
            </label>
            <p></p>
            <label for="vsota">
               VSOTA: 
                <input type="text" id="vsota" name="vsota" placeholder="vsota ">
            </label>
              <p></p>
            <div >
                PRIHODEK
                <input type="radio" id="plus" value="plus" name="check"  checked="checked">
                ODHODEK
                <input type="radio" id="minus" name="check" value="minus">
            </div>
              <p></p>
            <label for="opombe">
                OPOMBE:
                <input type="text" id="opombe" name="opombe" contenteditable="true" placeholder="opombe">
            </label>
            <p></p>
            

            <input type="submit" id="poslji" name="poslji" value="VNESI">
        </form>
        <p>  <br></p>
        <?php if (isset($_SESSION["napaka"])) { ?>
        <p id="napakaDisplay"><?php echo $_SESSION["napaka"];  $_SESSION["napaka"] = null;
 ?></p>
        <?php } ?>



        
        <div id="statistika" >
                    <p id="povprecje">Povprečje: <?php echo $_SESSION["avg"] ?></p>
                    <p id="max">Max: <?php echo $_SESSION["max"] ?></p>
                    <p id="min">Min: <?php echo $_SESSION["min"] ?></p>
                    <p id="stanje">STANJE: <?php echo $_SESSION["stanje"] ?></p>
                </div>

        <form method="GET" action="statistika.php">
            <div id="urejanja">
            <input type="submit" id="urediMax" name="urediMax"  value="UREDI PO MAX.">
            <input type="submit" id="urediMin" name="urediMin"  value="UREDI PO MIN.">
            </div>
            <br>
            <br>


        </form>


        <form method="GET" action="statistika.php" >
        IŠČI: 

        <input type="text"  id="iskanjeNiza"  name="iskanjeNiza" placeholder="vpiši niz tukaj ">
        <input type="submit" id="gumbIskanje" name="gumbIskanje"  value="IŠČI">

        </form>
            


    


        </div>
        <div >
            <table id="tabele">
                <tr  style="border:none"> 
                     <th  style="border:none!important">DATUM</th>
                    <th>NASLOVNIK</th>
                    <th>VSOTA</th>
                    <th>OPOMBE</th>
                </tr>

                <?php

if($_SERVER["REQUEST_METHOD"] == "GET" and  isset($_GET["urediMin"])){
    $id = $_SESSION["userID"];
    $sql = "SELECT * FROM data WHERE uid = $id" ;
    $result = $conn->query($sql);
    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
    }

    usort($data, function($a, $b) {
        return $a['VSOTA'] - $b['VSOTA'];
    });

    foreach ($data as $row) { 
        echo '<tr>';
        echo '<td>'. $row['DATUM'] .'</td>';
        echo '<td>'. $row['NASLOVNIK'] .'</td>';
        echo '<td>'. $row['VSOTA'] .'</td>';
        echo '<td>'. $row['OPOMBE'] .'</td>';
        echo "<td border-style:hidden ><form method='POST' action='obdelavaPodatkov.php'>
        <input type=hidden  name=id value=".$row["did"]." >
        <input type=submit id='deleteGumb' value=delete name=delete_confirmation  onClick=\"javascript: return confirm('Please confirm deletion');\" >
        </form>
        </td>";
    }
    die();

}
else if($_SERVER["REQUEST_METHOD"] == "GET" and  isset($_GET["urediMax"])){
    
        $id = $_SESSION["userID"];
        $sql = "SELECT * FROM data WHERE uid = $id" ;
        $result = $conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
    
        usort($data, function($a, $b) {
            return $b['VSOTA'] - $a['VSOTA'];
        });
    
        foreach ($data as $row) { 
            echo '<tr>';
            echo '<td>'. $row['DATUM'] .'</td>';
            echo '<td>'. $row['NASLOVNIK'] .'</td>';
            echo '<td>'. $row['VSOTA'] .'</td>';
            echo '<td>'. $row['OPOMBE'] .'</td>';
            echo '<td>'. $row['OPOMBE'] .'</td>';

            echo "<td border-style:hidden ><form method='POST' action='obdelavaPodatkov.php'>
            <input type=hidden  name=id value=".$row["did"]." >
            <input type=submit id='deleteGumb' value=delete name=delete_confirmation  onClick=\"javascript: return confirm('Please confirm deletion');\" >
            </form>
            </td>";
        }
        die();

    }
else if($_SERVER["REQUEST_METHOD"] == "GET" and isset($_GET["gumbIskanje"])){
    $niz = $_GET["iskanjeNiza"];
    $id = $_SESSION["userID"];
    $sql = "SELECT * FROM data WHERE uid = $id" ;
    $result = mysqli_query($conn, $sql); 

    while ($row = mysqli_fetch_assoc($result)) { 
        if($row["DATUM"] == $niz ||$row["NASLOVNIK"] == $niz ||$row["VSOTA"] == $niz ||$row["OPOMBE"] == $niz){
            echo '<tr>';
            echo '<td>'. $row['DATUM'] .'</td>';
            echo '<td>'. $row['NASLOVNIK'] .'</td>';
            echo '<td>'. $row['VSOTA'] .'</td>';
            echo '<td>'. $row['OPOMBE'] .'</td>';
            echo "<td border-style:hidden ><form method='POST' action='obdelavaPodatkov.php'>
            <input type=hidden  name=id value=".$row["did"]." >
            <input type=submit id='deleteGumb' value=delete name=delete_confirmation  onClick=\"javascript: return confirm('Please confirm deletion');\" >
            </form>
            </td>";
            echo "<td border-style:hidden ><form method='POST' action='sprememba.php'>
        <input type=hidden  name=spremeni    value=".$row["did"]." >
        <input type=submit id='spremeniGumb' value=uredi name=spremeniGumb >
        </form>
        </td>";
       
        }
    }
}
else{
    $id= $_SESSION["userID"];
    $sql = "SELECT * FROM data where uid = $id ";
    $result = mysqli_query($conn, $sql); 
    while ($row = mysqli_fetch_assoc($result)) { 
        echo '<tr>';
        echo '<td>'. $row['DATUM'] .'</td>';
        echo '<td>'. $row['NASLOVNIK'] .'</td>';
        echo '<td>'. $row['VSOTA'] .'</td>';
        echo '<td>'. $row['OPOMBE'] .'</td>';
        echo "<td border-style:hidden ><form method='POST' action='obdelavaPodatkov.php'>
        <input type=hidden  name=id value=".$row["did"]." >
        <input type=submit id='deleteGumb' value=izbriši name=delete_confirmation  onClick=\"javascript: return confirm('Please confirm deletion');\" >
        </form>
        </td>";
        echo "<td border-style:hidden ><form method='POST' action='sprememba.php'>
        <input type=hidden  name=spremeni    value=".$row["did"]." >
        <input type=submit id='spremeniGumb' value=uredi name=spremeniGumb >
        </form>
        </td>";
    } ;
}


?>


         </table>

         
            
        </div>
        </div>
        <div> 
        </div>
        </div>

        





<?php else: ?>
    <div  class="col-2 col-s-12">&nbsp;</div>
    <div class="col-6 col-s-12" >
        <p class="BlockedViewCentral">Please <a href="logIN.php">log in</a> or  <a href="register.php">register</a> to view this </p>
    </div>  
    <div  class="col-2 col-s-12">&nbsp;</div>

<?php endif; ?>

      
       
        

    <div id="aside" ></div>
    <div id="footer"></div>
    <script src="code.js"></script>


    
</body>
</html>

<?php
  mysqli_close($conn);
?>