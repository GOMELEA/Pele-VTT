<div align="center">
    <table width="960" border="0" class="titre4_anthracite" >
		<tr align="left">
            <td colspan="2">Diplome M&eacute;dical</td>
            <td colspan="2">Permis de conduire valides, autres que le permis B  </td>
            <td colspan="2"></td>
		</tr>
		<tr  align="left">
            <td width="6">&nbsp;</td>
            <td width="194"><select size="1" id="diplome_medical" name="diplome_medical" >
                <option value="<?php echo $tab['diplome_medical'];?>"  selected="selected" ><?php echo $tab['diplome_medical'];?></option>
                <option value="Docteur">Docteur</option>
                <option value="Infirmière">Infirmiere</option>
                <option value="Kiné">Kine</option>
                <option value=""></option>
                </select></td>
            <td width="14">&nbsp;</td>
            <td width="282"><input id="permis" name="permis" size="42" maxlength="40" type="text" value="<?php echo $tab['permis'];?>"></td>
            <td colspan="2"></td>
	    </tr>
    </table>
</div>
