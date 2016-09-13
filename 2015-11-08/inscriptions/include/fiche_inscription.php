<?
	# *****************  Sélection des include en fonction du type de l'inscription
	# *****************  $type est basé par l'url

	# *****************  RECHERCHE LA FICHE DE L'ANNEE DERNIERE
	if ($_SESSION['recherche']=="ok") include('include/message_recherche_ok.php');
	else 
	{
 		if ($_SESSION['recherche']=="pas_ok") include('include/message_recherche_pas_ok.php');
		include('include/interligne.php'); 
		include('include/contact_recherche.php');
	}
	$_SESSION['recherche']="";
	include('include/interligne.php'); 
?>	
<!-- Ouverture du Formulaire
	Le formulaire est personnalisé avec du php pour lancer la routine js correspondante pour contrôler le bon remplissage des champs -->
	
<form  name="formSaisie" method="post" 
	 <?php
		if ($faire=="modifier") 
		$suite_form= 'action="valid_inscription.php?type='.$type.'&index='.$index.'&faire=modifier"';
		else 
		$suite_form= 'action="valid_inscription.php?type='.$type.'&faire=sauver"';
		# *****************  Change le type de contrôle en fonction du type de l'inscription
		# l'inscription de &sans=1 dans l'url permet de bypasser les controls
		if ($sans=="1") $suite_form=$suite_form. ' >';
		elseif ($faire=="recherche") $suite_form=$suite_form.' onsubmit="return control_'.$type.'(\'recherche\')">';
		else $suite_form=$suite_form. ' onsubmit="return control_'.$type.'(\'\')" >';
		echo $suite_form;
	?>
<input id="dispo_collegien_F"  name="dispo_collegien_F" value="<?php echo $_SESSION['dispo_collegien_F']; ?>" type="hidden">
<input id="dispo_collegien_H"  name="dispo_collegien_H" value="<?php echo $_SESSION['dispo_collegien_H']; ?>" type="hidden">
<input id="dispo_staff"  name="dispo_staff" value="<?php echo $_SESSION['dispo_staff']; ?>" type="hidden">
<input id="type"  name="type" value="<?php echo $type; ?>" type="hidden">
<? $_SESSION['fiche_faite']="OK"; ?>
<?

	# *****************  CONTACT INSCRIT
 	include('include/contact.php'); 
	if ($type=="animateur") include('include/profession.php'); 
	if ($type=="ttv" or $type=="ggg" or $type=="ogm") include('include/profession_competence.php'); 
	if ($type=="ttv" or $type=="ggg" or $type=="ogm") include('include/diplome.php'); 
	if ($type=="collegien") include('include/scolaire_collegien.php'); 
	if ($type=="staff" ) include('include/scolaire_staff.php'); 
	if ($type=="staff" or $type=="collegien") include('include/paroisse_mouvement.php'); 
	if ($type=="abs" ) include('include/diocese.php'); 
	if ($type<>"staff" and $type<>"collegien") include('include/diplome_encadrement.php'); 


	# *****************  CONTACT RESPONSABLE
	include('include/interligne.php'); 
	if ($type=="ttv" or $type=="animateur" or $type=="abs" or $type=="ggg" or $type=="ogm") include('include/intitule_personne_a_prevenir_adulte.php'); 
	if ($type=="collegien" or $type=="staff" ) include('include/intitule_personne_a_prevenir_enfant.php'); 
	include('include/responsable.php'); 
	if ($type=="collegien" or $type=="staff" ) include('include/autorise_enfant.php'); 
	if ($type=="ttv" or $type=="animateur" or $type=="abs" or $type=="ggg" or $type=="ogm")  include('include/lien_personne.php'); 

	# *****************  CONTACT AUTRE PERSONNE
	include('include/interligne.php'); 
	if ($type=="collegien" or $type=="staff" ) include('include/autre_personne.php'); 

	# *****************  ASSURANCE RC
	include('include/interligne.php'); 
	include('include/assurance_rc.php'); 

	# *****************  DROIT A L'IMAGE
	include('include/interligne.php'); 
	if ($type=="ttv" or $type=="animateur" or $type=="abs" or $type=="ggg" or $type=="ogm")  include('include/droit_image_adulte.php'); 
	if ($type=="collegien" or $type=="staff" ) include('include/droit_image_enfant.php'); 

	# *****************  MATERIEL
	if ($type=="collegien" )
		{  include('include/interligne.php');
		   include('include/materiel.php'); 
		}

	# *****************  PRESENCE
	if ($type<>"collegien" )
		{   include('include/interligne.php'); 
		    include('include/titre_presence.php'); 
			include('include/presence.php'); 
			if ($type=="ttv" ) 
			{
				include('include/interligne.php'); 
				include('include/poste.php'); 
			}
		}

	# *****************  REGLEMENT
	include('include/interligne.php'); 
	if ($type=="ttv" or $type=="ogm" or $type=="ggg") include('include/reglement_ttv.php'); 
	if ($type=="animateur" ) include('include/reglement_anim.php'); 
	if ($type=="abs") include('include/reglement_abs.php'); 
	if ($type=="collegien" or $type=="staff" )  include('include/reglement_enfant.php'); 

	# *****************  DOCUMENTS
	echo "<input id='charte_pelerin'  name='charte_pelerin' value='".$tab['charte_pelerin']."' type='hidden'>";
	echo "<input id='diplome_medical_ok'  name='diplome_medical_ok' value='".$tab['diplome_medical_ok']."' type='hidden'>";
	echo "<input id='permis_ok'  name='permis_ok' value='".$tab['permis_ok']."' type='hidden'>";
	echo "<input id='diplome_encadrement_ok'  name='diplome_encadrement_ok' value='".$tab['diplome_encadrement_ok']."' type='hidden'>";
	echo "<input id='certificat_vaccination'  name='certificat_vaccination' value='".$tab['certificat_vaccination']."' type='hidden'>";
	echo "<input id='validite_vaccination'  name='validite_vaccination' value='".$tab['validite_vaccination']."' type='hidden'>";

	include('include/interligne.php'); 
	include('include/intitule_documents.php'); 
	if ($type=="ttv" or $type=="abs" or $type=="ogm" or $type=="ggg") include('include/assurance_voiture.php'); 
	if ($type=="animateur" or $type=="abs" ) include('include/bafa.php'); 
	if ($type=="ttv" ) include('include/doc_diplome.php'); 
	if ($type=="ttv" ) include('include/manipulation_denrees.php'); 
	if ($type=="ttv" or $type=="animateur" or $type=="abs"  or $type=="ogm" or $type=="ggg") include('include/vaccination.php'); 
	if ($type=="ttv" or $type=="animateur" or $type=="abs"  or $type=="ogm" or $type=="ggg") include('include/casier.php'); 
	if ($type=="collegien" or $type=="staff") include('include/liaison.php'); 
	include('include/interligne.php'); 
	include('include/observation.php'); 
	include('include/interligne.php'); 
?>
</form>
