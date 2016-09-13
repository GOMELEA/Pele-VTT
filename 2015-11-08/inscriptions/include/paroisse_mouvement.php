<div align="center">
    <table width="960" border="0" class="titre4_anthracite" >
		<tr align="left">
            <td height="31" colspan="3"><div align="left"><strong>Informations facultatives </strong></div></td>
        </tr>
		<tr align="left">
            <td colspan="2">Paroisse fr&eacute;quent&eacute;e (nom et ville) </td>
            <td>Mouvements fr&eacute;quent&eacute;s </td>
	    </tr>
		<tr align="left">
            <td width="3">&nbsp;</td>
            <td width="374"><input id="paroisse" name="paroisse" size="70" maxlength="80" type="text" value="<?php echo $tab['paroisse'];?>"></td>
            <td><input id="mouvements" name="mouvements" size="70" maxlength="80" type="text" value="<?php echo $tab['mouvements'];?>"></td>
	    </tr>
		<?php if ($_SESSION['instrument_ok']==1)
		echo '<tr align="left">
		  <td colspan="2">Instrument de musique apport&eacute; au camp</td>
		  <td>&nbsp; </td>
	    </tr>
		<tr align="left">
		  <td width="3">&nbsp;</td>
		  <td width="374"><input id="instrument" name="instrument" size="50" maxlength="50" type="text" value="'.$tab['instrument'].'"></td>
		  <td>&nbsp;</td>
		</tr>'
		?>
    </table>
</div>
