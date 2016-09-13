<?php
      session_start(); 
	  if ($_SESSION['index_route']=="") header("Location: http://www.pele-vtt.fr/inscriptions/Secretariat/index.php\n\n"); 
	  $Selection = $_GET["Selection"];
	  $go = $_GET["go"];
	  $action = $_GET["action"];
	  $envoi_courriel = $_GET["envoi_courriel"];
	  $index = $_GET["index"];
	  $ndepartement = $_GET["ndepartement"];
	  $index_inscription = $_GET["index_inscription"];
	  include('include/fonction_php.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
.Style7 {font-family: Arial, Helvetica, sans-serif; font-size: 24px; font-weight: bold; }
-->
</style>
<body>
<SCRIPT LANGUAGE="JavaScript">
function changement_route(index) 
{
var msg = "Êtes-vous sur de vouloir charger cette fiche d'inscription de route ?";
if (confirm(msg))
{
	n_departement=prompt("Entrez le numéro du département de la route où vous voulez transférer cette inscription :","");
	location.replace('secretariat_inscription.php?index_inscription='+index+'&ndepartement='+n_departement+'&action=changer_route');
}
}
function confirmation_corbeille(index) 
{
var msg = "Êtes-vous sur de vouloir mettre cette inscription à la corbeille?";
if (confirm(msg))
location.replace('secretariat_inscription.php?index_inscription='+index+'&action=corbeille');
}
function confirmation_supprimer_definitivement(index) 
{
var msg = "Êtes-vous sur de vouloir supprimer définitivement cette inscription ?";
if (confirm(msg))
location.replace('secretariat_inscription.php?index_inscription='+index+'&action=supprimer');
}
function confirmation_restauration(index) 
{
var msg = "Êtes-vous sur de vouloir restaurer cette inscription ?";
if (confirm(msg))
location.replace('secretariat_inscription.php?index_inscription='+index+'&action=restaurer');
}
function confirmation_envoi_courriel(index) 
{
var msg = "Êtes-vous sur de vouloir envoyer ce courriel ?";
if (confirm(msg))
location.replace('secretariat_inscription.php?Selection='+index+'&go=Afficher&envoi_courriel=ok');
}
function renvoie_dossier()
{
	var renvoie_dossier= document.getElementById("renvoie_dossier");
	if (renvoie_dossier.checked==false)
	{ 	alert("Veuillez cocher le droit à l'image");
		validation=false; }

if (confirm(msg))
location.replace('secretariat_inscription.php?Selection='+index+'&go=Afficher&envoi_info=ok');
}

renvoie_dossier()

</SCRIPT>
<script	src="../js/presence.js" type="text/javascript" ></script>
<?php 
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Envoi le courriel
	if ($action=="configuration_courriel" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement'])or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		$_SESSION['renvoie_dossier']=$_POST['renvoie_dossier'];
		$_SESSION['manque_piece']=$_POST['manque_piece'];
		$_SESSION['attestation']=$_POST['attestation'];
		$_SESSION['ar_documents']=$_POST['ar_documents'];
		$_SESSION['confirmation_inscription']=$_POST['confirmation_inscription'];
		$_SESSION['info_pratique']=$_POST['info_pratique'];
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Affiche les fiches à la corbeille
	if ($action=="liste_corbeille" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement'])or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		$_SESSION['liste_corbeille']=$_POST['liste_corbeille'];
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Envoi le courriel
	if ($envoi_courriel=="ok" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement'])or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		include('envoi_courriel.php');
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     SUPPRIME LA FICHE
	if ($action=="supprimer" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement'])or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		include('include/base/supprimer_inscription.php');
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     METTRE LA FICHE A LA CORBEILLE
	if ($action=="corbeille" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement'])or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		include('../include/base/connexion_serveur.php');
		$observation="Le ".date("Y-m-d à G")."h".date("i")." - Mise à la corbeille \n";
		$res =  log_mysql_query( "SELECT observation_inscription FROM  inscription WHERE `index_inscription` = '". $index_inscription ."' ", $mysql );
		$tab = mysql_fetch_array ($res);
		$req_modif_fiche = "UPDATE   `inscription`  SET observation_inscription = '" . $observation .mysql_real_escape_string($tab['observation_inscription'])."', corbeille='oui' WHERE `index_inscription` = '". $index_inscription ."' ";
		$res_insertion =    log_mysql_query( $req_modif_fiche, $mysql );
		$res =  log_mysql_query( "SELECT observation FROM  fiche WHERE `fiche_numero_inscription` = '". $index_inscription ."' ", $mysql );
		$tab = mysql_fetch_array ($res);
		$req_modif_fiche = "UPDATE   `fiche` SET  observation = '" . $observation .mysql_real_escape_string($tab['observation'])."', corbeille='oui' WHERE `fiche_numero_inscription` = '". $index_inscription ."' ";
		$res_insertion =    log_mysql_query( $req_modif_fiche, $mysql );
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     RESTAURER LA FICHE
	if ($action=="restaurer" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement'])or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		include('../include/base/connexion_serveur.php');
		$req_modif_fiche = "UPDATE   `inscription`  SET corbeille='non' WHERE `index_inscription` = '". $index_inscription ."' ";
		$res_insertion =    log_mysql_query( $req_modif_fiche, $mysql );
		$req_modif_fiche = "UPDATE   `fiche`  SET corbeille='non' WHERE `fiche_numero_inscription` = '". $index_inscription ."' ";
		$res_insertion =    log_mysql_query( $req_modif_fiche, $mysql );
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     DEPLACE LA FICHE SUR UNE AUTRE ROUTE
	if ($action=="changer_route" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement'])or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		include('../include/base/connexion_serveur.php');
		include('include/base/changer_route_inscription.php');
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     MODIFIE LA FICHE
	elseif ($action=="sauvegarder" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement'])or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		include('include/base/copie_variable_post_inscription.php');
		include('../include/base/connexion_serveur.php');
		$index_inscription=$Selection;
		include('include/base/update_inscription.php');
	}
?>

<table width="1200" border="0">
  <tr>
    <td colspan="12"><?php include('menu.html'); ?></td>
  </tr>
<tr>
	<td colspan="12" class="Style7">Fiche Inscription <? if ($_SESSION['liste_corbeille']=="oui") echo "à la Corbeille";?></td>
  <tr>
    <td width="350"><?php
	# *****************  AFFICHAGE de la liste déroulante pour les noms et prénoms
	if ($_SESSION['liste_corbeille']=="oui") $_SESSION['Where_corbeille']=' and corbeille="oui" ';
	else $_SESSION['Where_corbeille']=' and corbeille<>"oui" ';
	include('../include/base/connexion_serveur.php');
	echo '<form method="GET" action="secretariat_inscription.php" >';
	echo '<select name="Selection" id="menuadherents" onChange="submit();">';
	$resultat=log_mysql_query("SELECT `nom_inscription`,`prenom_inscription`,`index_inscription` FROM `inscription`  ".$_SESSION['where_simple'].$_SESSION['Where_corbeille']." order by `nom_inscription`,`prenom_inscription` ",$mysql) or die ("Requête non executée.");
	//Génération de la liste déroulante avec nom et prénom
	// le caractère + est utilisé pour faire la limite entre nom et prénom
	echo '<option value="" selected="selected" > </option>;';	
	while ($ligne=mysql_fetch_array($resultat))
	{
	$ligne=stripslashes_deep($ligne);
	echo '<option value ="'.$ligne["index_inscription"].'">'.$ligne["nom_inscription"]." + ".$ligne["prenom_inscription"].'</option>';
	}
	echo '</select>';
	echo '</form>'; ?></td>
    <td width="80"><?php 
	# *****************  AFFICHAGE de la liste déroulante pour les numéros
	echo '<form method="GET" action="secretariat_inscription.php" >';
	$index_inscription=$Selection; 
	echo '<select name="Selection" id="menu_index" onChange="submit();">';
	$resultat_index=log_mysql_query("SELECT `index_inscription` FROM `inscription`  ".$_SESSION['where_simple'].$_SESSION['Where_corbeille']." order by `index_inscription`",$mysql) or die ("Requête non executée.");
	//Génération de la liste déroulante avec nom et prénom
	// le caractère + est utilisé pour faire la limite entre nom et prénom
	echo '<option value="" selected="selected" > </option>;';	
	while ($ligne_index=mysql_fetch_array($resultat_index))
	{
	$ligne=stripslashes_deep($ligne);
	echo '<option>'.$ligne_index["index_inscription"].'</option>';
	}
	echo '</select>';
	echo '</form>'; 
	//Les lignes suivantes affichent le détail d'un adhérent
	// si l'utilisateur en a choisi un

	$resultat = log_mysql_query("Select * from `inscription` where `index_inscription`='".$index_inscription."'  ",$mysql) or die ("Requête non executée.");
	$inscription = mysql_fetch_array($resultat);
	$inscription=stripslashes_deep($inscription);

	$result=log_mysql_query("SELECT * FROM `fiche` where fiche_numero_inscription='".$inscription['index_inscription']. "'",$mysql) or die ("Requête non executée.");
	?></td>
	<td width="160">
        <form  name="formSaisie" method="post" action="secretariat_inscription.php?Selection=<?php echo $inscription['index_inscription']; ?>&go=Afficher&action=liste_corbeille" onClick="submit();">
        <input id="liste_corbeille" name="liste_corbeille" value="oui" <?php if ($_SESSION['liste_corbeille']=="oui") echo "checked=\"checked\"";?> type="checkbox"> Fiches à la corbeille
		</form>
    </td> 
	<td> </td>
	<td width="28"></td> 
	<td width="28"></td> 
    <td width="103"><form  name="formSaisie" method="post" action="secretariat_inscription.php?Selection=<?php echo $inscription['index_inscription']; ?>&go=Afficher&action=sauvegarder"><input id="button3" name="button" type="submit"  value=" Validation "></div></td>
    <td width="150"><div align="center"><INPUT TYPE='Button' onClick='changement_route(<?php echo $inscription['index_inscription']; ?>);' VALUE='Changer de Route'></div>  </td>
    <td><div align="right">
    <? if($inscription['corbeille']=="oui") echo "<INPUT TYPE='Button' onClick='confirmation_restauration(".$inscription['index_inscription'].");' VALUE='Restaurer'>"; ?></div> </td>
    <td width="61">
    <? if($inscription['corbeille']=="oui") echo "<INPUT TYPE='Button' onClick='confirmation_supprimer_definitivement(".$inscription['index_inscription'].");' VALUE='Supprimer'>";
		else echo "<INPUT TYPE='Button' onClick='confirmation_corbeille(".$inscription['index_inscription'].");' VALUE='Corbeille'>"; ?>
    </td>
</table>
<div style="float:left ">
<table width="411" border="0">
  <tr valign="top">
    <td width="411" rowspan="10">	
		<?php 
			include('include/secr_inscription.php');
			include('include/secr_observation_inscription.php');
		?>
	</td>
  </tr>
</table>
</form>  
</div>

<br>
<div style="float:left ">
<form  name="formSaisie" method="post" action="secretariat_inscription.php?Selection=<?php echo $inscription['index_inscription']; ?>&go=Afficher&action=configuration_courriel">
<table width="660" border="0" class="Style12">
    <tr  align="center">
      <td colspan="3" align="center">Envoyer un courriel pour :</td>
      <td>&nbsp;</td>
    </tr>
    <tr  align="center">
      <td align="left"><input id="renvoie_dossier" name="renvoie_dossier" value=1 <?php if ($_SESSION['renvoie_dossier']!=0) echo "checked=\"checked\"";?> type="checkbox" onChange="submit();">
       Renvoyer le dossier d'inscription<br>
      <input id="manque_piece" name="manque_piece" value=1 <?php if ($_SESSION['manque_piece']!=0) echo "checked=\"checked\"";?> type="checkbox" onChange="submit();">
       Informer qu'il manque des pi&egrave;ces <br>
      <input id="attestation" name="attestation" value=1 <?php if ($_SESSION['attestation']!=0) echo "checked=\"checked\"";?> type="checkbox" onChange="submit();">
       Envoyer une attestation de participation<br>
      <br></td>
      <td colspan="2" align="left">
      <input id="ar_documents" name="ar_documents" value=1 <?php if ($_SESSION['ar_documents']!=0) echo "checked=\"checked\"";?> type="checkbox" onChange="submit();">
      Informer qu'on a re&ccedil;u des documents<br>
      <input id="confirmation_inscription" name="confirmation_inscription" value=1 <?php if ($_SESSION['confirmation_inscription']!=0) echo "checked=\"checked\"";?> type="checkbox" onChange="submit();">
        Confirmer l'inscription<br>
      <input id="info_pratique" name="info_pratique" value=1 <?php if ($_SESSION['info_pratique']!=0) echo "checked=\"checked\"";?> type="checkbox" onChange="submit();">
       Envoyer les infos pratiques du P&eacute;l&eacute;<br>      <br></td>
      <td><img src="../Photo/envoyer.png" width="60"  border="0" title="Envoyer le courriel" onClick='confirmation_envoi_courriel(<?php echo $inscription['index_inscription']; ?>);'></td>
    </tr>
</table>
</form>

<br>
<table border="1">	<?php    
	while (	$tab=mysql_fetch_array($result))
		{ 	$tab=stripslashes_deep($tab);
		?>
		<tr>
		<td  height="40" valign="middle" ><?php 
			switch ($tab['type']) {
				case "ttv":
					echo '<img src="../Photo/inscription_ttv_petit.jpg" border="1">';
					break;
				case "abs":
					echo '<img src="../Photo/inscription_abs_petit.jpg" border="1">';
					break;
				case "staff":
					echo '<img src="../Photo/inscription_staff_petit.jpg" border="1">';
					break;
				case "animateur":
					echo '<img src="../Photo/inscription_animateur_petit.jpg" border="1">';
					break;
				case "collegien":
					echo '<img src="../Photo/inscription_collegien_petit.jpg" border="1">';
					break;
				case "ggg":
					echo '<img src="../Photo/inscription_ggg_petit.jpg" border="1">';
					break;
				case "ogm":
					echo '<img src="../Photo/inscription_ogm_petit.jpg" border="1">';
					break;
				}?></td>
		<td width="220" valign="middle"><?php echo $tab['nom_usage']." ".$tab['prenom'] ?></td>
		<td width="40" align="center" valign="middle"><?php echo $tab['reglement']." €" ?></td>
		<td width="28" <?php if ($tab['corbeille']=="oui") echo 'bgcolor="#000000"';elseif ($tab['documents_signe']!=0) echo 'bgcolor="#33CC00"'; else echo 'bgcolor="#FFCC00"'?>><div align="center"><span class="Style7">D</span> </div></td>
		<td width="28" <?php if ($tab['corbeille']=="oui") echo 'bgcolor="#000000"';elseif ($inscription['regle']!=0) echo 'bgcolor="#33CC00"'; else echo 'bgcolor="#FFCC00"'?> ><div align="center"><span class="Style7">R</span></div></td>
		<td width="28" <?php if ($tab['corbeille']=="oui") echo 'bgcolor="#000000"';elseif ($tab['present_au_pele']!=0) echo 'bgcolor="#33CC00"'; else echo 'bgcolor="#FFCC00"'?>><div align="center"><span class="Style7">P</span></div></td>
		<td width="50"  align="center"><a href="secretariat_fiche.php?Selection=<?php echo $tab['index']; ?>&go=Afficher"><img src="../Photo/modifier.jpg" width="40" height="40" border="0"></a></td>
		</tr>
		<?php
 		}
	?>
</table>

</div>
