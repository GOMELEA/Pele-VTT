<?php
# xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx     Copie des valeurs du formulaire dans variable locale        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

$_fiche_numero_inscription=$_SESSION['numero_inscription'];
$_route_index=$_SESSION['index_route'];
$_type=$_POST['type'];
$_titre=$_POST['titre'];
$_nom_usage= mysql_real_escape_string(strtoupper($_POST['nom_usage']));
$_nom_civil= mysql_real_escape_string(strtoupper($_POST['nom_civil']));
$_SESSION['nom_usage']=$_nom_usage;
$_nom_jeune_fille= mysql_real_escape_string (strtoupper($_POST['nom_jeune_fille']));
$_prenom= mysql_real_escape_string (ucwords(strtolower($_POST['prenom'])));
$_taille_teeshirt= $_POST['taille_teeshirt'];
$_SESSION['prenom']=$_prenom;
$_sexe=$_POST['sexe'];
$_date_naissance= date_format(date_create_from_format('j/n/Y', $_POST['j_nai_1']."/".$_POST['m_nai_1']."/".$_POST['a_nai_1']), 'Y-m-d');
$_ville_naissance= mysql_real_escape_string (strtoupper($_POST['ville_naissance']));
$_dep_naissance= mysql_real_escape_string ($_POST['dep_naissance']);
$_pays_naissance= mysql_real_escape_string (strtoupper($_POST['pays_naissance']));
$_nom_pere= mysql_real_escape_string(strtoupper($_POST['nom_pere']));
$_prenom_pere= mysql_real_escape_string (ucwords(strtolower($_POST['prenom_pere'])));
$_nom_mere= mysql_real_escape_string(strtoupper($_POST['nom_mere']));
$_prenom_mere= mysql_real_escape_string (ucwords(strtolower($_POST['prenom_mere'])));
$_adresse_1= mysql_real_escape_string ($_POST['adresse_1']);
$_adresse_2= mysql_real_escape_string ($_POST['adresse_2']);
$_adresse_3= mysql_real_escape_string ($_POST['adresse_3']);
$_ville= mysql_real_escape_string (strtoupper($_POST['ville']));
$_cdpostal=$_POST['cdpostal'];
$_courriel=$_POST['courriel'];
$_telephone=NumTel($_POST['telephone']);
$_tel_mobile=NumTel($_POST['tel_mobile']);
$_profession= mysql_real_escape_string ($_POST['profession']);
$_diocese= mysql_real_escape_string ($_POST['diocese']);
$_competence= mysql_real_escape_string ($_POST['competence']);
$_diplome_medical=$_POST['diplome_medical'];
$_permis= mysql_real_escape_string ($_POST['permis']);
$_diplome_encadrement=$_POST['diplome_encadrement'];
$_stagiaire_encadrement=$_POST['stagiaire_encadrement'];
$_attestation_encadrement=$_POST['attestation_encadrement'];
$_etablissement_scolaire=$_POST['etablissement_scolaire'];
$_niveau_scolaire= mysql_real_escape_string ($_POST['niveau_scolaire']);
$_paroisse= mysql_real_escape_string ($_POST['paroisse']);
$_mouvements= mysql_real_escape_string ($_POST['mouvements']);
$_instrument= mysql_real_escape_string ($_POST['instrument']);
$_etablissement_scolaire= mysql_real_escape_string ($_POST['etablissement_scolaire']);
$_classe= mysql_real_escape_string ($_POST['classe']);
$_titre_resp=$_POST['titre_resp'];
$_nom_resp= mysql_real_escape_string (strtoupper($_POST['nom_resp']));
$_prenom_resp=mysql_real_escape_string(ucwords(strtolower($_POST['prenom_resp'])));
$_adresse_1_resp= mysql_real_escape_string ($_POST['adresse_1_resp']);
$_adresse_2_resp= mysql_real_escape_string ($_POST['adresse_2_resp']);
$_adresse_3_resp= mysql_real_escape_string ($_POST['adresse_3_resp']);
$_ville_resp= mysql_real_escape_string (strtoupper($_POST['ville_resp']));
$_cdpostal_resp=$_POST['cdpostal_resp'];
$_courriel_resp=$_POST['courriel_resp'];
$_telephone_resp=NumTel($_POST['telephone_resp']);
$_tel_mobile_resp=NumTel($_POST['tel_mobile_resp']);
$_tel_mobile_resp2=NumTel($_POST['tel_mobile_resp2']);
$_lien_personne= mysql_real_escape_string ($_POST['lien_personne']);
$_titre_autre=$_POST['titre_autre'];
$_nom_autre= mysql_real_escape_string (strtoupper($_POST['nom_autre']));
$_prenom_autre=mysql_real_escape_string(ucwords(strtolower($_POST['prenom_autre'])));
$_telephone_autre=NumTel($_POST['telephone_autre']);
$_tel_mobile_autre=NumTel($_POST['tel_mobile_autre']);
$_tel_mobile_autre2=NumTel($_POST['tel_mobile_autre2']);
$_assurance_information=$_POST['assurance_information'];
//$_non_assurance_rc= mysql_real_escape_string ($_POST['non_assurance_rc']);
//$_police=mysql_real_escape_string ($_POST['police']);
//$_coordonnees_assurance= mysql_real_escape_string ($_POST['coordonnees_assurance']);
$_droit_image=$_POST['droit_image'];


