<?php
      session_start(); 
	  include('include/fonction_php.php');
	  $an = $_GET["annee"];
		include('../include/base/connexion_serveur.php');
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
	font-size: 10px;
	position: relative;
	color: #333333;
	background-color: #EEEEEE;
}
-->
 </style>
</head>
<body>
<table width="1200" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td>
	<p align="center"><?php include('menu.html'); ?><br></p>	</td>
	</td>
  </tr>
  <tr>
    <td class="Style11">	  <p align="center" class="Style26 Style27">Liste de tous les fabuleux GG de toutes les routes de l'année <? echo $an;?>   </p>
	</td>
  </tr>
	<?php
  		// Les OGM et GGG
		$titre = array("OGM","GGG");
		for($j=0;$j < 2;$j++) 
		{
			echo 
				'<tr> 
					<td class="Style11"><p align="left" class="Style26 Style27"> <BR><BR>'.$titre[$j].' : </p> </td> 
				</tr> ';
			echo '<tr>
					<td>';
			//Les sentinelles d'abord
			$req="SELECT * FROM   fiche  INNER JOIN route ON fiche.route_index = route.index_route Where `annee`='".$an."' and `sentinelle` LIKE '%".$titre[$j]."%' order by nom_usage, sentinelle";
			$res = log_mysql_query($req , $mysql);
			while ($tabres = mysql_fetch_array ($res))
			{
				$tabres=stripslashes_deep($tabres);
				echo '<div style="float:left;border-style:groove;width:190;height:310;background-color: #efb554;">'."\n";
				$nom_de_fichier='../data/'.formatage_repertoire($tabres['departement']).'/'.formatage_nom_de_fichier($tabres['nom_usage']).'_'.formatage_nom_de_fichier($tabres['prenom']).'.jpg';
				if (file_exists($nom_de_fichier))
					echo '<CENTER><img src="'.$nom_de_fichier.'" width="125" height="168" ></CENTER>';
				else {
					$nom_de_fichier='../data/'.formatage_repertoire($tabres['departement']).'/'.formatage_nom_de_fichier($tabres['nom_usage']).'_'.formatage_nom_de_fichier($tabres['prenom']).'_'.$an.'.jpg';
					if (file_exists($nom_de_fichier)) {
						echo '<CENTER><img src="'.$nom_de_fichier.'" width="125" height="168" ></CENTER>';
					} else {
						echo '<CENTER><img src="../data/gg.jpg" width="125" height="168" ></CENTER>';
					}
				}

				echo '<p align="center" class="Style3">'.$tabres['sentinelle']." </p>"."\n";
				echo '<p align="center" class="Style25">'.$tabres['titre']." ".$tabres['nom_usage']." ".$tabres['prenom']."<BR>";
				echo $tabres['telephone']."<BR>"."\n";
				echo $tabres['tel_mobile']."<BR>"."\n";
				echo $tabres['courriel']."<BR></p>"."\n";
				echo '</div>'."\n";
			}
			// Tous les 
			$req="SELECT * FROM   fiche  INNER JOIN route ON fiche.route_index = route.index_route Where `annee`='".$an."' and `type`='".$titre[$j]."' order by departement";
			$res = log_mysql_query($req , $mysql);
			while ($tabres = mysql_fetch_array ($res))
			{
			$tabres=stripslashes_deep($tabres);
			echo '<div style="float:left;border-style:groove;width:190;height:310;">'."\n";
			$nom_de_fichier='../data/'.formatage_repertoire($tabres['departement']).'/'.formatage_nom_de_fichier($tabres['nom_usage']).'_'.formatage_nom_de_fichier($tabres['prenom']).'.jpg';
			if (file_exists($nom_de_fichier))
				echo '<CENTER><img src="'.$nom_de_fichier.'" width="125" height="168" ></CENTER>';
			else {
					$nom_de_fichier='../data/'.formatage_repertoire($tabres['departement']).'/'.formatage_nom_de_fichier($tabres['nom_usage']).'_'.formatage_nom_de_fichier($tabres['prenom']).'_'.$an.'.jpg';
					if (file_exists($nom_de_fichier)) {
						echo '<CENTER><img src="'.$nom_de_fichier.'" width="125" height="168" ></CENTER>';
					} else {
						echo '<CENTER><img src="../data/gg.jpg" width="125" height="168" ></CENTER>';
					}
				}

			echo '<p align="center" class="Style3">'.$tabres['departement']." ".$tabres['n_departement']."<BR>";
			echo '<span class="Style19">'; include('include/affichage_historique_gg.php'); echo '</span></p>';
			echo '<p align="center" class="Style25">'.$tabres['titre']." ".$tabres['nom_usage']." ".$tabres['prenom']."<BR>";
			include('include/affichage_historique_gg.php'); 
			echo $tabres['telephone']."<BR>"."\n";
			echo $tabres['tel_mobile']."<BR>"."\n";
			echo $tabres['courriel']."<BR></p>"."\n";
			echo '</div>'."\n";
			}
			echo '</tr>'."\n";
			echo '</td>'."\n";
		}
  		// Les GG
		$titre = array("GG ABS","GG Animateur","GG Intendance","GG Media","GG Parcours","GG Priere","GG Santé","GG Secretariat","GG Staff","GG Technique","GG Vélo");
		for($j=0;$j < 11;$j++) 
		{
			echo 
				'<tr> 
					<td class="Style11"><p align="left" class="Style26 Style27"><BR><BR>'.$titre[$j].' : </p> </td> 
				</tr> ';
			echo '<tr>
					<td>';
			//Les sentinelles d'abord
			$req="SELECT * FROM   fiche  INNER JOIN route ON fiche.route_index = route.index_route Where `annee`='".$an."' and `sentinelle` LIKE '%".substr($titre[$j],3,20)."%' order by nom_usage, sentinelle";
			$res = log_mysql_query($req , $mysql);
			while ($tabres = mysql_fetch_array ($res))
			{
				$tabres=stripslashes_deep($tabres);
				echo '<div style="float:left;border-style:groove;width:190;height:310;background-color: #efb554;">'."\n";
				$nom_de_fichier='../data/'.formatage_repertoire($tabres['departement']).'/'.formatage_nom_de_fichier($tabres['nom_usage']).'_'.formatage_nom_de_fichier($tabres['prenom']).'.jpg';
				if (file_exists($nom_de_fichier))
					echo '<CENTER><img src="'.$nom_de_fichier.'" width="125" height="168" ></CENTER>';
				else {
					$nom_de_fichier='../data/'.formatage_repertoire($tabres['departement']).'/'.formatage_nom_de_fichier($tabres['nom_usage']).'_'.formatage_nom_de_fichier($tabres['prenom']).'_'.$an.'.jpg';
					if (file_exists($nom_de_fichier)) {
						echo '<CENTER><img src="'.$nom_de_fichier.'" width="125" height="168" ></CENTER>';
					} else {
						echo '<CENTER><img src="../data/gg.jpg" width="125" height="168" ></CENTER>';
					}
				}

				echo '<p align="center" class="Style3">'.$tabres['sentinelle']." </p>"."\n";
				echo '<p align="center" class="Style25">'.$tabres['titre']." ".$tabres['nom_usage']." ".$tabres['prenom']."<BR>";
				echo $tabres['telephone']."<BR>"."\n";
				echo $tabres['tel_mobile']."<BR>"."\n";
				echo $tabres['courriel']."<BR></p>"."\n";
				echo '</div>'."\n";
			}
			// Tous les 
			$req="SELECT * FROM   fiche  INNER JOIN route ON fiche.route_index = route.index_route Where `annee`='".$an."' and `gg`='".$titre[$j]."' order by departement";
			$res = log_mysql_query($req , $mysql);
			while ($tabres = mysql_fetch_array ($res))
			{
			$tabres=stripslashes_deep($tabres);
			echo '<div style="float:left;border-style:groove;width:190;height:310;">'."\n";
			$nom_de_fichier='../data/'.formatage_repertoire($tabres['departement']).'/'.formatage_nom_de_fichier($tabres['nom_usage']).'_'.formatage_nom_de_fichier($tabres['prenom']).'.jpg';
			if (file_exists($nom_de_fichier))
				echo '<CENTER><img src="'.$nom_de_fichier.'" width="125" height="168" ></CENTER>';
			else {
					$nom_de_fichier='../data/'.formatage_repertoire($tabres['departement']).'/'.formatage_nom_de_fichier($tabres['nom_usage']).'_'.formatage_nom_de_fichier($tabres['prenom']).'_'.$an.'.jpg';
					if (file_exists($nom_de_fichier)) {
						echo '<CENTER><img src="'.$nom_de_fichier.'" width="125" height="168" ></CENTER>';
					} else {
						echo '<CENTER><img src="../data/gg.jpg" width="125" height="168" ></CENTER>';
					}
				}

			echo '<p align="center" class="Style3">'.$tabres['departement']." ".$tabres['n_departement']."<BR>";
			echo '<span class="Style19">'; include('include/affichage_historique_gg.php'); echo '</span></p>';
			echo '<p align="center" class="Style25">'.$tabres['titre']." ".$tabres['nom_usage']." ".$tabres['prenom']."<BR>";
			echo $tabres['telephone']."<BR>"."\n";
			echo $tabres['tel_mobile']."<BR>"."\n";
			echo $tabres['courriel']."<BR></p>"."\n";
			echo '</div>'."\n";
			}
			echo '</tr>'."\n";
			echo '</td>'."\n";
		}
		?>
	</table>
</body>
</html>
