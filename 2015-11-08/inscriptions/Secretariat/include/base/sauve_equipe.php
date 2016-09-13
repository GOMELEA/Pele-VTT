<?php
# Gère la sauvegarde sur la base Mysql de l'équipe
include('../../../include/base/connexion_serveur.php');

	$route_index=$_SESSION['index_route'];
	$numero_equipe=$_POST['numero_equipe'];
	$nom_equipe=mysql_real_escape_string($_POST['nom_equipe']);
	$foulard=mysql_real_escape_string($_POST['foulard']);
	$tente=mysql_real_escape_string($_POST['tente']);
	$sous_camp=mysql_real_escape_string($_POST['sous_camp']);
	$image_foulard=$_POST['image_foulard'];

$resultat = log_mysql_query("Select index_equipe from `equipe` where `route_index`='".$_SESSION['index_route']."' and `numero_equipe`='".$_POST['numero_equipe']."'",$mysql) or die ("Requête non executée.");
$tab2 = mysql_fetch_array($resultat);

if (mysql_num_rows($resultat)==0)
{
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     REQUETE INSERTION            XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	 $req_desc_table = "INSERT INTO  `equipe`  ( `route_index`,`numero_equipe`,`nom_equipe`,`foulard`,`tente`,`sous_camp`,`image_foulard`)    VALUES ";
	$_requette = " ('" .$route_index."','".$numero_equipe."','".$nom_equipe."','".$foulard."','".$tente."','".$sous_camp."','".$image_foulard."' );" ;
	
	$req_inscription  = $req_desc_table . $_requette; 
	$res_insertion =    log_mysql_query($req_inscription  , $mysql );
	if ( $res_insertion <> 1)
	{
	   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
	   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
	   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
	}
	else
	{
	   $req_ident = "SELECT   MAX(`index_equipe`)  FROM `equipe` ";
	   $res_ident =  log_mysql_query($req_ident , $mysql );
	   $tabres2 = mysql_fetch_array ($res_ident);
	   $index_equipe= $tabres2[0] ;
	}

}
else
{
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     REQUETE Modification            XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	 $req_desc_table = "UPDATE equipe SET route_index='" . $route_index. "',numero_equipe='" . $numero_equipe. "',nom_equipe='" . $nom_equipe. "',foulard='" . 
	 	$foulard. "',tente='" . $tente. "',sous_camp='" . $sous_camp. "',image_foulard='" . $image_foulard. "' WHERE `index_equipe` = '". $tab2['index_equipe']."' ";
	 
	$req_inscription  = $req_desc_table; 
	$res_insertion =    log_mysql_query($req_inscription  , $mysql );
	$index_equipe=$tab2['index_equipe'];

	if ( $res_insertion <> 1)
	{
	   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
	   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
	   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
	}
}
	
mysql_close();
?>
