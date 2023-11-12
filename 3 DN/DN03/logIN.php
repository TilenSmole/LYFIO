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
    <div id="loginDesign"  class="col-4 col-s-12" >
            <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>">
                <p style="font-size: 40px; ">WELCOME TO LYFIO!</p>
                    USERNAME: 
                    <input type="text"  name="username" >
                  <br>
                    PASSWORD: 
                    <input type="password"  name="passwd" >

                    <br>
                    <br>
                    <input  type="submit" name="submit"  value="LOG IN" id="loginButton">
                    <br>                  



                    <?php if (isset($_SESSION["napakaLOGin"])) { ?>
                      <p id="napakaDisplay"><?php echo $_SESSION["napakaLOGin"]; ?></p>
                    <?php } ?>


                    <?php if($_SERVER["REQUEST_METHOD"] == "POST"){

                      $username =filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
                      $password =filter_input(INPUT_POST, "passwd", FILTER_SANITIZE_SPECIAL_CHARS);

                      if(empty($username)){
                        $_SESSION["napakaLOGin"]="please enter a valid username";
                        echo "<script>  window.location='logIN.php'; </script>";

                      }
                      elseif(empty($password)){
                        $_SESSION["napakaLOGin"]="please enter a valid password";
                        echo "<script>  window.location='logIN.php'; </script>";

                      }
                      else{
                        $sql = "SELECT * FROM users";
                        $result = mysqli_query($conn, $sql); 
                        while ($row = mysqli_fetch_assoc($result)) { 
                            if($row["username"] == $username and password_verify($password, $row["password"])){
                              $_SESSION["userLogged"] = true;
                              $_SESSION["user"] = $username;
                              sleep(1);
                              echo "<script>  window.location='index.php'; </script>";
                           
                            }
                        }
                        $_SESSION["napakaLOGin"]="no such user  ";

                      }


                    mysqli_close($conn);
                    }
                    ?>
                    
                  <p> &nbsp;</p>
                  <p style="font-size: 20px;">Not yet a user? <a href="register.php">Register now!</a></p>



                  </form>

        </div>

           
       
    
    <div id="footer"></div>
</body>
</html> 



