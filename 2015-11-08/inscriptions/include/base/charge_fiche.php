<?php
# Charge les paramètres de la fiche sélectionnée par la variable $index (dans l'url) dans le tableau $tab

if ($index<>0)
{
	include('include/base/connexion_serveur.php');
	$req_liste_1  = " SELECT `fiche_numero_inscription`   FROM `fiche` WHERE `index` = $index ;" ;
	$res_liste_1   = log_mysql_query($req_liste_1, $mysql);
	$tabres2 = mysql_fetch_array ($res_liste_1);
	$numero_inscription= $tabres2[0] ;

	# Test si la fiche à modifier fait bien partie de la session en cours - pour le cas où la variable $index serait modifiée par l'utilisateur dans l'url
	if ($numero_inscription==$_SESSION['numero_inscription'])
	{
		$resultat = log_mysql_query("Select * from `fiche` where `index`=$index", $mysql);
		$tab = mysql_fetch_array($resultat);
		$tab=stripslashes_deep($tab);
	}
	mysql_close();
}
?>
