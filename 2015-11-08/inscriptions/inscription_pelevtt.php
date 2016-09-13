<?php 
# <!-- Propose au participant de sélectionner le type de personne à incrire -->
session_start(); 
$route = $_GET["route"];
$type = $_GET["type"];
$faire = $_GET["faire"];
$index = $_GET["index"];
include('Secretariat/include/fonction_php.php');
include('include/test_session_ok.php'); // ** Test si la Session a déjà été tué  *************

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <LINK rel=stylesheet type="text/css" href="../total.css">
</head>

<body>
<!-- Sauvegarde des informations déposés sur la liste d'attente -->
<?php if ($faire=="sauver_attente") 
		{
			include ('include/base/sauver_attente.php'); 
			include ('include/envoi_confirmation_attente.php'); 
		}	?>

<!-- Table utilisée pour la mise en page générale -->
<table width="1010" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
	<td>
		<!-- Chargement de tous les paramètres de la route sélectionnée dans des variables $_SESSION et affichage du bandeau -->
		<?php 
			if ($_SESSION['index_route']<>$route and $route<>'') include('include/base/charge_variable_route.php'); 
			include('include/bandeau_route.php'); ?>
		<p align="center" class="titre2_marron">Choisissez votre inscription: </p>
		<!-- Affichage des différents types d'inscription -->

		<!-- Dans le cas des collégiens et lycéens, on vérifie si les inscriptions sont ouvertes par rapport à la date du début des inscriptions  $_SESSION['debut_inscription']-->
		<?php
			$date_debut_inscription = strtotime($_SESSION['debut_inscription']);
			$_var_maintenant=time()+2*60*60; // "gestion" du décalage horaire.....
			if ($_var_maintenant > $date_debut_inscription) 

				{ echo '<p align="center">
						<a href="inscription.php?type=collegien&faire=copier&sexe=H&index='.$index.'"><img src="Photo/inscription_garçons.jpg" width="120" height="140" border="1"></a>
						<img src="Photo/inscription_collegien_court.jpg" width="310" height="140" border="1">
						<a href="inscription.php?type=collegien&faire=copier&sexe=F&index='.$index.'"><img src="Photo/inscription_filles.jpg" width="120" height="140" border="1"></a>
						</p>';
				  echo '<p align="center"><a href="inscription.php?type=staff&faire=copier&index='.$index.'"><img src="Photo/inscription_staff.jpg" width="560" height="140" border="1"></a></p>';}
			Else			
				{ echo '<p align="center"><img src="Photo/inscription_collegien_pas_ouverte.jpg" width="560" height="140" border="1"></p>';
				 echo '<p align="center"><img src="Photo/inscription_staff_pas_ouverte.jpg" width="560" height="140" border="1"></p>';}
		?>
		<!-- Affichage des autres cas : abs, ttv, ggm.....-->
		<p align="center"><a href="inscription.php?type=animateur&faire=copier&index=<?php echo $index?>"><img src="Photo/inscription_animateur.jpg" width="560" height="142" border="1"></a></p>
		<p align="center"><a href="inscription.php?type=abs&faire=copier&index=<?php echo $index?>"><img src="Photo/inscription_abs.jpg" width="560" height="142" border="1"></a></p>
		<p align="center"><a href="inscription.php?type=ttv&faire=copier&index=<?php echo $index?>"><img src="Photo/inscription_ttv.jpg" width="560" height="156" border="1"></a></p>
		<p align="center"><a href="inscription.php?type=ggg&faire=copier&index=<?php echo $index?>"><img src="Photo/inscription_ggg.jpg" width="560" height="156" border="1"></a></p>
		<p align="center"><a href="inscription.php?type=ogm&faire=copier&index=<?php echo $index?>"><img src="Photo/inscription_ogm.jpg" width="560" height="156" border="1"></a></p>
		<p align="center">&nbsp;</p>
	</td>
  </tr>
</table>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>	
</body>
</html>
