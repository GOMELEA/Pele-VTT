<?php
# Gère la sauvegarde sur la base Mysql de la fiche d'inscription
if ($_POST['N_depart_lecture']<>"" and  $_POST['login_lecture']<>"" and $_POST['mdp_lecture']<>"") 
{
	$dep=$_POST['N_depart_lecture'];
	$log=$_POST['login_lecture'];
	$mdp=$_POST['mdp_lecture'];
	$auto="lecture";
}

if ($_POST['N_depart_secretariat']<>"" and  $_POST['login_secretariat']<>"" and $_POST['mdp_secretariat']<>"") 
{
	$dep=$_POST['N_depart_secretariat'];
	$log=$_POST['login_secretariat'];
	$mdp=$_POST['mdp_secretariat'];
	$auto="secretariat";
}

if ($_POST['login_admin']<>"" and  $_POST['mdp_admin']<>"" ) 
{
	$dep="";
	$log=$_POST['login_admin'];
	$mdp=$_POST['mdp_admin'];
	$auto="admin";
}

# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     REQUETE INSERTION            XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 $req_desc_table = "INSERT INTO  `mdp`  ( `n_departement`,`login`,`mdp`,`autorisation`)    VALUES ";
$_requette = " ('" .$dep."','".$log."','".$mdp."','".$auto."' );" ;


$req_inscription  = $req_desc_table . $_requette; 
$res_insertion =    log_mysql_query($req_inscription  , $mysql );
if ( $res_insertion == 1)
{
	regUser($log,$mdp);
	if ($auto=="admin") regUser_admin($log,$mdp);
}
else
{
   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
}
mysql_close();
?>
