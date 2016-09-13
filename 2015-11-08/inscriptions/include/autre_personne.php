<div align="center">
    <table width="960" align="center"  cellspacing="0"  class="titre4_anthracite" >
        <tr valign="middle" align="left">
            <td width="960"><p><span class="titre1_marron"> Autre Personne <br />
            </span><span class="titre2_noir">J'autorise la personne suivante &agrave; prendre en charge mon enfant en cas d'urgence</span></p></td>
        </tr>
    </table>
</div>
<div align="center">
    <table width="960" align="center"  cellspacing="0"  class="titre4_anthracite" >
        <tr valign="bottom" align="left">
            <td height="20" ></td>
            <td width="150" height="20" >Titre</td>
            <td width="11" height="20" ></td>
            <td width="176" height="20" >Nom</td>
            <td width="2"></td>
            <td width="195" colspan="2">Pr&eacute;nom</td>
            <td width="240"><div align="center"></div></td>
            <td width="253"></td>
        </tr>
        <tr valign="bottom" align="left" >
            <td height="20" ></td>
            <td height="20" ><select size="1" id="titre_autre" name="titre_autre" value="<?php echo $tab['titre_autre'];?>">
              <option value="<?php echo $tab['titre_autre'];?>"  selected="selected" ><?php echo $tab['titre_autre'];?></option>
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
            <td height="20" colspan="2" ><input id="nom_autre" name="nom_autre" size="30" type="text" onChange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['nom_autre'];?>" ></td>
            <td></td>
            <td><input id="prenom_autre" name="prenom_autre" size="30" type="text"  value="<?php echo $tab['prenom_autre'];?>"></td>
            <td><div align="center">
            </div></td>
            <td></td>
        </tr>
		<tr align="left">
            <td colspan="3">N&deg; de T&eacute;l&eacute;phone </td>
            <td colspan="2">N&deg; de Mobile 1 </td>
            <td colspan="3">N&deg; de Mobile 2 </td>
		</tr>
		<tr  align="left">
            <td colspan="3"><input id="telephone_autre" name="telephone_autre" size="15" maxlength="15" type="text" value="<?php echo $tab['telephone_autre'];?>"></td>
            <td colspan="2"><input id="tel_mobile_autre" name="tel_mobile_autre" size="15" maxlength="15" type="text" value="<?php echo $tab['tel_mobile_autre'];?>"></td>
            <td colspan="2"><input id="tel_mobile_autre2" name="tel_mobile_autre2" size="15" maxlength="15" type="text" value="<?php echo $tab['tel_mobile_autre2'];?>"></td>
		</tr>
    </table>
</div>
