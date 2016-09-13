<div align="center">
    <form  name="formRecherche" method="post" action="inscription.php?type=<? echo $type;?>&sexe=<? echo $sexe;?>&faire=recherche">
    <table width="960" align="center"  cellspacing="0" class="titre4_anthracite">
    	<tr align="left">
        	<td  colspan="10" class="titre1_marron" >Je recherche ma fiche de l'ann&eacute;e derni&egrave;re</td>
      	</tr>
      	<tr valign="bottom" align="left" >
            <td width="2" height="20" ></td>
            <td width="88" height="20" >&nbsp;</td>
            <td width="10" height="20" ></td>
            <td height="20" colspan="2" >Nom de Famille (Uniquement)</td>
            <td></td>
            <td>Code Confidentiel<br>(vous a &eacute;t&eacute; envoy&eacute; par courriel)</td>
            <td colspan="2" rowspan="2"><input id="button_recherche" name="button_recherche" type="submit"  value=" Je cherche "></td>
            <td width="129"></td>
        </tr>
        <tr valign="bottom" align="left" >
            <td height="20" ></td>
            <td height="20" >&nbsp;</td>
            <td height="20" ></td>
            <td height="20" colspan="2" ><input id="nom_recherche" name="nom_recherche" size="30" type="text" onchange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['nom_usage'];?>"></td>
            <td width="6"></td>
            <td width="234"><input id="code_recherche" name="code_recherche" size="30" type="text" value="<?php echo $tab['code_recherche'];?>"></td>
            <td width="129"></td>
        </tr>
        <tr valign="bottom" align="left" >
          <td height="20" ></td>
          <td height="20" colspan="9" >&nbsp;</td>
        </tr>
	</table>
    </form>
</div>
