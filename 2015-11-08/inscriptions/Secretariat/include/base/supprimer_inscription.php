 <body>
<?php
if ($index_inscription<>"")
{
include('../include/base/connexion_serveur.php');
$req_inscription="DELETE FROM  `inscription` WHERE `index_inscription`=$index_inscription ;";
$res_insertion =    log_mysql_query($req_inscription  , $mysql );
$req_inscription="DELETE FROM  `fiche` WHERE `fiche_numero_inscription`=$index_inscription ;";
$res_insertion =    log_mysql_query($req_inscription  , $mysql );
mysql_close();
}
?>
 </body>
