<?php
session_start();
$_SESSION["userLogged"] = null;
unset($_SESSION["userLogged"]);
session_destroy();
?>

<script>
  sessionStorage.clear();
  window.location.replace("logIN.php"); 
</script>
