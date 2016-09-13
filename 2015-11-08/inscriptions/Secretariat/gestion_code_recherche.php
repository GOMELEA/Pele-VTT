<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
      session_start(); 
	  include('include/fonction_php.php');
	$faire = $_GET["faire"];
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
<SCRIPT LANGUAGE="JavaScript">
function confirmation() 
{
var msg = "Êtes-vous sur de vouloir envoyer à toutes les personnes ayant fait une inscription, les codes de fiches ?";
if (confirm(msg))
location.replace('gestion_code_recherche.php?faire=envoie_courriel');
}
function confirmation_test() 
{
var msg = "Êtes-vous sur de vouloir envoyer aux secrétaires de l'année dernière, les codes de fiches ?";
if (confirm(msg))
location.replace('gestion_code_recherche.php?faire=test_courriel');
}

</SCRIPT>
<?php
include('../include/base/connexion_serveur.php');
// Recherche l'index de la route de l'année dernière
$req= " SELECT index_route from route WHERE annee='".($_SESSION['annee']-1)."' and n_departement='".$_SESSION['n_departement']."'" ;
$res1=mysql_fetch_array (log_mysql_query($req , $mysql));
$_SESSION['and_annee_precedente']=" and `route_index`='".$res1['index_route']."' ";
$_SESSION['where_annee_precedente']=" where `route_index`='".$res1['index_route']."' and corbeille <>'oui' ";


if ($faire=="sauvegarder")
{
	$_SESSION['debut_courriel_code_recherche']= stripslashes($_POST['debut_courriel_code_recherche']);
	$_SESSION['fin_courriel_code_recherche']=stripslashes($_POST['fin_courriel_code_recherche']);
}
if ($faire=="test_courriel")
{
	include('include/generer_code_recherche.php');
    require('../class.phpmailer.php');
	// On recherche les personnes inscrites au secrétariat l'année dernière
    $req_liste= " SELECT DISTINCT titre_inscription,nom_inscription, prenom_inscription,courriel_inscription from inscription INNER JOIN fiche".
				" ON fiche.fiche_numero_inscription = inscription.index_inscription ".
                "WHERE secretariat='1' and inscription.route_index='".$res1['index_route']."'" ;
	$res_liste= log_mysql_query($req_liste , $mysql);
	include('include/envoie_courriel_code_recherche.php');
}
if ($faire=="envoie_courriel")
{
	include('include/generer_code_recherche.php');
	// On va chercher la définition de la classe
    require('../class.phpmailer.php');
	$req_liste= "  SELECT DISTINCT titre_inscription,nom_inscription, prenom_inscription,courriel_inscription from inscription ".$_SESSION['where_annee_precedente']."" ;
	echo ($req_liste);
	$res_liste= log_mysql_query($req_liste , $mysql);
	include('include/envoie_courriel_code_recherche.php');
}
?>
<table width="990" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td colspan="2">
	<p align="center"><?php include('menu.html'); ?><br></p>	</td>
  </tr>
  <tr>
    <td colspan="2">
  	<p align="center" class="Style11">Envoi des Codes pour permettre de r&eacute;utiliser les fiches de l'ann&eacute;e <? echo $_SESSION['annee']-1; ?></p>
    </td>
   </tr>
  <form method="POST" action="gestion_code_recherche.php?faire=sauvegarder" >
  <tr>
    <td colspan="2">
  	  <p>Ce syst&egrave;me permet de simplifier l'inscription des personnes pour le p&eacute;l&eacute; <? echo $_SESSION['annee']; ?> lorsqu'ils ont 
      	participé au p&eacute;l&eacute; <? echo $_SESSION['annee']-1; ?>, en leur permettant de r&eacute;utiliser les informations saisies 
        en <? echo $_SESSION['annee']-1; ?>. Pour ce faire, le syt&egrave;me va:<br>
  	    * Calculer un code confidentiel (sauf si ce code a d&eacute;j&agrave; &eacute;t&eacute; calcul&eacute;) pour les inscrits de la route <? echo $_SESSION['annee']-1; ?><br>
  	    * Envoyer &agrave; chaque personne ayant fait une inscription en <? echo $_SESSION['annee']-1; ?>, un code confidentiel pour chaque personne inscrite<br>
  	    </p>
  	  <p>Vous pouvez personnaliser le texte du courriel et envoyer un courriel de test (la fiche des secr&eacute;taires de <? echo $_SESSION['annee']-1; ?> leur sera envoy&eacute;e avec une copie au courriel de copie)
  	    avant d'envoyer le courriel &agrave; toutes les personnes ayant fait une inscription en <? echo $_SESSION['annee']-1; ?>.<br>
      </p></td>
  </tr>
  <tr>
    <td colspan="2">D&eacute;but du courriel <br>
       <TEXTAREA rows=6 cols=110 id="debut_courriel_code_recherche" name="debut_courriel_code_recherche" onBlur="submit();"><?php echo $_SESSION['debut_courriel_code_recherche'];?> </TEXTAREA>
   </td>
  </tr>
  <tr>
    <td colspan="2">Fin du courriel <br>

       <TEXTAREA rows=6 cols=110 id="fin_courriel_code_recherche" name="fin_courriel_code_recherche" onBlur="submit();"><?php echo $_SESSION['fin_courriel_code_recherche'];?> </TEXTAREA>
  </td>
  </tr>
  </form>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <button type="button" onClick="confirmation_test()"> Envoyer un courriel de test au Secrétariat </button>
    </td>
    <td>
      <button type="button" onClick="confirmation()">Envoyer les codes à toutes les personnes ayant fait une inscription en <? echo $_SESSION['annee']-1; ?></button>
    </td>
  </tr>

</table>




</body>
</html>
