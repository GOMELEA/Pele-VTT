<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<style type="text/css">
.Style12 {
	font-family: Verdana;
	font-size: 10px;
	position: relative;
	color: #333333;
	background-color: #EEEEEE;
}
.Style11 {
	font-family: Verdana;
	font-size: 18px;
	position: relative;
	color: #967236;
	font-weight: bold;
}
.Style14 {font-size: 16px}
.Style15 {font-size: 18px}
</style>
</head>

<body>
<div align="center">
    <br>
  	<table width="370" border="0" class="Style12" >
		<tr align="left">
		  <td colspan="3" align="right" class="Style11 Style14"><div align="center" class="Style15">Responsable</div></td>
	  </tr>
		<tr align="left">
		  <td align="right">&nbsp;</td>
		  <td colspan="2"><div align="right">
	        <select size="1" id="titre_resp" name="titre_resp" >
              <option value="<?php echo $tab['titre_resp'];?>"  selected="selected" ><?php echo $tab['titre_resp'];?></option>
              <option value="Sans_titre"></option>
              <option value="Monsieur">Monsieur</option>
              <option value="Madame">Madame</option>
              <option value="Mademoiselle">Mlle</option>
              <option value="Frere">Fr&egrave;re</option>
              <option value="Pere">P&egrave;re</option>
              <option value="Soeur">Soeur</option>
              <option value="Mgr">Mgr</option>
            </select>
	        <input id="nom_resp" name="nom_resp" size="30" type="text" onChange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['nom_resp'];?>">
	      </div></td>
	  </tr>
		<tr align="left">
		  <td align="right">&nbsp;</td>
		  <td colspan="2">	      <div align="right">
		    <input id="prenom_resp" name="prenom_resp" size="30" type="text" value="<?php echo $tab['prenom_resp'];?>">
	      </div></td>
	  </tr>
		<tr align="left">
		  <td align="right">Adresse</td>
		  <td colspan="2"><input id="adresse_1_resp" name="adresse_1_resp" size="40" maxlength="40" type="text" value="<?php echo $tab['adresse_1_resp'];?>"></td>
	    </tr>
		<tr align="left">
		  <td align="right">&nbsp;</td>
          <td colspan="2"><input id="adresse_2_resp" name="adresse_2_resp" size="40" maxlength="40" type="text" value="<?php echo $tab['adresse_2_resp'];?>"></td>
      </tr>
		<tr align="left">
		  <td align="right">&nbsp;</td>
          <td colspan="2"><input id="adresse_3_resp" name="adresse_3_resp" size="40" maxlength="40" type="text" value="<?php echo $tab['adresse_3_resp'];?>"></td>
      </tr>
		<tr align="left">
		  <td align="right">Ville</td>
		  <td colspan="2"><input id="ville_resp" name="ville_resp" size="26" maxlength="26" type="text"  onChange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['ville_resp'];?>">
	      <input id="cdpostal_resp" name="cdpostal_resp" size="8" maxlength="10" type="text" value="<?php echo $tab['cdpostal_resp'];?>"></td>
	    </tr>
		<tr  align="left">
		  <td align="right">Courriel</td>
		  <td colspan="2"><input id="courriel_resp" name="courriel_resp" size="42" maxlength="50" type="text" value="<?php echo $tab['courriel_resp'];?>"></td>
	    </tr>
		<tr  align="left" valign="middle" bgcolor="#FFFF99">
		  <td height="36" align="right">Tel:	      </td>
	      <td colspan="2"><input id="telephone_resp" name="telephone_resp" size="15" maxlength="15" type="text" value="<?php echo $tab['telephone_resp'];?>">
Mobile 1:
  <input id="tel_mobile_resp" name="tel_mobile_resp" size="15" maxlength="15" type="text" value="<?php echo $tab['tel_mobile_resp'];?>"></td>
	  </tr>
		<tr  align="left">
		  <td align="right">Lien</td>
		  <td> <input id="lien_personne" name="lien_personne" size="13" maxlength="40" type="text" value="<?php echo $tab['lien_personne'].'"'; if ($type=="collegien" or $type=="staff") echo 'disabled="disabled"';?>"> </td>
	      <td bgcolor="#FFFF99">Mobile 2:
            <input id="tel_mobile_resp2" name="tel_mobile_resp2" size="15" maxlength="15" type="text" value="<?php echo $tab['tel_mobile_resp2'];?>"></td>
	  </tr>
  </table>
</div>

</div>
 
</body>

</html>
