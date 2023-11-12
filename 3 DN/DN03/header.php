<?php 
  include("databasa.php");
  session_start();
?>
<link rel="stylesheet" href="stils2.css">

<header  class="col-12">
    <nav class="col-12">
        <a href="index.php" id="imeAplikacije" class="col-4 col-s-5" style="padding-left: 0.5%;">LYFIO</a> 
        <a href="statistika.php" id="stat"class="col-2 col-s-2"  >PODATKI  </a>
        <a href="graf.html" id="oProjektu" class="col-2 col-s-3" >GRAF</a> 
        <a href="info.html" id="oProjektu" class="col-2 col-s-3" >O PROJEKTU </a> 
        <?php if(  isset($_SESSION["userLogged"])  and  $_SESSION["userLogged"] = true): ?>
            <a href="logOut.php" id="logIN" class="col-2 col-s-3" >
                    <span class="default-text"><?php echo $_SESSION["user"] ?></span>
        <span class="hover-text"     ;>LOG OUT</span>
            </a>
    <?php else: ?>
        <a href="logIN.php" id="logIN2" class="col-2 col-s-3"  >LOG IN/REGISTER </a>
    <?php endif; ?>

    </nav>
</header>


<?php


mysqli_close($conn);

?>