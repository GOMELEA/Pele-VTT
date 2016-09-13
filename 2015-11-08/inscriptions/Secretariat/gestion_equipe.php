<?php
      session_start(); 
	  include('include/fonction_php.php');
	$faire = $_GET["faire"];
	$index_equipe = $_GET["index_equipe"];
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
<SCRIPT LANGUAGE="JavaScript">
function confirmation(index_equipe) 
{
var msg = "Êtes-vous sur de vouloir supprimer cette équipe ?";
if (confirm(msg))
location.replace('gestion_equipe.php?index_equipe='+index_equipe+'&faire=supprimer');
}
function control_equipe() 
{
}

</SCRIPT>
<?php 
	include('../include/base/connexion_serveur.php');
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     SUPPRIME L'EQUIPE
	if ($faire=="supprimer" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement']) or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
		include('include/base/supprimer_equipe.php');
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     MODIFIE L'EQUIPE
	elseif ($faire=="modifier" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement']) or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{
		include('include/base/charge_equipe.php');
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     CREE L'EQUIPE
	elseif ($faire=="sauver" and $_POST['numero_equipe'] <>"" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement']) or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{
		include('include/base/sauve_equipe.php');
		sauvegarde('image_foulard','.jpg','../data/'.formatage_repertoire($_SESSION['departement']).'/foulard_equipe_'.$index_equipe.'.jpg',200000);
	}

?>
<table width="990" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td>
	<p align="center"><?php include('menu.html'); ?><br></p>	</td>
	</td>
  </tr>
  <tr>
    <td>
  	<p align="center" class="Style11"><br>
  	  Gestion des Equipes : </p>
		<form  name="formSaisie" method="post" action="gestion_equipe.php?faire=sauver" onSubmit="return control_equipe()" enctype="multipart/form-data" >
        <table border="1">
          <tr align="center" valign="middle">
            <td width="59">N°<br />
              Equipe      <br /></td>
            <td width="154">Nom Equipe      <br /></td>
            <td >Foulard</td>
            <td width="205">Image du Foulard</td>
            <td width="109">Tente</td>
            <td width="122">Sous Camp</td>
          </tr>
          <tr align="center" valign="middle">
            <td>
                <input id="numero_equipe" name="numero_equipe" size="5" maxlength="5" type="text" value="<?php echo $tab['numero_equipe'];?>">
            </td>
            <td>
                <input id="nom_equipe" name="nom_equipe" size="40" maxlength="40" type="text" value="<?php echo $tab['nom_equipe'];?>">
            </td>
            <td>
                <input id="foulard" name="foulard" size="20" maxlength="30" type="text" value="<?php echo $tab['foulard'];?>">
            </td>
            <td>
                <?php echo ' <img src="../data/'.formatage_repertoire($_SESSION['departement']).'/foulard_equipe_'.$tab['index_equipe'].'.jpg" height="150" alt="Charger une photo du foulard :">' ?>
                <input type = "file" name = "image_foulard" size="15"><input type = "hidden" name="MAX_FILE_SIZE" value="500000">
            </td>
            <td>
                <input id="tente" name="tente" size="15" maxlength="30" type="text" value="<?php echo $tab['tente'];?>">
            </td>
            <td>
                <input id="sous_camp" name="sous_camp" size="15" maxlength="30" type="text" value="<?php echo $tab['sous_camp'];?>">
            </td>
            <input id="button3" name="button" type="submit"  value=" Validation ">
          </tr>
        </table>
<br><br>
 <p class="Style11">Liste des Equipes : </p>     
<?php
$req_liste= "  SELECT * FROM equipe WHERE route_index = '".$_SESSION['index_route']."' order by numero_equipe" ;
$res_liste= log_mysql_query($req_liste , $mysql);
echo '<table  border="1">';
while ($tabres = mysql_fetch_array ($res_liste))
{	$tabres=stripslashes_deep($tabres);
	echo'
	  <tr class="Style12">
		<td>
		     <img src="../data/'.formatage_repertoire($_SESSION['departement']).'/foulard_equipe_'.$tabres['index_equipe'].'.jpg" height="150" >
		</td>
		<td width="300">
			<p class="Style11">'.$tabres['numero_equipe'].' '.$tabres['nom_equipe'].'</p>
			<p> Foulard : '.$tabres['foulard'].'</p>
			<p> Tente : '.$tabres['tente'].'</p>
			<p> Sous-Camp : '.$tabres['sous_camp'].'</p>
		</td>
		<td width="100"><div align="center"><img src="../Photo/corbeille.jpg"  height="60" onClick="confirmation('.$tabres['index_equipe'].');"></div></td>
		<td width="100"><div align="center"><a href="gestion_equipe.php?index_equipe='.$tabres['index_equipe'].'&faire=modifier"><img src="../Photo/modifier.jpg"  height="60"></a></div></td>
	</tr>';
}
echo '</table>';
?>      
      </td>
      </form>


</table>




</body>
</html>
