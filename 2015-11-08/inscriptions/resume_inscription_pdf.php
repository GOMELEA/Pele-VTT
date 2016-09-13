<?php
include(dirname(__FILE__)."/fpdf.php");
include(dirname(__FILE__)."/phpToPDF.php");

// ************************************************* CHARGEMENT DE L'INSCRIPTION  ****************************************************************
include(dirname(__FILE__)."/include/base/connexion_serveur.php");
$req="select * FROM `inscription` WHERE index_inscription='".$_var_index_inscription."' ";
$res = log_mysql_query($req , $mysql);
$inscription=mysql_fetch_array($res); 
$inscription=stripslashes_deep($inscription);

$PDF = new phpToPDF();
// ************************************************* PAGE D'ENTETE  ****************************************************************
$PDF->AddPage();
$PDF->Image(dirname(__FILE__)."/Photo/bandeau_vide.jpg",0,0,220);
$PDF->SetTextColor(236,184,99);
$PDF->SetFont("Arial","",10);
$PDF->SetXY(84,22);$PDF->Write(6,"de  ". $_SESSION['lieu_depart']."\n");
$PDF->SetXY(84,28);$PDF->Write(6,"�  ". $_SESSION['lieu_arrive']."\n");
$PDF->SetXY(84,34);$PDF->Write(6,"du  ". convdate($_SESSION['jour_debut_camp'])." au ". convdate($_SESSION['jour_fin_camp']));
$PDF->SetFillColor(255,255,255);
$PDF->SetFont("Arial","B",13);
$PDF->SetXY(170,5);
$PDF->Cell(35,10,"Inscr: ".$_var_index_inscription,1,1,'C',true); 
$PDF->SetXY(30,50);
$PDF->SetFont("Arial","",10);
$PDF->SetLeftMargin("20");
$PDF->SetTextColor(10,10,10);
$PDF->Write(10,"Bonjour ". $inscription['titre_inscription']." ". $inscription['prenom_inscription'] ." " .$inscription['nom_inscription'] ."\n\n");
$PDF->Write(4,"Merci pour votre inscription en ligne au P�l� VTT. \n\nSur cette page, vous trouverez le r�capitulatif des documents et du montant du r�glement ".
	" � nous faire parvenir. Sur les pages suivantes, vous trouverez les fiches d'inscription � nous retourner sign�es. ");
$PDF->Write(4,"Pour faciliter le travail du secr�tariat, nous vous remercions de bien vouloir joindre avec un trombone chaque fiche d'inscription ".
	" avec les documents correspondants.\n\n");
$PDF->Write(4,"Le p�l� VTT �tant soumis au contr�le Jeunesse et Sport, nous sommes tenus d'�tre en possession de tous ces documents ".
	"administratifs.");
$PDF->SetFont("Arial","B",11);
$delais = mktime(0, 0, 0, date("m")  , date("d")+15, date("Y"));
$PDF->Write(4,"	 L'inscription ne sera donc valid�e qu'� r�ception de l'int�gralit� des documents demand�s avant le ".date("d-m-Y", $delais).".\n");

