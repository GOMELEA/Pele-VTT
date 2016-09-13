<?php
# Copie les paramètres de la route sélectionnée au travers de $route (passé dans l'url) dans les variables de type $_SESSION

include('connexion_serveur.php');
$_SESSION['index_route']=$route;
$req_liste= "  SELECT * FROM `route` WHERE `index_route`= '".$_SESSION['index_route']."' " ;
$res_liste= log_mysql_query($req_liste , $mysql);
$tabres = mysql_fetch_array ($res_liste);
$tabres=stripslashes_deep($tabres);
mysql_close();
# xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx     Copie les valeurs de la route dans la Session        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

$_SESSION['index_route']=$tabres['index_route'];
$_SESSION['route_publique']=$tabres['route_publique'];
$_SESSION['annee']=$tabres['annee'];
$_SESSION['departement']=$tabres['departement'];
$_SESSION['n_departement']=$tabres['n_departement'];
$_SESSION['lieu_depart']=$tabres['lieu_depart'];
$_SESSION['lieu_arrive']=$tabres['lieu_arrive'];
$_SESSION['adresse_bandeau']=$tabres['adresse_bandeau'];
$_SESSION['nom_association']=$tabres['nom_association'];
$_SESSION['adresse_association']=$tabres['adresse_association'];
$_SESSION['siret_association']=$tabres['siret_association'];
$_SESSION['n_organisateur_DDCS']=$tabres['n_organisateur_DDCS'];
$_SESSION['n_camp_DDCS']=$tabres['n_camp_DDCS'];
$_SESSION['jour_debut_precamp']=$tabres['jour_debut_precamp'];
$_SESSION['jour_fin_postcamp']=$tabres['jour_fin_postcamp'];
$_SESSION['jour_debut_camp']=$tabres['jour_debut_camp'];
$_SESSION['jour_fin_camp']=$tabres['jour_fin_camp'];
$_SESSION['couchage_j1']=$tabres['couchage_j1'];
$_SESSION['couchage_j2']=$tabres['couchage_j2'];
$_SESSION['couchage_j3']=$tabres['couchage_j3'];
$_SESSION['couchage_j4']=$tabres['couchage_j4'];
$_SESSION['couchage_j5']=$tabres['couchage_j5'];
$_SESSION['couchage_j6']=$tabres['couchage_j6'];
$_SESSION['couchage_j7']=$tabres['couchage_j7'];
$_SESSION['couchage_j8']=$tabres['couchage_j8'];
$_SESSION['ordre_reglement']=$tabres['ordre_reglement'];
$_SESSION['adresse_reglement']=$tabres['adresse_reglement'];
$_SESSION['paiement_accepte']=$tabres['paiement_accepte'];
$_SESSION['tarif_1enf']=$tabres['tarif_1enf'];
$_SESSION['tarif_2enf']=$tabres['tarif_2enf'];
$_SESSION['tarif_3enf']=$tabres['tarif_3enf'];
$_SESSION['tarif_enf_sup']=$tabres['tarif_enf_sup'];
$_SESSION['tarif_abs']=$tabres['tarif_abs'];
$_SESSION['tarif_ttv']=$tabres['tarif_ttv'];
$_SESSION['tarif_anim']=$tabres['tarif_anim'];
$_SESSION['tarif_asso']=$tabres['tarif_asso'];
$_SESSION['url_site']=$tabres['url_site'];
$_SESSION['courriel_expediteur']=$tabres['courriel_expediteur'];
$_SESSION['courriel_copie']=$tabres['courriel_copie'];
$_SESSION['max_collegien']=$tabres['max_collegien'];
$_SESSION['max_collegienne']=$tabres['max_collegienne'];
$_SESSION['max_staff']=$tabres['max_staff'];
$_SESSION['forcage_collegien_attente']=$tabres['forcage_collegien_attente'];
$_SESSION['forcage_collegienne_attente']=$tabres['forcage_collegienne_attente'];
$_SESSION['forcage_staff_attente']=$tabres['forcage_staff_attente'];
$_SESSION['cout_dvd']=$tabres['cout_dvd'];
$_SESSION['dvd_text']=$tabres['dvd_text'];
$_SESSION['instrument_ok']=$tabres['instrument_ok'];
$_SESSION['debut_inscription']=$tabres['debut_inscription'];
$_SESSION['nom_compte_bancaire']=$tabres['nom_compte_bancaire'];
$_SESSION['n_compte_bancaire']=$tabres['n_compte_bancaire'];
$_SESSION['presence_staff']=$tabres['presence_staff'];
$_SESSION['presence_abs']=$tabres['presence_abs'];
$_SESSION['presence_animateur']=$tabres['presence_animateur'];
$_SESSION['presence_ttv']=$tabres['presence_ttv'];
$_SESSION['soutien']=$tabres['soutien'];
$_SESSION['accueil_info_diverses']=$tabres['accueil_info_diverses'];
$_SESSION['debut_courriel_code_recherche']= "Vous avez fait une inscription l'année dernière au pélé VTT.\n\nAfin de faciliter votre inscription de cette année, nous ".
	"vous envoyons un code confidentiel, qui vous permettra de réutiliser les informations que vous avez saisis l'année dernière. Vous trouverez un code pour chaque personne ".
	"inscrite.\n\nCe code est confidentiel et sans ce code, vous ne pourrez avoir accès à vos informations. Conservez-le bien.\n\nVoici les codes : ";
$_SESSION['fin_courriel_code_recherche']= "Attention de bien respecter les minuscules et les MAJUSCULES lorsque vous saisirez le code ".
	"sur le site d'inscription. \n\nLes inscriptions pour les animateurs, ttv et abs sont ouvertes, alors rendez-vous sur http://www.pele-vtt.fr/".
	" \n\nA très bientôt\n\nLe Secrétariat\n";
	

$_SESSION['and']=" and `route_index`='".$_SESSION['index_route']."' and `corbeille`<>'oui'";
$_SESSION['where']=" where `route_index`='".$_SESSION['index_route']."' and `corbeille`<>'oui'";
$_SESSION['and_simple']=" and `route_index`='".$_SESSION['index_route']."' ";
$_SESSION['where_simple']=" where `route_index`='".$_SESSION['index_route']."' ";


?>
