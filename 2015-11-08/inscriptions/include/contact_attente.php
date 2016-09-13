<!-- Page proposant de s'inscrire sur une liste d'attente -->
<form  name="formSaisie" method="post" action="inscription_pelevtt.php?faire=sauver_attente" onsubmit="return control_contact_attente()" >
<input id="type_attente"  name="type_attente" value="<?php echo $type; ?>" type="hidden">
<table width="450" align="center"  cellspacing="0" class="titre4_anthracite">
    <tr align="left">
        <td height="44"  colspan="6" align="center" class="titre1_marron" >Liste d'attente</td>
    </tr>
    <tr align="left">
        <td ></td>
        <td></td>
        <td colspan="4" align="center" class="titre3_anthracite" ><p>D&eacute;sol&eacute;, mais il n'y a <strong> plus de place disponible.</strong> <br />
        N&eacute;anmoins, nous aurons probablement des d&eacute;sistements <br />
        et nous serons heureux de vous en faire profiter,<br />
        si vous nous laissez vos coordonn&eacute;es</p>
        </td>
    </tr>
    <tr align="left">
        <td  colspan="6" class="titre1_marron" >Coordonn&eacute;es de l'inscrit </td>
    </tr>
    <tr valign="bottom" align="left" >
        <td width="2" height="20" ></td>
        <td width="88" >Sexe</td>
        <td width="10" height="20" ></td>
        <td height="20" >Nom</td>
        <td></td>
        <td>Pr&eacute;nom</td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td width="88" ><?php if ($tab['sexe']=="") $tab['sexe']=$sexe;?>
            <select size="1" id="sexe_attente" name="sexe_attente" >
                      <option value="<?php echo $tab['sexe'];?>"  selected="selected" ><?php echo $tab['sexe'];?> </option>
                      <option value="F">F</option>
                      <option value="H">H</option>
            </select>
        </td>
        <td height="20" ></td>
        <td height="20" ><input id="nom_attente" name="nom_attente" size="30" type="text" onchange="javascript:this.value=this.value.toUpperCase();" /></td>
        <td width="6"></td>
        <td width="234"><input id="prenom_attente" name="prenom_attente" size="30" type="text" /></td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ></td>
        <td height="20" ></td>
        <td height="20" >Code Postal </td>
        <td></td>
        <td>Ville</td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ></td>
        <td height="20" ></td>
        <td height="20" ><input id="cdpostal_attente" name="cdpostal_attente" size="8" maxlength="10" type="text" /></td>
        <td></td>
        <td><input id="ville_attente" name="ville_attente" size="26" maxlength="26" type="text"  onchange="javascript:this.value=this.value.toUpperCase();" /></td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" colspan="6" ><span class="titre1_marron">Coordonn&eacute;es </span><span class="titre3_marron">pour vous avertir d'une place disponible<br />
        <span class="titre3_anthracite">(Vous serez contact&eacute; principalement par courriel)</span></span></td>
    </tr>
    <tr valign="bottom" align="left" >
        <td width="2" height="20" ></td>
        <td width="88" >Titre</td>
        <td width="10" height="20" ></td>
        <td height="20" >Nom</td>
        <td></td>
        <td>Pr&eacute;nom</td>
    </tr>
     <tr valign="bottom" align="left" >
       <td height="20" ></td>
       <td ><select size="1" id="titre_resp_attente" name="titre_resp_attente" >
         <option value="Monsieur">Monsieur</option>
         <option value="Madame">Madame</option>
         <option value="Mademoiselle">Mlle</option>
         <option value="Frere">Fr&egrave;re</option>
         <option value="Pere">P&egrave;re</option>
         <option value="Soeur">Soeur</option>
         <option value="Mgr">Mgr</option>
       </select></td>
       <td height="20" ></td>
       <td height="20" ><input id="nom_resp_attente" name="nom_resp_attente" size="30" type="text" onchange="javascript:this.value=this.value.toUpperCase();" /></td>
       <td></td>
       <td><input id="prenom_resp_attente" name="prenom_resp_attente" size="30" type="text" /></td>
     </tr>
     <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ></td>
        <td height="20" ></td>
        <td height="20" >Courriel 1 </td>
        <td></td>
        <td></td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ></td>
        <td height="20" ></td>
        <td height="20" colspan="3" ><input id="courriel1_attente" name="courriel1_attente" size="60" maxlength="100" type="text" /></td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ></td>
        <td height="20" ></td>
        <td height="20" >Courriel 2</td>
        <td></td>
        <td></td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ></td>
        <td height="20" ></td>
        <td height="20" colspan="3" ><input id="courriel2_attente" name="courriel2_attente" size="60" maxlength="100" type="text" /></td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ></td>
        <td height="20" ></td>
        <td height="20" >N&deg; de T&eacute;l&eacute;phone </td>
        <td></td>
        <td>N&deg; de Mobile </td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ></td>
        <td height="20" ></td>
        <td height="20" ><input id="telephone_attente" name="telephone_attente" size="15" maxlength="15" type="text" /></td>
        <td></td>
        <td><input id="tel_mobile_attente" name="tel_mobile_attente" size="15" maxlength="15" type="text" /></td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" colspan="6" class="titre1_marron" >Observations</td>
    </tr>
    <tr valign="bottom" align="left" >
        <td height="20" ></td>
        <td ></td>
        <td height="20" ></td>
        <td height="20" colspan="3" ><p>
        <textarea rows="5" cols="50" id="observation_attente" name="observation_attente"> </textarea>
        </p></td>
    </tr>
    <tr valign="bottom" align="center" >
        <td height="30" colspan="6" class="titre1_marron"><p>Validez <span class="titre3_marron">cette inscription sur liste d'attente<br />
		en appuyant sur le bouton : </span>
            <input id="button" name="button" type="submit"  value=" VALIDATION ">
        <br />
        <br />
        <span class="titre3_anthracite">Un courriel automatique de confirmation va vous etre envoy&eacute;<br />
        N'oubliez pas de v&eacute;rifier !!!
        </span>
        <p></td>
    </tr>
</table>
</form>
