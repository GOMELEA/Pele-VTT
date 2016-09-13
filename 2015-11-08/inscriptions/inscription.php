<?php 
# <!-- Gere la saisie des informations propres à un participant du pélé -->

session_start(); 
$type = $_GET["type"];
$faire = $_GET["faire"];
$index = $_GET["index"];
$sans = $_GET["sans"];
$sexe = $_GET["sexe"];
include('Secretariat/include/fonction_php.php');
$_SESSION['inscription_en_cours']="oui";
include('Secretariat/include/log_url.php');     
include('include/test_session_ok.php'); // ** Test si la Session a déjà été tué  *************
if (strtotime($_SESSION['jour_fin_camp'])<time()) include('include/base/arret_session.php');  ?> <!-- Dans le cas ou par l'url on s'incrive à des camps des années passées -->

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <LINK rel=stylesheet type="text/css" href="../total.css">
</head>

<body>

<!-- Appel de javascript: 
	presence est utilisé pour cocher automatiquement des champs dans le tableau de présence
	controle_saisie vérifie si les informations saisies par l'inscrit sont OK -->
	<script	src="js/presence.js" type="text/javascript" ></script>
    <script	src="js/controle_saisie.js" type="text/javascript" ></script>
<?php
# Calcul s'il reste de la dispo pour les collégiens et staff et renvoie le résultat dans les variable logiques $_SESSION['dispo_collegien_F'],$_SESSION['dispo_collegien_H'],$_SESSION['dispo_staff']
	include('include/base/calcul_dispo.php');
?>

<!-- Table utilisée pour la mise en page générale -->
<table width="1010" border="0" align="center" >
  <tr>
    <td align="center">
        <?php
            # *****************  Change le type de bandeau en fonction du type de l'inscription
            # *****************  $type est basé par l'url
            echo '<img src="Photo/bandeau_inscription_'.$type.'.jpg"  border="1">';
            echo '<input id="type" name="type" type="hidden" value ="'.$type.'" >';
        ?>
        <br><br>
        <img src="Photo/1information.jpg" width="467" height="62">
        <br><br>
        <?php 
            # *****************  Test du code confidentiel pour place disponible 
			if ($faire==place_dispo)
			{
				include('include/base/connexion_serveur.php');
				if ($sexe<>"") $req_sexe=" and sexe_attente='".$sexe."' ";
				$resq="SELECT index_attente FROM attente WHERE type_attente='".$type."' and code_confidentiel= '".trim(mysql_real_escape_string($_POST['code_confidentiel']))."'  ".$req_sexe." ".$_SESSION['and_simple'].";";
				$res_liste= log_mysql_query($resq , $mysql);
				if (mysql_num_rows($res_liste)==0 or strlen($_POST['code_confidentiel'])<3 )
				{	$_SESSION['code_confidentiel_OK']=false;
					$_SESSION['reessayer_code']='Le Code ne fonctionne pas, merci de réessayer';
				}
				else
				{	if ($type=="staff") $_SESSION['code_confidentiel_staff_OK']=true;
					if ($type=="collegien" and $sexe=="H") $_SESSION['code_confidentiel_collegien_OK']=true;
					if ($type=="collegien" and $sexe=="F") $_SESSION['code_confidentiel_collegienne_OK']=true;
					$_SESSION['code_confidentiel_OK']=true;
					$res=mysql_fetch_array ($res_liste);
					$_SESSION['index_attente']=$res['index_attente'];
					$_SESSION['reessayer_code']='';
					$req_modif_fiche = "UPDATE   `attente`  SET code_confidentiel='en cours' WHERE `index_attente`= '".$_SESSION['index_attente']."' ;";
					$res_insertion =    log_mysql_query($req_modif_fiche  , $mysql );
				}
			}
			if (
					(($type=="collegien" and $sexe=="H") 
						and ($_SESSION['dispo_collegien_H']<1 or $_SESSION['forcage_collegien_attente']==1) 
						and $_SESSION['code_confidentiel_collegien_OK']<>"true") 
					or 
					(($type=="collegien" and $sexe=="F")
						and ($_SESSION['dispo_collegien_F']<1 or $_SESSION['forcage_collegienne_attente']==1)
						and $_SESSION['code_confidentiel_collegienne_OK']<>"true") 
					or
					($type=="staff"
						and ($_SESSION['dispo_staff']<1 or $_SESSION['forcage_staff_attente']==1)
						and $_SESSION['code_confidentiel_staff_OK']<>"true")
				)
				
			{
			# Gestion de la liste d'attente
				echo '
					<table width="960" cellspacing="0" align="center">
						<tr>
							<td  rowspan="2">'; include('include/contact_attente.php'); echo '</td>
							<td  rowspan="2"></td>
							<td  valign="top">'; include('include/desistement.php'); echo '</td>
						</tr>
						<tr>
							<td></td>
						</tr>
					</table> <br>';
			}
			Else 
			{
				# Charge les paramètres de la fiche sélectionnée par la variable $index (dans l'url) vers le tableau $tab 
				# sauf pour la première fiche, on charge toujours une fiche dont on supprime les informations personnelles - permet de ne pas ressaissir l'intégralité de la fiche
				if ($faire=="recherche") include('include/base/recherche_fiche.php');
				if ($index<>"") include('include/base/charge_fiche.php');
				if ($faire=="recherche") include('include/base/nettoye_fiche_annee_precedente.php');
				if ($index<>"" & $faire=="copier") include('include/base/nettoye_copie.php');
				include('./include/fiche_inscription.php');
			}
        ?>
	</td>
  </tr>
</table>
<div align="center"><img src="Photo/1information.jpg" width="467" height="62"></div></p>
</body>
</html>
