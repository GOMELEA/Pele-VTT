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
    <td colspan="3" bgcolor="#FFCCFF" class="Style11" ><div align="left">Dates</div></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFCCFF">Route Publique</td>
    <td colspan="2" bgcolor="#FFCCFF"><input id="route_publique" name="route_publique" value="1" <?php if ($tab['route_publique']=="1") echo "checked=\"checked\"";?>  type="checkbox"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFCCFF">Ann&eacute;e</td>
    <td colspan="2" bgcolor="#FFCCFF"><input id="annee" name="annee" size="4" maxlength="4" type="text" value="<?php echo $tab['annee'];?>"></td>
  </tr>
  <tr align="left">
    <td colspan="3" align="right" bgcolor="#FFCCFF"><div align="center"><span class="Style14">Jour et Heure </span><br>
&agrave; mettre au format AAAA-MM-JJ hh:mm:ss<br>
        ex: 2010-12-31 14:30:00 </div></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFCCFF">D&eacute;but Pre-camp</td>
    <td colspan="2" bgcolor="#FFCCFF"><input id="jour_debut_precamp" name="jour_debut_precamp" size="16" maxlength="19" type="text" value="<?php echo $tab['jour_debut_precamp'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFCCFF">D&eacute;but camp</td>
    <td colspan="2" bgcolor="#FFCCFF"><input id="jour_debut_camp" name="jour_debut_camp" size="16" maxlength="19" type="text" value="<?php echo $tab['jour_debut_camp'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFCCFF" >Fin camp</td>
    <td colspan="2" bgcolor="#FFCCFF" class="Style14"><input id="jour_fin_camp" name="jour_fin_camp" size="16" maxlength="19" type="text" value="<?php echo $tab['jour_fin_camp'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFCCFF">Fin Post-camp</td>
    <td colspan="2"  bgcolor="#FFCCFF"><input id="jour_fin_postcamp" name="jour_fin_postcamp" size="16" maxlength="19" type="text" value="<?php echo $tab['jour_fin_postcamp'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right" bgcolor="#FFCCFF">Ouverture Inscriptions </td>
    <td colspan="2"  bgcolor="#FFCCFF"><input id="debut_inscription" name="debut_inscription" size="16" maxlength="19" type="text" value="<?php echo $tab['debut_inscription'];?>"></td>
  </tr>
  <tr align="left">
    <td align="right">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr align="left">
    <td align="right" class="Style11"><div align="left">Limites</div></td>
    <td align="right">&nbsp;</td>
    <td align="center">For&ccedil;age Liste <br>
    d'Attente</td>
  </tr>
  <tr align="left">
    <td align="right">Max Coll&eacute;gien </td>
    <td><input id="max_collegien" name="max_collegien" size="3" maxlength="3" type="text" value="<?php echo $tab['max_collegien'];?>"></td>
    <td align="center"><input id="forcage_collegien_attente" name="forcage_collegien_attente" value="1" <?php if ($tab['forcage_collegien_attente']=="1") echo "checked=\"checked\"";?>  type="checkbox"></td>
  </tr>
  <tr align="left">
    <td align="right">Max Coll&eacute;gienne </td>
    <td><input id="max_collegienne" name="max_collegienne" size="3" maxlength="3" type="text" value="<?php echo $tab['max_collegienne'];?>"></td>
    <td align="center"><input id="forcage_collegienne_attente" name="forcage_collegienne_attente" value="1" <?php if ($tab['forcage_collegienne_attente']=="1") echo "checked=\"checked\"";?>  type="checkbox"></td>
  </tr>
  <tr align="left">
    <td align="right">Max Staff </td>
    <td><input id="max_staff" name="max_staff" size="2" maxlength="2" type="text" value="<?php echo $tab['max_staff'];?>"></td>
    <td align="center"><input id="forcage_staff_attente" name="forcage_staff_attente" value="1" <?php if ($tab['forcage_staff_attente']=="1") echo "checked=\"checked\"";?>  type="checkbox"></td>
  </tr>
  <tr align="left">
    <td align="right" class="Style11"><div align="left">DVD</div></td>
    <td colspan="2" align="right">&nbsp;</td>
  </tr>
  <tr align="left">
    <td align="right">Cout (&euro;)<br>
      si=0 --&gt; pas de DVD </td>
    <td colspan="2"><input id="cout_dvd" name="cout_dvd" size="2" maxlength="2" type="text" value="<?php echo $tab['cout_dvd'];?>"></td>
  </tr>
  <tr align="left">
    <td colspan="3" align="right"><div align="center">Texte de présentation du DVD : <br>
        <input id="dvd_text" name="dvd_text" size="40" maxlength="100" type="text" value="<?php echo $tab['dvd_text'];?>">
    </div></td>
  </tr>
  <tr align="left">
    <td align="right">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr align="left">
    <td align="right" class="Style11"><div align="left">Instruments</div></td>
    <td colspan="2" align="right">&nbsp;</td>
  </tr>
  <tr align="left">
    <td align="right">Apport&eacute;s par coll&eacute;gien <br>
    ou staff </td>
    <td colspan="2"><input id="instrument_ok" name="instrument_ok" value="1" <?php if ($tab['instrument_ok']=="1") echo "checked=\"checked\"";?>  type="checkbox"> </td>
  </tr>
  <tr align="left">
    <td align="right">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr align="left">
    <td align="right">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr align="left">
    <td align="right">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>

</html>