$_petit_dej_tout=$_POST['petit_dej_tout'];
$_petit_dej_23=$_POST['petit_dej_23'];
$_petit_dej_24=$_POST['petit_dej_24'];
$_petit_dej_25=$_POST['petit_dej_25'];
$_petit_dej_26=$_POST['petit_dej_26'];
$_petit_dej_27=$_POST['petit_dej_27'];
$_petit_dej_28=$_POST['petit_dej_28'];
$_petit_dej_29=$_POST['petit_dej_29'];
$_petit_dej_30=$_POST['petit_dej_30'];
$_matine_tout=$_POST['matine_tout'];
$_matine_23=$_POST['matine_23'];
$_matine_24=$_POST['matine_24'];
$_matine_25=$_POST['matine_25'];
$_matine_26=$_POST['matine_26'];
$_matine_27=$_POST['matine_27'];
$_matine_28=$_POST['matine_28'];
$_matine_29=$_POST['matine_29'];
$_matine_30=$_POST['matine_30'];
$_dejeuner_tout=$_POST['dejeuner_tout'];
$_dejeuner_23=$_POST['dejeuner_23'];
$_dejeuner_24=$_POST['dejeuner_24'];
$_dejeuner_25=$_POST['dejeuner_25'];
$_dejeuner_26=$_POST['dejeuner_26'];
$_dejeuner_27=$_POST['dejeuner_27'];
$_dejeuner_28=$_POST['dejeuner_28'];
$_dejeuner_29=$_POST['dejeuner_29'];
$_dejeuner_30=$_POST['dejeuner_30'];
$_apres_midi_tout=$_POST['apres_midi_tout'];
$_apres_midi_23=$_POST['apres_midi_23'];
$_apres_midi_24=$_POST['apres_midi_24'];
$_apres_midi_25=$_POST['apres_midi_25'];
$_apres_midi_26=$_POST['apres_midi_26'];
$_apres_midi_27=$_POST['apres_midi_27'];
$_apres_midi_28=$_POST['apres_midi_28'];
$_apres_midi_29=$_POST['apres_midi_29'];
$_apres_midi_30=$_POST['apres_midi_30'];
$_diner_tout=$_POST['diner_tout'];
$_diner_23=$_POST['diner_23'];
$_diner_24=$_POST['diner_24'];
$_diner_25=$_POST['diner_25'];
$_diner_26=$_POST['diner_26'];
$_diner_27=$_POST['diner_27'];
$_diner_28=$_POST['diner_28'];
$_diner_29=$_POST['diner_29'];
$_diner_30=$_POST['diner_30'];
$_soiree_tout=$_POST['soiree_tout'];
$_soiree_23=$_POST['soiree_23'];
$_soiree_24=$_POST['soiree_24'];
$_soiree_25=$_POST['soiree_25'];
$_soiree_26=$_POST['soiree_26'];
$_soiree_27=$_POST['soiree_27'];
$_soiree_28=$_POST['soiree_28'];
$_soiree_29=$_POST['soiree_29'];
$_soiree_30=$_POST['soiree_30'];
$_tente_tout=$_POST['tente_tout'];
$_tente_23=$_POST['tente_23'];
$_tente_24=$_POST['tente_24'];
$_tente_25=$_POST['tente_25'];
$_tente_26=$_POST['tente_26'];
$_tente_27=$_POST['tente_27'];
$_tente_28=$_POST['tente_28'];
$_tente_29=$_POST['tente_29'];
$_tente_30=$_POST['tente_30'];

