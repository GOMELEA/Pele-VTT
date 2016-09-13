<?php
	session_start(); 
	$faire = $_GET["faire"];
	$index_photo = $_GET["index_photo"];
	include('include/fonction_php.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <LINK rel=stylesheet type="text/css" href="../../total.css">
</head>
<body>

<SCRIPT LANGUAGE="JavaScript">
function confirmation(index_photo) 
{
var msg = "Êtes-vous sur de vouloir supprimer cette photo ?";
if (confirm(msg))
location.replace('carnet_priere.php?index_photo='+index_photo+'&faire=supprimer');
}
</SCRIPT>

<body>
<?php 
	include('../include/base/connexion_serveur.php');

	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     SUPPRIME LA PHOTO
	if ($faire=="supprimer" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement']) or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{	
		include('include/base/supprime_carnet_priere.php');
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     MODIFIE LA PHOTO
	elseif ($faire=="modifier" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement']) or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{
		include('include/base/charge_carnet_priere.php');
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     CREE LA PHOTO
	elseif ($faire=="sauver" and $_POST['texte_priere'] <>"" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement']) or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{
		include('include/base/sauve_carnet_priere.php');
		error_reporting(0);
		mkdir ('../data/_CARNET_PRIERES_'.$_SESSION['annee'],0777);
		chmod('../data/_CARNET_PRIERES_'.$_SESSION['annee'], 0777);
		error_reporting(1);
		sauvegarde_photo_carnet('photo_carnet','.jpg','../data/_CARNET_PRIERES_'.$_SESSION['annee'].'/Photo_'.formatage_repertoire($_SESSION['departement']).'_'.$index_photo.'.jpg');
	}
?>
<table width="1200" border="0" align="center" bgcolor="#FFFFFF" >
    <tr>
        <td> <p align="center"><?php include('menu.html'); ?></p> </td>
    </tr>
	<tr>
        <td> <p align="center" class="titre2_marron"> Carnet de Prières </p><br></td>
    </tr>
	<tr>
        <td> <p align="Left" class="titre2_marron"> Infos Générales (saisies dans Configuration Route) </p></td>
    </tr>
</table>
<table width="1200" border="0" align="center" bgcolor="#eeeeee" class="titre3_anthracite_sans_fond" >
	<?php
		$resultat = log_mysql_query("Select * from `route` where annee='".$_SESSION['annee']."' and n_departement='".$_SESSION['n_departement']."'",$mysql) or die ("Requête non executée.");
		$tab = mysql_fetch_array($resultat);
		$tab=stripslashes_deep($tab);
	?>
	<tr align="left">
		<td align="right" bgcolor="#FFCCFF">Début Pre-camp</td>
		<td bgcolor="#FFCCFF"><input id="jour_debut_precamp" name="jour_debut_precamp" size="16" maxlength="19" type="text" value="<?php echo $tab['jour_debut_precamp'];?>" readonly></td>
		<td align="right" bgcolor="#CCFFFF">1ere Nuit (Pré-camp)</td>
		<td bgcolor="#CCFFFF"><input id="couchage_j1" name="couchage_j1" size="40" maxlength="40" type="text" value="<?php echo $tab['couchage_j1'];?>" readonly></td>
		<td align="center" bgcolor="#CCFFFF">Intention de Prières</td>
	</tr>
	<tr align="left">
		<td align="right" bgcolor="#FFCCFF" >Fin camp</td>
		<td bgcolor="#FFCCFF" class="Style14"><input id="jour_fin_camp" name="jour_fin_camp" size="16" maxlength="19" type="text" value="<?php echo $tab['jour_fin_camp'];?>" readonly></td>
		<td align="right" bgcolor="#CCFFFF">2&egrave;me Nuit</td>
		<td bgcolor="#CCFFFF"><input id="couchage_j2" name="couchage_j2" size="40" maxlength="40" type="text" value="<?php echo $tab['couchage_j2'];?>" readonly></td>
		<td rowspan="6"><TEXTAREA rows=10 cols=40 id="intention_priere" name="intention_priere"><?php echo ereg_replace('<br>','',$tab['intention_priere']);?> </TEXTAREA></td>
	</tr>
	<tr align="left">
		<td align="right">Max Collégien </td>
		<td><input id="max_collegien" name="max_collegien" size="3" maxlength="3" type="text" value="<?php echo $tab['max_collegien'];?>" readonly></td>
		<td align="right" bgcolor="#CCFFFF">3&egrave;me Nuit</td>
		<td bgcolor="#CCFFFF"><input id="couchage_j3" name="couchage_j3" size="40" maxlength="40" type="text" value="<?php echo $tab['couchage_j3'];?>" readonly></td>
	</tr>
	<tr align="left">
		<td align="right">Max Collégienne </td>
		<td><input id="max_collegienne" name="max_collegienne" size="3" maxlength="3" type="text" value="<?php echo $tab['max_collegienne'];?>" readonly></td>
		<td align="right" bgcolor="#CCFFFF">4&egrave;me Nuit</td>
		<td bgcolor="#CCFFFF"><input id="couchage_j4" name="couchage_j4" size="40" maxlength="40" type="text" value="<?php echo $tab['couchage_j4'];?>" readonly></td>
	</tr>
	<tr align="left">
		<td align="right">Max Staff </td>
		<td><input id="max_staff" name="max_staff" size="2" maxlength="2" type="text" value="<?php echo $tab['max_staff'];?>" readonly></td>
		<td align="right" bgcolor="#CCFFFF">4&egrave;me Nuit</td>
		<td bgcolor="#CCFFFF"><input id="couchage_j4" name="couchage_j4" size="40" maxlength="40" type="text" value="<?php echo $tab['couchage_j4'];?>" readonly></td>
	</tr>
	<tr align="left">
		<td align="right" bgcolor="#CCFFFF">Lieu de D&eacute;part </td>
		<td bgcolor="#CCFFFF"><input id="lieu_depart" name="lieu_depart" size="40" maxlength="40" type="text" value="<?php echo $tab['lieu_depart'];?>" readonly></td>
		<td align="right" bgcolor="#CCFFFF">5&egrave;me Nuit</td>
		<td bgcolor="#CCFFFF"><input id="couchage_j5" name="couchage_j5" size="40" maxlength="40" type="text" value="<?php echo $tab['couchage_j5'];?>" readonly></td>
	</tr>
	<tr align="left">
		<td align="right" bgcolor="#CCFFFF">Lieu d'Arriv&eacute;e </td>
		<td bgcolor="#CCFFFF"><input id="lieu_arrive" name="lieu_arrive" size="40" maxlength="40" type="text" value="<?php echo $tab['lieu_arrive'];?>" readonly></td>
		<td align="right" bgcolor="#CCFFFF">6&egrave;me Nuit</td>
		<td bgcolor="#CCFFFF"><input id="couchage_j6" name="couchage_j6" size="40" maxlength="40" type="text" value="<?php echo $tab['couchage_j6'];?>" readonly></td>
	</tr>
</table>

<table width="1200" border="0" align="center" bgcolor="#FFFFFF" >
    <tr>
        <td> <p align="left" class="titre2_marron"> Saisie des Photos : </p></td>
    </tr>
	<form  name="formSaisie" method="post" action="carnet_priere.php?faire=sauver&<? echo 'index_photo='.$tab1['index_photo']; ?>" onSubmit="return control_equipe()" enctype="multipart/form-data" >
	<tr>
		<td>
			<table border="1">
				<tr align="center" valign="middle">
					<td width="205">Photo</td>
					<td width="154">Texte spirituel pour accompagner la photo <BR>(max 200 caractères)<br /></td>
					<td >Référence du texte <BR>(max 25 caractères)</td>
					<td rowspan="2"><input id="button3" name="button" type="submit"  value=" Validation "></td>
				</tr>
				<tr align="center" valign="middle">
					<td>
						<?php
							if (file_exists('../data/_CARNET_PRIERES_'.$_SESSION['annee'].'/Photo_'.formatage_repertoire($_SESSION['departement']).'_'.$tab1['index_photo'].'.jpg'))
								{
									echo ' <img src="../data/_CARNET_PRIERES_'.$_SESSION['annee'].'/Photo_'.formatage_repertoire($_SESSION['departement']).'_'.$tab1['index_photo'].'.jpg" height="150" >';
								}
							else
								{
									echo ' Charger la photo prise en mode portrait
									<img src="../Photo/portrait-paysage.jpg" height="150"> 
									(taille au moins 2Mo)';
								} 
						?>
						<input type = "file" name = "photo_carnet" size="15"><input type = "hidden" name="MAX_FILE_SIZE" value="500000">
					</td>
					<td>
						<TEXTAREA rows=10 cols=50 id="texte_priere" name="texte_priere" maxlength="200" ><?php echo $tab1['texte_priere'];?> </TEXTAREA>
					</td>
					<td>
						<input id="ref_priere" name="ref_priere" size="25" maxlength="25" type="text" value="<?php echo $tab1['ref_priere'];?>">
					</td>
				</tr>
			</table>

			<br><br>
			<p class="titre2_marron">Liste des Photos (Max 10): </p>     
			<?php
				$req_liste= "  SELECT * FROM carnet_priere WHERE route_index = '".$_SESSION['index_route']."' order by index_photo" ;
				$res_liste= log_mysql_query($req_liste , $mysql);
				echo '<table  border="1" class="titre3_anthracite_sans_fond">';
				while ($tabres = mysql_fetch_array ($res_liste))
				{	$tabres=stripslashes_deep($tabres);
					echo'
					<tr>
						<td rowspan="2">
							<img src="../data/_CARNET_PRIERES_'.$_SESSION['annee'].'/Photo_'.formatage_repertoire($_SESSION['departement']).'_'.$tabres['index_photo'].'.jpg" height="300" >
						</td>
						<td colspan="2" width="300">
							<p class="titre2_marron">'.$tabres['index_photo'].'</p>
							<p> Texte Prière :<BR> '.$tabres['texte_priere'].'</p>
							<p> Référence Prière : '.$tabres['ref_priere'].'</p>

						</td>
					</tr>
					<tr>
						<td>
							<div align="center"><img src="../Photo/corbeille.jpg"  height="60" onClick="confirmation('.$tabres['index_photo'].');"></div>
						</td>
						<td>
							<div align="center"><a href="carnet_priere.php?index_photo='.$tabres['index_photo'].'&faire=modifier"><img src="../Photo/modifier.jpg"  height="60"></a></div>
						</td>
					</tr>';
				}
				echo '</table>';
			?>     
		</td>
	</tr>
	</form>
</table>
</body>
</html>
