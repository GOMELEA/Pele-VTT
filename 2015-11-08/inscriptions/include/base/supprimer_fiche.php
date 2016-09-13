<?php
# Supprime les paramètres de la fiche sélectionnée par la variable $index (dans l'url) 


include('include/base/connexion_serveur.php');
$req_liste_1  = " SELECT `fiche_numero_inscription`   FROM `fiche` WHERE `index` = $index ;" ;
$res_liste_1   = log_mysql_query($req_liste_1, $mysql);
while ($tabres2 = mysql_fetch_array ($res_liste_1))
  {
     $numero_de_fiche= $tabres2[0] ;
  }
# Test si la fiche à supprimer fait bien partie de la session en cours 
if ($numero_de_fiche==$_SESSION['numero_inscription'])
{
	$req_inscription="DELETE FROM  `fiche` WHERE `index`=$index ;";
	$res_insertion =    log_mysql_query($req_inscription  , $mysql );
}
mysql_close();
?>
