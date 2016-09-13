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
.Style15 {font-size: 18px}
</style>
</head>

<body>
<div align="center">
    <br>
  	<table width="414" border="0" class="Style12" >
		<tr align="left">
		  <td colspan="3" align="right" class="Style11 Style14"><div align="center" class="Style15">En cas d'urgence</div></td>
	  	</tr>
		<tr align="left">
		  <td colspan="3">
	        <select size="1" id="titre_autre" name="titre_autre" >
              <option value="<?php echo $tab['titre_autre'];?>"  selected="selected" ><?php echo $tab['titre_autre'];?></option>
              <option value="Sans_titre"></option>
              <option value="Monsieur">Monsieur</option>
              <option value="Madame">Madame</option>
              <option value="Mademoiselle">Mlle</option>
              <option value="Frere">Fr&egrave;re</option>
              <option value="Pere">P&egrave;re</option>
              <option value="Soeur">Soeur</option>
              <option value="Mgr">Mgr</option>
            </select>
	        <input id="nom_autre" name="nom_autre" size="21" type="text" onChange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['nom_autre'];?>">
	     	<input id="prenom_autre" name="prenom_autre" size="21" type="text" value="<?php echo $tab['prenom_autre'];?>">
          </td>
	  </tr>
		<tr  align="left" valign="middle" bgcolor="#FFFF99">
		  <td height=30 align="right">Tel:	      </td>
	      <td ><input id="telephone_autre" name="telephone_autre" size="15" maxlength="15" type="text" value="<?php echo $tab['telephone_autre'];?>">
           </td>
	      <td >
Mobile 1:
  <input id="tel_mobile_autre" name="tel_mobile_autre" size="15" maxlength="15" type="text" value="<?php echo $tab['tel_mobile_autre'];?>"></td>
	  </tr>
		<tr  align="left">
    		<td colspan="2"></td>	    
		  <td height=30  bgcolor="#FFFF99">Mobile 2:
            <input id="tel_mobile_autre2" name="tel_mobile_autre2" size="15" maxlength="15" type="text" value="<?php echo $tab['tel_mobile_autre2'];?>"></td>
	  </tr>
  </table>
</div>

</div>
 
</body>

</html>
