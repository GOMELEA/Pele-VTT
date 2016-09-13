<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
  <tr height="200">
    <td>
	<p align="center"><img src="../Photo/bandeau.jpg" ></p>
	</td>
  </tr>
  <tr>
    <td>
  	<p align="center" class="Style11">Liste des fiches OK : </p>
	<table width="1200" border="0">
      <tr class="Style20">
        <td><div align="center">Date</div></td>
        <td><div align="center">N°<br> 
          Inscription</div></td>
        <td>Nom</td>
        <td>Pr&eacute;nom</td>
        <td>Type</td>
        <td><div align="center">Réglement<br> 
          OK</div></td>
        <td><p align="center">Documents<br> 
          OK</p>          </td>
        <td><div align="center">Charte</div></td>
        <td><div align="center">Fiche Inscription</div></td>
        <td><div align="center">Diplome</div></td>
        <td><div align="center">Assurance</div></td>
        <td><div align="center">Non<br>
          Contagion</div></td>
        <td><div align="center">Fiche<br> 
          Sanitaire</div></td>
      </tr>
	<?php  
		   $req_liste= "  SELECT * FROM fiche INNER JOIN inscription ON inscription.index_inscription= fiche.fiche_numero_inscription ".
		   				"WHERE documents_signe= '1' and inscription.regle='1' ".$_SESSION['and']."  order by date_inscription, fiche_numero_inscription ; ";
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
		  {$tabres=stripslashes_deep($tabres);
		 ?>
		<tr class="Style25">
		<td align="center"><?php echo $tabres['date_inscription']; ?></td>
		<td align="center"><?php echo '<a href="secretariat_inscription.php?Selection='.$tabres['fiche_numero_inscription'].'&go=Afficher">'.$tabres['fiche_numero_inscription'].'</a>'; ?> </td>
		<td><?php echo '<a href="secretariat_fiche.php?Selection='.$tabres['index'].'&go=Afficher">'.$tabres['nom_usage'].'</a>'; ?> </td>
		<td><?php echo $tabres['prenom']; ?></td>
		<td><?php echo $tabres['type']; ?></td>
		<td align="center"><?php echo $tabres['regle']; ?>
		  <div align="center"></div></td>
		<td align="center"><?php echo $tabres['documents_signe']; ?>
		  <div align="center"></div></td>
		<td align="center"><?php echo $tabres['charte_pelerin']; ?>
		  <div align="center"></div></td>
		<td align="center"><?php echo $tabres['fiche_inscription_signee']; ?>
		  <div align="center"></div></td>
		<td align="center"><?php echo $tabres['bafa']; ?>
		  <div align="center"></div></td>
		<td align="center"><?php echo $tabres['assurance_voiture']; ?>
		  <div align="center"></div></td>
		<td align="center"><?php echo $tabres['certificat_vaccination']; ?>
		  <div align="center"></div></td>
		<td align="center"><?php echo $tabres['fiche_liaison']; ?>
		  <div align="center"></div></td>
		</tr>
		<?php
		 }
		?>
    </table></td>
  </tr>


</table>




</body>
</html>
