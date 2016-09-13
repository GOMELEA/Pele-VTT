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
<div align="center">
    <br>
  	<table border="0" class="Style12" >
		<tr align="left">
		  <td colspan="4" class="Style11" ><div align="center">Info sur les Pr&eacute;sences pendant le Camp </div></td>
      </tr>
		<tr align="left">
          <td align="right">Pr&eacute;sence<br>
          Staff </td>
          <td><TEXTAREA rows=10 cols=75 id="presence_staff" name="presence_staff"><?php echo ereg_replace('<br>','',$tab['presence_staff']);?> </TEXTAREA></td>
	      <td align="right">Pr&eacute;sence<br>
  ABS </td>
	      <td><TEXTAREA rows=10 cols=75 id="presence_abs" name="presence_abs"><?php echo ereg_replace('<br>','',$tab['presence_abs']);?> </TEXTAREA></td>
	  </tr>
		<tr align="left">
          <td align="right">Pr&eacute;sence<br>
          Animateur </td>
          <td><TEXTAREA rows=10 cols=75 id="presence_animateur" name="presence_animateur"><?php echo ereg_replace('<br>','',$tab['presence_animateur']);?> </TEXTAREA></td>
	      <td align="right">Pr&eacute;sence<br>
  TTV </td>
	      <td><TEXTAREA rows=10 cols=75 id="presence_ttv" name="presence_ttv"><?php echo ereg_replace('<br>','',$tab['presence_ttv']);?> </TEXTAREA></td>
	  </tr>
	  	  </tr>
		<tr align="left">
		  <td colspan="4" class="Style11" ><div align="left">Divers</div></td>
      </tr>
		<tr align="left">
          <td align="right">Soutien </td>
          <td><TEXTAREA rows=10 cols=75 id="soutien" name="soutien"><?php echo ereg_replace('<br>','',$tab['soutien']);?> </TEXTAREA></td>
	      <td align="right"></td>
	      <td></td>
	  </tr>

 </table>
<br></div>

</body>

</html>
