<?php 
# <!-- Page d'information sur la route sélectionnée -->
session_start(); 
$route = $_GET["route"];
include('Secretariat/include/fonction_php.php');
include('Secretariat/include/log_url.php');     
if ($route=="") include('include/test_session_ok.php'); // ** Test si la Session a déjà été tué  *************

// ************************************************* Test si une inscription est en cours  ****************************************************************
if ($_SESSION['inscription_en_cours']=="oui")  
{
   echo "Désolé, mais une inscription est en cours sur cet ordinateur. <BR><BR>" ;
   echo "Vous pouvez,<BR>" ;
   echo "Soit :<BR>" ;
   echo '<a href="inscriptions/valid_inscription.php">    Continuer votre inscription en cours</a><br>' ;
   echo "Soit :<BR>" ;
   echo '<a href="inscriptions/include/base/arret_session.php">    Forcer une nouvelle inscription</a><br>' ;
  die('');
}

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <LINK rel=stylesheet type="text/css" href="../total.css">
</head>

<body>
<!-- Table utilisée pour la mise en page générale -->
<table width="1010" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
	<td colspan="5" class="titre1_marron" align="center">
		<!-- Chargement de tous les paramètres de la route sélectionnée dans des variables $_SESSION et affichage du bandeau -->
		<?php 
			if ($_SESSION['index_route']<>$route and $route<>'') include('include/base/charge_variable_route.php'); 
			if (strtotime($_SESSION['jour_fin_camp'])<time()) include('include/base/arret_session.php');  ?> <!-- Dans le cas ou par l'url on s'incrive à des camps des années passées -->
      	<p ><img src="Photo/bandeau_vide.jpg" ></p>
		<p>Bienvenue sur la route du <? echo $_SESSION['n_departement'];?> - <? echo $_SESSION['departement'];?><br>	
	    Voici quelques infos sur la route de cette ann&eacute;e</p>
	</td>
  </tr>
  <tr>
    <td colspan="5" class="titre2_marron"><br>
      Parcours : 
    </td>
  </tr>
  <tr class="titre3_noir">
    <td width="33" ></td>
    <td colspan="4" ><p>Cette ann&eacute;e, le parcours partira de <? echo $_SESSION['lieu_depart'];?> et arrivera &agrave; <? echo $_SESSION['lieu_arrive'];?> .<br>
      Les lieux des campements seront :<br>
      - <?php echo $_SESSION['couchage_j3'] ?><br>
      - <?php echo $_SESSION['couchage_j4'] ?><br>
      - <?php echo $_SESSION['couchage_j5'] ?><br>
      - <?php echo $_SESSION['couchage_j6'] ?>
    </p></td>
  </tr>
  <tr>
    <td colspan="5" class="titre2_marron"><br>
    Dates : </td>
  </tr>
  <tr class="titre3_noir">
    <td ></td>
    <td colspan="4" >Le camp pour les coll&eacute;giens aura lieu du <?php echo convdate_litteral($_SESSION['jour_debut_camp']) ?> au <?php echo convdate_litteral($_SESSION['jour_fin_camp']) ?> .<br>
      Le pr&eacute;camp, pour les lycéens, animateurs, ttv et abs, commencera d&egrave;s le <?php echo convdate_litteral($_SESSION['jour_debut_precamp']) ?> &agrave; <?php echo $_SESSION['couchage_j1'] ?>.</td>
  </tr>
  <tr>
    <td colspan="5" class="titre2_marron"><p><br>
    Tarifs : </p></td>
  </tr>
  <tr class="titre3_noir">
    <td ></td>
    <td colspan="4" ><p>- Coll&eacute;giens et Staff :</p></td>
  </tr>
  <tr class="titre3_noir">
    <td ></td>
    <td width="32" ><p>&nbsp;</p></td>
    <td colspan="3" >- 1 Enfant : <? echo $_SESSION['tarif_1enf'];?> &euro;<br>
      - 2 Enfants de la m&ecirc;me famille : <? echo $_SESSION['tarif_2enf'];?> &euro;<br>
      - 3 Enfants de la m&ecirc;me famille : <? echo $_SESSION['tarif_3enf'];?> &euro;<br>
      - Enfant suppl&eacute;mentaire de la m&ecirc;me famille : <? echo $_SESSION['tarif_enf_sup'];?> &euro;</td>
  </tr>
  <tr class="titre3_noir">
    <td ></td>
    <td colspan="4" ><p>- Animateurs : <? echo $_SESSION['tarif_anim'];?> &euro;<br>
      - ABS : <? echo $_SESSION['tarif_abs'];?> &euro;<br>
      - TTV : <? echo $_SESSION['tarif_ttv'];?> &euro;
    </p></td>
  </tr>
  <tr>
    <td colspan="5" class="titre2_marron"><br>
    Inscriptions : </td>
  </tr>
  <tr class="titre3_noir">
    <td ></td>
    <td colspan="4" ><p>- Une fois votre inscription termin&eacute;e, vous recevrez un courriel automatique de <? echo $_SESSION['courriel_expediteur'];?>, vous envoyant les documents &agrave; remplir.</p></td>
  </tr>
  <tr>
    <td colspan="5" class="titre2_marron"><br>
    Infos Diverses : </td>
  </tr>
  <tr class="titre3_noir">
    <td ></td>
    <td colspan="4" >
		<?php 
			if ($_SESSION['url_site']<>"") echo '- <a href="'.$_SESSION['url_site'].'">Site Web</a><br>';
			if ($_SESSION['url_facebook']<>"") echo '- <a href="'.$_SESSION['url_facebook'].'">Page Facebook</a><br>';
			if ($_SESSION['url_twitter']<>"") echo '- <a href="'.$_SESSION['url_twitter'].'">Compte Twitter</a><br>';
			if ($_SESSION['accueil_info_diverses']<>"") echo '- '.$_SESSION['accueil_info_diverses'].' ';
		?>
     </td>
  </tr>
  <tr class="titre3_noir">
    <td ></td>
    <td colspan="4" >&nbsp;</td>
  </tr>
  <tr class="titre3_noir">
    <td ></td>
    <td >&nbsp;</td>
    <td width="511" ></td>
	<td width="319" valign="middle" bgcolor="#EFB554" align="center" class="titre2_noir" ><strong>Commencez<br>
votre inscription</strong></td>
    <td width="93" ><a href="inscription_pelevtt.php"><img src="Photo/fleche.gif" alt="" width="75" height="75" border="0"></a></td>
  </tr>
  <tr class="titre3_noir">
    <td height="64" colspan="5" ><br></td>
  </tr>
</table>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>	
</body>
</html>
