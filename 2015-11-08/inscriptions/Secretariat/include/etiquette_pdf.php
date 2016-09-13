<?php
include("../fpdf.php");
include("../phpToPDF.php");

// ************************************************* CHARGEMENT DES SOUTIENS  ****************************************************************
include("../include/base/connexion_serveur.php");
$req="select * FROM `soutien` ".$_SESSION['where_soutien']." order by cdpostal, ville,adresse_1 ";
$res = log_mysql_query($req , $mysql);

// ************************************************* EDITION DES ETIQUETTES  ****************************************************************
$PDF = new phpToPDF();
$PDF->AddPage();
$PDF -> SetMargins (0,0) ;
$PDF->SetXY(5,0);
$PDF->SetFont('Arial','',10);
$nb_etiquette=0;
$nbcol=1;
$nblig=0;
	
	while ($tabres = mysql_fetch_array ($res))
	{
		$tabres=stripslashes_deep($tabres);
		$texte="\n";
		if ($tabres['nom']<>"" or $tabres['prenom']<>"") 
			{$texte=$texte.$tabres['titre'].' '.$tabres['nom'].' '.$tabres['prenom']."\n ";}
		if ($tabres['societe']<>"") 
			{$texte=$texte.$tabres['societe']."\n ";}
		if ($tabres['adresse_1']<>"") 
			{$texte=$texte.$tabres['adresse_1']."\n ";}
		if ($tabres['adresse_2']<>"") 
			{$texte=$texte.$tabres['adresse_2']."\n ";}
		if ($tabres['adresse_3']<>"") 
			{$texte=$texte.$tabres['adresse_3']."\n ";}
		$texte=$texte.$tabres['cdpostal'].' '.$tabres['ville']."\n ";
		if ($tabres['pays']<>"") 
			{$texte=$texte.$tabres['pays']."\n ";}
		$PDF->MultiCell(60,5, $texte, 0,"C");
		$PDF->SetXY($nbcol*70+5,$nblig*37);
		$nb_etiquette=$nb_etiquette+1;
		$nbcol=$nbcol+1;
		if ($nbcol==3) {$nbcol=0;$nblig=$nblig+1;}
		if ($nb_etiquette==21) {$PDF->AddPage();$nb_etiquette=0;$nblig=0;$PDF->SetXY(5,0);}
	}
// ************************************************* Sauvegarde du Fichier  ****************************************************************
	$chemin="../data/".formatage_repertoire($_SESSION['departement'])."/".$_SESSION['annee']."/";
	$fichier="etiquette.PDF";
	error_reporting(0);
	mkdir ("data/".formatage_repertoire($_SESSION['departement']),0777);
	mkdir ("data/".formatage_repertoire($_SESSION['departement'])."/".$_SESSION['annee'],0777);
	error_reporting(1);
	$PDF->Output($chemin.$fichier, "F");
	
// ************************************************* Envoi du courriel  ****************************************************************
	// On va chercher la définition de la classe
   require('../class.phpmailer.php');
 
   // On créé une nouvelle instance de la classe
   $mail = new PHPMailer();
 
   // De qui vient le message, e-mail puis nom
   $mail->From = $_SESSION['courriel_expediteur'];
   $mail->FromName = "Pélé VTT - ".$_SESSION['departement'];
 
   // Définition du sujet/objet
   $mail->Subject = "Pélé VTT - Etiquettes Soutien";
 
   // On définit le corps du message
   $_message="Bonjour ,\n\n\n\n";
	$_message=$_message."Vous trouverez en pièce jointe, les étiquettes demandées.\n";
	$_message=$_message."Nous vous rappellons que ces étiquettes sont faites pour des planches A4 de 24 étiquettes de 70 * 37 mm.\n ";
	$_message=$_message."\n \n Si vous n'arrivez pas à ouvrir la pièce jointe vous pouvez installer le logiciel ".
	"gratuit à l'adresse suivante http://get.adobe.com/fr/reader/\n\n";
	$_message=$_message."\n\nA très bientôt  \n\nLe Secrétariat\n";

   $mail->Body = $_message;
 
   // Il reste encore à ajouter au moins un destinataire
   $mail->AddAddress($courriel);
   $mail->AddBcc($_SESSION['courriel_expediteur']);
 
   // On met en pièce jointe le fichier.pdf
	$mail->AddAttachment($chemin.$fichier);
   // Pour finir, on envoi l'e-mail
   $mail->send();
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX       montage de la requete de mise à jour         XXXXXXXXXXXXXXXXXXXXXxXXX
	$_aujourdhui=date("Y-m-d");
	$_requette = "UPDATE   `soutien`  SET date_impression = '" . $_aujourdhui ."' ".$_SESSION['where_soutien']."";
	$res_insertion =    log_mysql_query($_requette  , $mysql );

   
?>


