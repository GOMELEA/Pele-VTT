<div align="center">
    <table width="960" align="center"  cellspacing="0"  class="titre4_anthracite" >
        <tr valign="bottom" align="left">
            <td height="20" ></td>
            <td width="90" height="20" >Titre</td>
            <td width="11" height="20" ></td>
            <td width="176" height="20" >Nom</td>
            <td width="2"></td>
            <td width="195" colspan="2">Pr&eacute;nom</td>
            <td width="240"><div align="center"></div></td>
            <td width="253"></td>
        </tr>
        <tr valign="bottom" align="left" >
            <td height="20" ></td>
            <td height="20" ><select size="1" id="titre_resp" name="titre_resp" value="<?php echo $tab['titre_resp'];?>">
              <option value="<?php echo $tab['titre_resp'];?>"  selected="selected" ><?php echo $tab['titre_resp'];?></option>
              <option value="Sans_titre"></option>
              <option value="Monsieur">Monsieur</option>
              <option value="Madame">Madame</option>
              <option value="Mademoiselle">Mlle</option>
              <option value="Frere">Fr&egrave;re</option>
              <option value="Pere">P&egrave;re</option>
              <option value="Soeur">Soeur</option>
              <option value="Mgr">Mgr</option>
            </select></td>
            <td height="20" ></td>
            <td height="20" colspan="2" ><input id="nom_resp" name="nom_resp" size="30" type="text" onChange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['nom_resp'];?>" onBlur="valider_adresse_inscrit();"></td>
            <td></td>
            <td><input id="prenom_resp" name="prenom_resp" size="30" type="text"  value="<?php echo $tab['prenom_resp'];?>"></td>
            <td><div align="center">
            </div></td>
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
            <td><input id="adresse_1_resp" name="adresse_1_resp" size="40" maxlength="40" type="text" value="<?php echo $tab['adresse_1_resp'];?>"></td>
            <td></td>
            <td><input id="adresse_2_resp" name="adresse_2_resp" size="40" maxlength="40" type="text" value="<?php echo $tab['adresse_2_resp'];?>"></td>
            <td colspan="2"><input id="adresse_3_resp" name="adresse_3_resp" size="40" maxlength="40" type="text" value="<?php echo $tab['adresse_3_resp'];?>"></td>
	    </tr>
		<tr align="left">
            <td colspan="2">Ville</td>
            <td colspan="2">Code Postal </td>
            <td colspan="2"></td>
		</tr>
		<tr align="left">
            <td></td>
            <td><input id="ville_resp" name="ville_resp" size="26" maxlength="26" type="text" onChange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['ville_resp'];?>" onBlur="valider_adresse_inscrit();"></td>
            <td></td>
            <td><input id="cdpostal_resp" name="cdpostal_resp" size="8" maxlength="10" type="text" value="<?php echo $tab['cdpostal_resp'];?>"></td>
            <td></td>
            <td></td>
		</tr>
		<tr align="left">
            <td colspan="2">Courriel</td>
            <td colspan="2">N&deg; de T&eacute;l&eacute;phone </td>
            <td>N&deg; de Mobile 1 </td>
            <td>N&deg; de Mobile 2 </td>
		</tr>
		<tr  align="left">
            <td></td>
            <td><input id="courriel_resp" name="courriel_resp" size="42" maxlength="50" type="text" value="<?php echo $tab['courriel_resp'];?>"></td>
            <td></td>
            <td><input id="telephone_resp" name="telephone_resp" size="15" maxlength="15" type="text" value="<?php echo $tab['telephone_resp'];?>"></td>
            <td><input id="tel_mobile_resp" name="tel_mobile_resp" size="15" maxlength="15" type="text" value="<?php echo $tab['tel_mobile_resp'];?>"></td>
            <td><input id="tel_mobile_resp2" name="tel_mobile_resp2" size="15" maxlength="15" type="text" value="<?php echo $tab['tel_mobile_resp2'];?>"></td>
		</tr>
    </table>
</div>
