<?php
# Gère la sauvegarde sur la base Mysql de la fiche de liste d'attente

include('connexion_serveur.php');
$_aujourdhui=date("Y-m-d-G-i-s");

# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX       montage de la requete d'insertion par blocs            XXXXXXXXXXXXXXXXXXXXXxXXX
$_requette = " ('" . 
$_SESSION['index_route']."','".$_POST['type_attente']."','".$_aujourdhui."','".$_POST['sexe_attente']."','".mysql_real_escape_string(strtoupper($_POST['nom_attente']))."','".
mysql_real_escape_string (ucwords(strtolower($_POST['prenom_attente'])))."','".$_POST['cdpostal_attente']."','".mysql_real_escape_string (strtoupper($_POST['ville_attente']))."','".
$_POST['titre_resp_attente']."','".mysql_real_escape_string(strtoupper($_POST['nom_resp_attente']))."','".mysql_real_escape_string (ucwords(strtolower($_POST['prenom_resp_attente'])))."','".
$_POST['courriel1_attente']."','".$_POST['courriel2_attente']."','".NumTel($_POST['telephone_attente'])."','".NumTel($_POST['tel_mobile_attente'])."','".
mysql_real_escape_string ($_POST['observation_attente'])."','".$_POST['code_confidentiel']."','attente' )" ;

# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     REQUETE INSERTION            XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 $req_desc_table = "INSERT INTO  `attente`  ( " . 
"`route_index`,`type_attente`,`date_liste_attente`,`sexe_attente`,`nom_attente`,`prenom_attente`,`cdpostal_attente`,`ville_attente`,`titre_resp_attente`,`nom_resp_attente`,`prenom_resp_attente`,".
"`courriel1_attente`,`courriel2_attente`,`telephone_attente`,`tel_mobile_attente`,`observation_attente`,`code_confidentiel`,`etat_attente`)    VALUES ";

$req_inscription  = $req_desc_table . $_requette; 
$res_insertion =    log_mysql_query($req_inscription  , $mysql );


if ( $res_insertion <> 1)
{	echo "requete ".$req_inscription;
   echo "Une erreur s'est produite lors de l'envoie de votre fiche sur liste d'attente au serveur". "<BR>" ;
   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
}
mysql_close();
?>

