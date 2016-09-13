 <?php
      session_start(); 
	  $faire = $_GET["faire"];
	  $type = $_GET["type"];
	  $index = $_GET["index"];
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
-->
 </style>
</head>

<body>
<script type="text/javascript">
function control_saisi_par()
{
// Déclaration de variables
    var saisi_par = document.getElementById("saisi_par");
    var type = document.getElementById("type");
	validation=true;
	
	if (saisi_par.value.length<3)
		{ 	alert("Veuillez renseigner la personne qui saisi la fiche");
			validation=false; }
	if (type.value!="priere"&type.value.length<3)
		{ 	alert("Veuillez renseigner le type de soutien");
			validation=false; }
  if(validation==true)
  {
    return true;
  }
  else return false;
}
</script>

<?php
include('../include/base/connexion_serveur.php');
?>
<table width="1100" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td>
	<p align="center"><?php include('menu.html'); ?><br></p>	
	</td>
  </tr>
  <tr>
    <td>
    	<br><p align="center" class="Style11">Fiche <? if ($type=='priere') echo 'd\'amicale prière'; else echo ' de soutien'; ?></p><br>
	</td>
  </tr>
  <tr>
    <td>   
        <?
        $req_liste= "  SELECT * FROM soutien WHERE index_soutien=".$index." " ;
        $res_liste= log_mysql_query($req_liste , $mysql);
        $tab = stripslashes_deep(mysql_fetch_array ($res_liste)); ?>

        <div align="center">
        <form  name="formSaisie" method="post" action="<? if ($type=='priere') echo 'soutien.php?faire=sauver&type=priere&index='.$index;
																else echo 'soutien.php?faire=sauver&index='.$index; ?>" onSubmit="return control_saisi_par()">
            <table width="960" align="center"  cellspacing="0" class="titre4_anthracite">
                <tr valign="bottom" align="center" >
                    <td colspan="4" height="20" >Saisi par</td>
                    <td colspan="3" height="20" ><? if ($type<>'priere') echo "Type"; ?></td>
                    <td height="20" >Imprimé le :</td>
                    <td colspan="2" height="20" >Année</td>
                </tr>
                <tr valign="bottom" align="center" >
                    <td colspan="4" height="23" class="Style12" ><select size="1" id="saisi_par" name="saisi_par" >
                      <option value="<?php if ($tab['saisi_par']<>"") echo $tab['saisi_par']; else echo $_SESSION['saisi_par'];?>"  selected="selected" >
					  					<?php if ($tab['saisi_par']<>"") echo $tab['saisi_par']; else echo $_SESSION['saisi_par'];?></option>
                      <option value=""></option>
                      <option value="GG ABS">GG ABS</option>
                      <option value="GG Animateur">GG Animateur</option>
                      <option value="GG Intendance">GG Intendance</option>
                      <option value="GG Media">GG Media</option>
                      <option value="GG Parcours">GG Parcours</option>
                      <option value="GG Priere">GG Prière</option>
                      <option value="GG Santé">GG Santé</option>
                      <option value="GG Secretariat">GG Secretariat</option>
                      <option value="GG Staff">GG Staff</option>
                      <option value="GG Technique">GG Technique</option>
                      <option value="GG Vélo">GG Vélo</option>
                      <option value="GGG">GGG</option>
                      <option value="OGM">OGM</option>
                      </select></td>
                    <td colspan="3" height="23" class="Style12" > <? if ($type<>'priere') 
					   echo '
                      <select size="1" id="type" name="type" >
                      <option value="'.$tab['type'].'"  selected="selected" >'.$tab['type'].'</option>
                      <option value=""></option>
                      <option value="Don Financier">Don Financier</option>
                      <option value="Don en Nature">Don en Nature</option>
                      <option value="Prêt de Matériel">Prêt de Matériel</option>
                      <option value="Lieux de camp">Lieux de camp</option>
                      </select>'; ?></td>
                    <td colspan="1" height="23" class="Style12" ><input id="date_impression" name="date_impression" size="10" type="text" value="<?php if ($tab['date_impression']<>"") echo $tab['date_impression'] ;else echo $_SESSION['date_impression'];?>"></td>
                    <td colspan="2" height="23" class="Style12" ><input id="annee" name="annee" size="5" type="text" value="<?php if ($tab['annee']<>"") echo $tab['annee'] ;else echo $_SESSION['annee'];?>"></td>
                </tr>
                <tr valign="bottom" align="left" >
                    <td width="2" height="20" ></td>
                    <td width="88" height="20" >Titre</td>
                    <td width="10" height="20" ></td>
                    <td height="20" colspan="2" >Nom</td>
                    <td></td>
                    <td>Pr&eacute;nom</td>
                    <td width="234">Société / Communauté</td>
                    <td width="38"></td>
                    <td width="129"></td>
                </tr>
                <tr valign="bottom" align="left" >
                    <td height="20" ></td>
                    <td height="20" ><select size="1" id="titre" name="titre" >
                      <option value="<?php echo $tab['titre'];?>"  selected="selected" ><?php echo $tab['titre'];?></option>
                      <option value="Monsieur">Monsieur</option>
                      <option value="Madame">Madame</option>
                      <option value="Mademoiselle">Mlle</option>
                      <option value="Frere">Fr&egrave;re</option>
                      <option value="Pere">P&egrave;re</option>
                      <option value="Soeur">Soeur</option>
                      <option value="Mgr">Mgr</option>
                        </select></td>
                    <td height="20" ></td>
                    <td height="20" colspan="2" ><input id="nom" name="nom" size="30" type="text" onChange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['nom'];?>"></td>
                    <td width="6"></td>
                    <td width="234"><input id="prenom" name="prenom" size="30" type="text" value="<?php echo $tab['prenom'];?>"></td>
                    <td><input id="societe" name="societe" size="50" type="text" value="<?php echo $tab['societe'];?>" /></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <table width="960" border="0" class="titre4_anthracite" >
              <tr align="left">
                    <td colspan="2">Ligne d'adresse 1 </td>
                    <td colspan="2">Ligne d'adresse 2 </td>
                    <td colspan="2">Ligne d'adresse 3 </td>
                </tr>
                <tr align="left">
                    <td></td>
                    <td><input id="adresse_1" name="adresse_1" size="40" maxlength="40" type="text" value="<?php echo $tab['adresse_1'];?>"></td>
                    <td></td>
                    <td><input id="adresse_2" name="adresse_2" size="40" maxlength="40" type="text" value="<?php echo $tab['adresse_2'];?>"></td>
                    <td></td>
                    <td><input id="adresse_3" name="adresse_3" size="40" maxlength="40" type="text" value="<?php echo $tab['adresse_3'];?>"></td>
                </tr>
                <tr align="left">
                    <td colspan="2">Ville</td>
                    <td colspan="2">Code Postal </td>
                    <td colspan="2">Pays</td>
                </tr>
                <tr align="left">
                    <td></td>
                    <td><input id="ville" name="ville" size="26" maxlength="26" type="text"  onchange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['ville'];?>"></td>
                    <td></td>
                    <td><input id="cdpostal" name="cdpostal" size="8" maxlength="10" type="text" value="<?php echo $tab['cdpostal'];?>"></td>
                    <td></td>
                    <td><input id="pays" name="pays" size="26" maxlength="26" type="text"  onchange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['pays'];?>"></td>
                </tr>
                <tr align="left">
                    <td colspan="2">Courriel</td>
                    <td colspan="2">N&deg; de T&eacute;l&eacute;phone </td>
                    <td colspan="2">N&deg; de Mobile </td>
                </tr>
                <tr  align="left">
                    <td></td>
                    <td><input id="courriel" name="courriel" size="42" maxlength="50" type="text" value="<?php echo $tab['courriel'];?>"></td>
                    <td></td>
                    <td><input id="telephone" name="telephone" size="15" maxlength="15" type="text" value="<?php echo $tab['telephone'];?>"></td>
                    <td></td>
                    <td><input id="tel_mobile" name="tel_mobile" size="15" maxlength="15" type="text" value="<?php echo $tab['tel_mobile'];?>"></td>
                </tr>
            </table>
            <table width="960" align="center"  cellspacing="0"   class="titre4_anthracite" >
                <tr valign="middle" align="left">
                    <td height="32" colspan="2" >Observations </td>
                </tr>
                <tr valign="bottom" class="Style12">
                    <td height="81" colspan="2" ><TEXTAREA rows=5 cols=69 id="observations" name="observations"><?php echo $tab['observations'];?></TEXTAREA></td>
                </tr>
                    <td height="30" colspan="2" class="titre1_marron">
                    <input id="button" name="button" type="submit"  value=" VALIDATION "></td>
                </tr>
            </table>
            </form>
        </div>
	</td>
  </tr>
</table>
</body>
</html>
      
