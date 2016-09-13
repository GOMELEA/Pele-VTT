<?php
      session_start(); 
	  if ($_SESSION['index_route']=="") header("Location: http://www.pele-vtt.fr/inscriptions/Secretariat/index.php\n\n"); 
	  $Selection = $_GET["Selection"];
	  $go = $_GET["go"];
	  $index = $_GET["index"];
	  $action = $_GET["action"];
	  include('include/fonction_php.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
.Style7 {font-family: Arial, Helvetica, sans-serif; font-size: 24px; font-weight: bold; }
.Style12 {
	font-family: Verdana;
	font-size: 10px;
	position: relative;
	color: #333333;
	background-color: #EEEEEE;
}
.Style11 {
	font-family: Verdana;
	font-size: 18px;
	position: relative;
	color: #967236;
	font-weight: bold;
}
.Style14 {font-size: 16px}
-->
</style>
<body>
<SCRIPT LANGUAGE="JavaScript">
function confirmation(index) 
{
var msg = "Êtes-vous sur de vouloir supprimer cette route ?";
if (confirm(msg))
location.replace('config_route.php?index='+index+'&action=supprimer');
}
function nouveau() 
{
location.replace('config_route.php?&action=nouveau');
}
</SCRIPT>
<?php 
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Crée une nouvelle ROUTE
	
	if ($action=="nouveau" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat") or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		include('../include/base/connexion_serveur.php');
		include('include/base/nouvelle_route.php');
		$Selection="";
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     SUPPRIME LA ROUTE
	if ($action=="supprimer" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_POST['n_departement']) or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		include('../include/base/connexion_serveur.php');
		include('include/base/supprimer_route.php');
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     MODIFIE LA ROUTE
	elseif ($action=="sauvegarder" and (($index=='0' ) or $index<>'0' )and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_POST['n_departement']) or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		include('include/base/copie_variable_post_route.php');
		include('../include/base/connexion_serveur.php');
		include('include/base/update_route.php');
		// Recharge les paramètres de la route actuelle
		$route=$_SESSION['index_route'];
		include('../include/base/charge_variable_route.php'); 

		
		# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Sauvegarde des fichiers uploadé par l'utilisateur
		
		sauvegarde('logo_departement','.jpg','../Photo/'.$_departement.'.jpg',50000);
		error_reporting(0);
		mkdir ("../data/".formatage_repertoire($_departement),0777);
		chmod("../data/".formatage_repertoire($_departement), 0777);
		mkdir ("../data/".formatage_repertoire($_departement)."/".$_annee,0777);
		chmod("../data/".formatage_repertoire($_departement)."/".$_annee, 0777);
		error_reporting(1);
		sauvegarde('signature_ogm','.jpg','../data/'.formatage_repertoire($_departement).'/'.$_annee.'/signature_ogm.jpg',200000);
		sauvegarde('charte_pelerin','.pdf','../data/'.formatage_repertoire($_departement).'/'.$_annee.'/charte_du_pelerin.pdf',200000);
		sauvegarde('fiche_sanitaire','.pdf','../data/'.formatage_repertoire($_departement).'/'.$_annee.'/fiche_sanitaire.pdf',100000);
		sauvegarde('collegien','.pdf','../data/'.formatage_repertoire($_departement).'/'.$_annee.'/Information_collegien.pdf',1000000);
		sauvegarde('staff','.pdf','../data/'.formatage_repertoire($_departement).'/'.$_annee.'/Information_staff.pdf',1000000);
		sauvegarde('animateur','.pdf','../data/'.formatage_repertoire($_departement).'/'.$_annee.'/Information_animateur.pdf',1000000);
		sauvegarde('abs','.pdf','../data/'.formatage_repertoire($_departement).'/'.$_annee.'/Information_abs.pdf',1000000);
		sauvegarde('ttv','.pdf','../data/'.formatage_repertoire($_departement).'/'.$_annee.'/Information_ttv.pdf',1000000);
		sauvegarde('velo','.pdf','../data/'.formatage_repertoire($_departement).'/'.$_annee.'/Fiche_sanitaire_Velo.pdf',1000000);
	}
?>
<table width="1200" border="0">
  <tr>
    <td colspan="12"><?php include('menu.html'); ?></td>
  </tr>
  <tr>
	<td colspan="12" class="Style7">Configuration de la Route </td>
  <tr>
    <td width="350"><?php
	# *****************  AFFICHAGE de la liste déroulante pour les noms et prénoms
	include('../include/base/connexion_serveur.php');
	echo '<form method="GET" action="config_route.php" >';
	$pos=strpos($Selection, "+"); 
	if ($pos>0)
		{
		$annee_route=substr($Selection,0, $pos-1); 
		$departement_route=mysql_real_escape_string(substr($Selection, $pos+2)); 
		}
	else
		{
		$annee_route=""; 
		$departement_route=""; 
		}
	echo '<select name="Selection" id="menuadherents" onChange="submit();">';
	$resultat=log_mysql_query("SELECT `annee`,`departement` FROM `route` order by `annee` DESC,`departement` ",$mysql) or die ("Requête non executée.");
	//Génération de la liste déroulante avec departement et année
	// le caractère + est utilisé pour faire la limite entre année et departement
	echo '<option value="'.$annee_route.' + '.$departement_route.'" selected="selected" >'.$annee_route.' + '.$departement_route.'</option>;';	
	while ($ligne=mysql_fetch_array($resultat))
	{
		$ligne=stripslashes_deep($ligne);
		echo '<option>'.$ligne["annee"]." + ".$ligne["departement"].'</option>';
	}
	echo '</select>';
	echo '</form>'; ?>	</td>
    <td width="220"> <?php 

	// **************** Les lignes suivantes affichent le détail d'un adhérent
	// **************** si l'utilisateur en a choisi un

	if ($pos>0 or $action=='nouveau') $resultat = log_mysql_query("Select * from `route` where annee='".$annee_route."' and departement='".$departement_route."'",$mysql) or die ("Requête non executée.");
	if ($pos<=0 and $action<>'nouveau') $resultat = log_mysql_query("Select * from `route` where `index_route`='".$Selection."'",$mysql) or die ("Requête non executée.");
	$tab = mysql_fetch_array($resultat);
	$tab=stripslashes_deep($tab);
	?>	</td>
	<td> <form  name="formSaisie" method="post" action="config_route.php?Selection= <?php echo $tab['index_route'].$_index_nouvelle_route; ?> &go=Afficher&action=sauvegarder" enctype="multipart/form-data"></td>
    <td width="103"><div align="left"><INPUT TYPE='Button' onClick='nouveau();'  VALUE='Nouveau'></div></td>
    <td width="197"> <div align="center"><input id="button3" name="button" type="submit"  value=" Validation "></div> </td>
    <td></td>
    <td width="61"><div align="right"><INPUT TYPE='Button' onClick='confirmation(<?php echo $tab['index_route']; ?>);' VALUE='Supprimer'></div></td>
 
</table>
  	<table border="0" class="Style12" >
		<tr align="left">
		  <td colspan="4" class="Style11" ><div align="center">Donn&eacute;es du Camp </div></td>
	      <td colspan="2" valign="top" rowspan="2" bgcolor="#FFFFCC" class="Style11" ><?php include('config_admin.php'); ?></td>
	  </tr>
		<tr align="left">
          <td colspan="2" valign="top" bgcolor="#FFCCFF" class="Style11" ><?php include('config_date.php'); ?></td>
	      <td colspan="2" valign="top" class="Style11" ><?php include('config_lieux.php'); ?></td>
      </tr>
  </table>
  <?php include('config_presence.php'); ?>
  <?php include('config_fichier.php'); ?>
</form>