<?php
      session_start(); 
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
body {
	background-image: url(../Photo/choisir-route.jpg); background-repeat:no-repeat; 
background-position: center center;
}
-->
</style>
<body>
<table width="908" border="0" align="center"><tr>
    <td width="450" height="309"> <span class="Style7">Choisissez votre Route</span>      <?php
	# *****************  AFFICHAGE de la liste déroulante pour les noms et prénoms
	include('../include/base/connexion_serveur.php');
	echo '<form method="GET" action="synthese.php" >';
	echo '<select name="Selection" id="route" onChange="submit();">';
	# *****************  Si c'est un gg qui se connecte on se limite à son département
	$req_gg="";
	if (substr($_SERVER["REMOTE_USER"],0,9)=="ggpelevtt") $req_gg=' WHERE n_departement="'.substr($_SERVER["REMOTE_USER"],9,4).'" ';
	$requette="SELECT `annee`,`departement` FROM `route` ".$req_gg." order by `annee` DESC,`departement` ";
	$resultat=log_mysql_query($requette,$mysql) or die ("Requête non executée.");
	//Génération de la liste déroulante avec departement et année
	// le caractère + est utilisé pour faire la limite entre année et departement
	echo '<option value="'.$_SESSION['annee'].' + '.addslashes($_SESSION['departement']).'" selected="selected" >'.$_SESSION['annee'].' + '.$_SESSION['departement'].'</option>';	
	while ($ligne=mysql_fetch_array($resultat))
	{
		$ligne=stripslashes_deep($ligne);
		echo '<option value="'.$ligne["annee"].' + '.addslashes($ligne["departement"]).'" >'.$ligne["annee"].' + '.$ligne["departement"].'</option>';
	}
	echo '</select>';
	echo '</form>'; ?>	</td>
    <td width="450"><img src="../Photo/vide713-451.gif" width="455" height="312" border="0" usemap="#Map"></td>
  <tr>
    <td colspan="2"><div align="right">
      <p class="Style7">Les donn&eacute;es de  cette base<br>
          sont STRICTEMENT r&eacute;serv&eacute;es<br>
          au P&eacute;l&eacute; VTT </p>
      <p class="Style7">&nbsp;</p>
      <p class="Style7">&nbsp;</p>
    </div></td>
</table>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<map name="Map">
  <area shape="poly" coords="312,92,433,103,440,310,311,273" href="liste_gg.php" target="_top">
</map>
</body>
