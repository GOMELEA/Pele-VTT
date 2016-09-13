<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
      session_start(); 
	  include('include/fonction_php.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
.Style3 {
	font-family: Tahoma;
	font-size: 16px;
	position: relative;
	font-weight: bold;

}
.Style11 {
	font-family: Tahoma;
	font-size: 20px;
	position: relative;
	font-weight: bold;
	color: #967236;
}
.Style12 {
	font-family: Verdana;
	font-size: 10px;
	position: relative;
	color: #333333;
}
-->
</style>
 <link href="/normal.css" rel="stylesheet" type="text/css">
 <style type="text/css">
<!--
.Style8 {color: #FFFFFF}
.Style19 {
	font-family: Tahoma;
	font-size: 12px;
	color: #990000;
	font-style: italic;
}
.Style20 {
	font-size: 12px;
	font-weight: bold;
}
.Style22 {font-size: 14px}
.Style24 {font-size: 12; font-weight: bold; }
body {
	background-color: #EFB554;
}
.Style25 {	font-family: Verdana;
	font-size: 12px;
	position: relative;
	color: #333333;
	background-color: #EEEEEE;
}
-->
 </style>
</head>

<body>
<table width="990" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td>
	<p align="center"><?php include('menu.html'); ?><br></p>	</td>
	</td>
  </tr>
    <td>
        <table width="700" border="0">
            <tr class="Style3">
                <td>
                  	<p align="center" class="Style11">Suivi des versions et des modifications <br>(cliquez pour voir la video)<br></td>
            </tr>
             <tr>
                <td><a href="Video/encadrement_scan.JPG">
                Version 2.73 (30-12-2013) Ajout de la possibilité de stocker les dossiers d'encadrement scannés</td>
            </tr>
             <tr>
                <td><a href="Video/liste_tshirt.JPG">
                Version 2.72 (29-12-2013) Mise en place d'une gestion de T-Shirt</td>
            </tr>
             <tr>
                <td><a href="Video/supprime_courriel.JPG">
                Version 2.71 (29-12-2013) Ajout de la possibilité de supprimer des courriels de la base, lorsque des personnes ne 
					veulent plus recevoir de courriels ou lors que les courriels sont HS</td>
            </tr>
             <tr>
                <td><a href="Video/historique_gg.JPG">
                Version 2.70 (28-12-2013) Ajout de l'historique sur les fiches des GG</td>
            </tr>
             <tr>
                <td><a href="Video/changement_logo.jpg">
                Version 2.69 (28-12-2013) Changement du logo</td>
            </tr>
             <tr>
                <td><a href="Video/absence_equipe.jpg">
                Version 2.68 (28-12-2013) Correction du bug d'absence d'affichage du nom de l'équipe dans la liste "tous"</td>
            </tr>
             <tr>
                <td>
                Version 2.67 (01-12-2013) Effacement du courriel et des telephones des mineurs lors de l'utilisation des données de l'année précédente</td>
            </tr>
             <tr>
                <td>
                Version 2.66 (01-12-2013) Mise en place de la saisie des infos pour le carnet de prière</td>
            </tr>
             <tr>
                <td>
                Version 2.65 (01-12-2013) Modifs pour empecher d'envoyer un code de liste d'attente si le délais n'a pas été fixé</td>
            </tr>
             <tr>
                <td>
                Version 2.64 (01-12-2013) Modif pour empêcher des inscriptions sur des routes anciennes à partir d'adresse url</td>
            </tr>
             <tr>
                <td><a href="Video/ajout_trombi.jpg">
                Version 2.63 (01-04-2013) Ajout d'un trombinoscope pour chaque type de participants</td>
            </tr>
             <tr>
                <td>
                Version 2.62 (15-03-2013) Prise en compte des numéros de route pour les départements avec plusieurs routes</td>
            </tr>
             <tr>
                <td><a href="Video/ajout_casier.JPG">
                Version 2.61 (15-03-2013) Remise en place de la demande de casier judiciaire pour les adultes</td>
            </tr>
             <tr>
                <td><a href="Video/ajout_autre_personne.JPG">
                Version 2.60 (15-03-2013) Ajout pour les collégiens et staffs dans l'inscription une autre personne autorisé à venir le chercher</td>
            </tr>
             <tr>
                <td><a href="Video/ajout_nuit_sur_place.JPG">
                Version 2.59 (15-03-2013) Modification de nuit sous tente par nuit sur place</td>
            </tr>
             <tr>
                <td><a href="Video/ajout_droit_image.JPG">
                Version 2.58 (15-03-2013) Modification des explications de la nécessité de cocher le droit à l'image</td>
            </tr>
             <tr>
                <td>
                Version 2.57 (15-03-2013) Suppression des mineurs de la liste DDCS</td>
            </tr>
             <tr>
                <td>
                Version 2.56 (15-03-2013) Création des chèques vacances à 15€</td>
            </tr>
             <tr>
                <td>
                Version 2.55 (15-03-2013) Correction du Bug de calcul des réglements manquants dans le cas d'utilisation de bon caf ou chèque vacances</td>
            </tr>
             <tr>
                <td>
                Version 2.54 (15-03-2013) Historisation des photos des participants (les photos des participants sont stockées par année)</td>
            </tr>
             <tr>
                <td><a href="Video/ajout_autre_liste.JPG">
                Version 2.53 (15-03-2013) Découpage du menu Liste et création d'un menu autres listes</td>
            </tr>
             <tr>
                <td><a href="Video/ajout_nom_civil.JPG">
                Version 2.52 (15-03-2013) Ajout du nom civil s'il est différent de l'usuel</td>
            </tr>
             <tr>
                <td><a href="Video/ajout_assistance_commune.JPG">
                Version 2.51 (15-03-2013) Ajout des arrondissements de naissance (Paris, Marseille, Lyon...) et assistance à la saisie de la commune et du département</td>
            </tr>
             <tr>
                <td><a href="Video/ajout_reseaux_sociaux.JPG">
                Version 2.50 (18-12-2012) Ajout des informations concernant facebook et twitter dans la page des inscriptions</td>
            </tr>
             <tr>
                <td>
                Version 2.49 (01-11-2012) Correction du Bug de mise en place de la photo d'un participant avec un apostrophe dans le nom</td>
            </tr>
             <tr>
                <td><a href="Video/modif_attestation.JPG">
                Version 2.48 (17-07-2012) Modification des attestation de présence en fonction de la date d'édition</td>
            </tr>
             <tr>
                <td><a href="Video/ajout_liste_observations.jpg">
                Version 2.47 (30-06-2012) Ajout d'une liste des Observations</td>
            </tr>
             <tr>
                <td><a href="Video/ajout_liste_regime.jpg">
                Version 2.46 (26-06-2012) Ajout d'une liste de Régime Alimentaire</td>
            </tr>
             <tr>
                <td>
                Version 2.45 (04-06-2012) Débugage d'un problème de changement de route à cause des informations dans l'observation</td>
            </tr>
             <tr>
                <td>
                Version 2.44 (04-06-2012) Modification du Bug sur les tries des chèques bancaires qui triait d'abord les cheque 1 puis 2 puis 3. Mise en place de trie par date puis nom.</td>
            </tr>
             <tr>
                <td>
                Version 2.43 Modification du Bug permettant de réutiliser le code de l'année précédente lorsqu'on profite d'une place disponible</td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/autres_reglements.html">
                Version 2.42 Prise en compte des autres modes de réglements (CAF, chèques vacances)</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/conservations_documents.html">
                Version 2.41 Conservations des documents des participants d'une année sur l'autre</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/inscriptions_ddcs.html">
                Version 2.40 Aide à la saisie DDCS</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/attestations.html">
                Version 2.40 Envoie des attestations et des reçus par courriel</a></td>
            </tr>
             <tr>
                <td>
                Version 2.39 Modification du Bug sur liste des repas avec non-apparition des collégiens</td>
            </tr>
             <tr>
                <td>
				<a href="Video/ajout_naissance_etranger.jpg">
                Version 2.38 Ajout des nom et prénoms des parents en cas de naissance à l'étranger pour les adultes (déclarations DDCS)</td>
            </tr>
             <tr>
                <td>
				<a href="Video/ajout_annee_courriel.jpg">
                Version 2.37 Ajout des conditions sur l'age et sur l'année de la route pour les listes de courriels</td>
            </tr>
             <tr>
                <td>
                Version 2.36 Modification du format d'enregistrement des dates de naissance</td>
            </tr>
             <tr>
                <td>
				<a href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/ajout_departement.JPG">
                Version 2.35 Ajout du nom des département pour faciliter l'inscription DDJS</a></td>
            </tr>
             <tr>
                <td>
				<a href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/ajout_liste_classe.jpg">
                Version 2.34 Mise en place de listes fermées pour le choix de la classe des collégiens et staff pour permettre les stats</a></td>
            </tr>
             <tr>
                <td>
				<a href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/ajout_nom.JPG">
                Version 2.33 Ajout des 5 premiers caractères du nom sur les fiches des participants pour faciliter le classement</a></td>
            </tr>
             <tr>
                <td>
				<a href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/ajout_courriel.JPG">
                Version 2.32 Ajout du courriel du secrétariat sur la liste de choix des routes</a></td>
            </tr>
             <tr>
                <td>
				<a href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/ajout_date_ouverture.JPG">
                Version 2.31 Ajout de la date d'ouverture des inscriptions pour les jeunes</a></td>
            </tr>
             <tr>
                <td>
				<a href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/ajout_route_publique.JPG">
                Version 2.30 Ajout de la variable "Route publique" qui doit être cochée pour que la route soit affichée pour les inscriptions</a></td>
            </tr>
             <tr>
                <td>
                <a href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/ajout_tarif_anim.JPG">
				Version 2.29 Ajout d'un tarif Animateur distinct de celui des TTV</a></td>
            </tr>
           <tr>
                <td>
                <a href="../../../Production 2013-01-10/inscriptions/Secretariat/liste_etiquette.php">
				Version 2.28 Création d'une page de génération d'étiquettes</a></td>
            </tr>
            <tr>
                <td>
                <a href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/ajout_sentinelle.JPG">
				Version 2.27 Ajout des sentinelles dans le Trombinoscope</a></td>
            </tr>
            <tr>
                <td>
                <a href="../../../Production 2013-01-10/inscriptions/Secretariat/stat.php">
				Version 2.26 Création d'une page de statistique</a></td>
            </tr>
            <tr>
                <td>
                Version 2.25 Correction d'un Bug d'édition d'étiquettes de Soutien</a></td>
            </tr>
            <tr>
                <td>
                <a href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/ajout_historique.JPG">
				Version 2.24 Ajout de l'historique sur les fiches des participants</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/liste_impression.html">
                Version 2.23 Explication des impressions et modifications des listes</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/soutien_impression.html">
                Version 2.22 Impression etiquettes et export excel pour les soutiens</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/modif_administratif.html">
                Version 2.21  Modifications des demandes administratives pour 2011</a></td>
            </tr>
            <tr>
                <td>
                Version 2.20 Débogage divers et varié....</a></td>
            </tr>
            <tr>
                <td>
                Version 2.19 Mise en place d'un système de log (enregistrements), pour faciliter le déboggage</a></td>
            </tr>
            <tr>
                <td>
                Version 2.18 Modification de liste\tous\encadrement pour ajout du calcul du nombre de BAFD</a></td>
            </tr>
            <tr>
                <td>
                Version 2.17 Déménagement du site chez OVH et possibilité de créer des adresses @pelevtt.fr de redirection</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/soutien.html">
                Version 2.16 Création d'une base de données pour les soutiens</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/inscription_attente.html">
                Version 2.15 Modification du système de suivi des inscriptions</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/courriel_auto.html">
                Version 2.14 Modification du système d'envoi de courriel</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/corbeille.html">
                Version 2.13 Mise en place d'un système de corbeille pour les fiches d'inscriptions</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/casier_judiciaire.html">
                Version 2.12 Suppression de la demande de casier judiciaire</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/bordereau_hypertexte.html">
                Version 2.11 Ajout de liens hypertexte dans le bordereau des chèques pour pouvoir modifier les chèques</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/departement_naissance.html">
                Version 2.10 Ajout du champs "Département Naissance"</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/code_confidentiel.html">
                Version 2.09 Création d'un système permettant de réutiliser les fiches de l'année précédente</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/gestion_equipe.html">
                Version 2.08 Création d'une gestion spécifique pour les équipes</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/liste_par_fonction.html">
                Version 2.07 Modifications de la liste par fonctions</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/liste_courriel.html">
                Version 2.06 Modifications de l'affichage des listes de courriels</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/classe_en_cours.html">
                Version 2.05 Dans les fiches d'inscriptions des jeunes modifications de l'info pour les classes</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/apostrophe.html">
                Version 2.04 Possibilité d'utiliser les apostrophes dans les textes</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=820,height=470'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/page_info_accueil.html">
                Version 2.03 Ajout d'une page d'accueil pour les inscriptions</a></td>
            </tr>
            <tr>
                <td>
                <a onclick="window.open(this, 'Zazie', 'width=900,height=500'); return false;" href="../../../Production 2013-01-10/inscriptions/Secretariat/Video/suppression_bouton_afficher.html">
                Version 2.02 Suppression Bouton Afficher</a></td>
            </tr>
        </table>
	</td>
  <tr>
</table>






</body>
</html>
