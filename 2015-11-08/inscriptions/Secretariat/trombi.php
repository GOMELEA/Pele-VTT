<?php
      session_start(); 
	  include('include/fonction_php.php');
	  $type = $_GET["type"];
	  $poste = $_GET["poste"];
	  $an = $_SESSION["annee"];
	  $route = $_SESSION["index_route"];
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
    <td class="Style11">	  <p align="center" class="Style26 Style27">Liste de <? echo $type; if ($poste<>"") echo " au poste de ".$poste; ?> de l'année <? echo $an;?>   </p>
	</td>
  </tr>
	<?php
			echo '<tr>
					<td>';
			if ($poste<>"")
				$requete="and `type` = '".$type."' and ".$poste."=1  ";
			else $requete="and `type` = '".$type."' ";
			$req="SELECT * FROM   fiche  INNER JOIN route ON fiche.route_index = route.index_route Where `annee`='".$an."' ".$requete.$_SESSION['and']." order by nom_usage";
			$res = log_mysql_query($req , $mysql);
			while ($tabres = mysql_fetch_array ($res))
			{
				$tabres=stripslashes_deep($tabres);
				echo '<div style="float:left;border-style:groove;width:190;height:260;">'."\n";
				
				for ($i = $_SESSION['annee']; $i >2008; $i--)
					{
						if (file_exists('../data/'.formatage_repertoire($_SESSION['departement']).'/'.formatage_nom_de_fichier($tabres['nom_usage']).'_'.formatage_nom_de_fichier($tabres['prenom']).'_'.$i.'.jpg')) break;
					}
					
				if ($i==2008) 
					$nom_de_fichier='../data/'.formatage_repertoire($_SESSION['departement']).'/'.formatage_nom_de_fichier($tabres['nom_usage']).'_'.formatage_nom_de_fichier($tabres['prenom']).'.jpg';
				else 
					$nom_de_fichier='../data/'.formatage_repertoire($_SESSION['departement']).'/'.formatage_nom_de_fichier($tabres['nom_usage']).'_'.formatage_nom_de_fichier($tabres['prenom']).'_'.$i.'.jpg';
				if (file_exists($nom_de_fichier))
					echo '<CENTER><img src="'.$nom_de_fichier.'" width="125" height="168" ></CENTER>';
				else 
					echo '<CENTER><img src="'.$nom_de_fichier.'" width="125" height="168" ></CENTER>';
				echo '<p align="center" class="Style25"><a href="secretariat_fiche.php?Selection='.$tabres['index'].'&go=Afficher">'.$tabres['titre']." ".$tabres['nom_usage']." ".$tabres['prenom'].'</a>'."<BR>"."\n";
				echo $tabres['telephone']."<BR>"."\n";
				echo $tabres['tel_mobile']."<BR>"."\n";
				echo $tabres['courriel']."<BR></p>"."\n";
				echo '</div>'."\n";
			}
			
		?>
	</table>
</body>
</html>
