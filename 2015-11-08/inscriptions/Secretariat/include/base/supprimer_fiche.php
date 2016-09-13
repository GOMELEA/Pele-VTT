 <body>
<?php
if ($index<>"")
{
include('../include/base/connexion_serveur.php');
$req_inscription="DELETE FROM  `fiche` WHERE `index`=$index ;";
$res_insertion =    log_mysql_query($req_inscription  , $mysql );
mysql_close();
}
?>
 </body>