// Recherche de l'inscription en cours
$req_fiche  = "  SELECT `index`,`nom_usage`,`prenom` FROM `fiche` WHERE fiche_numero_inscription = ". $_var_index_inscription." order by `nom_usage`,`prenom`;" ;
$res_fiche   = log_mysql_query($req_fiche  , $mysql);
$PDF->SetFont("Arial","BI",13);
$PDF->SetLeftMargin("10");
$PDF->Write(10,"\nDocuments � nous faire parvenir : \n");
while ($tabres = mysql_fetch_array ($res_fiche))
 { 
 	$tabres=stripslashes_deep($tabres);
	$req_f  = "SELECT * FROM `fiche` WHERE `index` = ". $tabres[0].";" ;
	$res_f   = log_mysql_query($req_f  , $mysql);
	
	// Afichage pour chaque fiche des documents � envoyer
	while ($tab = mysql_fetch_array ($res_f))
	 { 
		$tab=stripslashes_deep($tab);
		// Afichage des noms et pr�noms
	 	$PDF->SetFont("Arial","B",10);
		$PDF->SetLeftMargin("20");
		$PDF->Write(4,"\n".$tab['nom_usage']." ".$tab['prenom']);
	 	$PDF->SetFont("Arial","",9);
		$PDF->SetLeftMargin("30");
		switch ($tab['type']) {
			case "ttv":
				$PDF->Write(4," (TTV - Plus de 25 ans) \n");
				$PDF->Write(4,"- La fiche d'inscription sign�e \n");
				$PDF->Write(4,"- Copie de la carte verte de votre assurance voiture si vous utilisez votre v�hicule pendant le P�l� VTT\n");
				if ($tab['intendance']=="1") $PDF->Write(4,"- Certificat d'aptitude � manipuler les denr�es alimentaires, d�livr� par votre m�decin traitant \n");
				if ($tab['charte_pelerin']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre charte du P�lerin sign�e de l'ann�e derni�re\n");
				else $PDF->Write(4,"- La charte du P�lerin sign�e \n");
				if ($tab['diplome_encadrement']!="" and $tab['diplome_encadrement_ok']<>1)
					$PDF->Write(4,"- Copie des diplomes d'encadrement utilis�s pendant le P�l� VTT\n"); 
				else if ($tab['diplome_encadrement_ok']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre diplome d'encadrement de l'ann�e derni�re\n");
				if ($tab['attestation_encadrement']=="1") 
					$PDF->Write(4,"- Copie des attestations d'animation de mineurs sur 28 jours pendant les 5 derni�res ann�es\n"); 
				else if ($tab['diplome_medical_ok']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre diplome m�dical de l'ann�e derni�re\n");
				if ($tab['permis']!="" and $tab['permis']!="sans" and $tab['permis_ok']<>1) 
					$PDF->Write(4,"- Copie des permis de conduire utilis�s pendant le P�l� VTT\n"); 
				else if ($tab['permis_ok']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre copie de permis de conduire de l'ann�e derni�re\n");
				if ($tab['certificat_vaccination']<>1) 
					$PDF->Write(4,"- Attestation de vaccination � jour, d�livr�e par votre m�decin traitant ou photocopie du carnet de vaccination � jour\n"); 
				else if ($tab['certificat_vaccination']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre copie d'attestation de vaccination de l'ann�e derni�re qui est encore valide\n");
				if ($tab['casier']<>"1") $PDF->Write(4,"- Un extrait de casier judiciaire N�3 datant de moins de 3 mois \n");
				break;
			case "abs":
				$PDF->Write(4," (ABS) \n");
				$PDF->Write(4,"- La fiche d'inscription sign�e \n");
				if ($tab['charte_pelerin']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre charte du P�lerin sign�e de l'ann�e derni�re\n");
				else $PDF->Write(4,"- La charte du P�lerin sign�e \n");
				if ($tab['certificat_vaccination']<>1) 
					$PDF->Write(4,"- Attestation de vaccination � jour, d�livr�e par votre m�decin traitant ou photocopie du carnet de vaccination � jour\n"); 
				else if ($tab['certificat_vaccination']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre copie d'attestation de vaccination de l'ann�e derni�re qui est encore valide\n");
				$PDF->Write(4,"- Copie de la carte verte de votre assurance voiture si vous utilisez votre v�hicule pendant le P�l� VTT\n");
				if ($tab['diplome_encadrement']!="" and $tab['diplome_encadrement_ok']<>1)
					$PDF->Write(4,"- Copie des diplomes d'encadrement utilis�s pendant le P�l� VTT\n"); 
				else if ($tab['diplome_encadrement_ok']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre diplome d'encadrement de l'ann�e derni�re\n");
				if ($tab['attestation_encadrement']=="1") 
					$PDF->Write(4,"- Copie des attestations d'animation de mineurs sur 28 jours pendant les 5 derni�res ann�es\n"); 
				if ($tab['casier']<>"1") $PDF->Write(4,"- Un extrait de casier judiciaire N�3 datant de moins de 3 mois \n");
				break;
			case "ggg":
				$PDF->Write(4," (GGG) \n");
				$PDF->Write(4,"- La fiche d'inscription sign�e \n");
				if ($tab['charte_pelerin']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre charte du P�lerin sign�e de l'ann�e derni�re\n");
				else $PDF->Write(4,"- La charte du P�lerin sign�e \n");
				if ($tab['certificat_vaccination']<>1) 
					$PDF->Write(4,"- Attestation de vaccination � jour, d�livr�e par votre m�decin traitant ou photocopie du carnet de vaccination � jour\n"); 
				else if ($tab['certificat_vaccination']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre copie d'attestation de vaccination de l'ann�e derni�re qui est encore valide\n");
				$PDF->Write(4,"- Copie de la carte verte de votre assurance voiture si vous utilisez votre v�hicule pendant le P�l� VTT\n");
				if ($tab['diplome_encadrement']!="" and $tab['diplome_encadrement_ok']<>1)
					$PDF->Write(4,"- Copie des diplomes d'encadrement utilis�s pendant le P�l� VTT\n"); 
				else if ($tab['diplome_encadrement_ok']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre diplome d'encadrement de l'ann�e derni�re\n");
				if ($tab['attestation_encadrement']=="1") 
					$PDF->Write(4,"- Copie des attestations d'animation de mineurs sur 28 jours pendant les 5 derni�res ann�es\n"); 
				if ($tab['casier']<>"1") $PDF->Write(4,"- Un extrait de casier judiciaire N�3 datant de moins de 3 mois \n");
				break;
			case "ogm":
				$PDF->Write(4," (OGM) \n");
				$PDF->Write(4,"- La fiche d'inscription sign�e \n");
				if ($tab['charte_pelerin']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre charte du P�lerin sign�e de l'ann�e derni�re\n");
				else $PDF->Write(4,"- La charte du P�lerin sign�e \n");
				if ($tab['certificat_vaccination']<>1) 
					$PDF->Write(4,"- Attestation de vaccination � jour, d�livr�e par votre m�decin traitant ou photocopie du carnet de vaccination � jour\n"); 
				else if ($tab['certificat_vaccination']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre copie d'attestation de vaccination de l'ann�e derni�re qui est encore valide\n");
				$PDF->Write(4,"- Copie de la carte verte de votre assurance voiture si vous utilisez votre v�hicule pendant le P�l� VTT\n");
				if ($tab['diplome_encadrement']!="" and $tab['diplome_encadrement_ok']<>1)
					$PDF->Write(4,"- Copie des diplomes d'encadrement utilis�s pendant le P�l� VTT\n"); 
				else if ($tab['diplome_encadrement_ok']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre diplome d'encadrement de l'ann�e derni�re\n");
				if ($tab['attestation_encadrement']=="1") 
					$PDF->Write(4,"- Copie des attestations d'animation de mineurs sur 28 jours pendant les 5 derni�res ann�es\n"); 
				if ($tab['casier']<>"1") $PDF->Write(4,"- Un extrait de casier judiciaire N�3 datant de moins de 3 mois \n");
				break;
			case "staff":
				$PDF->Write(4," (Staff - Lyc�en) \n");
				$PDF->Write(4,"- La fiche d'inscription sign�e \n");
				$PDF->Write(4,"- La charte du P�lerin sign�e \n");
				$PDF->Write(4,"- La fiche de liaison sanitaire, remplie et sign�e\n");
				break;
			case "animateur":
				$PDF->Write(4," (Animateur) \n");
				$PDF->Write(4,"- La fiche d'inscription sign�e \n");
				if ($tab['charte_pelerin']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre charte du P�lerin sign�e de l'ann�e derni�re\n");
				else $PDF->Write(4,"- La charte du P�lerin sign�e \n");
				if ($tab['certificat_vaccination']<>1) 
					$PDF->Write(4,"- Attestation de vaccination � jour, d�livr�e par votre m�decin traitant ou photocopie du carnet de vaccination � jour\n"); 
				else if ($tab['certificat_vaccination']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre copie d'attestation de vaccination de l'ann�e derni�re qui est encore valide\n");
				if ($tab['diplome_encadrement']!="" and $tab['diplome_encadrement_ok']<>1)
					$PDF->Write(4,"- Copie des diplomes d'encadrement utilis�s pendant le P�l� VTT\n"); 
				else if ($tab['diplome_encadrement_ok']=="1") 
					$PDF->Write(4,"- Nous avons conserv� votre diplome d'encadrement de l'ann�e derni�re\n");
				if ($tab['attestation_encadrement']=="1") 
					$PDF->Write(4,"- Copie des attestations d'animation de mineurs sur 28 jours pendant les 5 derni�res ann�es\n"); 
				if ($tab['casier']<>"1") $PDF->Write(4,"- Un extrait de casier judiciaire N�3 datant de moins de 3 mois \n");
				break;
			case "collegien":
				$PDF->Write(4," (Coll�gien) \n");
				$PDF->Write(4,"- La fiche d'inscription sign�e \n");
				$PDF->Write(4,"- La charte du P�lerin sign�e \n");
				$PDF->Write(4,"- La fiche de liaison sanitaire, remplie et sign�e\n");
				break;
		}
 	}
 }
				# *********************************************************************************
				# *****************  DVD
				# *********************************************************************************
if ($_SESSION['qte_dvd']<>"") 
{
	$PDF->SetFont("Arial","BI",13);
	$PDF->SetLeftMargin("10");
	$PDF->Write(10,"\nDVD du P�l� VTT : \n");
	$PDF->SetFont("Arial","",9);
	$PDF->SetLeftMargin("20");
	$PDF->Write(4," Vous avez pr�-command� ".$_SESSION['qte_dvd']." DVD du p�l� VTT.");
}
				# *********************************************************************************
				# *****************  R�glement
				# *********************************************************************************
$PDF->SetFont("Arial","BI",13);
$PDF->SetLeftMargin("10");
$PDF->Write(10,"\nMontant du r�glement : \n");
$PDF->SetFont("Arial","",9);
$PDF->SetLeftMargin("20");
$PDF->Write(4,"Merci de nous faire parvenir un ch�que de ".$inscription['total_reglement']." �, � l'ordre de ".$_SESSION['ordre_reglement']." ");
if ($inscription['soutien']>0) $PDF->Write(4,". Nous tenons � vous remercier pour les ".$inscription['soutien']." � de soutien au p�l� VTT.\n");

				# *********************************************************************************
				# *****************  Adresse Courrier
				# *********************************************************************************
$PDF->SetFont("Arial","BI",13);
$PDF->SetLeftMargin("10");
$PDF->Write(10,"\nMerci d'adresser votre courrier � : \n");
$PDF->SetFont("Arial","",9);
$PDF->SetLeftMargin("20");
$PDF->Write(4,$_SESSION['adresse_reglement']);
$PDF->SetX(100);
$PDF->Write(4,"A tr�s bient�t!\n\n	");
$PDF->SetX(150);
$PDF->Write(4,"Le Secr�tariat");

// ************************************************* PAGE D'INSCRIPTION  ****************************************************************
// Pour chaque fiche, on affiche le r�sum� de l'inscription
$req_fiche  = "  SELECT `index`,`nom_usage`,`prenom` FROM `fiche` WHERE fiche_numero_inscription = ". $_var_index_inscription." order by `nom_usage`,`prenom`;" ;
$res_fiche   = log_mysql_query($req_fiche  , $mysql);
while ($tabres = mysql_fetch_array ($res_fiche))
	{
		$tabres=stripslashes_deep($tabres);
		$req_f  = "SELECT * FROM `fiche` WHERE `index` = ". $tabres[0].";" ;
		$res_f   = log_mysql_query($req_f  , $mysql);
		// Afichage pour chaque fiche des documents � envoyer
		while ($tab = mysql_fetch_array ($res_f))
			{
				$tab=stripslashes_deep($tab);
				$PDF->AddPage();
				# *********************************************************************************
				# *****************  Change le type de bandeau en fonction du type de l'inscription
				# *********************************************************************************
				switch ($tab['type']) {
					case "ttv":
						$PDF->Image(dirname(__FILE__)."/Photo/bandeau_inscription_ttv.jpg",0,0,220);
						break;
					case "abs":
						$PDF->Image(dirname(__FILE__)."/Photo/bandeau_inscription_abs.jpg",0,0,220);
						break;
					case "staff":
						$PDF->Image(dirname(__FILE__)."/Photo/bandeau_inscription_staff.jpg",0,0,220);
						break;
					case "animateur":
						$PDF->Image(dirname(__FILE__)."/Photo/bandeau_inscription_animateur.jpg",0,0,220);
						break;
					case "ogm":
						$PDF->Image(dirname(__FILE__)."/Photo/bandeau_inscription_ogm.jpg",0,0,220);
						break;
					case "ggg":
						$PDF->Image(dirname(__FILE__)."/Photo/bandeau_inscription_ggg.jpg",0,0,220);
						break;
					case "collegien":
						$PDF->Image(dirname(__FILE__)."/Photo/bandeau_inscription_collegien.jpg",0,0,220);
						break;
				}
				# *********************************************************************************
				# *****************  Affiche le d�but du nom
				# *********************************************************************************
				$PDF->SetFillColor(255,255,255);
				$PDF->SetFont("Arial","B",25);
				$PDF->SetXY(175,2);
				$PDF->Cell(30,10,substr($tab['nom_usage'],0,5),1,1,'C',true); 
				# *********************************************************************************
				# *****************  Affiche le num�ro D'inscription
				# *********************************************************************************
				$PDF->SetFillColor(255,255,255);
				$PDF->SetFont("Arial","B",13);
				$PDF->SetXY(175,16);
				$PDF->Cell(30,10,"Inscr: ".$_var_index_inscription,1,1,'C',true); 
				# *********************************************************************************
				# *****************  Affiche le num�ro de la fiche
				# *********************************************************************************
				$PDF->SetFillColor(255,255,255);
				$PDF->SetFont("Arial","B",13);
				$PDF->SetXY(175,28);
				$PDF->Cell(30,10,"Fiche: ".$tab['index'],1,1,'C',true); 
				# *********************************************************************************
				# *****************  Charge le contact inscrit
				# *********************************************************************************
				$PDF->SetXY(10,50);
				$PDF->SetFont("Arial","B",12);
				$PDF->SetLeftMargin("10");
				$PDF->Write(4,"Coordonn�es de l'inscrit: ");
				$PDF->Write(4,$tab['titre']." ");
				$PDF->Write(4,$tab['prenom']." ".$tab['nom_usage']);
				if ($tab['nom_civil']<>"") $PDF->Write(4," (".$tab['nom_civil'].")\n");
				else $PDF->Write(4,"\n");
				$PDF->SetFont("Arial","",9);
				$PDF->SetLeftMargin("20");
				$PDF->Write(4," n�(e) le : ".substr($tab['date_naissance'],8,2) . "/" . substr($tab['date_naissance'],5,2) . "/" . substr($tab['date_naissance'],0,4)." � ".$tab['ville_naissance']);
				if ($tab['nom_jeune_fille']<>"") $PDF->Write(4," n�e ".$tab['nom_jeune_fille']."\n");
				else $PDF->Write(4,"\n");

				if (strlen($tab['dep_naissance'])<5)
					$PDF->Write(4," n�(e) � l'�tranger en ".$tab['dpays_naissance'] ." de Mr". $tab['nom_pere']." ".$tab['prenom_pere']." et de Mme ". $tab['nom_mere']." ".$tab['prenom_mere']."\n");
				else $PDF->Write(4," n�(e) dans le d�partement de ".$tab['dep_naissance'] ."\n");
				$PDF->Write(4,"Habitant � : ");
				$PDF->SetX(40);
				$PDF->SetLeftMargin("40");
				If ($tab['adresse_1']<>"") $PDF->Write(4,$tab['adresse_1']."\n");
				If ($tab['adresse_2']<>"") $PDF->Write(4,$tab['adresse_2']."\n");
				If ($tab['adresse_3']<>"") $PDF->Write(4,$tab['adresse_3']."\n");
				$PDF->SetLeftMargin("20");
				$PDF->Write(4,$tab['cdpostal']." ".$tab['ville']."\n");
				$PDF->Write(4,"Courriel : ".$tab['courriel']." - ");
				$PDF->Write(4,"Joignable au  : ");
				If ($tab['telephone']<>"" and $tab['tel_mobile']<>"") $PDF->Write(4,$tab['telephone']. " ou ".$tab['tel_mobile']."\n");
				Else $PDF->Write(4,$tab['telephone']. $tab['tel_mobile']."\n");
				$PDF->Write(4,"Taille T-Shirt : ".$tab['taille_teeshirt']."\n");
				# *****************  Coll�gien ou staff
				if ($tab['type']=="staff" or $tab['type']=="collegien") 
				{
					$PDF->Write(4,"Scolarit� : en classe de ".$tab['classe']." � " .$tab['etablissement_scolaire']."\n");
					if ($tab['paroisse']<>"") $PDF->Write(4,"Participe � la paroisse de : ".$tab['paroisse']." ");
					if ($tab['paroisse']<>"" and $tab['mouvements']<>"") $PDF->Write(4," et � : ".$tab['mouvements']." ");
					if ($tab['paroisse']=="" and $tab['mouvements']<>"") $PDF->Write(4,"Participe � : ".$tab['mouvements']." ");
					if ($tab['paroisse']<>"" or $tab['mouvements']<>"") $PDF->Write(4,"\n");
					if ($tab['instrument']<>"" ) $PDF->Write(4,"Amm�ne l'instrument de musique suivant :  ".$tab['instrument']." au camps.\n");
				}
				# *****************  Animateur
				$res=mysql_fetch_array(log_mysql_query("SELECT description_diplome FROM diplome WHERE index_diplome='".$tab['diplome_encadrement']."'",$mysql));
				$nom_diplome=stripslashes($res[0]);
						
				if ($tab['type']=="animateur") 
				{
					$PDF->Write(4,"Niveau Scolaire : ".$tab['niveau_scolaire']);
					if ($tab['profession']<>"") $PDF->Write(4," - Profession : ".$tab['profession']);
					$PDF->Write(4,"\n");
					if ($tab['diplome_encadrement']<>"") 
					{
						$PDF->Write(4,"Diplome d'encadrement : ".$nom_diplome);
						if ($tab['stagiaire_encadrement']=="1") $PDF->Write(4," - Stagiaire ");
						if ($tab['attestation_encadrement']=="1") $PDF->Write(4," \nJe justifie d'au moins 28 jours d'animations de mineurs dans les 5 derni�res ann�es ");
						$PDF->Write(4,"\n");
					}
				}
				# *****************  ABS
				if ($tab['type']=="abs") 
				{
					$PDF->Write(4,"Dioc�se ou congr�gation : ".$tab['diocese']);
					$PDF->Write(4,"\n");
					if ($tab['diplome_encadrement']<>"") 
					{
						$PDF->Write(4,"Diplome d'encadrement : ".$nom_diplome);
						if ($tab['stagiaire_encadrement']=="1") $PDF->Write(4," - Stagiaire ");
						if ($tab['attestation_encadrement']=="1") $PDF->Write(4," \nJe justifie d'au moins 28 jours d'animations de mineurs dans les 5 derni�res ann�es ");
						$PDF->Write(4,"\n");
					}
				}
				# *****************  TTV - GGG - OGM
				if ($tab['type']=="ttv" or $tab['type']=="ggg" or $tab['type']=="ogm") 
				{
					$PDF->Write(4,"Profession : ".$tab['profession']);
					$PDF->Write(4," - Comp�tences utiles : ".$tab['competence']);
					$PDF->Write(4,"\n");
					if ($tab['diplome_medical']<>"" or $tab['permis']<>"" )
					{
						$PDF->Write(4,"Autres : ");
						if ($tab['diplome_medical']<>"") $PDF->Write(4,"  Diplome M�dical : ".$tab['diplome_medical']);
						if ($tab['permis']<>"") $PDF->Write(4,"   Permis : ".$tab['permis']);
						$PDF->Write(4,"\n");
					}
					if ($tab['diplome_encadrement']<>"") 
					{
						$PDF->Write(4,"Diplome d'encadrement : ".$nom_diplome);
						if ($tab['stagiaire_encadrement']=="1") $PDF->Write(4," - Stagiaire ");
						if ($tab['attestation_encadrement']=="1") $PDF->Write(4," \nJe justifie d'au moins 28 jours d'animations de mineurs dans les 5 derni�res ann�es ");
						$PDF->Write(4,"\n");
					}
				}
				# *********************************************************************************
				# *****************  Charge le contact responsable
				# *********************************************************************************
				$PDF->SetFont("Arial","B",12);
				$PDF->SetLeftMargin("10");
				if ($tab['type']=="ttv" or $tab['type']=="animateur" or $tab['type']=="abs") $PDF->Write(4,"\n Coordonn�es de la personne � pr�venir en cas d'urgence: ");
				if ($tab['type']=="collegien" or $tab['type']=="staff" ) $PDF->Write(4,"\n Coordonn�es de la personne responsable:\n ");
				$PDF->Write(4,$tab['titre_resp']." ".$tab['prenom_resp']." ".$tab['nom_resp']."\n");
				$PDF->SetFont("Arial","",9);
				$PDF->SetLeftMargin("20");
				$PDF->Write(4,"Habitant � : ");
				$PDF->SetX(40);
				$PDF->SetLeftMargin("40");
				If ($tab['adresse_1_resp']<>"") $PDF->Write(4,$tab['adresse_1_resp']."\n");
				If ($tab['adresse_2_resp']<>"") $PDF->Write(4,$tab['adresse_2_resp']."\n");
				If ($tab['adresse_3_resp']<>"") $PDF->Write(4,$tab['adresse_3_resp']."\n");
				$PDF->SetLeftMargin(20);
				$PDF->Write(4,$tab['cdpostal_resp']." ".$tab['ville_resp']."\n");
				$PDF->Write(4,"Courriel : ".$tab['courriel_resp']." - ");
				$PDF->Write(4,"Joignable au  :");
				If ($tab['telephone_resp']<>"" ) $PDF->Write(4," Fixe : ".$tab['telephone_resp']);
				If ($tab['tel_mobile_resp']<>"" ) $PDF->Write(4," Mobile : ".$tab['tel_mobile_resp']);
				If ($tab['tel_mobile_resp2']<>"" ) $PDF->Write(4," Mobile : ".$tab['tel_mobile_resp2']);
				$PDF->Write(4,"\n");
				if ($tab['type']=="collegien" or $tab['type']=="staff" ) $PDF->Write(4,"j'autorise mon enfant � participer au p�l� VTT\n ");
				else $PDF->Write(4,"Lien avec cette personne : ".$tab['lien_personne']."\n");
				# *********************************************************************************
				# *****************  Charge la personne autoris� � venir chercher l'enfant
				# *********************************************************************************
				if ($tab['prenom_autre']<>"" or $tab['nom_autre']<>"")
				{
					$PDF->SetFont("Arial","B",12);
					$PDF->SetLeftMargin("10");
					$PDF->Write(4,"\n Coordonn�es d'une autre personne en cas d'urgence : \n");
					$PDF->Write(4," ".$tab['titre_autre']." ".$tab['prenom_autre']." ".$tab['nom_autre']."\n");
					$PDF->SetFont("Arial","",9);
					$PDF->SetLeftMargin(20);
					$PDF->Write(4,"Joignable au  :");
					If ($tab['telephone_autre']<>"" ) $PDF->Write(4," Fixe : ".$tab['telephone_autre']);
					If ($tab['tel_mobile_autre']<>"" ) $PDF->Write(4," Mobile : ".$tab['tel_mobile_autre']);
					If ($tab['tel_mobile_autre2']<>"" ) $PDF->Write(4," Mobile : ".$tab['tel_mobile_autre2']);
					$PDF->Write(4,"\n");
					$PDF->Write(4,"J'autorise cette personne � prendre en charge mon enfant en cas d'urgence\n ");
				}
				# *********************************************************************************
				# *****************  Droit � l'image et assurance
				# *********************************************************************************
				$PDF->SetFont("Arial","B",12);
				$PDF->SetLeftMargin("10");
				$PDF->Write(4,"\nDroit � l'image\n");
				$PDF->SetFont("Arial","",9);
				$PDF->SetLeftMargin("20");
				if ($tab['type']=="collegien" or $tab['type']=="staff" ) $PDF->Write(4,"J'autorise ".
						"la diffusion des images de mon enfant qui pourraient �tre prises pendant le camp, sur tout support ".
						"�dit� par l'association dans le cadre du p�l� VTT\n Je confirme que je suis inform�(e) de l'int�r�t de souscrire un contrat ".
						"d'assurance de personnes (Responsabilit� Civile ou extra-scolaire) couvrant les dommages corporels auxquels les activit�s".
						" du p�l� VTT peuvent exposer mon enfant\n");
				Else $PDF->Write(4,"J'autorise la diffusion des images qui pourraient �tre prises de moi pendant le camp, sur tout support ".
						"�dit� par l'association dans le cadre du p�l� VTT\nJe confirme que je suis inform�(e) de l'int�r�t de souscrire un ".
						"contrat d'assurance de personnes (Responsabilit� Civile ou extra-scolaire) couvrant les dommages corporels auxquels".
						" peuvent m'exposer les activit�s du p�l� VTT\n");

				# *********************************************************************************
				# *****************  Mat�riel
				# *********************************************************************************
				if ($tab['type']=="collegien" )
				{
					$PDF->SetFont("Arial","B",12);
					$PDF->SetLeftMargin("10");
					$PDF->Write(4,"\nCertificat de contr�le du mat�riel\n");
					$PDF->SetFont("Arial","",9);
					$PDF->Write(4,"Je certifie que le VTT de mon enfant est en �tat de fonctionnement et qu'il a �t� v�rifi� par nos soins ".
							"ou par un professionnel avant le d�but du p�l� VTT\n");
				}
				# *********************************************************************************
				# *****************  Pr�sence
				# *********************************************************************************
				if ($tab['type']<>"collegien")
				{
					$PDF->SetFont("Arial","B",12);
					$PDF->SetLeftMargin("10");
					$PDF->Write(4,"\nPr�sence pendant le p�l� VTT (1=pr�sent)\n\n");
					// D�finition des propri�t�s du tableau.
					$proprietesTableau = array(
						'BRD_COLOR' => array(0,92,177),
						'BRD_SIZE' => '0.3',
						'TB_ALIGN' => 'C',
						'L_MARGIN' => 15,
						);
					// D�finition des propri�t�s du header du tableau.	
					$proprieteHeader = array(
						'T_COLOR' => array(150,10,10),
						'T_SIZE' => 12,
						'T_FONT' => 'Arial',
						'V_ALIGN' => 'T',
						'T_TYPE' => 'B',
						'LN_SIZE' => 5,
						'BG_COLOR_COL0' => array(170, 240, 230),
						'BG_COLOR' => array(170, 240, 230),
						'BRD_COLOR' => array(0,92,177),
						'BRD_SIZE' => 0.2,
						'BRD_TYPE' => '1',
						'BRD_TYPE_NEW_PAGE' => '',
						);
					// Contenu du header du tableau.	
					
					$date=maketime($_SESSION['jour_debut_precamp']);
					$contenuHeader = array(30,18,18,18,18,18,18,18,18,
						" ","[C]".date_fran($date+3600*24*0), "[C]".date_fran($date+3600*24*1), "[C]".date_fran($date+3600*24*2),"[C]".date_fran($date+3600*24*3),"[C]".date_fran($date+3600*24*4),
						"[C]".date_fran($date+3600*24*5),"[C]".date_fran($date+3600*24*6),"[C]".date_fran($date+3600*24*7));
					
					// D�finition des propri�t�s du reste du contenu du tableau.	
					$proprieteContenu = array(
						'T_COLOR' => array(0,0,0),
						'T_SIZE' => 10,
						'T_FONT' => 'Arial',
						'V_ALIGN' => 'M',
						'T_TYPE' => '',
						'LN_SIZE' => 5,
						'BG_COLOR_COL0' => array(245, 245, 150),
						'BG_COLOR' => array(255,255,255),
						'BRD_COLOR' => array(0,92,177),
						'BRD_SIZE' => 0.1,
						'BRD_TYPE' => '1',
						'BRD_TYPE_NEW_PAGE' => '',
						);	
					
					// Contenu du tableau.	
					$contenuTableau = array(
						"Petit D�j", "[C]".$tab['petit_dej_23'], "[C]".$tab['petit_dej_24'],"[C]".$tab['petit_dej_25'],"[C]".$tab['petit_dej_26'],"[C]".$tab['petit_dej_27'],"[C]".$tab['petit_dej_28'], "[C]".$tab['petit_dej_29'], "[C]".$tab['petit_dej_30'],
						"Matin�e", "[C]".$tab['matine_23'], "[C]".$tab['matine_24'],"[C]".$tab['matine_25'],"[C]".$tab['matine_26'],"[C]".$tab['matine_27'],"[C]".$tab['matine_28'], "[C]".$tab['matine_29'], "[C]".$tab['matine_30'],
						"D�jeuner", "[C]".$tab['dejeuner_23'], "[C]".$tab['dejeuner_24'],"[C]".$tab['dejeuner_25'],"[C]".$tab['dejeuner_26'],"[C]".$tab['dejeuner_27'],"[C]".$tab['dejeuner_28'], "[C]".$tab['dejeuner_29'], "[C]".$tab['dejeuner_30'],
						"Apr�s-Midi", "[C]".$tab['apres_midi_23'], "[C]".$tab['apres_midi_24'],"[C]".$tab['apres_midi_25'],"[C]".$tab['apres_midi_26'],"[C]".$tab['apres_midi_27'],"[C]".$tab['apres_midi_28'], "[C]".$tab['apres_midi_29'], "[C]".$tab['apres_midi_30'],
						"D�ner", "[C]".$tab['diner_23'], "[C]".$tab['diner_24'],"[C]".$tab['diner_25'],"[C]".$tab['diner_26'],"[C]".$tab['diner_27'],"[C]".$tab['diner_28'], "[C]".$tab['diner_29'], "[C]".$tab['diner_30'],
						"Soir�e", "[C]".$tab['soiree_23'], "[C]".$tab['soiree_24'],"[C]".$tab['soiree_25'],"[C]".$tab['soiree_26'],"[C]".$tab['soiree_27'],"[C]".$tab['soiree_28'], "[C]".$tab['soiree_29'], "[C]".$tab['soiree_30'],
						"Nuit sur place", "[C]".$tab['tente_23'], "[C]".$tab['tente_24'],"[C]".$tab['tente_25'],"[C]".$tab['tente_26'],"[C]".$tab['tente_27'],"[C]".$tab['tente_28'], "[C]".$tab['tente_29'], "[C]".$tab['tente_30'],
						);
					$PDF->drawTableau($PDF, $proprietesTableau, $proprieteHeader, $contenuHeader, $proprieteContenu, $contenuTableau);
				}
				# *********************************************************************************
				# *****************  Poste
				# *********************************************************************************
				if ($tab['type']=="ttv" )
				{
					$PDF->SetFont("Arial","B",12);
					$PDF->SetLeftMargin("10");
					$PDF->Write(4,"\nPoste pendant le p�l� : ");
					if ($tab['parcours']==1) $PDF->Write(4,"Parcours ");
					if ($tab['intendance']==1) $PDF->Write(4,"Intendance ");
					if ($tab['velo']==1) $PDF->Write(4,"R�paration V�lo ");
					if ($tab['media']==1) $PDF->Write(4,"Equipe Multi-m�dia ");
					if ($tab['infirmerie']==1) $PDF->Write(4,"Infirmerie ");
					if ($tab['secretariat']==1) $PDF->Write(4,"Secr�tariat ");
					if ($tab['technique']==1) $PDF->Write(4,"Technique ");
					if ($tab['priere']==1) $PDF->Write(4,"Amicale Pri�re ");
					$PDF->Write(4,"\n");
				}
				
				# *********************************************************************************
				# *****************  Documents
				# *********************************************************************************
				$PDF->SetFont("Arial","B",12);
				$PDF->SetLeftMargin("10");
				$PDF->Write(4,"\nDocuments � joindre (� joindre avec un trombone � cette fiche sign�e)\n");
				$PDF->SetFont("Arial","",9);
				$PDF->SetLeftMargin("20");
				switch ($tab['type']) {
					case "ttv":
						$PDF->Write(4,"- Copie de la carte verte de votre assurance voiture si vous utilisez votre v�hicule pendant le P�l� VTT\n");
						if ($tab['intendance']=="1") $PDF->Write(4,"- Certificat d'aptitude � manipuler les denr�es alimentaires, d�livr� par votre m�decin traitant \n");
						if ($tab['charte_pelerin']<>"1") 
							$PDF->Write(4,"- La charte du P�lerin sign�e \n");
						if ($tab['diplome_encadrement']!="" and $tab['diplome_encadrement_ok']<>1)
							$PDF->Write(4,"- Copie des diplomes d'encadrement utilis�s pendant le P�l� VTT\n"); 
						if ($tab['attestation_encadrement']=="1") 
							$PDF->Write(4,"- Copie des attestations d'animation de mineurs sur 28 jours pendant les 5 derni�res ann�es\n"); 
						if ($tab['diplome_medical']!="" and $tab['diplome_medical']!="sans" and $tab['diplome_medical_ok']<>1) 
							$PDF->Write(4,"- Copie des diplomes m�dicaux utilis�s pendant le P�l� VTT\n"); 
						if ($tab['permis']!="" and $tab['permis']!="sans" and $tab['permis_ok']<>1) 
							$PDF->Write(4,"- Copie des permis de conduire utilis�s pendant le P�l� VTT\n"); 
						if ($tab['certificat_vaccination']<>1) 
							$PDF->Write(4,"- Attestation de vaccination � jour, d�livr�e par votre m�decin traitant ou photocopie du carnet de vaccination � jour\n"); 
						if ($tab['casier']<>"1") 
							$PDF->Write(4,"- Un extrait de casier judiciaire N�3 datant de moins de 3 mois \n");
						break;
					case "abs":
						if ($tab['charte_pelerin']<>"1") 
							$PDF->Write(4,"- La charte du P�lerin sign�e \n");
						if ($tab['diplome_encadrement']!="" and $tab['diplome_encadrement_ok']<>1)
							$PDF->Write(4,"- Copie des diplomes d'encadrement utilis�s pendant le P�l� VTT\n"); 
						if ($tab['attestation_encadrement']=="1") 
							$PDF->Write(4,"- Copie des attestations d'animation de mineurs sur 28 jours pendant les 5 derni�res ann�es\n"); 
						$PDF->Write(4,"- Copie de la carte verte de votre assurance voiture si vous utilisez votre v�hicule pendant le P�l� VTT\n");
						if ($tab['certificat_vaccination']<>1) 
							$PDF->Write(4,"- Attestation de vaccination � jour, d�livr�e par votre m�decin traitant ou photocopie du carnet de vaccination � jour\n"); 
						if ($tab['casier']<>"1") 
							$PDF->Write(4,"- Un extrait de casier judiciaire N�3 datant de moins de 3 mois \n");
						break;
					case "ggg":
						if ($tab['charte_pelerin']<>"1") 
							$PDF->Write(4,"- La charte du P�lerin sign�e \n");
						if ($tab['diplome_encadrement']!="" and $tab['diplome_encadrement_ok']<>1)
							$PDF->Write(4,"- Copie des diplomes d'encadrement utilis�s pendant le P�l� VTT\n"); 
						if ($tab['attestation_encadrement']=="1") 
							$PDF->Write(4,"- Copie des attestations d'animation de mineurs sur 28 jours pendant les 5 derni�res ann�es\n"); 
						$PDF->Write(4,"- Copie de la carte verte de votre assurance voiture si vous utilisez votre v�hicule pendant le P�l� VTT\n");
						if ($tab['certificat_vaccination']<>1) 
							$PDF->Write(4,"- Attestation de vaccination � jour, d�livr�e par votre m�decin traitant ou photocopie du carnet de vaccination � jour\n"); 
						if ($tab['casier']<>"1") 
							$PDF->Write(4,"- Un extrait de casier judiciaire N�3 datant de moins de 3 mois \n");
						break;
					case "ogm":
						if ($tab['charte_pelerin']<>"1") 
							$PDF->Write(4,"- La charte du P�lerin sign�e \n");
						if ($tab['diplome_encadrement']!="" and $tab['diplome_encadrement_ok']<>1)
							$PDF->Write(4,"- Copie des diplomes d'encadrement utilis�s pendant le P�l� VTT\n"); 
						if ($tab['attestation_encadrement']=="1") 
							$PDF->Write(4,"- Copie des attestations d'animation de mineurs sur 28 jours pendant les 5 derni�res ann�es\n"); 
						$PDF->Write(4,"- Copie de la carte verte de votre assurance voiture si vous utilisez votre v�hicule pendant le P�l� VTT\n");
						if ($tab['certificat_vaccination']<>1) 
							$PDF->Write(4,"- Attestation de vaccination � jour, d�livr�e par votre m�decin traitant ou photocopie du carnet de vaccination � jour\n"); 
						if ($tab['casier']<>"1") 
							$PDF->Write(4,"- Un extrait de casier judiciaire N�3 datant de moins de 3 mois \n");
						break;
					case "staff":
						$PDF->Write(4,"- La charte du P�lerin sign�e \n");
						$PDF->Write(4,"- La fiche de liaison sanitaire, remplie et sign�e\n");
						break;
					case "animateur":
						if ($tab['charte_pelerin']<>"1") 
							$PDF->Write(4,"- La charte du P�lerin sign�e \n");
						if ($tab['diplome_encadrement']!="" and $tab['diplome_encadrement_ok']<>1)
							$PDF->Write(4,"- Copie des diplomes d'encadrement utilis�s pendant le P�l� VTT\n"); 
						if ($tab['attestation_encadrement']=="1") 
							$PDF->Write(4,"- Copie des attestations d'animation de mineurs sur 28 jours pendant les 5 derni�res ann�es\n"); 
						if ($tab['certificat_vaccination']<>1) 
							$PDF->Write(4,"- Attestation de vaccination � jour, d�livr�e par votre m�decin traitant ou photocopie du carnet de vaccination � jour\n"); 
						if ($tab['casier']<>"1") 
							$PDF->Write(4,"- Un extrait de casier judiciaire N�3 datant de moins de 3 mois \n");
						break;
					case "collegien":
						$PDF->Write(4,"- La charte du P�lerin sign�e \n");
						$PDF->Write(4,"- La fiche de liaison sanitaire, remplie et sign�e\n");
						break;
				}

				# *********************************************************************************
				# *****************  Signature
				# *********************************************************************************
				$PDF->SetXY(20,260);
				$PDF->SetFillColor(255,191,116);
				$PDF->Cell(180,15,'Fait � :                                                 				
						Le :                                            Signature du Responsable:                                    ',1,1,'C',true); 
			}
	}
mysql_close();

 	// Sauvegarde du Fichier
	$racine=dirname(__FILE__);
	$chemin=$racine."/data/".formatage_repertoire($_SESSION['departement'])."/".$_SESSION['annee']."/";
	$fichier=formatage_repertoire($_SESSION['departement'])."_".$_SESSION['annee']."_".$_var_index_inscription.".PDF";
	error_reporting(0);
	mkdir ("data/".formatage_repertoire($_SESSION['departement']),0777);
	mkdir ("data/".formatage_repertoire($_SESSION['departement'])."/".$_SESSION['annee'],0777);
	error_reporting(1);
	$PDF->Output($chemin.$fichier, "F");
?>


