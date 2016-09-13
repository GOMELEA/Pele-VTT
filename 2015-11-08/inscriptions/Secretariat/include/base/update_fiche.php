<?php

# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX       montage de la requete de modification  pour la FICHE         XXXXXXXXXXXXXXXXXXXXXxXXX
 $req_modif_fiche = "UPDATE   `fiche`  SET fiche_numero_inscription='" . $_fiche_numero_inscription."',route_index='" . $_route_index. 
"',type='" . $_type."',titre='" .$_titre."',code_recherche='" . $_code_recherche."',nom_usage='" . $_nom_usage.
"',nom_jeune_fille='" . $_nom_jeune_fille."',prenom='" . $_prenom. "',taille_teeshirt='" . $_taille_teeshirt. 
"',date_naissance='" . $_date_naissance."',ville_naissance='" . $_ville_naissance."',dep_naissance='" . $_dep_naissance.
"',pays_naissance='" . $_pays_naissance."',nom_pere='" . $_nom_pere."',prenom_pere='" . $_prenom_pere. "',nom_mere='" . $_nom_mere. "',prenom_mere='" . $_prenom_mere. 
"',sexe='" . $_sexe. 
"',adresse_1='" . $_adresse_1."',adresse_2='" . $_adresse_2."',adresse_3='" . $_adresse_3."',ville='" . $_ville."',cdpostal='" . $_cdpostal. 
"',courriel='" . $_courriel."',telephone='" . $_telephone."',tel_mobile='" . $_tel_mobile."',diocese='" . $_diocese."',profession='" . $_profession. 
"',competence='" . $_competence."',diplome_medical='" . $_diplome_medical."',permis='" . $_permis.
"',diplome_encadrement='" . $_diplome_encadrement."',stagiaire_encadrement='" . $_stagiaire_encadrement."',attestation_encadrement='" . $_attestation_encadrement.
"',etablissement_scolaire='" . $_etablissement_scolaire."',classe='" . $_classe."',paroisse='" . $_paroisse."',mouvements='" . $_mouvements. 
"',instrument='" . $_instrument."',niveau_scolaire='" . $_niveau_scolaire."',titre_resp='" . $_titre_resp."',nom_resp='" . $_nom_resp. 
"',prenom_resp='" . $_prenom_resp."',adresse_1_resp='" . $_adresse_1_resp."',adresse_2_resp='" . $_adresse_2_resp."',adresse_3_resp='" . $_adresse_3_resp. 
"',ville_resp='" . $_ville_resp."',cdpostal_resp='" . $_cdpostal_resp."',courriel_resp='" . $_courriel_resp."',telephone_resp='" . $_telephone_resp. 
"',tel_mobile_resp='" . $_tel_mobile_resp."',tel_mobile_resp2='" . $_tel_mobile_resp2."',lien_personne='" . $_lien_personne.
"',titre_autre='" . $_titre_autre."',nom_autre='" . $_nom_autre."',prenom_autre='" . $_prenom_autre. 
"',telephone_autre='" . $_telephone_autre."',tel_mobile_autre='" . $_tel_mobile_autre."',tel_mobile_autre2='" . $_tel_mobile_autre2."',non_assurance_rc='" . $_non_assurance_rc. 
"',police='" . $_police."',coordonnees_assurance='" . $_coordonnees_assurance."',droit_image='" . $_droit_image."',petit_dej_tout='" . $_petit_dej_tout. 
"',petit_dej_23='" . $_petit_dej_23."',petit_dej_24='" . $_petit_dej_24."',petit_dej_25='" . $_petit_dej_25."',petit_dej_26='" . $_petit_dej_26. 
"',petit_dej_27='" . $_petit_dej_27."',petit_dej_28='" . $_petit_dej_28."',petit_dej_29='" . $_petit_dej_29."',petit_dej_30='" . $_petit_dej_30. 
"',matine_tout='" . $_matine_tout."',matine_23='" . $_matine_23."',matine_24='" . $_matine_24."',matine_25='" . $_matine_25."',matine_26='" . $_matine_26. 
"',matine_27='" . $_matine_27."',matine_28='" . $_matine_28."',matine_29='" . $_matine_29."',matine_30='" . $_matine_30."',dejeuner_tout='" . $_dejeuner_tout. 
"',dejeuner_23='" . $_dejeuner_23."',dejeuner_24='" . $_dejeuner_24."',dejeuner_25='" . $_dejeuner_25."',dejeuner_26='" . $_dejeuner_26. 
"',dejeuner_27='" . $_dejeuner_27."',dejeuner_28='" . $_dejeuner_28."',dejeuner_29='" . $_dejeuner_29."',dejeuner_30='" . $_dejeuner_30. 
"',apres_midi_tout='" . $_apres_midi_tout."',apres_midi_23='" . $_apres_midi_23."',apres_midi_24='" . $_apres_midi_24."',apres_midi_25='" . $_apres_midi_25. 
"',apres_midi_26='" . $_apres_midi_26."',apres_midi_27='" . $_apres_midi_27."',apres_midi_28='" . $_apres_midi_28."',apres_midi_29='" . $_apres_midi_29. 
"',apres_midi_30='" . $_apres_midi_30."',diner_tout='" . $_diner_tout."',diner_23='" . $_diner_23."',diner_24='" . $_diner_24."',diner_25='" . $_diner_25. 
"',diner_26='" . $_diner_26."',diner_27='" . $_diner_27."',diner_28='" . $_diner_28."',diner_29='" . $_diner_29."',diner_30='" . $_diner_30. 
"',soiree_tout='" . $_soiree_tout."',soiree_23='" . $_soiree_23."',soiree_24='" . $_soiree_24."',soiree_25='" . $_soiree_25."',soiree_26='" . $_soiree_26. 
"',soiree_27='" . $_soiree_27."',soiree_28='" . $_soiree_28."',soiree_29='" . $_soiree_29."',soiree_30='" . $_soiree_30."',tente_tout='" . $_tente_tout. 
"',tente_23='" . $_tente_23."',tente_24='" . $_tente_24."',tente_25='" . $_tente_25."',tente_26='" . $_tente_26."',tente_27='" . $_tente_27. 
"',tente_28='" . $_tente_28."',tente_29='" . $_tente_29."',tente_30='" . $_tente_30."',parcours='" . $_parcours."',intendance='" . $_intendance. 
"',velo='" . $_velo."',media='" . $_media."',infirmerie='" . $_infirmerie."',secretariat='" . $_secretariat."',technique='" . $_technique. 
"',priere='" . $_priere."',gg='" . $_gg."',sentinelle='" . $_sentinelle."',reglement='" . $_reglement."',observation='" . $_observation."',charte_pelerin='" . $_charte_pelerin. 
"',fiche_inscription_signee='" . $_fiche_inscription_signee.
"',diplome_encadrement_ok='" . $_diplome_encadrement_ok."',attestation_encadrement_ok='" . $attestation_encadrement_ok."',diplome_medical_ok='" . $_diplome_medical_ok."',permis_ok='" . $_permis_ok.
"',assurance_voiture='" . $_assurance_voiture."',materiel_verifie='" . $_materiel_verifie. "',manipulation_denrees='" . $_manipulation_denrees. 
"',besoin_vtt='" . $_besoin_vtt."',validite_vaccination='" . $_validite_vaccination."',certificat_vaccination='" . $_certificat_vaccination."',fiche_liaison='" . $_fiche_liaison."',regime='" . $_regime. 
"',documents_signe='" . $_documents_signe."',inscrit_DDCS='" . $_inscrit_DDCS."',equipe='" . $_equipe."',present_au_pele='" . $_present_au_pele."',casier='" . $_casier."' WHERE `index` = '". $index ."' ";

$res_insertion =    log_mysql_query( $req_modif_fiche, $mysql ); 

if ( $res_insertion == 1)
{
}
else
{  echo  $req_modif_fiche;
   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : pelevtt@diocese-avignon.fr". "<BR>" ;
   echo "Détail de l'erreur".$req_modif_fiche. "<BR>" ;
}

mysql_close();
?>
