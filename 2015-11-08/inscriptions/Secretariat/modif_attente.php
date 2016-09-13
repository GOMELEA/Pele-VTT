<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
      session_start(); 
	  $type = $_GET["type"];
	  $index = $_GET["index"];
	  $faire = $_GET["faire"];

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
    <LINK rel=stylesheet type="text/css" href="../../total.css">
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
</head>
<body>

-->
 </style>
</head>
<SCRIPT LANGUAGE="JavaScript">
function confirmation_code(index,date) 
{
var msg = "Êtes-vous sur de vouloir envoyer le courriel avec le code confidentiel pour cette fiche ?";
if (confirm(msg))
	{
			if (date!=943916400)
				location.replace('modif_attente.php?index='+index+'&faire=envoie_code');
			else alert ('Veuillez sélectionner une date limite de réponse. N\'oubliez pas d\'appuyer sur le bouton validation');
	}
}
function confirmation_suppression(index) 
{
var msg = "Êtes-vous sur de vouloir supprimer la fiche de la liste d'attente ?";
if (confirm(msg))
{				location.replace('modif_attente.php?index='+index+'&faire=supprimer');
}
}
</SCRIPT>

<body>
<?php
include('../include/base/connexion_serveur.php');
if ($faire=="sauver_attente") include ('include/base/update_attente.php'); 
$req_liste= "  SELECT * FROM attente WHERE index_attente= $index  ".$_SESSION['and_simple']." ;" ;
$res_liste= log_mysql_query($req_liste , $mysql);
$tab = mysql_fetch_array ($res_liste);
$tab=stripslashes_deep($tab);
if ($faire=="envoie_code") include ('include/envoie_code.php'); 
if ($faire=="supprimer") 
{
	$tab['observation_attente']=date('j/n/Y à G:i:s')." : Suppression de la fiche \n".$tab['observation_attente'];
	$req_modif_fiche = "UPDATE   `attente`  SET observation_attente='" . mysql_real_escape_string ($tab['observation_attente'])."',etat_attente='supprime' WHERE `index_attente` = '". $index ."' ";
	$res_insertion =    log_mysql_query($req_modif_fiche  , $mysql );
}
?>
<form  name="formSaisie" method="post" action="modif_attente.php?index=<?php echo $index;?>&faire=sauver_attente"  >
<table width="990" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td>
	<p align="center"><?php //include('menu.html'); ?><br></p>	</td>
	</td>
  </tr>
  <tr>
    <td align="center">
  	<p align="center" class="Style11"> Fiche sur listes d'attente
  	  <input id="button" name="button" type="submit"  value=" VALIDATION ">
  	</p>

