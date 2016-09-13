<?php
include("../fpdf.php");
include("../phpToPDF.php");

// ************************************************* CHARGEMENT DE L'INSCRIPTION  ****************************************************************
include("../include/base/connexion_serveur.php");
$req="select * FROM `inscription` WHERE index_inscription='".$_var_index_inscription."' ";
$res = log_mysql_query($req , $mysql);
$inscription=mysql_fetch_array($res); 
$inscription=stripslashes_deep($inscription);

$PDF = new phpToPDF();

// ************************************************* PAGE D'ENTETE  ****************************************************************
$PDF->AddPage();
$PDF->Image("../Photo/bandeau_vide.jpg",0,0,220);
$PDF->SetTextColor(236,184,99);
$PDF->SetFont("Arial","",10);
$PDF->SetXY(84,22);$PDF->Write(6,"de  ". $_SESSION['lieu_depart']."\n");
$PDF->SetXY(84,28);$PDF->Write(6,"à  ". $_SESSION['lieu_arrive']."\n");
$PDF->SetXY(84,34);$PDF->Write(6,"du  ". convdate($_SESSION['jour_debut_camp'])." au ". convdate($_SESSION['jour_fin_camp']));
$PDF->SetFillColor(255,255,255);
$PDF->SetFont("Arial","B",13);
$PDF->SetXY(30,50);
$PDF->Write(10,$_SESSION['nom_association']."\n".$_SESSION['adresse_association']."\nN° de SIRET : ".$_SESSION['siret_association']."\nN° d\'organisateur séjours DDCS : ".$_SESSION['_organisateur_DDCS']."\n\n\n");
$PDF->SetFont("Arial","B",16);
$PDF->Write(10,"Reçu et attestation de présence\n\n\n");

$PDF->SetFont("Arial","",10);
$PDF->SetLeftMargin("20");
$PDF->SetTextColor(10,10,10);
$PDF->Write(10,"atteste que ". $inscription['titre_inscription']." ". $inscription['prenom_inscription'] ." " .$inscription['nom_inscription'] ."a versé à notre association la somme totale de " 
			.$inscription['total_reglement'] ."€ comme participation aux frais du séjour Pélé VTT organisé par notre association et agréé par la Direction Départementale de la Cohésion sociale sous le n° "
			.$_SESSION['n_camp_DDCS']."\n\n");
$PDF->Write(4,"Séjour auquel les personnes suivantes ont participé :");

// Recherche de l'inscription en cours
$req_fiche  = "  SELECT `index`,`titre`,`nom`,`prenom`,`reglement` FROM `fiche` WHERE fiche_numero_inscription = ". $_var_index_inscription." order by `nom`,`prenom`;" ;
echo $req_fiche;
$res_fiche   = log_mysql_query($req_fiche  , $mysql);
while ($tabres = mysql_fetch_array ($res_fiche))
 { 
 	$tabres=stripslashes_deep($tabres);
	$PDF->SetFont("Arial","",9);
	$PDF->SetLeftMargin("30");
	$PDF->Write(4,"\n- ".$tabres['titre']." ".$tabres['nom']." ".$tabres['prenom']." pour un montant de ".$tabres['reglement']." €");
 }

// Sauvegarde du Fichier
$chemin="../data/".formatage_repertoire($_SESSION['departement'])."/".$_SESSION['annee']."/";
$fichier=formatage_repertoire($_SESSION['departement'])."_".$_SESSION['annee']."_".$_var_index_inscription."attestation.PDF";
error_reporting(0);
mkdir ("data/".formatage_repertoire($_SESSION['departement']),0777);
mkdir ("data/".formatage_repertoire($_SESSION['departement'])."/".$_SESSION['annee'],0777);
error_reporting(1);
$PDF->Output($chemin.$fichier, "F");
?>


