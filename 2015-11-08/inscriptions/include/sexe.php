<?php 

If ($type=="collegien") 
{
	if($tab['sexe']<>"") $sexe=$tab['sexe'];
	echo '
	<select size="1" id="sexe" name="sexe" disabled="disabled">
			  <option value="'.$sexe.'"  selected="selected" >'.$sexe.'</option>
			  <option value="F">F</option>
			  <option value="H">H</option>
	</select>';
	echo '<input id="sexe" name="sexe" type="hidden" value ="'.$sexe.'" >';
}
else
{	
	echo '
	<select size="1" id="sexe" name="sexe">
			  <option value="'.$tab['sexe'].'"  selected="selected" >'.$tab['sexe'].'</option>
			  <option value="F">F</option>
			  <option value="H">H</option>
	</select>';
}