<table align="center"  cellspacing="0" class="titre4_anthracite">
    <tr align="left">
        <td colspan="6" class="titre2_marron" >Coordonn&eacute;es de l'inscrit sur liste d'attente</td>
        <td bgcolor="#FFFFFF" class="titre2_marron" >&nbsp;</td>
        <td bgcolor="#FFFFFF" class="titre2_marron" >&nbsp;</td>
        <td colspan="2" align="center" class="titre2_marron" >Suivi du dossier</td>
        </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td >Sexe</td>
        <td height="20" ></td>
        <td height="20" >Nom</td>
        <td></td>
        <td>Pr&eacute;nom</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td colspan="2" align="center">Date d'inscription </td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ><?php if ($tab['sexe']=="") $tab['sexe']=$sexe;?>
            <select size="1" id="sexe_attente" name="sexe_attente">
                      <option value="<?php echo $tab['sexe_attente'];?>"  selected="selected" ><?php echo $tab['sexe_attente'];?> </option>
                      <option value="F">F</option>
                      <option value="H">H</option>
            </select>
        </td>
        <td height="20" ></td>
        <td height="20" ><input id="nom_attente" name="nom_attente" size="30" type="text"  value="<?php echo $tab['nom_attente'];?>" onchange="javascript:this.value=this.value.toUpperCase();" /></td>
        <td></td>
        <td><input id="prenom_attente" name="prenom_attente" size="30" type="text"  value="<?php echo $tab['prenom_attente'];?>"/></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td colspan="2" align="center"><input id="date_liste_attente" name="date_liste_attente" size="18" maxlength="15" type="text" value="<?php echo date('j/n/Y à G:i:s',maketime($tab['date_liste_attente']));?>" disabled="disabled"/></td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td >Type</td>
        <td height="20" ></td>
        <td height="20" >Code Postal </td>
        <td></td>
        <td>Ville</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td align="center">Date Limite de Réponse</td>
        <td align="center">Code Confidentiel</td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ><input id="type_attente" name="type_attente" size="8" maxlength="10" type="text"  value="<?php echo $tab['type_attente'];?>"/></td>
        <td height="20" ></td>
        <td height="20" ><input id="cdpostal_attente" name="cdpostal_attente" size="8" maxlength="10" type="text"  value="<?php echo $tab['cdpostal_attente'];?>"/></td>
        <td></td>
        <td><input id="ville_attente" name="ville_attente" size="26" maxlength="26" type="text"   value="<?php echo $tab['ville_attente'];?>" onchange="javascript:this.value=this.value.toUpperCase();" /></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF"></td>
        <td align="center"><select size="1" id="date_limite_inscription" name="date_limite_inscription"  onChange="submit();">
          <option value="<?php echo $tab['date_limite_inscription'];?>"  selected="selected" ><?php if ($tab['date_limite_inscription']<>"") echo date('j/n/Y à G:i:s',maketime($tab['date_limite_inscription']));?></option>
          <?php
			 	for ($i=0;$i < 22;$i++) 
				{
					$date = mktime(22, 0, 0, date("m"), date("d")+$i, date("y")); 
					$date2=date('Y/m/d H:i:s', $date);
					echo '<option value="'.$date2.'">'.$i.' jours</option>';
				}
			?>
        </select></td>
        <td align="center"><input id="code_confidentiel" name="code_confidentiel" size="15" maxlength="15" type="text" value="<?php echo $tab['code_confidentiel'];?>" /></td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="36" colspan="6" ><span class="titre2_marron">Coordonn&eacute;es </span><span class="titre3_marron">du responsable</span></td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td rowspan="2" align="center" valign="bottom"><img src="../Photo/envoie_code_confidentiel.png" width="75" height="50" title="Envoyer le courriel avec le code confidentiel" onClick='confirmation_code(<?php echo $index.",".maketime($tab['date_limite_inscription']); ?>);'></td>
        <td rowspan="2" align="center" valign="bottom"><img src="../Photo/corbeille.jpg" width="50" height="50" title="Supprimer la fiche de la liste d'attente" onClick='confirmation_suppression(<?php echo $index; ?>);'></td>
        </tr>
    <tr valign="bottom" align="left" >
        <td height="25"  ></td>
        <td >Titre</td>
        <td  ></td>
        <td  >Nom</td>
        <td></td>
        <td>Pr&eacute;nom</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
     <tr valign="bottom" align="left" >
       <td height="20" ></td>
       <td ><select size="1" id="titre_resp_attente" name="titre_resp_attente"  >
         <option value="<?php echo $tab['titre_resp_attente'];?>"  selected="selected" ><?php echo $tab['titre_resp_attente'];?></option>
         <option value="Monsieur">Monsieur</option>
         <option value="Madame">Madame</option>
         <option value="Mademoiselle">Mlle</option>
         <option value="Frere">Fr&egrave;re</option>
         <option value="Pere">P&egrave;re</option>
         <option value="Soeur">Soeur</option>
         <option value="Mgr">Mgr</option>
       </select></td>
       <td height="20" ></td>
       <td height="20" ><input id="nom_resp_attente" name="nom_resp_attente" size="30" type="text" value="<?php echo $tab['nom_resp_attente'];?>" onchange="javascript:this.value=this.value.toUpperCase();" /></td>
       <td></td>
       <td><input id="prenom_resp_attente" name="prenom_resp_attente" size="30" type="text" value="<?php echo $tab['prenom_resp_attente'];?>" /></td>
       <td bgcolor="#FFFFFF">&nbsp;</td>
       <td bgcolor="#FFFFFF">&nbsp;</td>
       <td align="center">Envoi du courriel <br>
         avec le code confidentiel</td>
       <td align="center">Supprime la fiche<br>
         de la liste d'attente</td>
       </tr>
     <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ></td>
        <td height="20" ></td>
        <td height="20" >Courriel 1 </td>
        <td></td>
        <td></td>
        <td bgcolor="#FFFFFF"></td>
        <td bgcolor="#FFFFFF"></td>
        <td colspan="2" align="left">Observations</td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ></td>
        <td height="20" ></td>
        <td height="20" colspan="3" ><input id="courriel1_attente" name="courriel1_attente" size="60" maxlength="100" type="text" value="<?php echo $tab['courriel1_attente'];?>" /></td>
        <td height="20" bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td colspan="2" rowspan="5" align="center"><textarea rows="7" cols="50" id="observation_attente" name="observation_attente"><?php echo $tab['observation_attente'];?></textarea></td>
        </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ></td>
        <td height="20" ></td>
        <td height="20" >Courriel 2</td>
        <td></td>
        <td></td>
        <td bgcolor="#FFFFFF"></td>
        <td bgcolor="#FFFFFF"></td>
        </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ></td>
        <td height="20" ></td>
        <td height="20" colspan="3" ><input id="courriel2_attente" name="courriel2_attente" size="60" maxlength="100" type="text" value="<?php echo $tab['courriel2_attente'];?>" /></td>
        <td height="20" bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ></td>
        <td height="20" ></td>
        <td height="20" >N&deg; de T&eacute;l&eacute;phone </td>
        <td></td>
        <td>N&deg; de Mobile </td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ></td>
        <td height="20" ></td>
        <td height="20" ><input id="telephone_attente" name="telephone_attente" size="15" maxlength="15" type="text" value="<?php echo $tab['telephone_attente'];?>" /></td>
        <td></td>
        <td><input id="tel_mobile_attente" name="tel_mobile_attente" size="15" maxlength="15" type="text" value="<?php echo $tab['tel_mobile_attente'];?>" /></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
    <tr valign="bottom" align="center" >
      <td>&nbsp;</td>
        <td height="30" class="titre2_marron"><p></td>
        <td height="30" class="titre2_marron">&nbsp;</td>
        <td height="30" class="titre2_marron">&nbsp;</td>
        <td height="30" class="titre2_marron">&nbsp;</td>
        <td height="30" class="titre2_marron">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="titre2_marron">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="titre2_marron">&nbsp;</td>
        <td height="30" colspan="2" valign="middle" class="titre2_noir"><a href="gestion_attente.php#<?php echo $index; ?>"> Retour &agrave; la liste d'attente</a></td>
        </tr>
</table>
</form>
<br><br>
</td>
  </tr>



</table>
<table>




</body>
</html>
