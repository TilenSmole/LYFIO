<?php 
  include("databasa.php");
  session_start();
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
    <div  class="col-4 col-s-12">
        &nbsp;
        </div>
    <div id="RegisterDesign"  class="col-4 col-s-12">
    <form  method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" >
                <p style="font-size: 40px; ">WELCOME TO LYFIO!</p>
                    USERNAME: 
                    <input type="text" id="username" name="username" >
                  <br>

                  DATE OF BIRTH: 
                    <input type="date" name="birth_date" id="birth_date" >
                  <br> 

                    PASSWORD: 
                    <input type="password" id="passwd" name="passwd" >

                  <br> 
                  REPEAT PASSWORD: 
                    <input type="password" id="RepeatedPasswd" name="RepeatedPasswd" >
                  <br>
                  <br>
                    <input type="submit" name="submitRegister" id="submitRegister" value="REGISTER" id="submitRegister">
                  <br>

                    <?php if (isset($_SESSION["napakaRegister"])) { ?>
                      <p id="napakaDisplay"><?php echo $_SESSION["napakaRegister"]; ?></p>
                    <?php } ?>
                    <?php

          if($_SERVER["REQUEST_METHOD"] == "POST"){
        
            $username =filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
            $password =filter_input(INPUT_POST, "passwd", FILTER_SANITIZE_SPECIAL_CHARS);
            $birth_date =$_POST['birth_date'];
            $RepeatedPasswd =filter_input(INPUT_POST, "RepeatedPasswd", FILTER_SANITIZE_SPECIAL_CHARS);
            
            $sql = "SELECT * FROM users";
            $result = mysqli_query($conn, $sql); 
            $pogoj = false;
            while ($row = mysqli_fetch_assoc($result)) { 
                if($row["username"] == $username ){
                  $pogoj = true;
                  break;
                }
            }

            if(empty($username)){
              $_SESSION["napakaRegister"]="please enter a  username";
              echo "<script>  window.location='register.php'; </script>";
            }
            elseif(empty($password)){
              $_SESSION["napakaRegister"]="please enter a  username";
                        echo "<script>  window.location='register.php'; </script>";
            }
            elseif(empty($birth_date)){
              $_SESSION["napakaRegister"]="please enter a valid date";
              echo "<script>  window.location='register.php'; </script>";
            }
            elseif($pogoj){
              $_SESSION["napakaRegister"]="$username sadly does already exists :(";
              echo "<script>  window.location='register.php'; </script>";
            }
            elseif($password != $RepeatedPasswd){
              echo "passwords dont match!";
            }else{
              $_SESSION["userLogged"] = true;
              $_SESSION["user"] = $username;
              $hash = password_hash($password, PASSWORD_DEFAULT);
              $sql =  "INSERT INTO users (username, password, birth_date) VALUES ('$username', '$hash',  '$birth_date')";
              $_SESSION["userLogged"] = true;
              $_SESSION["user"] = $username;
              mysqli_query($conn, $sql);
              mysqli_close($conn);
              echo "you are now registered! You are being redirected in 1s"; 

              sleep(1);
            echo "<script>  window.location='index.php'; </script>";
              exit;
            }


          }


        ?>


                  <br>
                  <p style="font-size: 20px;">Already a user? <a href="LogIN.php">Log in now!</a></p>



                  </form>

        </div>   
    <div id="footer"></div> 
</body>
</html>
