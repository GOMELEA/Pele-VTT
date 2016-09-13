<link rel="stylesheet" type="text/css" href="../ext/jquery/jquery-ui.css">
<link rel="stylesheet" href="../styles/suggestion.css" />
<script src="../ext/jquery/jquery.min.js"></script>
<script src="../ext/jquery/jquery-ui.min.js"></script>
<script>
function lookup(ville_naissance) {
	if (ville_naissance.length == 0) {
		// Hide the suggestion box.
		$('#suggestions').hide();
	} else {
		$.post("./include/contact.ajax.php", {
			queryString : "" + ville_naissance + ""
		}, function(data) {
			if (data.length > 0) {
				$('#suggestions').show();
				$('#autoSuggestionsList').html(data);
			}
		});
	}
} // lookup

function fillCommune(thisCom) {
	$('#ville_naissance').val(thisCom);
}
function fillDept(thisDept) {
	$('#dep_naissance').val(thisDept);
}
function hide() {
	setTimeout("$('#suggestions').hide();", 200);
}
</script>
<div align="center" style="position: relative; z-index: 100;">
    <table width="960" align="center"  cellspacing="0" class="titre4_anthracite">
    	<tr align="left">
        	<td  colspan="10" class="titre1_marron" >Coordonn&eacute;es de l'inscrit      </td>
      	</tr>
      	<tr valign="bottom" align="left" >
            <td width="2" height="20" ></td>
            <td width="88" height="20" >Titre</td>
            <td width="10" height="20" ></td>
            <td height="20" colspan="2">Nom d'usage</td>
            <td width="234"><?php if ($type<>"collegien" and $type<>"staff" ) echo"Nom de jeune Fille " ?></td>
            <td colspan ="2">Nom civil (si diff&eacute;rent de nom d&apos;usage)</td>
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
            <td height="20" colspan="2" ><input id="nom_usage" name="nom_usage" size="30" type="text" onchange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['nom_usage'];?>"></td>
            
			<td><div align="left"> <?php if ($type<>"collegien" and $type<>"staff" ) 
            echo '<input id="nom_jeune_fille2" name="nom_jeune_fille" size="30" type="text" onChange="javascript:this.value=this.value.toUpperCase();" value="'.$tab['nom_jeune_fille'].'">' ?>     
            </div></td>
			
			<td colspan="2"><input id="nom_civil" name="nom_civil" size="30" type="text" onchange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['nom_civil'];?>"></td>
           
            <td></td>
            <td></td>
        </tr>
		
		<tr valign="bottom" align="left" >
            <td width="2"  ></td>
            <td width="88"  ></td>
            <td width="10"  ></td>
            <td  colspan="2">Pr&eacute;nom</td>
            <td width="234"></td>
            <td></td><td width="129"></td>
        </tr>
		<tr>
		    <td></td>
            <td></td>
			<td></td>
			<td width="234"><input id="prenom" name="prenom" size="30" type="text" value="<?php echo $tab['prenom'];?>"></td>
            <td></td>
            <td></td>
            <td></td>
		</tr>
		<tr valign="bottom" align="left" >
            <td width="2"  ></td>
            <td width="88"  ></td>
            <td width="10"  ></td>
            <td colspan="2">Taille du T-Shirt</td>
            <td width="234"></td>
            <td></td><td width="129"></td>
        </tr>
		<tr>
		    <td></td>
            <td></td>
			<td></td>
			<td width="234" ><select size="1" id="taille_teeshirt" name="taille_teeshirt" >
				<option value="<?php echo $tab['taille_teeshirt'];?>"  selected="selected" ><?php echo $tab['taille_teeshirt'];?></option>
				<option value="S">S</option>
				<option value="M">M</option>
				<option value="L">L</option>
				<option value="XL">XL</option>
				<option value="XXL">XXL</option>
				</select>
			</td>
            <td></td>
            <td></td>
            <td></td>
		</tr>
      	<tr valign="bottom" align="left" >
            <td height="20" ></td>
            <td height="20" ><?php if ($type<>"ttv" and $type<>"abs" and $type<>"ggg" and $type<>"ogm") echo"Sexe:";  ?>
            <div align="center"></div></td>
            <td height="20" ></td>
            <td height="20" colspan="2" ><div align="center">Date de Naissance <br>(jj/mm/aaaa) : </div></td>
            
            <td>Lieu de naissance : </td>
            <td>Departement Naissance</td>
            <td></td>
            <td></td>
      	</tr>
        <tr valign="bottom" align="left" >
            <td height="20" ></td>
            <td height="20" ><div align="center"><?php if ($type<>"ttv" and $type<>"abs"  and $type<>"ogm" and $type<>"ggg") include('include/sexe.php'); ?>
            </div></td>
            <td height="20" ></td>
            <td height="20" colspan="2" ><div align="center">
              <input id="j_nai_1"  name="j_nai_1" size="1" maxlength="2" type="text" value="<?php echo substr($tab['date_naissance'],8,2);?>">
              <input id="m_nai_1" name="m_nai_1" size="1" maxlength="2" type="text" value="<?php echo substr($tab['date_naissance'],5,2);?>">
              <input id="a_nai_1" name="a_nai_1" size="4" maxlength="4" type="text" onBlur="Ctrl_date();" value="<?php echo substr($tab['date_naissance'],0,4);?>">
            </div></td>
            <td>
			
			<input id="ville_naissance" name="ville_naissance" size="26" maxlength="26" type="text" value="<?php echo $tab['ville_naissance'];?>" onkeyup="lookup(this.value);" onblur="hide();">
			
			<div class="suggestionsBox" id="suggestions" style="display: none;">
			<img src="../images/upArrow.png" style="position: relative; top: -12px; left: 20px;" alt="upArrow" />
			<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
			</div>
			
			</td>

            <td height="20" >
				<input id="dep_naissance" name="dep_naissance" type="text" size="30" value="<?php echo $tab['dep_naissance'];?>">
			</td>
			<td></td>
            <td></td>
		</tr>
        <tr height="10" ></tr>
	</table>
    <?php if ($type<>"collegien" & $type<>"staff") echo'
  	<table width="960" border="0" cellspacing="0" class="titre4_anthracite" border-color="#999999">
		<tr align="left">
            <td colspan="2" rowspan="2" align="center" valign="middle" bgcolor="#999999">Renseignements n&eacute;cessaires <br />
            en cas de naissance &agrave; l\'&eacute;tranger</td>
            <td colspan="2" bgcolor="#999999">Nom du Père </td>
            <td colspan="2" bgcolor="#999999">Prénom du Père </td>
		</tr>
		<tr align="left">
            <td bgcolor="#999999"></td>
            <td bgcolor="#999999"><input id="nom_pere" name="nom_pere" size="40" maxlength="40" type="text" value="'.$tab['nom_pere'].'"></td>
            <td bgcolor="#999999"></td>
            <td bgcolor="#999999"><input id="prenom_pere" name="prenom_pere" size="40" maxlength="40" type="text" value="'.$tab['prenom_pere'].'"></td>
		</tr>
		<tr align="left">
            <td colspan="2" bgcolor="#999999">Pays de Naissance</td>
            <td colspan="2" bgcolor="#999999">Nom de jeune fille de la Mère </td>
            <td colspan="2" bgcolor="#999999">Prénom de la Mère </td>
		</tr>
		<tr align="left">
            <td bgcolor="#999999"></td>
            <td bgcolor="#999999"><input id="pays_naissance" name="pays_naissance" size="40" maxlength="40" type="text" value="'.$tab['pays_naissance'].'"></td>
            <td bgcolor="#999999"></td>
            <td bgcolor="#999999"><input id="nom_mere" name="nom_mere" size="40" maxlength="40" type="text" value="'.$tab['nom_mere'].'"></td>
            <td bgcolor="#999999"></td>
            <td bgcolor="#999999"><input id="prenom_mere" name="prenom_mere" size="40" maxlength="40" type="text" value="'.$tab['prenom_mere'].'"></td>
		</tr>
	</table>';
	?>
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
            <td colspan="2"></td>
		</tr>
		<tr align="left">
            <td></td>
            <td><input id="ville" name="ville" size="26" maxlength="26" type="text"  onchange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['ville'];?>"></td>
            <td></td>
            <td><input id="cdpostal" name="cdpostal" size="8" maxlength="10" type="text" value="<?php echo $tab['cdpostal'];?>"></td>
            <td></td>
            <td></td>
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
</div>
