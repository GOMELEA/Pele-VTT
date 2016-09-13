<div align="center">
    <table width="960" align="center"  cellspacing="0"  class="titre4_anthracite" >
        <tr align="left">
            <td width="967" class="titre1_marron" >Droit &agrave; l'image <span class="titre3_marron">(&agrave; cocher)</span>       </td>
        </tr>
    </table>
  	<table width="960" border="0" class="titre4_anthracite" >
		<tr align="left">
              <td><input id="droit_image" name="droit_image" value="1" <?php if ($tab['droit_image']=="1") echo "checked=\"checked\"";?>  type="checkbox"> 
                <span class="titre3_anthracite">J'autorise la diffusion des images  qui pourraient &ecirc;tre prises de moi pendant le camp, sur tout support &eacute;dit&eacute; par l'association  dans le cadre du p&eacute;l&eacute; VTT</span>
                <p>Conform&eacute;ment &agrave; la loi Informatique et Libert&eacute;s en date du 6 janvier 1978, vous disposez par ailleurs d'un droit d'acc&egrave;s, de rectification, de modification et de suppression concernant les donn&eacute;es qui vous concernent. Vous pouvez exercer ce droit en nous contactant par courriel <?php echo $_SESSION['courriel_expediteur'] ?> </p>		    </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
		</tr>
    </table>
</div>
