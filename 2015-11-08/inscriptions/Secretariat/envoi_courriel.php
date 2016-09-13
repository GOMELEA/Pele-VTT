<?php
$_var_index_inscription=$Selection;
// ************************************************* Recherche de l'inscription  ****************************************************************
include('../include/base/connexion_serveur.php');
$resultat = log_mysql_query("Select * from `inscription` where `index_inscription`='".$_var_index_inscription."'",$mysql) or die ("Requ�te non execut�e.");
$inscription = mysql_fetch_array($resultat);
$inscription=stripslashes_deep($inscription);

 	// On va chercher la d�finition de la classe
   require('../class.phpmailer.php');
 
   // On cr�� une nouvelle instance de la classe
   $mail = new PHPMailer();
   $mail->IsHTML(true);
   
   // De qui vient le message, e-mail puis nom
   $mail->From = $_SESSION['courriel_expediteur'];
   $mail->FromName = "Secr�tariat P�l� VTT - ".$_SESSION['departement'];
 
   // D�finition du sujet/objet
   $mail->Subject = "P�l� VTT";
 
   // On d�finit le corps du message
   $_message="Bonjour ". $inscription['titre_inscription']." ". $inscription['prenom_inscription'] ." " .$inscription['nom_inscription'] .",<br><br><br><br>";
   
   if ($_SESSION['renvoie_dossier']==1)
   {	
		$delais = mktime(0, 0, 0, date("m")  , date("d")+15, date("Y"));
		$_message=$_message."Nous vous renvoyons les documents r�capitulatif de votre inscription au P�l� VTT, ainsi que les documents � imprimer et � nous retourner ";
		$_message=$_message."sign�s accompagn�s de votre r�glement par courrier avant le ".date("d-m-Y", $delais).".<br> <br> Si vous n'arrivez pas � ouvrir la pi�ce jointe vous pouvez installer le logiciel ".
		"gratuit � l'adresse suivante http://get.adobe.com/fr/reader/<br><br>";
   }
   if ($_SESSION['ar_documents']==1)
   {	
		$_message=$_message."Nous avons bien re�u les documents que vous nous avez fait parvenir par courrier.<br><br>";
   }
   if ($_SESSION['attestation']==1)
   {	
		$_message=$_message."Nous vous envoyons en pi�ce jointe le re�u et l'attestation des personnes inscrites par vos soin au P�l� VTT.<br> <br>";
		$_message=$_message."Si vous n'arrivez pas � ouvrir la pi�ce jointe vous pouvez installer le logiciel gratuit � l'adresse suivante http://get.adobe.com/fr/reader/<br><br>";
   }
   if ($_SESSION['confirmation_inscription']==1)
   {	
		$_message=$_message."Nous vous confirmons l'inscription au p�l� VTT des personnes suivantes:";
		// Recherche de l'inscription en cours
		$req_fiche  = "  SELECT * FROM `fiche` WHERE fiche_numero_inscription = ". $inscription['index_inscription']." and corbeille <>'oui' order by `nom_usage`,`prenom`;" ;
		$res_fiche   = log_mysql_query($req_fiche  , $mysql);
		while ($tabres = mysql_fetch_array ($res_fiche))
		 { 
			$tab=stripslashes_deep($tabres);
			// Afichage des noms et pr�noms
			$_message=$_message."<br>- ".$tab['nom_usage']." ".$tab['prenom'];
		}
		$_message=$_message."<br><br>";
   }
   if ($_SESSION['manque_piece']==1)
   {	
		$_message=$_message."D�sol�, mais votre dossier d'inscription au P�l� VTT n'est pas complet. ";
		$_message=$_message."Nous vous rapellons que le p�l� VTT �tant soumis au contr�le Jeunesse et Sport, nous sommes tenus d'�tre en possession de tous ces documents ".
			"administratifs.<br><br>Vous trouverez ci-apr�s la liste des pi�ces manquantes � votre dossier";
		
		// Recherche de l'inscription en cours
		$req_fiche  = "  SELECT * FROM `fiche` WHERE fiche_numero_inscription = ". $inscription['index_inscription']." and corbeille <>'oui' order by `nom_usage`,`prenom`;" ;
		$res_fiche   = log_mysql_query($req_fiche  , $mysql);
		$_message=$_message."<br><br>LISTE DES PERSONNES INSCRITES : <br>";
		$ttv=0;
		$abs=0;
		$staff=0;
		$animateur=0;
		$collegien=0;
		$fiche_inscription=0;
		$fiche_sanitaire=0;
		$charte_du_pelerin=0;
		while ($tabres = mysql_fetch_array ($res_fiche))
		 { 
			$tabres=stripslashes_deep($tabres);
			$req_f  = "SELECT * FROM `fiche` WHERE `index` = ". $tabres[0]." and corbeille <>'oui';" ;
			$res_f   = log_mysql_query($req_f  , $mysql);
			// Afichage pour chaque fiche des documents � envoyer
			while ($tab = mysql_fetch_array ($res_f))
			 { 
				$tab=stripslashes_deep($tab);
				// Afichage des noms et pr�noms
				$_message=$_message."<br>- ".$tab['nom_usage']." ".$tab['prenom'];
				// Calcul de l'age
				$naissance=mktime(0,0,0,substr($tab['date_naissance'],5,2),substr($tab['date_naissance'],8,2),substr($tab['date_naissance'],0,4));
				$d1 = explode("-", $_SESSION['jour_debut_camp']);
				$date_camp=mktime(0,0,0, $d1[1], $d1[2], $d1[0]);
				$secondes = ($date_camp > $naissance)? $date_camp - $naissance : $naissance - $date_camp;
				$age = date('Y', $secondes) - 1970;
				if ($tab['diplome_encadrement']<>"")
				{
					$res=mysql_fetch_array(log_mysql_query("SELECT * FROM diplome WHERE index_diplome='".$tab['diplome_encadrement']."'",$mysql));
					$tab['description_diplome_encadrement']=stripslashes($res['description_diplome']);
				}
		
				switch ($tab['type']) {
					case "ttv":
						$_message=$_message." (TTV - Plus de 25 ans) <br>";
						if ($tab['documents_signe']==1) $_message=$_message."   - Bravo!!! Nous avons tous les documents.  <br>";
						Else
						{	if ($tab['charte_pelerin']<>1) {$_message=$_message."   - Il nous manque la charte du P�lerin sign�e <br>";$charte_du_pelerin=$charte_du_pelerin+1;}
							if ($tab['assurance_voiture']<>1) $_message=$_message."   - Il nous manque la copie de la carte verte de votre assurance voiture si vous utilisez votre v�hicule pendant le P�l� VTT<br>";
							if ($tab['certificat_vaccination']<>1) $_message=$_message."   - Il nous manque l'attestation de vaccination � jour d�livr� par le m�decin traitant ou une photocopie de votre carnet de vaccination � jour<br>";
							if ($tab['manipulation_denrees']<>1 and $tab['intendance']==1) $_message=$_message."   - Il nous manque l'attestation d'aptitude � manipuler les denr�es alimentaires, d�livr� par le m�decin traitant<br>";
							if ($tab['fiche_inscription_signee']<>1) {$_message=$_message."   - Il nous manque la fiche d'inscription sign�e <br>";$fiche_inscription=$fiche_inscription+1;}
							if ($tab['diplome_encadrement']!=""  and $tab['diplome_encadrement_ok']!=1) 
								$_message=$_message."   - Il nous manque la copie de votre diplome ".$tab['description_diplome_encadrement']." <br>";
							if ($tab['attestation_encadrement']=="1" and $tab['attestation_encadrement_ok']<>"1") 
								$_message=$_message."   - Il nous manque la justification de vos 28 jours d'animation de camp de mineur<br>";
							if ($tab['diplome_medical']!="" and $tab['diplome_medical']!="sans" and $tab['diplome_medical_ok']!=1) 
								$_message=$_message."   - Il nous manque la copie de votre diplome m�dical correspondant � votre profession : ".$tab['diplome_medical']." <br>";
							if ($tab['permis']!="" and $tab['permis']!="sans" and $tab['permis_ok']!=1) 
								$_message=$_message."   - Il nous manque la copie de votre permis ".$tab['permis']." <br>)";
							if ($tab['casier']<>1) {$_message=$_message.'   - Il nous manque un extrait de votre casier judiciaire (disponible sur Internet,
								 <a href="https://www.cjn.justice.gouv.fr/cjn/b3/eje20c" 		target="_blank">cliquez ICI </a>)<br>';}
						}
						$ttv=1;
						break;
					case "ggg":
						$_message=$_message." (GGG) <br>";
						if ($tab['documents_signe']==1) $_message=$_message."   - Bravo!!! Nous avons tous les documents.  <br>";
						Else
						{	if ($tab['charte_pelerin']<>1) {$_message=$_message."   - Il nous manque la charte du P�lerin sign�e <br>";$charte_du_pelerin=$charte_du_pelerin+1;}
							if ($tab['assurance_voiture']<>1) $_message=$_message."   - Il nous manque la copie de la carte verte de votre assurance voiture si vous utilisez votre v�hicule pendant le P�l� VTT<br>";
							if ($tab['certificat_vaccination']<>1) $_message=$_message."   - Il nous manque l'attestation de vaccination � jour d�livr� par le m�decin traitant ou une photocopie de votre carnet de vaccination � jour<br>";
							if ($tab['fiche_inscription_signee']<>1) {$_message=$_message."   - Il nous manque la fiche d'inscription sign�e <br>";$fiche_inscription=$fiche_inscription+1;}
							if ($tab['diplome_encadrement']!=""  and $tab['diplome_encadrement_ok']!=1) 
								$_message=$_message."   - Il nous manque la copie de votre diplome ".$tab['description_diplome_encadrement']." <br>";
							if ($tab['attestation_encadrement']=="1" and $tab['attestation_encadrement_ok']<>"1") 
								$_message=$_message."   - Il nous manque la justification de vos 28 jours d'animation de camp de mineur<br>";
							if ($tab['diplome_medical']!="" and $tab['diplome_medical']!="sans" and $tab['diplome_medical_ok']!=1) 
								$_message=$_message."   - Il nous manque la copie de votre diplome m�dical correspondant � votre profession : ".$tab['diplome_medical']." <br>";
							if ($tab['permis']!="" and $tab['permis']!="sans" and $tab['permis_ok']!=1) 
								$_message=$_message."   - Il nous manque la copie de votre permis ".$tab['permis']." <br>";
							if ($tab['casier']<>1) {$_message=$_message.'   - Il nous manque un extrait de votre casier judiciaire (disponible sur Internet,
								 <a href="https://www.cjn.justice.gouv.fr/cjn/b3/eje20c" 		target="_blank">cliquez ICI </a>)<br>';}
						}
						break;
					case "ogm":
						$_message=$_message." (OGM) <br>";
						if ($tab['documents_signe']==1) $_message=$_message."   - Bravo!!! Nous avons tous les documents.  <br>";
						Else
						{	if ($tab['charte_pelerin']<>1) {$_message=$_message."   - Il nous manque la charte du P�lerin sign�e <br>";$charte_du_pelerin=$charte_du_pelerin+1;}
							if ($tab['assurance_voiture']<>1) $_message=$_message."   - Il nous manque la copie de la carte verte de votre assurance voiture si vous utilisez votre v�hicule pendant le P�l� VTT<br>";
							if ($tab['certificat_vaccination']<>1) $_message=$_message."   - Il nous manque l'attestation de vaccination � jour d�livr� par le m�decin traitant ou une photocopie de votre carnet de vaccination � jour<br>";
							if ($tab['fiche_inscription_signee']<>1) {$_message=$_message."   - Il nous manque la fiche d'inscription sign�e <br>";$fiche_inscription=$fiche_inscription+1;}
							if ($tab['diplome_encadrement']!=""  and $tab['diplome_encadrement_ok']!=1) 
								$_message=$_message."   - Il nous manque la copie de votre diplome ".$tab['description_diplome_encadrement']." <br>";
							if ($tab['attestation_encadrement']=="1" and $tab['attestation_encadrement_ok']<>"1") 
								$_message=$_message."   - Il nous manque la justification de vos 28 jours d'animation de camp de mineur<br>";
							if ($tab['diplome_medical']!="" and $tab['diplome_medical']!="sans" and $tab['diplome_medical_ok']!=1) 
								$_message=$_message."   - Il nous manque la copie de votre diplome m�dical correspondant � votre profession : ".$tab['diplome_medical']." <br>";
							if ($tab['permis']!="" and $tab['permis']!="sans" and $tab['permis_ok']!=1) 
								$_message=$_message."   - Il nous manque la copie de votre permis ".$tab['permis']." <br>";
							if ($tab['casier']<>1) {$_message=$_message.'   - Il nous manque un extrait de votre casier judiciaire (disponible sur Internet,
								 <a href="https://www.cjn.justice.gouv.fr/cjn/b3/eje20c" 		target="_blank">cliquez ICI </a>)<br>';}
						}
						break;
					case "abs":
						$_message=$_message." (ABS) <br>";
						if ($tab['documents_signe']==1) $_message=$_message."   - Bravo!!! Nous avons tous les documents.  <br>";
						Else
						{	if ($tab['charte_pelerin']<>1) {$_message=$_message."   - Il nous manque la charte du P�lerin sign�e <br>";$charte_du_pelerin=$charte_du_pelerin+1;}
							if ($tab['assurance_voiture']<>1) $_message=$_message."   - Il nous manque la copie de la carte verte de votre assurance voiture si vous utilisez votre v�hicule pendant le P�l� VTT<br>";
							if ($tab['certificat_vaccination']<>1) $_message=$_message."   - Il nous manque l'attestation de vaccination � jour d�livr� par le m�decin traitant ou une photocopie de votre carnet de vaccination � jour<br>";
							if ($tab['fiche_inscription_signee']<>1) {$_message=$_message."   - Il nous manque la fiche d'inscription sign�e <br>";$fiche_inscription=$fiche_inscription+1;}
							if ($tab['diplome_encadrement']!=""  and $tab['diplome_encadrement_ok']!=1) 
								$_message=$_message."   - Il nous manque la copie de votre diplome ".$tab['description_diplome_encadrement']." <br>";
							if ($tab['attestation_encadrement']=="1" and $tab['attestation_encadrement_ok']<>"1") 
								$_message=$_message."   - Il nous manque la justification de vos 28 jours d'animation de camp de mineur<br>";
							if ($tab['diplome_medical']!="" and $tab['diplome_medical']!="sans" and $tab['diplome_medical_ok']!=1) 
								$_message=$_message."   - Il nous manque la copie de votre diplome m�dical correspondant � votre profession : ".$tab['diplome_medical']." <br>";
							if ($tab['permis']!="" and $tab['permis']!="sans" and $tab['permis_ok']!=1) 
								$_message=$_message."   - Il nous manque la copie de votre permis ".$tab['permis']." <br>";
							if ($tab['casier']<>1) {$_message=$_message.'   - Il nous manque un extrait de votre casier judiciaire (disponible sur Internet,
								 <a href="https://www.cjn.justice.gouv.fr/cjn/b3/eje20c" 		target="_blank">cliquez ICI </a>)<br>';}
						}
						$abs=1;
						break;
					case "staff":
						$_message=$_message." (Staff - Lyc�en) <br>";
						if ($tab['documents_signe']==1) $_message=$_message."   - Bravo!!! Nous avons tous les documents.  <br>";
						Else
						{	if ($tab['charte_pelerin']<>1) {$_message=$_message."   - Il nous manque la charte du P�lerin sign�e <br>";$charte_du_pelerin=$charte_du_pelerin+1;}
							if ($tab['fiche_liaison']<>1) {$_message=$_message."   - Il nous manque la fiche de liaison sanitaire, remplie et sign�e<br>";$fiche_sanitaire=$fiche_sanitaire+1;}
							if ($tab['fiche_inscription_signee']<>1) {$_message=$_message."   - Il nous manque la fiche d'inscription sign�e <br>";$fiche_inscription=$fiche_inscription+1;}
						}
						$staff=1;
						break;
					case "animateur":
						$_message=$_message." (Animateur) <br>";
						if ($tab['documents_signe']==1) $_message=$_message."   - Bravo!!! Nous avons tous les documents.  <br>";
						Else
						{	if ($tab['charte_pelerin']<>1) {$_message=$_message."   - Il nous manque la charte du P�lerin sign�e <br>";$charte_du_pelerin=$charte_du_pelerin+1;}
							if ($tab['certificat_vaccination']<>1) $_message=$_message."   - Il nous manque l'attestation de vaccination � jour d�livr� par le m�decin traitant ou une photocopie de votre carnet de vaccination � jour<br>";
							if ($tab['fiche_inscription_signee']<>1) {$_message=$_message."   - Il nous manque la fiche d'inscription sign�e <br>";$fiche_inscription=$fiche_inscription+1;}
							if ($tab['diplome_encadrement']!=""  and $tab['diplome_encadrement_ok']!=1) 
								$_message=$_message."   - Il nous manque la copie de votre diplome ".$tab['description_diplome_encadrement']." <br>";
							if ($tab['attestation_encadrement']=="1" and $tab['attestation_encadrement_ok']<>"1") 
								$_message=$_message."   - Il nous manque la justification de vos 28 jours d'animation de camp de mineur<br>";
							if ($tab['casier']<>1) {$_message=$_message.'   - Il nous manque un extrait de votre casier judiciaire (disponible sur Internet,
								 <a href="https://www.cjn.justice.gouv.fr/cjn/b3/eje20c" 		target="_blank">cliquez ICI </a>)<br>';}
						}
						$animateur=1;
						break;
					case "collegien":
						$_message=$_message." (Coll�gien) <br>";
						if ($tab['documents_signe']==1) $_message=$_message."   - Bravo!!! Nous avons tous les documents.  <br>";
						Else
						{	if ($tab['charte_pelerin']<>1) {$_message=$_message."   - Il nous manque la charte du P�lerin sign�e <br>";$charte_du_pelerin=$charte_du_pelerin+1;}
							if ($tab['fiche_liaison']<>1) {$_message=$_message."   - Il nous manque la fiche de liaison sanitaire, remplie et sign�e<br>";$fiche_sanitaire=$fiche_sanitaire+1;}
							if ($tab['fiche_inscription_signee']<>1) {$_message=$_message."   - Il nous manque la fiche d'inscription sign�e <br>";$fiche_inscription=$fiche_inscription+1;}
						}
						$collegien=1;
						break;
				}
			}
		 }
						# *********************************************************************************
						# *****************  R�glement
						# *********************************************************************************
		$_message=$_message."<br><br>REGLEMENT : <br>";
		if ($inscription['regle']==1) $_message=$_message."   Merci, nous avons re�u l'int�gralit� du r�glement.";
		else 
			{
				$reste_a_payer=$inscription['total_reglement']-$inscription['montant_1']-$inscription['montant_2']-$inscription['montant_3']-$inscription['liquide'];
				if ($reste_a_payer==$inscription['total_reglement']) $_message=$_message."   Nous sommes dans l'attente de l'int�gralit� de votre r�glement, soit ".$reste_a_payer." euros.";
				if ($reste_a_payer<$inscription['total_reglement'] and $reste_a_payer>0) $_message=$_message."   Nous sommes dans l'attente du compl�ment de votre r�glement, soit ".$reste_a_payer." euros.";
				if ($reste_a_payer<0) $_message=$_message."   Merci, nous avons re�u l'int�gralit� du r�glement.";
			}
				
						# *********************************************************************************
						# *****************  Fin Courrier
						# *********************************************************************************
		$_message=$_message."<br><br><br>Merci de nous renvoyer rapidement les pi�ces manquantes � l'adresse suivante : <br>".nl2br($_SESSION['adresse_reglement'])."<br><br>";   
	}
   if ($_SESSION['info_pratique']==1)
   {	
		$_message=$_message."Vous trouverez en pi�ce jointe les informations pratiques pour un bon d�roulement de votre p�l� VTT.<br> <br>Si vous n'arrivez pas � ouvrir la pi�ce jointe vous pouvez installer le logiciel ".
		"gratuit � l'adresse suivante http://get.adobe.com/fr/reader/<br><br>";

   }
	
	$_message=$_message."<br><br>A tr�s bient�t  <br><br>Le Secr�tariat<br>";

   $mail->Body = $_message;
 
   // Il reste encore � ajouter au moins un destinataire
   $mail->AddAddress($inscription['courriel_inscription'], $inscription['prenom_inscription'] ." " .$inscription['nom_inscription']);
   $mail->AddBcc($_SESSION['courriel_copie']);
 

   // On met en pi�ce jointe Information collegien.pdf
	// Recherche de l'inscription en cours
   if ($_SESSION['info_pratique']==1)
   {
		$req_fiche  = "  SELECT `index` FROM `fiche` WHERE fiche_numero_inscription = ". $_var_index_inscription." and corbeille <>'oui' order by `nom_usage`,`prenom`;" ;
		$res_fiche   = log_mysql_query($req_fiche  , $mysql);
		while ($tabres = mysql_fetch_array ($res_fiche))
		 { 
			$req_f  = "SELECT type FROM `fiche` WHERE `index` = ". $tabres[0].";" ;
			$res_f   = log_mysql_query($req_f  , $mysql);
			while ($tab = mysql_fetch_array ($res_f))
			 { 
				switch ($tab['type']) 
				{
					case "ttv":($ttv=1);break;
					case "abs":($abs=1);break;
					case "staff":($staff=1);break;
					case "animateur":($animateur=1);break;
					case "collegien":($collegien=1);break;
				}
			}
		 }
		$chemin=$racine."../data/".formatage_repertoire($_SESSION['departement'])."/".$_SESSION['annee']."/";
	   if ($ttv==1) $mail->AddAttachment($chemin."Information_ttv.pdf");
	   if ($abs==1) $mail->AddAttachment($chemin."Information_abs.pdf");
	   if ($staff==1) $mail->AddAttachment($chemin."Information_staff.pdf");
	   if ($animateur==1) $mail->AddAttachment($chemin."Information_animateur.pdf");
	   if ($collegien==1) $mail->AddAttachment($chemin."Information_collegien.pdf");
	   if ($collegien==1 or $animateur==1) $mail->AddAttachment($chemin."Fiche_sanitaire_Velo.pdf");
   }
   if ($_SESSION['renvoie_dossier']==1)
   {	
		// On met nos documents en pi�ce jointe
		include('../resume_inscription_pdf.php');
		$chemin="../data/".formatage_repertoire($_SESSION['departement'])."/".$_SESSION['annee']."/";
		$fichier=formatage_repertoire($_SESSION['departement'])."_".$_SESSION['annee']."_".$_var_index_inscription.".PDF";
		$mail->AddAttachment($chemin.$fichier);
		$mail->AddAttachment($chemin."charte_du_pelerin.pdf");
		// Test pour voir s'il y a des coll�giens ou des staff, pour voir s'il faut joindre la fiche de liason sanitaire
		$req3="select count(*) FROM `fiche` WHERE (type = 'collegien' or type = 'staff') and fiche_numero_inscription = '". $_var_index_inscription ."' ";
		$res3 = log_mysql_query($req3 , $mysql);
		$resultat3=mysql_fetch_array($res3); 
		if ($resultat3[0]>0) $mail->AddAttachment($chemin."fiche_sanitaire.pdf");
   }
   if ($_SESSION['attestation']==1)
   {	
		// On met nos documents en pi�ce jointe
		include('../attestation_pdf.php');
		$chemin="../data/".formatage_repertoire($_SESSION['departement'])."/".$_SESSION['annee']."/";
		$fichier=formatage_repertoire($_SESSION['departement'])."_".$_SESSION['annee']."_".$_var_index_inscription."_attestation.PDF";
		$mail->AddAttachment($chemin.$fichier);
   }

	   
   // Pour finir, on envoi l'e-mail
   $mail->send();
   
