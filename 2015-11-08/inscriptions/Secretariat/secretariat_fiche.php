<?php
      session_start(); 
	  if ($_SESSION['index_route']=="") header("Location: http://www.pele-vtt.fr/inscriptions/Secretariat/index.php\n\n"); 
	  $Selection = $_GET["Selection"];
	  $go = $_GET["go"];
	  $action = $_GET["action"];
	  $index = $_GET["index"];
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
function confirmation_corbeille(index) 
{
var msg = "Êtes-vous sur de vouloir mettre cette fiche de participant à la corbeille?";
if (confirm(msg))
location.replace('secretariat_fiche.php?index='+index+'&action=corbeille');
}
function confirmation_supprimer_definitivement(index) 
{
var msg = "Êtes-vous sur de vouloir supprimer définitivement cette fiche de participant ?";
if (confirm(msg))
location.replace('secretariat_fiche.php?index='+index+'&action=supprimer');
}
function confirmation_restauration(index) 
{
var msg = "Êtes-vous sur de vouloir restaurer cette fiche de participant ?";
if (confirm(msg))
location.replace('secretariat_fiche.php?index='+index+'&action=restaurer');
}
</SCRIPT>
<script	src="../js/presence.js" type="text/javascript" ></script>
<?php 
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Affiche les fiches à la corbeille
	if ($action=="liste_corbeille" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement'])or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		$_SESSION['liste_corbeille']=$_POST['liste_corbeille'];
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     SUPPRIME LA FICHE
	if ($action=="supprimer" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement']) or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		include('include/base/supprimer_fiche.php');
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     METTRE LA FICHE A LA CORBEILLE
	if ($action=="corbeille" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement'])or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		include('../include/base/connexion_serveur.php');
		$res =  log_mysql_query( "SELECT observation FROM  fiche WHERE `index` = '". $index ."' ", $mysql );
		$tab = mysql_fetch_array ($res);
		$observation="Le ".date("Y-m-d à G")."h".date("i")." - Mise à la corbeille \n".$tab['observation'];
		$req_modif_fiche = "UPDATE   `fiche`  SET corbeille='oui', observation = '" . mysql_real_escape_string($observation) ."' WHERE `index` = '". $index ."' ";
		$res_insertion =    log_mysql_query( $req_modif_fiche, $mysql );
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     RESTAURER LA FICHE
	if ($action=="restaurer" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement'])or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		include('../include/base/connexion_serveur.php');
		$req_modif_fiche = "UPDATE   `fiche`  SET corbeille='non' WHERE `index` = '". $index ."' ";
		$res_insertion =    log_mysql_query( $req_modif_fiche, $mysql );
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     MODIFIE LA FICHE
	elseif ($action=="sauvegarder" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement']) or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		$index=$Selection;
		include('include/base/copie_variable_post.php');
		include('../include/base/connexion_serveur.php');
		include('include/base/update_fiche.php');
		error_reporting(0);
		mkdir ("../data/".formatage_repertoire($_SESSION['departement']),0777);
		error_reporting(1);
		sauvegarde('photo_identite','.jpg','../data/'.formatage_repertoire($_SESSION['departement']).'/'.formatage_nom_de_fichier($_nom_usage).'_'.formatage_nom_de_fichier($_prenom).'_'.$_SESSION['annee'].'.jpg',50000);
		sauvegarde('diplome_encadrement','.jpg','../data/_DIPLOME_ENCADREMENT/'.formatage_nom_de_fichier($_nom_usage).'_'.formatage_nom_de_fichier($_prenom).'_'.$_date_naissance.'.jpg',500000);
	}
?>
<table width="1200" border="0">
  <tr>
    <td colspan="12"><?php include('menu.html'); ?></td>
  </tr>
  <tr>
	<td colspan="12" class="Style7">Fiche Participant  <? if ($_SESSION['liste_corbeille']=="oui") echo "à la Corbeille";?></td>
  <tr>
    <td width="350"><?php
	# *****************  AFFICHAGE de la liste déroulante pour les noms et prénoms
	if ($_SESSION['liste_corbeille']=="oui") $_SESSION['Where_corbeille']=' and corbeille="oui" ';
	else $_SESSION['Where_corbeille']=' and corbeille<>"oui" ';
	include('../include/base/connexion_serveur.php');
	echo '<form method="GET" action="secretariat_fiche.php" >';
	echo '<select name="Selection" id="menuadherents" onChange="submit();">';
	$resultat=log_mysql_query("SELECT `nom_usage`,`prenom`,`index` FROM `fiche`".$_SESSION['where_simple'].$_SESSION['Where_corbeille']." order by `nom_usage`,`prenom` ",$mysql) or die ("Requête non executée.");
	//Génération de la liste déroulante avec nom et prénom
	// le caractère + est utilisé pour faire la limite entre nom et prénom
	echo '<option value="" selected="selected" > </option>;';	
	while ($ligne=mysql_fetch_array($resultat))
	{
	$ligne=stripslashes_deep($ligne);
	echo '<option value ="'.$ligne["index"].'">'.$ligne["nom_usage"]." + ".$ligne["prenom"].'</option>';
	}
	echo '</select>';
	echo '</form>'; ?>	</td>
    <td width="80"><?php 
	# *****************  AFFICHAGE de la liste déroulante pour les numéros
	echo '<form method="GET" action="secretariat_fiche.php" >';
	$index=$Selection; 
	echo '<select name="Selection" id="menu_index" onChange="submit();">';
	$resultat_index=log_mysql_query("SELECT `index` FROM `fiche` ".$_SESSION['where_simple'].$_SESSION['Where_corbeille']." order by `index`",$mysql) or die ("Requête non executée.");
	//Génération de la liste déroulante avec nom et prénom
	// le caractère + est utilisé pour faire la limite entre nom et prénom
	echo '<option value="" selected="selected" > </option>;';	
	while ($ligne_index=mysql_fetch_array($resultat_index))
	{
		$ligne=stripslashes_deep($ligne);
		echo '<option>'.$ligne_index["index"].'</option>';
	}
	echo '</select>';
	echo '</form>'; 
	//Les lignes suivantes affichent le détail d'un adhérent
	// si l'utilisateur en a choisi un

	$resultat = log_mysql_query("Select * from `fiche` where `index`='".$index."'",$mysql) or die ("Requête non executée.");
	$tab = mysql_fetch_array($resultat);
	$tab=stripslashes_deep($tab);
	$type=$tab['type'];
	$result=log_mysql_query("SELECT * FROM `inscription` where index_inscription='".$tab['fiche_numero_inscription']. "'",$mysql) or die ("Requête non executée.");
	$inscription=mysql_fetch_array($result);
	$inscription=stripslashes_deep($inscription);

	?>	</td>
    <td width="160">
        <form  name="formSaisie" method="post" action="secretariat_fiche.php?Selection=<?php echo $inscription['index_inscription']; ?>&go=Afficher&action=liste_corbeille" onClick="submit();">
        <input id="liste_corbeille" name="liste_corbeille" value="oui" <?php if ($_SESSION['liste_corbeille']=="oui") echo "checked=\"checked\"";?> type="checkbox"> Fiches à la corbeille
		</form>
    </td> 

	<td> <form  name="formSaisie" method="post" action="secretariat_fiche.php?Selection= <?php echo $tab['index']; ?> &go=Afficher&action=sauvegarder" enctype="multipart/form-data" ></td>
	<td width="28" <?php if ($tab['corbeille']=="oui") echo 'bgcolor="#000000"';elseif ($tab['documents_signe']!=0) echo 'bgcolor="#33CC00"'; else echo 'bgcolor="#FFCC00"'?>><div align="center"><span class="Style7">D</span> </div></td>
    <td width="28" <?php if ($tab['corbeille']=="oui") echo 'bgcolor="#000000"';elseif ($inscription['regle']!=0) echo 'bgcolor="#33CC00"'; else echo 'bgcolor="#FFCC00"'?> ><div align="center"><span class="Style7">R</span></div></td>
    <td width="28" <?php if ($tab['corbeille']=="oui") echo 'bgcolor="#000000"';elseif ($tab['present_au_pele']!=0) echo 'bgcolor="#33CC00"'; else echo 'bgcolor="#FFCC00"'?>><div align="center"><span class="Style7">P</span></div></td>
    <td width="197"> <input id="button3" name="button" type="submit"  value=" Validation "> </td>
    <td><div align="right">
    <? if($tab['corbeille']=="oui") echo "<INPUT TYPE='Button' onClick='confirmation_restauration(".$tab['index'].");' VALUE='Restaurer'>"; ?></div> </td>
    <td width="61">
    <? if($tab['corbeille']=="oui") echo "<INPUT TYPE='Button' onClick='confirmation_supprimer_definitivement(".$tab['index'].");' VALUE='Supprimer'>";
		else echo "<INPUT TYPE='Button' onClick='confirmation_corbeille(".$tab['index'].");' VALUE='Corbeille'>"; ?>
    </td>
  
</table>
<table width="1200" border="0">
  <tr valign="top">
    <td colspan="3" class="Style14">	
	<?php 
		Echo "Historique : ";
		$req_liste1= "  select `index`, `annee`, `type`  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE `nom_usage`='".
						$tab['nom_usage']."' and `prenom`='".$tab['prenom']."' and `date_naissance`='".$tab['date_naissance']."' and fiche.corbeille <>'oui'; ";
		$res_liste1= log_mysql_query($req_liste1 , $mysql);
		while ($tabres1 = mysql_fetch_array ($res_liste1))
			{   
				switch ($tabres1['type']) {
				case "collegien":
					$couleur="#FFFFFF";break;
				case "staff":
					$couleur="#E7D63F";break;
				case "animateur":
					$couleur="#195DB0";break;
				case "ttv":
					$couleur="#92131E";break;
				case "abs":
					$couleur="#076A58";break;
				case "ggg":
					$couleur="#000000";break;
				case "ogm":
					$couleur="#EF6703";break;
				}
				echo '<p style=" background : '.$couleur.' ; display : inline ;">'.
					 '<a href="secretariat_fiche.php?Selection='.$tabres1['index'].'&go=Afficher" ';
                                if ($tabres1['type']<>"collegien") echo 'style="color:#FFFFFF;"';
				echo '>-'.$tabres1['annee'].'-</a>'.'</p>';
			}

	?></td>
  </tr>
</table>

<table width="1250" border="0" bgcolor=
		<?php 
			//Change la couleur de l'arrière plan en fonction du type de fiche
			switch ($type) {
			case "ttv":
				echo '"#8B1315">';
				break;
			case "abs":
				echo '"#00936F">';
				break;
			case "staff":
				echo '"#F4EE40">';
				break;
			case "animateur":
				echo '"#1871D7">';
				break;
			case "collegien":
				echo '"#FDFDFD">';
				break;
			case "ogm":
				echo '"#EF6A01">';
				break;
			case "ggg":
				echo '"#2D2D2D">';
				break;
			default:
				echo '"#EFB554">';
				break;
		}?>
  <tr valign="top">
    <td width="411">	<?php 
 	include('include/secr_document.php'); 
 	include('include/secr_bandeau_inscription.php'); 
 	include('include/secr_observation.php'); 
 	if ($tab['prenom_autre']<>"" or $tab['nom_autre']<>"") include('include/secr_autre.php'); 
	?></td>
	    <td width="411">	<?php 
 	include('include/secr_contact.php'); 
	?></td>
		    <td width="411">	<?php 
 	include('include/secr_presence.php'); 
 	include('include/secr_responsable.php'); 
	?></td>
	</tr>
</table>

</form>