<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
      session_start(); 
	  $type = $_GET["type"];
	  $index = $_GET["index"];
	  $faire = $_GET["faire"];
	  $where = $_GET["where"];
	  $courriel = $_GET["courriel"];
	  include('include/fonction_php.php');
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <LINK rel=stylesheet type="text/css" href="../../total.css">
</head>
<body>

<SCRIPT LANGUAGE="JavaScript">
function confirmation(index) 
{
	var msg = "Êtes-vous sur de vouloir supprimer cet ingrédient ?";
	if (confirm(msg))
	location.replace('ingredient.php?index='+index+'&faire=supprimer');
}
</SCRIPT>

<?php
include('../include/base/connexion_serveur.php');
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     SUPPRIME LA FICHE DE SOUTIEN
if ($faire=="supprimer")
	include('include/base/supprimer_ingredient.php');
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     SAUVE LA FICHE DE SOUTIEN
elseif ($faire=="sauver")
	include('include/base/sauve_ingredient.php');
?>
<table width="1200" border="0" align="center" bgcolor="#FFFFFF" >
	<tr>
		<td>
		<p align="center"><?php include('menu.html'); ?><br></p>	
		</td>
	</tr>
	<tr class="titre1_noir">
		<td>
		<p align="center" >Liste des ingrédients</p>
		</td>
	</tr>
	<tr class="titre3_noir">
		<td>
		<p align="Left" >Ingrédients déjà dans la liste</p>
		</td>
	</tr>
	<tr> 
			<td>
			<form method="POST" action="ingredient.php" >

			<!-- ************ SELECTION ***************  -->
			<table border="0">
				<tr class="titre4_anthracite">   <!-- ************ TITRE DES FILTRES DE SELECTION ***************  -->
					<td>Texte à rechercher</td>
					<td>Classement</td>
					<td>Nom</td>
				</tr>
				<tr>                              <!-- ************ FILTRES DE SELECTION ***************  -->
					<td>
						<input id="rech_texte" name="rech_texte" size="20" type="text" value="<?php echo $_POST['rech_texte']?>" onChange="submit()"></td>
					</td>
					<td>    <!--  // ****************** FILTRE SUR LE CLASSEMENT  -->
						<select size="1" id="rech_classement" name="rech_classement" onChange="submit();" >
						<option value="<?php echo $_POST['rech_classement'];?>"  selected="selected" ><?php echo $_POST['rech_classement']; ?></option>
						<option value=""></option>
						<?				
						$resultat_index=log_mysql_query("SELECT DISTINCT `classement` FROM `ingredient`  ",$mysql) or die ("Requête non executée.");
						while ($ligne_index=mysql_fetch_array($resultat_index))
						{
						$ligne=stripslashes_deep($ligne);
						echo '<option value="'.$ligne_index["classement"].'">'.$ligne_index["classement"].'</option>';
						}
						echo '</select>';
						?> 
					</td>
					<td>    <!--  // ****************** FILTRE SUR LE NOM  -->
						<select size="1" id="rech_nom" name="rech_nom" onChange="submit();" >
						<option value="<?php echo $_POST['rech_nom'];?>"  selected="selected" ><?php echo $_POST['rech_nom']; ?></option>
						<option value=""></option>
						<?				
						$resultat_index=log_mysql_query("SELECT DISTINCT `nom` FROM `ingredient`  ",$mysql) or die ("Requête non executée.");
						while ($ligne_index=mysql_fetch_array($resultat_index))
						{
						$ligne=stripslashes_deep($ligne);
						echo '<option value="'.$ligne_index["nom"].'">'.$ligne_index["nom"].'</option>';
						}
						echo '</select>';
						?> 
					</td>
				</tr>
			</table>

			<!-- ************ AFFICHAGE DES RESULTATS ***************  -->
			<table width="1200" border="0">
				<tr class="titre4_anthracite">
					<td width="100">Classement</td>
					<td width="300">Nom</td>
					<td width="100">Unités</td>
					<td width="600">Observations</td>
				</tr>
			<?php   // ****************** CALCUL DU FILTRE POUR LA REQUETE SQL
				$_where='WHERE 1=1 ';
				if ($_POST['rech_texte']<>"") $_where=$_where.' AND (`nom` LIKE \'%'.$_POST['rech_texte'].'%\' OR classement LIKE \'%'.$_POST['rech_texte'].'%\' OR observations LIKE \'%'.$_POST['rech_texte'].'%\')';
				if ($_POST['rech_nom']<>"" ) $_where=$_where.' AND `nom`=\''.$_POST['rech_nom'].'\' ';
				if ($_POST['rech_classement']<>"") $_where=$_where.' AND classement=\''.$_POST['rech_classement'].'\' ';
				
				$req_liste= "  SELECT * FROM ingredient ".$_where."   order by classement,nom" ;
				$res_liste= log_mysql_query($req_liste , $mysql);
				while ($tabres = mysql_fetch_array ($res_liste))
				{$tabres=stripslashes_deep($tabres);
				 ?>
				<tr bordercolor="#666666" class="Style25"> <!-- ************ AFFICHAGE DES LIGNES DE RESULTATS ***************  -->
					<td><?php echo $tabres['classement']; ?>  </td>
					<td><?php echo $tabres['nom']; ?>  </td>
					<td><?php echo $tabres['unite']; ?>  </td>
					<td><?php echo $tabres['observations']; ?>  </td>
					<td><?php echo '<a href="ingredient.php?&faire=modifier&index='.$tabres['index'].'"><img src="../Photo/modifier.png" border="0" height="20" Title="Modifier"></a>    '; 
					echo '<img src="../Photo/corbeille.jpg"  height="20" Title="Supprimer" onClick="confirmation('.$tabres['index'].');">  '; 			
					?>  </td>
				</tr>
				<?php
				 }
				?>

			</table>
			</form>
		</td>
	</tr>
</table>
</body>
</html>
