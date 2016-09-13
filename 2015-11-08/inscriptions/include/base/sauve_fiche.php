<?php
# Gère la sauvegarde sur la base Mysql de la fiche d'inscription


# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX       montage de la requete d'insertion par blocs            XXXXXXXXXXXXXXXXXXXXXxXXX
$_requette = " ('" . 
$_fiche_numero_inscription."','".$_route_index."','".$_type."','".$_titre."','".$_nom_usage."','".$_nom_civil."','".$_nom_jeune_fille."','".$_prenom."','".$_taille_teeshirt."','".$_date_naissance."','".
$_ville_naissance."','".$_dep_naissance."','".$_pays_naissance."','".$_nom_pere."','".$_prenom_pere."','".$_nom_mere."','".$_prenom_mere."','".
$_sexe."','".$_adresse_1."','".$_adresse_2."','".$_adresse_3."','".$_ville."','".$_cdpostal."','".$_courriel."','".$_telephone."','".
$_tel_mobile."','".$_diocese."','".$_profession."','".$_competence."','".$_diplome_medical."','".$_permis."','".
$_diplome_encadrement."','".$_stagiaire_encadrement."','".$_attestation_encadrement."','".$_etablissement_scolaire."','".
$_classe."','".$_paroisse."','".$_mouvements."','".$_instrument."','".$_niveau_scolaire."','".$_titre_resp."','".$_nom_resp."','".$_prenom_resp."','".$_adresse_1_resp."','".
$_adresse_2_resp."','".$_adresse_3_resp."','".$_ville_resp."','".$_cdpostal_resp."','".$_courriel_resp."','".$_telephone_resp."','".$_tel_mobile_resp."','".$_tel_mobile_resp2."','".
$_lien_personne."','".$_assurance_information."','".$_non_assurance_rc."','".$_police."','".$_coordonnees_assurance."','".$_droit_image."','".$_petit_dej_tout."','".$_petit_dej_23."','".$_petit_dej_24."','".
$_petit_dej_25."','".$_petit_dej_26."','".$_petit_dej_27."','".$_petit_dej_28."','".$_petit_dej_29."','".$_petit_dej_30."','".$_matine_tout."','".$_matine_23."','".
$_matine_24."','".$_matine_25."','".$_matine_26."','".$_matine_27."','".$_matine_28."','".$_matine_29."','".$_matine_30."','".$_dejeuner_tout."','".$_dejeuner_23."','".
$_dejeuner_24."','".$_dejeuner_25."','".$_dejeuner_26."','".$_dejeuner_27."','".$_dejeuner_28."','".$_dejeuner_29."','".$_dejeuner_30."','".$_apres_midi_tout."','".$_apres_midi_23."','".
$_apres_midi_24."','".$_apres_midi_25."','".$_apres_midi_26."','".$_apres_midi_27."','".$_apres_midi_28."','".$_apres_midi_29."','".$_apres_midi_30."','".$_diner_tout."','".
$_diner_23."','".$_diner_24."','".$_diner_25."','".$_diner_26."','".$_diner_27."','".$_diner_28."','".$_diner_29."','".$_diner_30."','".$_soiree_tout."','".$_soiree_23."','".
$_soiree_24."','".$_soiree_25."','".$_soiree_26."','".$_soiree_27."','".$_soiree_28."','".$_soiree_29."','".$_soiree_30."','".$_tente_tout."','".$_tente_23."','".$_tente_24."','".
$_tente_25."','".$_tente_26."','".$_tente_27."','".$_tente_28."','".$_tente_29."','".$_tente_30."','".$_parcours."','".$_intendance."','".$_velo."','".$_media."','".$_infirmerie."','".
$_secretariat."','".$_technique."','".$_priere."','".$_gg."','".$_reglement."','".$_observation."','".$_charte_pelerin."','".$_fiche_inscription_signee."','".$_diplome_encadrement_ok."','".$_assurance_voiture."','".
$_materiel_verifie."','".$_besoin_vtt."','".$_diplome_medical_ok."','".$_permis_ok."','".$_validite_vaccination."','".$_certificat_vaccination."','".$_fiche_liaison."','".$_regime."','".$_documents_signe."','".
$_equipe."','".$_present_au_pele . "' );" ;

# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     REQUETE INSERTION            XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 $req_desc_table = "INSERT INTO  `fiche`  ( " . 
"`fiche_numero_inscription`,`route_index`,`type`,`titre`,`nom_usage`,`nom_civil`,`nom_jeune_fille`,`prenom`,`taille_teeshirt`,`date_naissance`,`ville_naissance`,`dep_naissance`,`pays_naissance`,`nom_pere`,".
"`prenom_pere`,`nom_mere`,`prenom_mere`,`sexe`,`adresse_1`,".
"`adresse_2`,`adresse_3`,`ville`,`cdpostal`,`courriel`,`telephone`,`tel_mobile`,`diocese`,`profession`,`competence`,`diplome_medical`,`permis`,".
"`diplome_encadrement`,`stagiaire_encadrement`,`attestation_encadrement`,".
"`etablissement_scolaire`,`classe`,`paroisse`,`mouvements`,`instrument`,`niveau_scolaire`,`titre_resp`,`nom_resp`,`prenom_resp`,`adresse_1_resp`,`adresse_2_resp`,`adresse_3_resp`,".
"`ville_resp`,`cdpostal_resp`,`courriel_resp`,`telephone_resp`,`tel_mobile_resp`,`tel_mobile_resp2`,`lien_personne`,`assurance_information`,`non_assurance_rc`,`police`,`coordonnees_assurance`,".
"`droit_image`,`petit_dej_tout`,`petit_dej_23`,`petit_dej_24`,`petit_dej_25`,`petit_dej_26`,`petit_dej_27`,`petit_dej_28`,`petit_dej_29`,`petit_dej_30`,`matine_tout`,`matine_23`,".
"`matine_24`,`matine_25`,`matine_26`,`matine_27`,`matine_28`,`matine_29`,`matine_30`,`dejeuner_tout`,`dejeuner_23`,`dejeuner_24`,`dejeuner_25`,`dejeuner_26`,`dejeuner_27`,".
"`dejeuner_28`,`dejeuner_29`,`dejeuner_30`,`apres_midi_tout`,`apres_midi_23`,`apres_midi_24`,`apres_midi_25`,`apres_midi_26`,`apres_midi_27`,`apres_midi_28`,`apres_midi_29`,".
"`apres_midi_30`,`diner_tout`,`diner_23`,`diner_24`,`diner_25`,`diner_26`,`diner_27`,`diner_28`,`diner_29`,`diner_30`,`soiree_tout`,`soiree_23`,`soiree_24`,`soiree_25`,".
"`soiree_26`,`soiree_27`,`soiree_28`,`soiree_29`,`soiree_30`,`tente_tout`,`tente_23`,`tente_24`,`tente_25`,`tente_26`,`tente_27`,`tente_28`,`tente_29`,`tente_30`,`parcours`,".
"`intendance`,`velo`,`media`,`infirmerie`,`secretariat`,`technique`,`priere`,`gg`,`reglement`,`observation`,`charte_pelerin`,`fiche_inscription_signee`,`diplome_encadrement_ok`,`assurance_voiture`,`materiel_verifie`,".
"`besoin_vtt`,`diplome_medical_ok`,`permis_ok`,`validite_vaccination`,`certificat_vaccination`,`fiche_liaison`,`regime`,`documents_signe`,`equipe`,`present_au_pele` )    VALUES ";

$req_inscription  = $req_desc_table . $_requette; 

$res_insertion =    log_mysql_query($req_inscription  , $mysql );


if ( $res_insertion == 1)
{
		$req_liste= "  SELECT `index` FROM `fiche` WHERE `nom_usage`= '".$_nom_usage."' and `prenom`= '".$_prenom."' and `a_nai_1`= '".$_a_nai_1."' " ;
		$res_liste= log_mysql_query($req_liste , $mysql);
		$tabres = mysql_fetch_array ($res_liste);
		$index=$tabres['index'];
}
else
{	echo "requete ".$req_inscription;
   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
}
mysql_close();
?>
