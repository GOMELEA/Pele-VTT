<?php

// Recherche l'index correspondant à un nom et au code_recherche
if (trim($_POST['code_recherche'])<>"")
{
	include('include/base/connexion_serveur.php');
	$req_liste_1  = " SELECT `index` FROM `fiche` INNER JOIN inscription ON fiche.fiche_numero_inscription = inscription.index_inscription ".
					"WHERE fiche.nom_usage = '".trim(mysql_real_escape_string(strtoupper($_POST['nom_recherche']))).
					"' and fiche.code_recherche = '".trim(mysql_real_escape_string ($_POST['code_recherche'])).
					"' order by inscription.date_inscription asc ;";
	$res_liste_1   = log_mysql_query($req_liste_1, $mysql);
	while ($tabres = mysql_fetch_array ($res_liste_1)) $index=$tabres[0];
	if (mysql_num_rows($res_liste_1)>0)  $_SESSION['recherche']="ok";
	else $_SESSION['recherche']="pas_ok";
	$req_liste_1  = " SELECT `fiche_numero_inscription`   FROM `fiche` WHERE `index` = $index ;" ;
	$res_liste_1   = log_mysql_query($req_liste_1, $mysql);
	$tabres2 = mysql_fetch_array ($res_liste_1);
	$numero_inscription= $tabres2[0] ;
	$resultat = log_mysql_query("Select * from `fiche` where `index`=$index",$mysql);
	$tab = mysql_fetch_array($resultat);
	$tab=stripslashes_deep($tab);
	mysql_close();
}


?>
