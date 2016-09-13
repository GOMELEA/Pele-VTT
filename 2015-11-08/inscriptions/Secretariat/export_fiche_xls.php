<?php

// ************************************************* CHARGEMENT DES SOUTIENS  ****************************************************************
session_start(); 
include("../include/base/connexion_serveur.php");
include('include/fonction_php.php');

if ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement'])or $_SERVER["REMOTE_USER"]=="o.lefrancois")
{
	$req="select * FROM `fiche` ".$_SESSION['where']."";
	$res = log_mysql_query($req , $mysql);
	
	//Premiere ligne = nom des champs 
	$csv_output .= "index;corbeille;fiche_numero_inscription;route_index;code_recherche;type;titre;nom_usage;nom_jeune_fille;prenom;j_nai_1;m_nai_1;a_nai_1;".
					"ville_naissance;dep_naissance;sexe;adresse_1;adresse_2;adresse_3;ville;cdpostal;courriel;telephone;tel_mobile;diocese;profession;".
					"competence;diplome_medical;permis;diplome_encadrement;etablissement_scolaire;classe;paroisse;mouvements;instrument;niveau_scolaire;".
					"titre_resp;nom_resp;prenom_resp;adresse_1_resp;adresse_2_resp;adresse_3_resp;ville_resp;cdpostal_resp;courriel_resp;telephone_resp;".
					"tel_mobile_resp;tel_mobile_resp2;lien_personne;assurance_information;non_assurance_rc;police;coordonnees_assurance;droit_image;".
					"petit_dej_tout;petit_dej_23;petit_dej_24;petit_dej_25;petit_dej_26;petit_dej_27;petit_dej_28;petit_dej_29;petit_dej_30;matine_tout;".
					"matine_23;matine_24;matine_25;matine_26;matine_27;matine_28;matine_29;matine_30;dejeuner_tout;dejeuner_23;dejeuner_24;dejeuner_25;".
					"dejeuner_26;dejeuner_27;dejeuner_28;dejeuner_29;dejeuner_30;apres_midi_tout;apres_midi_23;apres_midi_24;apres_midi_25;apres_midi_26;".
					"apres_midi_27;apres_midi_28;apres_midi_29;apres_midi_30;diner_tout;diner_23;diner_24;diner_25;diner_26;diner_27;diner_28;diner_29;".
					"diner_30;soiree_tout;soiree_23;soiree_24;soiree_25;soiree_26;soiree_27;soiree_28;soiree_29;soiree_30;tente_tout;tente_23;tente_24;".
					"tente_25;tente_26;tente_27;tente_28;tente_29;tente_30;parcours;intendance;velo;media;infirmerie;secretariat;technique;priere;gg;".
					"reglement;observation;charte_pelerin;fiche_inscription_signee;diplome_encadrement_ok;permis_ok;diplome_medical_ok;assurance_voiture;".
					"materiel_verifie;besoin_vtt;certificat_vaccination;manipulation_denrees;fiche_liaison;regime;documents_signe;equipe;present_au_pele;casier\n";
	//Boucle sur les resultats
	while($row = mysql_fetch_array($res)) 
	{
	$csv_output .= "$row[index];$row[corbeille];$row[fiche_numero_inscription];$row[route_index];$row[code_recherche];$row[type];$row[titre];$row[nom_usage];".
					"$row[nom_jeune_fille];$row[prenom];$row[j_nai_1];$row[m_nai_1];$row[a_nai_1];$row[ville_naissance];$row[dep_naissance];$row[sexe];".
					"$row[adresse_1];$row[adresse_2];$row[adresse_3];$row[ville];$row[cdpostal];$row[courriel];$row[telephone];$row[tel_mobile];$row[diocese];".
					"$row[profession];$row[competence];$row[diplome_medical];$row[permis];$row[diplome_encadrement];$row[etablissement_scolaire];$row[classe];".
					"$row[paroisse];$row[mouvements];$row[instrument];$row[niveau_scolaire];$row[titre_resp];$row[nom_resp];$row[prenom_resp];".
					"$row[adresse_1_resp];$row[adresse_2_resp];$row[adresse_3_resp];$row[ville_resp];$row[cdpostal_resp];$row[courriel_resp];".
					"$row[telephone_resp];$row[tel_mobile_resp];$row[tel_mobile_resp2];$row[lien_personne];$row[assurance_information];$row[non_assurance_rc];".
					"$row[police];$row[coordonnees_assurance];$row[droit_image];$row[petit_dej_tout];$row[petit_dej_23];$row[petit_dej_24];$row[petit_dej_25];".
					"$row[petit_dej_26];$row[petit_dej_27];$row[petit_dej_28];$row[petit_dej_29];$row[petit_dej_30];$row[matine_tout];$row[matine_23];".
					"$row[matine_24];$row[matine_25];$row[matine_26];$row[matine_27];$row[matine_28];$row[matine_29];$row[matine_30];$row[dejeuner_tout];".
					"$row[dejeuner_23];$row[dejeuner_24];$row[dejeuner_25];$row[dejeuner_26];$row[dejeuner_27];$row[dejeuner_28];$row[dejeuner_29];".
					"$row[dejeuner_30];$row[apres_midi_tout];$row[apres_midi_23];$row[apres_midi_24];$row[apres_midi_25];$row[apres_midi_26];".
					"$row[apres_midi_27];$row[apres_midi_28];$row[apres_midi_29];$row[apres_midi_30];$row[diner_tout];$row[diner_23];$row[diner_24];".
					"$row[diner_25];$row[diner_26];$row[diner_27];$row[diner_28];$row[diner_29];$row[diner_30];$row[soiree_tout];$row[soiree_23];".
					"$row[soiree_24];$row[soiree_25];$row[soiree_26];$row[soiree_27];$row[soiree_28];$row[soiree_29];$row[soiree_30];$row[tente_tout];".
					"$row[tente_23];$row[tente_24];$row[tente_25];$row[tente_26];$row[tente_27];$row[tente_28];$row[tente_29];$row[tente_30];".
					"$row[parcours];$row[intendance];$row[velo];$row[media];$row[infirmerie];$row[secretariat];$row[technique];$row[priere];$row[gg];".
					"$row[reglement];$row[observation];$row[charte_pelerin];$row[fiche_inscription_signee];$row[diplome_encadrement_ok];$row[permis_ok];".
					"$row[diplome_medical_ok];$row[assurance_voiture];$row[materiel_verifie];$row[besoin_vtt];$row[certificat_vaccination];".
					"$row[manipulation_denrees];$row[fiche_liaison];$row[regime];$row[documents_signe];$row[equipe];$row[present_au_pele];$row[casier];\n";
	}
	
	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: attachment; filename=export.csv");
	print $csv_output;
}
?>


