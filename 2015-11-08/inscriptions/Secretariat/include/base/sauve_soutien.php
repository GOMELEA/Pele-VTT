<?php
# Gère la sauvegarde sur la base Mysql de la fiche de soutien

$_departement=$_SESSION['n_departement'];
$_annee=$_POST['annee'];
if ($_POST['type']<>'') $_type=$_POST['type']; else $_type=$type;
$_saisi_par=$_POST['saisi_par'];
$_SESSION['saisi_par']=$_saisi_par; // pour créer une rémanence sur ce champs
$_titre=$_POST['titre'];
$_nom= mysql_real_escape_string(strtoupper($_POST['nom']));
$_prenom= mysql_real_escape_string (ucwords(strtolower($_POST['prenom'])));
$_societe= mysql_real_escape_string ($_POST['societe']);
$_adresse_1= mysql_real_escape_string ($_POST['adresse_1']);
$_adresse_2= mysql_real_escape_string ($_POST['adresse_2']);
$_adresse_3= mysql_real_escape_string ($_POST['adresse_3']);
$_ville= mysql_real_escape_string (strtoupper($_POST['ville']));
$_cdpostal=$_POST['cdpostal'];
$_pays= mysql_real_escape_string (strtoupper($_POST['pays']));
$_courriel=$_POST['courriel'];
$_telephone=NumTel($_POST['telephone']);
$_tel_mobile=NumTel($_POST['tel_mobile']);
$_date_impression=$_POST['date_impression'];
$_observations= mysql_real_escape_string ($_POST['observations']);

if ($index=="")
{
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     REQUETE INSERTION            XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	$_requette = " ('" . 
	$_departement."','".$_annee."','".$_type."','".$_saisi_par."','".$_titre."','".$_nom."','".$_prenom."','".$_societe."','".$_adresse_1."','".$_adresse_2."','".$_adresse_3."','".$_ville."','".$_cdpostal."','".
	$_pays."','".$_courriel."','".$_telephone."','".$_tel_mobile."','".$_observations."' );" ;
	
	 $req_desc_table = "INSERT INTO  `soutien`  ( " . 
	"`departement`,`annee`,`type`,`saisi_par`,`titre`,`nom`,`prenom`,`societe`,`adresse_1`,`adresse_2`,`adresse_3`,`ville`,`cdpostal`,`pays`,`courriel`,`telephone`,`tel_mobile`,`observations` )    VALUES ";
	
	$req_inscription  = $req_desc_table . $_requette; 
	$res_insertion =    log_mysql_query($req_inscription  , $mysql );

	if ( $res_insertion <> 1)
	{  echo "requete ".$req_inscription;
	   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
	   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
	   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
	}
}
else
{
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     REQUETE Modification            XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	 $req_desc_table = "UPDATE soutien SET departement='" . $_departement. "',annee='" . $_annee. "',type='" . $_type. "',saisi_par='" . 
	 	$_saisi_par. "',titre='" . $_titre. "',nom='" . $_nom. "',prenom='" . $_prenom."',societe='" . $_societe. "',adresse_1='" . $_adresse_1. "',adresse_2='" . 
	 	$_adresse_2. "',adresse_3='" . $_adresse_3. "',ville='" . $_ville. "',cdpostal='" . $_cdpostal."',pays='" . $_pays. "',courriel='" . $_courriel. "',telephone='" . 
	 	$_telephone. "',tel_mobile='" . $_tel_mobile. "',observations='" .$_observations."',date_impression='" .$_date_impression."' WHERE `index_soutien` = '". $index."' ";
	 
	$req_inscription  = $req_desc_table; 
	$res_insertion =    log_mysql_query($req_inscription  , $mysql );

	if ( $res_insertion <> 1)
	{  echo "requete ".$req_inscription;
	   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
	   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
	   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
	}
}
	
?>
