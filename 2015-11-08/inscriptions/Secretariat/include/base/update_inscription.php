<?php
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX       montage de la requete de modification  pour l'INSCRIPTION         XXXXXXXXXXXXXXXXXXXXXxXXX

$_reglement_dvd = $_qte_dvd*$_SESSION['cout_dvd'];
$req="select sum(reglement) AS SOMME  FROM `fiche` WHERE fiche_numero_inscription='" . $index_inscription."' and corbeille <>'oui' ";
$res = log_mysql_query($req , $mysql);
$resultat=mysql_fetch_array($res); 
$_total_reglement=($resultat[0]+$_reglement_dvd +$_soutien);

$req_modif_fiche = "UPDATE   `inscription`  SET route_index='" . $_index_route. "',titre_inscription='" . $_titre_inscription. "',nom_inscription='" . 
$_nom_inscription. "',prenom_inscription='" . $_prenom_inscription. "',courriel_inscription='" . 
$_courriel_inscription. "',qte_dvd='".$_qte_dvd."',reglement_dvd='".$_reglement_dvd."',date_inscription='" .
$_date_inscription. "',soutien='" . $_soutien. "',total_reglement='" . 
$_total_reglement. "',n_cheque_1='" . $_n_cheque_1. "',date_cheque_1='" . $_date_cheque_1. "',banque_1='" . $_banque_1. "',nom_cheque_1='" . 
$_nom_cheque_1. "',prenom_cheque_1='" . $_prenom_cheque_1. "',montant_1='" . $_montant_1. "',n_cheque_2='" . 
$_n_cheque_2. "',date_cheque_2='" . $_date_cheque_2."',banque_2='" . $_banque_2. "',nom_cheque_2='" . $_nom_cheque_2. "',prenom_cheque_2='" . 
$_prenom_cheque_2. "',montant_2='" . $_montant_2. "',n_cheque_3='" . $_n_cheque_3. "',date_cheque_3='" . $_date_cheque_3."',banque_3='" . $_banque_3. "',nom_cheque_3='" . 
$_nom_cheque_3. "',prenom_cheque_3='" . $_prenom_cheque_3. "',montant_3='" . $_montant_3. "',liquide='" . $_liquide."',date_autre_reglement='" . $_date_autre_reglement."',nb_cheque_10='".
$_nb_cheque_10."',nb_cheque_15='" . $_nb_cheque_15."',nb_cheque_20='" . $_nb_cheque_20."',reglement_caf='" . $_reglement_caf. "',regle='" . 
$_regle. "',complete='" . $_complete."',demande_attestation='" . $_demande_attestation. "',observation_inscription='" . $_observation_inscription."' WHERE `index_inscription` = '". $index_inscription ."' ";

 $res_insertion =    log_mysql_query( $req_modif_fiche, $mysql );

if ( $res_insertion == 1)
{
}
else
{
   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pelevtt.fr". "<BR>" ;
}

mysql_close();
?>
