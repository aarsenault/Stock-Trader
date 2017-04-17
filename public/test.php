

<?php 

require("../includes/config.php"); 

echo(" HELLO " );
echo( $_SESSION["stockinfo"]["symbol"] );
print_r($_SESSION);
echo( var_dump($_SESSION["stockinfo"]["symbol"]) );               



?>


