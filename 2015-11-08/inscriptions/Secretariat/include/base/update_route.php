<?php
# Gère la modification d'une  route sur la base Mysql 


# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX       montage de la requete de modification  pour la route         XXXXXXXXXXXXXXXXXXXXXxXXX

$req_modif_fiche = "UPDATE   `route`  SET  annee='" . $_annee. "',route_publique='" . $_route_publique. "',departement='" . $_departement. "',n_departement='" . $_n_departement."',lieu_depart='" . 
$_lieu_depart. "',lieu_arrive='" . $_lieu_arrive. "',adresse_bandeau='" . $_adresse_bandeau. "',nom_association='" . 
$_nom_association. "',adresse_association='" . $_adresse_association. "',siret_association='" . $_siret_association. "',n_organisateur_DDCS='" . $_n_organisateur_DDCS. "',n_camp_DDCS='" . 
$_n_camp_DDCS. "',jour_debut_precamp='" . $_jour_debut_precamp. "',jour_fin_postcamp='" . $_jour_fin_postcamp. "',jour_debut_camp='" . 
$_jour_debut_camp. "',jour_fin_camp='" . $_jour_fin_camp. "',couchage_j1='" . $_couchage_j1. "',couchage_j2='" . $_couchage_j2. "',couchage_j3='" . 
$_couchage_j3. "',couchage_j4='" . $_couchage_j4. "',couchage_j5='" . $_couchage_j5. "',couchage_j6='" . $_couchage_j6. "',couchage_j7='" . 
$_couchage_j7. "',couchage_j8='" . $_couchage_j8. "',ordre_reglement='" . $_ordre_reglement."',paiement_accepte='" . $_paiement_accepte. "',tarif_1enf='" . 
$_tarif_1enf. "',tarif_2enf='" . $_tarif_2enf. "',tarif_3enf='" . $_tarif_3enf. "',tarif_enf_sup='" . $_tarif_enf_sup. "',tarif_abs='" .
$_tarif_abs. "',tarif_ttv='" . $_tarif_ttv. "',tarif_anim='" . $_tarif_anim. "',tarif_asso='" . $_tarif_asso. "',adresse_reglement='" . 
$_adresse_reglement. "',url_site='" . $_url_site."',url_facebook='" . $_url_facebook."',url_twitter='" . $_url_twitter."',courriel_expediteur='" . 
$_courriel_expediteur. "',courriel_copie='" . $_courriel_copie. "',max_collegien='" . 
$_max_collegien. "',max_collegienne='" . $_max_collegienne."',max_staff='" . $_max_staff."',forcage_collegien_attente='" . $_forcage_collegien_attente."',forcage_collegienne_attente='" .
$_forcage_collegienne_attente."',forcage_staff_attente='" . $_forcage_staff_attente."',cout_dvd='" .
$_cout_dvd. "',dvd_text='" . $_dvd_text."',instrument_ok='" . $_instrument_ok."',debut_inscription='" . $_debut_inscription. "',nom_compte_bancaire='" . 
$_nom_compte_bancaire. "',n_compte_bancaire='" . $_n_compte_bancaire. "',presence_staff='" . $_presence_staff. "',presence_abs='" . 
$_presence_abs. "',presence_animateur='" . $_presence_animateur. "',presence_ttv='" . $_presence_ttv."',soutien='" . 
$_soutien.  "',accueil_info_diverses='" . $_accueil_info_diverses."',intention_priere='" . $_intention_priere."' WHERE index_route='" . $Selection."' ";

 $res_insertion =    log_mysql_query( $req_modif_fiche, $mysql );
 

if ( $res_insertion == 1)
{
}
else
{
   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
}

mysql_close();
?>
