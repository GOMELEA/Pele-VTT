<?php
# Gère la sauvegarde sur la base Mysql de l'équipe

	$route_index=$_SESSION['index_route'];
	$n_photo=$_POST['n_photo'];
	$chemin_photo='../data/_CARNET_PRIERES_'.$_SESSION['annee'].'/Photo_'.formatage_repertoire($_SESSION['departement']).'_'.$n_photo.'.jpg';
	$texte_priere=mysql_real_escape_string($_POST['texte_priere']);
	$ref_priere=mysql_real_escape_string($_POST['ref_priere']);


if ($index_photo=="")
{
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     REQUETE INSERTION            XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	 $req_desc_table = "INSERT INTO  `carnet_priere`  ( `route_index`,`chemin_photo`,`texte_priere`,`ref_priere`)    VALUES ";
	$_requette = " ('" .$route_index."','".$chemin_photo.$index_photo."','".$texte_priere."','".$ref_priere."');" ;

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
	   $req_ident = "SELECT   MAX(`index_photo`)  FROM `carnet_priere` ";
	   $res_ident =  log_mysql_query($req_ident , $mysql );
	   $tabres2 = mysql_fetch_array ($res_ident);
	   $index_photo= $tabres2[0] ;
	}

}
else
{
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     REQUETE Modification            XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX



	$req_desc_table = "UPDATE carnet_priere SET route_index='" . $route_index. "',chemin_photo='" . $chemin_photo.$index_photo. "',texte_priere='" . $texte_priere. "',ref_priere='" . $ref_priere
	 . "' WHERE `index_photo` = '". $index_photo."' ";
	$req_inscription  = $req_desc_table; 
	$res_insertion =    log_mysql_query($req_inscription  , $mysql );

	if ( $res_insertion <> 1)
	{
	   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
	   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
	   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
	}
}
	
mysql_close();
?>
