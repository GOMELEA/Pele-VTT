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
    <td colspan="2" bgcolor="#CCFFFF" class="Style11" >Lieux</td>
  </tr>
  <tr align="left">
    <td width="77" align="right" bgcolor="#CCFFFF"><div align="right">D&eacute;partement (Nom) </div></td>
    <td width="343" bgcolor="#CCFFFF"><input id="departement" name="departement" size="40" maxlength="40" type="text" value="<?php echo $tab['departement'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#CCFFFF">D&eacute;partement ( Num&eacute;ro) </td>
    <td bgcolor="#CCFFFF"><input id="n_departement" name="n_departement" size="6" maxlength="6" type="text" value="<?php echo $tab['n_departement'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#CCFFFF">D&eacute;partement (Logo)</td>
    <td bgcolor="#CCFFFF">
      <input type = "file" name = "logo_departement" size="40">
      <input type = "hidden" name="MAX_FILE_SIZE2" value="20000">
      <br>
      <?php echo ' <img src="../Photo/'.$tab['departement'].'.jpg" width="200" >' ?></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#CCFFFF">Lieu de D&eacute;part </td>
    <td bgcolor="#CCFFFF"><input id="lieu_depart" name="lieu_depart" size="40" maxlength="40" type="text" value="<?php echo $tab['lieu_depart'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#CCFFFF">Lieu d'Arriv&eacute;e </td>
    <td bgcolor="#CCFFFF"><input id="lieu_arrive" name="lieu_arrive" size="40" maxlength="40" type="text" value="<?php echo $tab['lieu_arrive'];?>"></td>
  </tr>
  <tr align="left">
    <td colspan="2" align="right" bgcolor="#CCFFFF" class="Style14"><div align="center">Couchages (d&egrave;s le pr&eacute;-camp)</div></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#CCFFFF">1ere Nuit</td>
    <td bgcolor="#CCFFFF"><input id="couchage_j1" name="couchage_j1" size="40" maxlength="40" type="text" value="<?php echo $tab['couchage_j1'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#CCFFFF">2&egrave;me Nuit</td>
    <td bgcolor="#CCFFFF"><input id="couchage_j2" name="couchage_j2" size="40" maxlength="40" type="text" value="<?php echo $tab['couchage_j2'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#CCFFFF">3&egrave;me Nuit</td>
    <td bgcolor="#CCFFFF"><input id="couchage_j3" name="couchage_j3" size="40" maxlength="40" type="text" value="<?php echo $tab['couchage_j3'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#CCFFFF">4&egrave;me Nuit</td>
    <td bgcolor="#CCFFFF"><input id="couchage_j4" name="couchage_j4" size="40" maxlength="40" type="text" value="<?php echo $tab['couchage_j4'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#CCFFFF">5&egrave;me Nuit</td>
    <td bgcolor="#CCFFFF"><input id="couchage_j5" name="couchage_j5" size="40" maxlength="40" type="text" value="<?php echo $tab['couchage_j5'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#CCFFFF">6&egrave;me Nuit</td>
    <td bgcolor="#CCFFFF"><input id="couchage_j6" name="couchage_j6" size="40" maxlength="40" type="text" value="<?php echo $tab['couchage_j6'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#CCFFFF">7&egrave;me Nuit</td>
    <td bgcolor="#CCFFFF"><input id="couchage_j7" name="couchage_j7" size="40" maxlength="40" type="text" value="<?php echo $tab['couchage_j7'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#CCFFFF">8&egrave;me Nuit</td>
    <td bgcolor="#CCFFFF"><input id="couchage_j8" name="couchage_j8" size="40" maxlength="40" type="text" value="<?php echo $tab['couchage_j8'];?>"></td>
  </tr>
</table>
<table border="0" class="Style12" bgcolor="#CCCCCC" >
  <tr align="left">
    <td colspan="2" class="Style11" >Infos Inscription</td>
  </tr>
  <tr align="left">
    <td width="116" align="right" ><div align="right">Infos Diverses Inscription</div></td>
    <td width="283" ><TEXTAREA rows=15 cols=40 id="accueil_info_diverses" name="accueil_info_diverses"><?php echo ereg_replace('<br>','',$tab['accueil_info_diverses']);?> </TEXTAREA></td>
  </tr>
  <tr align="left">
    <td width="116" align="right" ><div align="right">Intention de Prières pour les Carnet de prières (max 250 caractères)</div></td>
    <td width="283" ><TEXTAREA rows=15 cols=40 id="intention_priere" name="intention_priere" maxlength="250"><?php echo ereg_replace('<br>','',$tab['intention_priere']);?> </TEXTAREA></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>

</html>