//**********************Mise à 0 des jours en dehors du camp et remplissage automatique pour les collégiens

// ************************************************* Affichage des dates du calendrier de présence  ****************************************************************
$date=maketime($_SESSION['jour_debut_precamp']);
$debut_precamp = explode("-", $_SESSION['jour_debut_precamp']);
$titre = array("petit_dej_", "matine_", "dejeuner_","apres_midi_","diner_", "soiree_","tente_");
$heure=array(7,9,12,14,19,20,23);
	// ************************************************* Boucle pour la création des lignes  ****************************************************************
  for($j=0;$j < 7;$j++) 
  {
	// ************************************************* Boucle pour la création des checkbox du calendrier  ****************************************************************
	for($i=23;$i < 31;$i++) 
	{ 	// ******************************************   Calcul de la date correspondant à la cellule  ***************************
		$jour=$debut_precamp[2]+$i-23;
		$date= mktime($heure[$j],0,0, $debut_precamp[1], $jour, $debut_precamp[0]);
		// ******************************************   Test si le camps n'est pas déjà commencé ou déjà fini   ***********************************************************
		$variable="_".$titre[$j].$i;
		if ($_type=="collegien")
		{	if ($date<maketime($_SESSION['jour_debut_camp']) or $date>maketime($_SESSION['jour_fin_camp']))	$$variable=0;
			else $$variable=1;
		}
		elseif ($date<maketime($_SESSION['jour_debut_precamp']) or $date>maketime($_SESSION['jour_fin_postcamp'])) $$variable=0;
	}
  }



$_parcours=$_POST['parcours'];
$_intendance=$_POST['intendance'];
$_velo=$_POST['velo'];
$_media=$_POST['media'];
$_infirmerie=$_POST['infirmerie'];
$_secretariat=$_POST['secretariat'];
$_technique=$_POST['technique'];
$_priere=$_POST['priere'];
$_reglement=$_POST['reglement'];
$_observation= mysql_real_escape_string ($_POST['observation']);
$_fiche_inscription_signee=$_POST['fiche_inscription_signee'];
$_assurance_voiture=$_POST['assurance_voiture'];
$_besoin_vtt="0";
$_fiche_liaison="0";
$_gg="0";
$_materiel_verifie=$_POST['materiel_verifie'];
$_documents_signe=$_POST['documents_signe'];

$_diplome_encadrement_ok=$_POST['diplome_encadrement_ok'];
$_diplome_medical_ok=$_POST['diplome_medical_ok'];
$_permis_ok=$_POST['permis_ok'];
$_charte_pelerin=$_POST['charte_pelerin'];
$_certificat_vaccination=$_POST['certificat_vaccination'];
$_validite_vaccination=$_POST['validite_vaccination'];



?>
