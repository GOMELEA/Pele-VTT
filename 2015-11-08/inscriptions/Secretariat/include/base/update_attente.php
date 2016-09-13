<?php
# Gère la modification sur la base Mysql de la fiche de liste d'attente

include('../include/base/connexion_serveur.php');


# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX       montage de la requete d'insertion par blocs            XXXXXXXXXXXXXXXXXXXXXxXXX
$req_modif_fiche = "UPDATE   `attente`  SET route_index='" . $_SESSION['index_route']."',type_attente='" . $_POST['type_attente']. 
"',sexe_attente='" . $_POST['sexe_attente'].
"',nom_attente='" . mysql_real_escape_string(strtoupper($_POST['nom_attente']))."',prenom_attente='" . mysql_real_escape_string (ucwords(strtolower($_POST['prenom_attente']))).
"',cdpostal_attente='" . $_POST['cdpostal_attente']."',ville_attente='" . mysql_real_escape_string (strtoupper($_POST['ville_attente'])).
"',titre_resp_attente='" . $_POST['titre_resp_attente']."',nom_resp_attente='" . mysql_real_escape_string(strtoupper($_POST['nom_resp_attente'])).
"',prenom_resp_attente='" . mysql_real_escape_string (ucwords(strtolower($_POST['prenom_resp_attente'])))."',courriel1_attente='" . $_POST['courriel1_attente'].
"',courriel2_attente='" . $_POST['courriel2_attente']."',telephone_attente='" . NumTel($_POST['telephone_attente']).
"',tel_mobile_attente='" . NumTel($_POST['tel_mobile_attente'])."',observation_attente='" . mysql_real_escape_string ($_POST['observation_attente']).
"',date_limite_inscription='" . $_POST['date_limite_inscription']."',code_confidentiel='" . $_POST['code_confidentiel'].
"' WHERE `index_attente` = '". $index ."' ";
$res_insertion =    log_mysql_query($req_modif_fiche  , $mysql );


if ( $res_insertion <> 1)
{	echo "requete ".$req_inscription;
   echo "Une erreur s'est produite lors de l'envoie de votre fiche sur liste d'attente au serveur". "<BR>" ;
   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
}
mysql_close();
?>

