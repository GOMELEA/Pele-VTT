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
</style>
</head>

<body>
<div align="center">
<br>
<table width="414" border="0" class="Style12" >
    <tr align="left" valign="middle" height="40" >
        <td align="center" class="Style11 " <?php if ($inscription['complete']!=0) echo 'bgcolor="#33CC00"'; else echo 'bgcolor="#FFCC00"'?>><a href="secretariat_inscription.php?Selection=<?php echo $inscription['index_inscription']; ?>&go=Afficher"><img src="../Photo/loupe.gif" width="30" border="0" title="Affichage de l'inscription"></a></td>
        <td colspan="4" align="center" class="Style11 " <?php if ($inscription['corbeille']=="oui") echo 'bgcolor="#000000"';elseif ($inscription['complete']!=0) echo 'bgcolor="#33CC00"'; else echo 'bgcolor="#FFCC00"'?>>Inscription N&deg;
      <input id="index_inscription" name="index_inscription" size="5" type="text"  value="<?php echo $inscription['index_inscription'];?>"></td>
    </tr>
</table>
  
</div>

</body>

</html>
