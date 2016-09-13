<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
      session_start(); 
	  $an = $_GET["annee"];
	  include('include/fonction_php.php');
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
<?php
include('../include/base/connexion_serveur.php');
?>
<table width="990" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td>
	<p align="center"><?php include('menu.html'); ?><br></p>	</td>
	</td>
  </tr>
  <tr>
    <td>
  	<p align="center" class="Style11"><br>Liste des courriels des GG de toutes les routes de l'année <? echo $an;?>   </p>
	<p align="Left" class="Style11"><br>Par route </p>
	<table width="1200" border="0">
		<?php
			$req="SELECT departement FROM   route  Where `annee`='".$an."' order by departement";
			$res = log_mysql_query($req , $mysql);
			while ($tabres = mysql_fetch_array ($res))
			{
				echo '<tr>'."\n";
				echo '<td class="Style3"><p align="left">'.$tabres['departement'].' : </p>';
				echo '</tr>'."\n";
				echo '</td>'."\n";
				echo '<tr>'."\n";
				echo '<td >'."\n";
				$req2="SELECT * FROM   fiche  INNER JOIN route ON fiche.route_index = route.index_route Where `annee`='".$an.
					"' and `departement`='".$tabres['departement']."'and (`gg`<>'0' or `type`='ggg' or `type`='ogm') order by nom_usage";
				$courriel="";
				$res2 = log_mysql_query($req2 , $mysql);
				while ($tabres2 = mysql_fetch_array ($res2))
					{ $courriel=$tabres2['courriel'].'; '.$courriel;}			
				echo $courriel; 
				echo '</td>'."\n";
				echo '</tr>'."\n";
			}
		?>
	</table>
	<p align="Left" class="Style11"><br>Par Fonction </p>
	<table width="1200" border="0">
		<?php
			$titre = array("ogm","ggg");
			for($j=0;$j < 2;$j++) 
			{
				echo '<tr>'."\n";
				echo '<td class="Style3"><p align="left">'.$titre[$j].' : </p>';
				echo '</tr>'."\n";
				echo '</td>'."\n";
				echo '<tr>'."\n";
				echo '<td >'."\n";
				$req2="SELECT * FROM   fiche  INNER JOIN route ON fiche.route_index = route.index_route Where `annee`='".$an.
					"' and `type`='".$titre[$j]."' order by nom_usage";
				$courriel="";
				$res2 = log_mysql_query($req2 , $mysql);
				while ($tabres2 = mysql_fetch_array ($res2))
					{ $courriel=$tabres2['courriel'].'; '.$courriel;}			
				echo $courriel; 
				echo '</td>'."\n";
				echo '</tr>'."\n";
			}
		?>
		<?php
			$titre = array("GG ABS","GG Animateur","GG Intendance","GG Media","GG Parcours","GG Priere","GG Santé","GG Secretariat","GG Staff","GG Technique","GG Vélo");
			for($j=0;$j < 11;$j++) 
			{
				echo '<tr>'."\n";
				echo '<td class="Style3"><p align="left">'.$titre[$j].' : </p>';
				echo '</tr>'."\n";
				echo '</td>'."\n";
				echo '<tr>'."\n";
				echo '<td >'."\n";
				$req2="SELECT * FROM   fiche  INNER JOIN route ON fiche.route_index = route.index_route Where `annee`='".$an.
					"' and `gg`='".$titre[$j]."' order by nom_usage";
				$courriel="";
				$res2 = log_mysql_query($req2 , $mysql);
				while ($tabres2 = mysql_fetch_array ($res2))
					{ $courriel=$tabres2['courriel'].'; '.$courriel;}			
				echo $courriel; 
				echo '</td>'."\n";
				echo '</tr>'."\n";
			}
		?>
	</table>
</td>


</table>




</body>
</html>
