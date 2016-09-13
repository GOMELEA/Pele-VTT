<?php
include("fpdf.php");
include("phpToPDF.php");

// ************************************************* CHARGEMENT DE L'INSCRIPTION  ****************************************************************
include("include/base/connexion_serveur.php");
$req="select * FROM `inscription` WHERE index_inscription='".$_var_index_inscription."' ";
$res = log_mysql_query($req , $mysql);
$inscription=mysql_fetch_array($res); 
$inscription=stripslashes_deep($inscription);

$PDF = new phpToPDF();

// ************************************************* ENTETE  ****************************************************************
$PDF->AddPage();
$PDF->Image(dirname(__FILE__)."/Photo/bandeau_vide.jpg",0,0,220);
$PDF->SetTextColor(236,184,99);
$PDF->SetFont("Arial","",10);
$PDF->SetXY(84,22);$PDF->Write(6,"de  ". $_SESSION['lieu_depart']."\n");
$PDF->SetXY(84,28);$PDF->Write(6,"à  ". $_SESSION['lieu_arrive']."\n");
$PDF->SetXY(84,34);$PDF->Write(6,"du  ". convdate($_SESSION['jour_debut_camp'])." au ". convdate($_SESSION['jour_fin_camp']));
$PDF->SetFillColor(255,255,255);
$PDF->SetTextColor(10,10,10);
$PDF->SetFont("Arial","",13);
$PDF->SetXY(10,50);
$PDF->Write(6,$_SESSION['nom_association']."\n".$_SESSION['adresse_association']."\nN° de SIRET : ".$_SESSION['siret_association']."\nN° d'organisateur séjours DDCS : ".$_SESSION['n_organisateur_DDCS']."\n\n\n");
$PDF->SetFont("Arial","B",20);
$PDF->SetLeftMargin("55");
$PDF->Write(10,"Reçu et Attestation de présence\n\n");

$PDF->SetFont("Arial","",10);
$PDF->SetLeftMargin("20");$PDF->Write(6,"\n");
$PDF->SetTextColor(10,10,10);
// ************************************************* RECHERCHE OGM  ****************************************************************
$req_liste= "  SELECT `nom_usage`,`prenom` FROM fiche WHERE `type`= 'ogm' ".$_SESSION['and'] ;
$res_liste= log_mysql_query($req_liste , $mysql);
$tabres = mysql_fetch_array ($res_liste);
$tabres=stripslashes_deep($tabres);
$PDF->Write(7,$tabres['prenom']." ".$tabres['nom_usage'].", directeur de camp, atteste que ");
$PDF->SetFont("Arial","B",12);
$PDF->Write(7,$inscription['titre_inscription']." ". $inscription['prenom_inscription'] ." " .$inscription['nom_inscription'] ."\n");
$PDF->SetFont("Arial","",10);
$PDF->Write(7,"a versé à notre association la somme totale de ");
$PDF->SetFont("Arial","B",12);
$PDF->Write(7,$inscription['total_reglement'] ."€ \n");
$PDF->SetFont("Arial","",10);
$PDF->Write(7,"comme participation aux frais du séjour Pélé VTT, camp organisé par notre association ".$_SESSION['nom_association']."\net agréé par la Direction Départementale de la Cohésion Sociale \nsous le n° "
			.$_SESSION['n_camp_DDCS'].".\n\n");
$PDF->SetFont("Arial","B",12);

$aujourdhui = mktime(0, 0, 0, date("m"), date("d"), date("y")); 
if ( $aujourdhui<maketime($_SESSION['jour_fin_camp'])) $avant_camp=true;
else $avant_camp=false;

if ($avant_camp==true)  $PDF->Write(4,"Séjour auquel les personnes suivantes vont participer :");
else $PDF->Write(4,"Séjour auquel les personnes suivantes ont participé :");

// Recherche de l'inscription en cours
$PDF->SetFont("Arial","",12);
if ($avant_camp==true)$req_fiche  = "  SELECT `index`,`titre`,`nom_usage`,`prenom`,`reglement`,`type` FROM `fiche` WHERE fiche_numero_inscription = ". $_var_index_inscription."  order by `nom_usage`,`prenom`;" ;
else $req_fiche  = "  SELECT `index`,`titre`,`nom_usage`,`prenom`,`reglement`,`type` FROM `fiche` WHERE fiche_numero_inscription = ". $_var_index_inscription." AND present_au_pele='1' order by `nom_usage`,`prenom`;" ;
$res_fiche   = log_mysql_query($req_fiche  , $mysql);
while ($tab = mysql_fetch_array ($res_fiche))
 { 
 	$tab=stripslashes_deep($tab);
	$PDF->SetFont("Arial","",9);
	$PDF->SetLeftMargin("30");
	$PDF->Write(6,"\n- ");
	$PDF->SetFont("Arial","B",10);
	$PDF->Write(6,$tab['titre']." ".$tab['nom_usage']." ".$tab['prenom']);
	$PDF->SetFont("Arial","",9);
	$PDF->Write(6," pour un montant de ");
	$PDF->SetFont("Arial","B",10);
	$PDF->Write(6,$tab['reglement']." € ");
 	$PDF->SetFont("Arial","",9);
	if ($tab['titre']=="collegien") $dure= "du  ". convdate($_SESSION['jour_debut_camp'])." au ". convdate($_SESSION['jour_fin_camp']);
	else $dure="du  ". convdate($_SESSION['jour_debut_precamp'])." au ". convdate($_SESSION['jour_fin_postcamp']);
	$PDF->Write(6,$dure.". ");
}
$PDF->Image(dirname(__FILE__).'/data/'.formatage_repertoire($_SESSION['departement']).'/'.$_SESSION['annee'].'/'.'signature_ogm.jpg',120,220,80);
$PDF->SetXY(50,200);
$PDF->SetLeftMargin("50");
$PDF->SetFont("Arial","",10);
$PDF->Write(10,"\n\n\nPour valoir ce que de droit\nFait le ".getJour(date("l"))." ".date("j")." ".getMois(date("F"))." ".date("Y")."\n".$tabres['prenom']." ".$tabres['nom_usage'].", Directeur de camp");


// Sauvegarde du Fichier
$racine=dirname(__FILE__);
$chemin=$racine."/data/".formatage_repertoire($_SESSION['departement'])."/".$_SESSION['annee']."/";
$fichier=formatage_repertoire($_SESSION['departement'])."_".$_SESSION['annee']."_".$_var_index_inscription."_attestation.PDF";
error_reporting(0);
mkdir ("data/".formatage_repertoire($_SESSION['departement']),0777);
mkdir ("data/".formatage_repertoire($_SESSION['departement'])."/".$_SESSION['annee'],0777);
error_reporting(1);
$PDF->Output($chemin.$fichier, "F");
?>


