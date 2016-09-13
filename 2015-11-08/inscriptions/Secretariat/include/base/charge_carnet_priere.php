<?php
# Gère la sauvegarde sur la base Mysql de la fiche d'inscription

# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     REQUETE SELECT            XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
$req = "SELECT * FROM carnet_priere WHERE `index_photo`=".$index_photo;
$res =    log_mysql_query($req, $mysql );
$tabres = mysql_fetch_array ($res);
$tabres=stripslashes_deep($tabres);


$tab1['index_photo']=$tabres['index_photo'];
$tab1['route_index']=$tabres['route_index'];
$tab1['chemin_photo']=$tabres['chemin_photo'];
$tab1['texte_priere']=$tabres['texte_priere'];
$tab1['ref_priere']=$tabres['ref_priere'];
?>
