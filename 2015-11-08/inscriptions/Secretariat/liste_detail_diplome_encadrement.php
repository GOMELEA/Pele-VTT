<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
      session_start(); 
	  $type = $_GET["type"];
	  $diplome = $_GET["diplome"];
	  $stagiaire = $_GET["stagiaire"];
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
    <td align="center">
  	<p align="center" class="Style11">Liste des <? if ($type!="") echo $type; else echo 'diplom�s';if ($stagiaire==1) echo ' en stage'; ?> avec une �quivalence de <?php echo $diplome;  ?>: </p>
	<table width="1200" border="0">
      <tr class="Style3">
        <td>Titre</td>
        <td>Nom</td>
        <td>Pr&eacute;nom</td>
        <td>Diplome </td>
        <td>Description</td>
        <td>Equivalence</td>
        <td>28 jours d'exp</td>
        <td>Doc Diplome</td>
        <td>Attestation 28j</td>
      </tr>
	<?php   

		if ($diplome=="BAFD")
			$or=' or (diplome_equivalence= "BAFD si exp" and attestation_encadrement="1")';
		elseif ($diplome=="BAFA")
			$or=' or (diplome_equivalence= "BAFD si exp" and attestation_encadrement="0")';
		if ($type!="") $req_type="and type= '".$type."' ";

		$req="SELECT * FROM `fiche` INNER JOIN diplome ON diplome_encadrement = index_diplome ".
			$_SESSION['where'] .$req_type." and (`diplome_equivalence`= '".$diplome."'".$or." ) and `stagiaire_encadrement`= '".$stagiaire."'  ";
		$res_liste = log_mysql_query($req , $mysql);
	    while ($tabres = mysql_fetch_array ($res_liste))
		  {  $tabres=stripslashes_deep($tabres);
		 ?>
		<tr class="Style25">
		<td><?php echo $tabres['titre']; ?></td>
		<td><?php echo '<a href="secretariat_fiche.php?Selection='.$tabres['index'].'&go=Afficher">'.$tabres['nom_usage'].'</a>'; ?> </td>
		<td><?php echo $tabres['prenom']; ?></td>
		<td><?php echo $tabres['abreviation_diplome']; ?></td>
		<td><?php echo $tabres['description_diplome']; ?></td>
		<td><?php echo $tabres['diplome_equivalence']; ?></td>
		<td><?php if($tabres['attestation_encadrement']==1) echo "Oui"; ?></td>
		<td><?php if ($tabres['diplome_encadrement_ok']==1) echo "Re�u";else echo "en attente"; ?></td>
		<td><?php if ($tabres['attestation_encadrement_ok']==1) echo "Re�u";elseif ($tabres['attestation_encadrement']==1) echo "en attente"; ?></td>
		</tr>
		<?php
		 }
		?>
    </table>
	<BR><br>
</td>
  </tr>



</table>


</body>
</html>
