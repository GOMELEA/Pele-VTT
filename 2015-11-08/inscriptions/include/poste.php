<div align="center">
    <table width="960" align="center"  cellspacing="0"  class="titre4_anthracite" >
        <tr align="left">
            <td width="967" class="titre1_marron" >Poste pendant le p&eacute;l&eacute; </td>
        </tr>
    </table>
  	<table width="960" border="0" class="titre4_anthracite" >
		<tr  align="left">
            <td><input id="parcours" name="parcours" value=1 <?php if ($tab['parcours']!=0) echo "checked=\"checked\"";?> type="checkbox"> 
            Parcours 
            <input id="intendance" name="intendance" value=1 <?php if ($tab['intendance']!=0) echo "checked=\"checked\"";?> type="checkbox"> 
            Intendance 
            <input id="velo" name="velo" value=1 <?php if ($tab['velo']!=0) echo "checked=\"checked\"";?> type="checkbox">
            R&eacute;paration V&eacute;lo 
            <input id="media" name="media" value=1 <?php if ($tab['media']!=0) echo "checked=\"checked\"";?> type="checkbox">
            Multi-M&eacute;dia 
            <input id="infirmerie" name="infirmerie" value=1 <?php if ($tab['infirmerie']!=0) echo "checked=\"checked\"";?> type="checkbox">
            Infirmerie 
            <input id="secretariat" name="secretariat" value=1 <?php if ($tab['secretariat']!=0) echo "checked=\"checked\"";?> type="checkbox">
            Secr&eacute;tariat 
            <input id="technique" name="technique" value=1 <?php if ($tab['technique']!=0) echo "checked=\"checked\"";?> type="checkbox">
            Technique
            <input id="priere" name="priere" value=1 <?php if ($tab['priere']!=0) echo "checked=\"checked\"";?> type="checkbox">
            Amicale Prière</td>
        </tr>
  </table>
</div>
