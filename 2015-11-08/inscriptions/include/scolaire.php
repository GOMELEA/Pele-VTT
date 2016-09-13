<div align="center">
    <table width="960" border="0" class="titre4_anthracite" >
		<tr align="left">
            <td colspan="2">Etablissement Scolaire (nom et ville) </td>
            <td colspan="2">Classe pendant l'ann&eacute;e <?php echo ($_SESSION['annee']-1).'-'.$_SESSION['annee'] ?> </td>
            <td colspan="2">&nbsp;</td>
		</tr>
		<tr align="left">
            <td width="3">&nbsp;</td>
            <td width="419"><input id="etablissement_scolaire" name="etablissement_scolaire" size="60" maxlength="60" type="text" value="<?php echo $tab['etablissement_scolaire'];?>"></td>
            <td width="14">&nbsp;</td>
            <td width="471"><input id="classe" name="classe" size="10" maxlength="10" type="text" value="<?php echo $tab['classe'];?>"></td>
            <td width="11">&nbsp;</td>
            <td width="16">&nbsp;</td>
		</tr>
    </table>
</div>
