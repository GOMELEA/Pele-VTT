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
</style>
</head>

<body>
<table border="0" class="Style12" >
  <tr align="left">
    <td colspan="2" bgcolor="#FFFFCC" class="Style11" ><div align="center">Donn&eacute;es Administratives </div></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFFFCC">Nom de l'Association </td>
    <td bgcolor="#FFFFCC"><input id="nom_association" name="nom_association" size="60" maxlength="60" type="text" value="<?php echo $tab['nom_association'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFFFCC">Adresse </td>
    <td bgcolor="#FFFFCC"><TEXTAREA rows=4 cols=40 id="adresse_association" name="adresse_association"><?php echo $tab['adresse_association'];?></TEXTAREA></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFFFCC">N° Siret </td>
    <td bgcolor="#FFFFCC"><input id="siret_association" name="siret_association" size="60" maxlength="60" type="text" value="<?php echo $tab['siret_association'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFFFCC">N° Organisateur DDCS </td>
    <td bgcolor="#FFFFCC"><input id="n_organisateur_DDCS" name="n_organisateur_DDCS" size="60" maxlength="60" type="text" value="<?php echo $tab['n_organisateur_DDCS'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFFFCC">N° Camp DDCS </td>
    <td bgcolor="#FFFFCC"><input id="n_camp_DDCS" name="n_camp_DDCS" size="60" maxlength="60" type="text" value="<?php echo $tab['n_camp_DDCS'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFFFCC">Signature et Tampon de L'OGM<BR> 8*8 cm 300 dpi<br> format .jpg</td>
    <td bgcolor="#FFFFCC">
    <input type = "file" name = "signature_ogm" size="50">
    <input type = "hidden" name="MAX_FILE_SIZE2" value="20000">
    <br> 		
    <?php echo ' <img src="../data/'.formatage_repertoire($tab['departement']).'/'.$tab['annee'].'/signature_ogm.jpg" width="200" >' ?></td>
  </tr>
  <tr align="left">
    <td colspan="2" align="right" bgcolor="#FFFFCC" class="Style14"><div align="center">Internet - Courriel </div></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFFFCC">Adresse site Internet </td>
    <td bgcolor="#FFFFCC"><input id="url_site" name="url_site" size="60" maxlength="100" type="text" value="<?php echo $tab['url_site'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFFFCC">Adresse page Facebook </td>
    <td bgcolor="#FFFFCC"><input id="url_facebook" name="url_facebook" size="60" maxlength="150" type="text" value="<?php echo $tab['url_facebook'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFFFCC">Adresse Twitter </td>
    <td bgcolor="#FFFFCC"><input id="url_twitter" name="url_twitter" size="60" maxlength="150" type="text" value="<?php echo $tab['url_twitter'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFFFCC">Courriel Exp&eacute;diteur </td>
    <td bgcolor="#FFFFCC"><input id="courriel_expediteur" name="courriel_expediteur" size="60" maxlength="60" type="text" value="<?php echo $tab['courriel_expediteur'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFFFCC">Courriel de Copie </td>
    <td bgcolor="#FFFFCC"><input id="courriel_copie" name="courriel_copie" size="60" maxlength="60" type="text" value="<?php echo $tab['courriel_copie'];?>"></td>
  </tr>
  <tr align="left">
    <td colspan="2" align="right" bgcolor="#FFFFCC" class="Style14"><div align="center">Compte Bancaire </div></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFFFCC">Nom du Compte </td>
    <td bgcolor="#FFFFCC"><input id="nom_compte_bancaire" name="nom_compte_bancaire" size="60" maxlength="60" type="text" value="<?php echo $tab['nom_compte_bancaire'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFFFCC">N&deg; du Compte </td>
    <td bgcolor="#FFFFCC"><input id="n_compte_bancaire" name="n_compte_bancaire" size="60" maxlength="60" type="text" value="<?php echo $tab['n_compte_bancaire'];?>"></td>
  </tr>
  <tr align="left">
    <td colspan="2" align="right" bgcolor="#FFFFCC" class="Style14"><div align="center">R&eacute;glement</div></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFFFCC">Ordre r&eacute;glement des ch&egrave;ques </td>
    <td bgcolor="#FFFFCC"><input id="ordre_reglement" name="ordre_reglement" size="40" maxlength="40" type="text" value="<?php echo $tab['ordre_reglement'];?>"></td>
  </tr>
  <tr align="left">
    <td rowspan="3" align="right" bgcolor="#FFFFCC">Coordonn&eacute;es<br> 
    pour le r&eacute;glement </td>
    <td rowspan="3" bgcolor="#FFFFCC"><textarea rows=4 cols=40 id="adresse_reglement" name="adresse_reglement"><?php echo stripslashes($tab['adresse_reglement']);?></textarea></td>
  </tr>
  <tr align="left"> </tr>
  <tr align="left"> </tr>
  <tr align="left">
    <td bgcolor="#FFFFCC"><div align="right">Mode de Paiement Accept&eacute;s </div></td>
    <td bgcolor="#FFFFCC"><TEXTAREA rows=4 cols=40 id="paiement_accepte" name="paiement_accepte"><?php echo $tab['paiement_accepte'];?></TEXTAREA></td>
  </tr>
  <tr align="left">
    <td colspan="2" align="right" bgcolor="#FFFFCC" class="Style14"><div align="center">Tarifs (&euro;) </div></td>
  </tr>
  <tr align="left">
    <td bgcolor="#FFFFCC"><div align="right">1 Enfant </div></td>
    <td bgcolor="#FFFFCC"><div align="left">
      <input id="tarif_1enf" name="tarif_1enf" size="3" maxlength="3" type="text" value="<?php echo $tab['tarif_1enf'];?>">
    </div></td>
  </tr>
  <tr align="left">
    <td bgcolor="#FFFFCC"><div align="right">2 Enfant </div></td>
    <td bgcolor="#FFFFCC"><div align="left">
      <input id="tarif_2enf" name="tarif_2enf" size="3" maxlength="3" type="text" value="<?php echo $tab['tarif_2enf'];?>">
    </div></td>
  </tr>
  <tr align="left">
    <td bgcolor="#FFFFCC"><div align="right">3 Enfant </div></td>
    <td bgcolor="#FFFFCC"><div align="left">
      <input id="tarif_3enf" name="tarif_3enf" size="3" maxlength="3" type="text" value="<?php echo $tab['tarif_3enf'];?>">
    </div></td>
  </tr>
  <tr align="left">
    <td bgcolor="#FFFFCC"><div align="right">Enfant Suppl&eacute;mentaire </div></td>
    <td bgcolor="#FFFFCC"><div align="left">
      <input id="tarif_enf_sup" name="tarif_enf_sup" size="3" maxlength="3" type="text" value="<?php echo $tab['tarif_enf_sup'];?>">
    </div></td>
  </tr>
  <tr align="left">
    <td bgcolor="#FFFFCC"><div align="right">Animateur </div></td>
    <td bgcolor="#FFFFCC"><div align="left">
      <input id="tarif_anim" name="tarif_anim" size="3" maxlength="3" type="text" value="<?php echo $tab['tarif_anim'];?>">
    </div></td>
  </tr>
  <tr align="left">
    <td bgcolor="#FFFFCC"><div align="right">TTV</div></td>
    <td bgcolor="#FFFFCC"><div align="left">
      <input id="tarif_ttv" name="tarif_ttv" size="3" maxlength="3" type="text" value="<?php echo $tab['tarif_ttv'];?>">
    </div></td>
  </tr>
  <tr align="left">
    <td bgcolor="#FFFFCC"><div align="right">ABS</div></td>
    <td bgcolor="#FFFFCC"><div align="left">
      <input id="tarif_abs" name="tarif_abs" size="3" maxlength="3" type="text" value="<?php echo $tab['tarif_abs'];?>">
    </div></td>
  </tr>
  <tr align="left">
    <td bgcolor="#FFFFCC"><div align="right">dont Cotisation Asso </div></td>
    <td bgcolor="#FFFFCC"><div align="left">
      <input id="tarif_asso" name="tarif_asso" size="3" maxlength="3" type="text" value="<?php echo $tab['tarif_asso'];?>">
    </div></td>
  </tr>
</table>
</body>

</html>
