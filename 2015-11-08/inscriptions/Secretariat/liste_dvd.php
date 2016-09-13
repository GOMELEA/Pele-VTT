<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
      session_start(); 
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
  </tr>
  <tr>
    <td>
  	<p align="center" class="Style11">Liste des commandes de DVD : </p>
	<table width="1200" border="0">
      <tr class="Style20">
        <td width="181"><div align="center">Date</div></td>
        <td width="109"><div align="center">N°<br> 
          Inscription</div></td>
        <td width="118">Nom</td>
        <td width="165">Pr&eacute;nom</td>
        <td width="116">Qté</td>
        </tr>
	<?php  
		   $req_liste= "  SELECT * FROM inscription WHERE qte_dvd> '0' ".$_SESSION['and']."  order by nom_inscription ; ";
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
		  {	$tabres=stripslashes_deep($tabres);
		 ?>
		<tr class="Style25">
		<td align="center"><?php echo $tabres['date_inscription']; ?></td>
		<td align="center"><?php echo '<a href="secretariat_inscription.php?Selection='.$tabres['index_inscription'].'&go=Afficher">'.$tabres['index_inscription'].'</a>'; ?> </td>
		<td><?php echo '<a href="secretariat_inscription.php?Selection='.$tabres['index_inscription'].'&go=Afficher">'.$tabres['nom_inscription'].'</a>'; ?> </td>
		<td><?php echo $tabres['prenom_inscription']; ?></td>
		<td><?php echo $tabres['qte_dvd']; ?></td>
		</tr>
		<?php
		 }
		?>
    </table></td>
  </tr>


</table>




</body>
</html>
