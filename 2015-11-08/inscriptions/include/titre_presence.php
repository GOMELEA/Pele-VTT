<div align="center">
    <table width="960" align="center"  cellspacing="0"  class="titre4_anthracite" >
        <tr align="left">
            <td width="967" class="titre1_marron" >Pr&eacute;sence lors du p&eacute;l&eacute; <span class="titre3_marron">(&agrave; cocher)</span></td>
        </tr>
        <tr align="left">
            <td class="titre3_anthracite" ><strong>Voici quelques indications:</strong><br>
            <?php echo ereg_replace(chr(13),'<br>',$_SESSION['presence_'.$type]);?>  <br><br></td>
        </tr>
    </table>
</div>