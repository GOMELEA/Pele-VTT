<?php
# xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx     Copie des valeurs du formulaire dans variable locale        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
# xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx     éléments de l'INSCRIPTION

include('../include/base/connexion_serveur.php');

$_index_route=$_SESSION['index_route'];
$_titre_inscription=$_POST['titre_inscription'];
$_nom_inscription=mysql_real_escape_string(strtoupper($_POST['nom_inscription']));
$_prenom_inscription=mysql_real_escape_string(ucwords(strtolower($_POST['prenom_inscription'])));
$_courriel_inscription=$_POST['courriel_inscription'];
$_qte_dvd=$_POST['qte_dvd'];
$_reglement_dvd=$_POST['reglement_dvd'];
$_date_inscription=$_POST['date_inscription'];
$_soutien=$_POST['soutien'];
$_total_reglement=$_POST['total_reglement'];
$_n_cheque_1=$_POST['n_cheque_1'];
$_banque_1=mysql_real_escape_string($_POST['banque_1']);
$_nom_cheque_1=mysql_real_escape_string(strtoupper($_POST['nom_cheque_1']));
$_prenom_cheque_1=mysql_real_escape_string(ucwords(strtolower($_POST['prenom_cheque_1'])));
$_montant_1=$_POST['montant_1'];
if ($_POST['date_cheque_1']=='0000-00-00' and $_montant_1>0) $_date_cheque_1=date('Y-m-d');
else $_date_cheque_1=$_POST['date_cheque_1'];
$_n_cheque_2=$_POST['n_cheque_2'];
$_banque_2=mysql_real_escape_string($_POST['banque_2']);
$_nom_cheque_2=mysql_real_escape_string(strtoupper($_POST['nom_cheque_2']));
$_prenom_cheque_2=mysql_real_escape_string(ucwords(strtolower($_POST['prenom_cheque_2'])));
$_montant_2=$_POST['montant_2'];
if ($_POST['date_cheque_2']=='0000-00-00' and $_montant_2>0) $_date_cheque_2=date('Y-m-d');
else $_date_cheque_2=$_POST['date_cheque_2'];
$_n_cheque_3=$_POST['n_cheque_3'];
$_banque_3=mysql_real_escape_string($_POST['banque_3']);
$_nom_cheque_3=mysql_real_escape_string(strtoupper($_POST['nom_cheque_3']));
$_prenom_cheque_3=mysql_real_escape_string(ucwords(strtolower($_POST['prenom_cheque_3'])));
$_montant_3=$_POST['montant_3'];
if ($_POST['date_cheque_3']=='0000-00-00' and $_montant_3>0) $_date_cheque_3=date('Y-m-d');
else $_date_cheque_3=$_POST['date_cheque_3'];
$_liquide=$_POST['liquide'];
$_nb_cheque_10=$_POST['nb_cheque_10'];
$_nb_cheque_15=$_POST['nb_cheque_15'];
$_nb_cheque_20=$_POST['nb_cheque_20'];
$_reglement_caf=$_POST['reglement_caf'];
if ($_POST['date_autre_reglement']=='0000-00-00' and ($_nb_cheque_10>0 or $_nb_cheque_20>0 or $_nb_cheque_15>0 or $_liquide>0 or $_reglement_caf>0)) $_date_autre_reglement=date('Y-m-d');
else $_date_autre_reglement=$_POST['date_autre_reglement'];
$_regle=$_POST['regle'];
$_demande_attestation=$_POST['demande_attestation'];
$_complete=$_POST['complete'];
$_observation_inscription=mysql_real_escape_string($_POST['observation_inscription']);

?>