// ************************************************* Mise en place annotation dans observation  ****************************************************************
include('include/base/connexion_serveur.php');
$_aujourdhui="Le ".date("Y-m-d � G")."h".date("i")." ";
$observation=$_aujourdhui;
if ($_SESSION['renvoie_dossier']==1) $observation=$observation."- Renvoi Dossier ";
if ($_SESSION['manque_piece']==1) $observation=$observation."- Manque Pi�ces ";
if ($_SESSION['attestation']==1) $observation=$observation."- Attestation Participation ";
if ($_SESSION['ar_documents']==1) $observation=$observation."- Documents Re�us ";
if ($_SESSION['confirmation_inscription']==1) $observation=$observation."- Confirmation de l\'inscription ";
if ($_SESSION['info_pratique']==1) $observation=$observation."- Info Pratiques ";
$observation=$observation."\n".$inscription['observation_inscription'];
$observation=addslashes($observation);

# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX       montage de la requete de mise � jour         XXXXXXXXXXXXXXXXXXXXXxXXX
$_aujourdhui=date("Y-m-d-G-i");
if ($_SESSION['renvoie_dossier']==1 or $_SESSION['manque_piece']==1) $_dates=",date_relance='". $_aujourdhui."'";
if ($_SESSION['confirmation_inscription']==1 ) $_dates=$_dates.",date_confirmation='". $_aujourdhui."'";
if ($_SESSION['info_pratique']==1 ) $_dates=$_dates.",date_info_pratique='". $_aujourdhui."'";
if ($_SESSION['attestation']==1 ) $_dates=$_dates.",date_attestation='". $_aujourdhui."'";

$_requette = "UPDATE   `inscription`  SET observation_inscription = '" . $observation ."'".$_dates." WHERE index_inscription = '".$_var_index_inscription."' ";
$res_insertion =    log_mysql_query($_requette  , $mysql );


mysql_close();
?>

