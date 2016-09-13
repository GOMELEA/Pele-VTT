<?php
	$faire = $_GET["faire"];
	$index_mdp = $_GET["index_mdp"];
	include('../include/fonction_php.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Document sans nom</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<style type="text/css">
<!--
.Style7 {font-family: Arial, Helvetica, sans-serif; font-size: 24px; font-weight: bold; }
.Style12 {
	font-family: Verdana;
	font-size: 10px;
	position: relative;
	color: #333333;
	background-color: #EEEEEE;
}
-->
</style>
<body>
<SCRIPT LANGUAGE="JavaScript">
function confirmation(index_mdp) 
{
var msg = "Êtes-vous sur de vouloir supprimer cet utilisateur ?";
if (confirm(msg))
location.replace('gestion_mdp.php?index_mdp='+index_mdp+'&faire=supprimer');
}
function control_mdp() 
{
}

</SCRIPT>
<?php 
	include('../../include/base/connexion_serveur.php');
	include('htacess.php');
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     SUPPRIME L'UTILISATEUR
	if ($faire=="supprimer") include('supprimer_mdp.php');
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     MODIFIE L'UTILISATEUR
	elseif ($faire=="modifier")	
	{
		include('update_mdp.php');
		include('supprimer_mdp.php');
	}
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     CREE L'UTILISATEUR
	elseif ($faire=="sauver")	include('sauve_mdp.php');
?>
<form  name="formSaisie" method="post" action="gestion_mdp.php?faire=sauver" onsubmit="return control_mdp()" >
<table width="1200" border="0">
  <tr>
    <td></td>
  </tr>
</table>

<p>&nbsp;</p>
<table width="800" border="0">
  <tr class="Style7">
    <td colspan="5"><div align="center">Lecture</div></td>
  </tr>
  <tr class="Style12">
    <td><div align="center">N&deg; <br>
        D&eacute;partement </div></td>
    <td><div align="center">Login</div></td>
    <td><div align="center">Mot de Passe </div></td>
    <td colspan="2"><div align="center">Validation</div></td>
  </tr>
  <tr class="Style12">
    <td><div align="center">
        <input id="N_depart_lecture" name="N_depart_lecture" size="6" maxlength="6" type="text" value="<?php echo $tab['N_depart_lecture'];?>">
    </div></td>
    <td><div align="center">
        <input id="login_lecture" name="login_lecture" size="15" maxlength="15" type="text" value="<?php echo $tab['login_lecture'];?>">
    </div></td>
    <td><div align="center">
        <input id="mdp_lecture" name="mdp_lecture" size="15" maxlength="15" type="text" value="<?php echo $tab['mdp_lecture'];?>">
    </div></td>
    <td colspan="2"><div align="center">
        <input id="button" name="button2" type="submit"  value=" Validation ">
    </div></td>
  </tr>
</table>
<?php 
$autorisation='lecture';
include ('liste.php'); 
?>

<p>&nbsp;</p>
<table width="800" border="0">
  <tr class="Style7">
    <td colspan="5"><div align="center">Secr&eacute;tariat</div></td>
  </tr>
  <tr class="Style12">
    <td><div align="center">N&deg; <br>
        D&eacute;partement </div></td>
    <td><div align="center">Login</div></td>
    <td><div align="center">Mot de Passe </div></td>
    <td colspan="2"><div align="center">Validation</div></td>
  </tr>
  <tr class="Style12">
    <td><div align="center">
        <input id="N_depart_secretariat" name="N_depart_secretariat" size="6" maxlength="6" type="text" value="<?php echo $tab['N_depart_secretariat'];?>">
    </div></td>
    <td><div align="center">
        <input id="login_secretariat" name="login_secretariat" size="15" maxlength="15" type="text" value="<?php echo $tab['login_secretariat'];?>">
    </div></td>
    <td><div align="center">
        <input id="mdp_secretariat" name="mdp_secretariat" size="15" maxlength="15" type="text" value="<?php echo $tab['mdp_secretariat'];?>">
    </div></td>
    <td colspan="2"><div align="center">
        <input id="button2" name="button3" type="submit"  value=" Validation ">
    </div></td>
  </tr>
</table>
<?php 
$autorisation='secretariat';
	include ('liste.php'); ?>

<p>&nbsp;</p>
<table width="800" border="0">
  <tr class="Style7">
    <td colspan="4"><div align="center">Administration</div></td>
  </tr>
  <tr class="Style12">
    <td><div align="center">Login</div></td>
    <td><div align="center">Mot de Passe </div></td>
    <td colspan="2"><div align="center">Validation</div></td>
  </tr>
  <tr class="Style12">
    <td><div align="center">
        <input id="login_admin" name="login_admin" size="15" maxlength="15" type="text" value="<?php echo $tab['login_admin'];?>">
    </div></td>
    <td><div align="center">
        <input id="mdp_admin" name="mdp_admin" size="15" maxlength="15" type="text" value="<?php echo $tab['mdp_admin'];?>">
    </div></td>
    <td colspan="2"><div align="center">
        <input id="button4" name="button4" type="submit"  value=" Validation ">
    </div></td>
  </tr>
</table>
<?php
include ('liste_admin.php'); ?>

<p>&nbsp;</p>
