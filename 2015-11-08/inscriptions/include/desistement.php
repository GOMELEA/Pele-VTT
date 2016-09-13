<!-- Page proposant de rentrer son code confidentiel pour profiter d'une place disponible -->
<form  name="formSaisie" method="post" action="inscription.php?<? echo "type=".$type."&sexe=".$sexe;?>&faire=place_dispo" >
<table width="400" align="center"  cellspacing="0" class="titre4_anthracite">
    <tr align="left">
        <td height="44"  colspan="4" align="center" class="titre1_marron" >Place disponible</td>
    </tr>
    <tr align="left">
        <td ></td>
        <td colspan="3" align="center" class="titre3_anthracite"><p>Vous avez &eacute;t&eacute; inform&eacute; par courriel d'un d&eacute;sistement.<br />
        Sur ce courriel se trouve un code confidentiel. <br />
        Merci de le saisir en respectant les minuscules et majuscules<br />
        <br /><strong><p style="background-color:#C00; color:#FFF ; font-size:16px";> <? if ($_SESSION['code_confidentiel_OK']==false) echo "<br>".$_SESSION['reessayer_code']."<br><br>"; ?></p></strong>
        <br />
        </td>
    </tr>
    <tr valign="bottom" align="left" >
        <td width="4" height="20" ></td>
        <td width="32" ></td>
        <td width="20" height="20" ></td>
        <td width="384" height="20" >Code Confidentiel : </td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td width="32" ></td>
        <td height="20" ></td>
        <td height="20" ><input id="code_confidentiel" name="code_confidentiel" size="30" type="text" /></td>
    </tr>
    <tr valign="bottom" align="center" >
        <td height="30" colspan="4" class="titre1_marron"><p>Validez <span class="titre3_marron">en appuyant sur le bouton : </span>
        <input id="button" name="button" type="submit"  value=" VALIDATION ">
        <br><br>
        </td>
    </tr>
</table>
</form>

