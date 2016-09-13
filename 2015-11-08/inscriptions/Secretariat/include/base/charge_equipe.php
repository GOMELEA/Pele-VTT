<?php
# Gère la sauvegarde sur la base Mysql de la fiche d'inscription

# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     REQUETE SELECT            XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
$req = "SELECT * FROM equipe WHERE `index_equipe`=".$index_equipe;
$res =    log_mysql_query($req, $mysql );
$tabres = mysql_fetch_array ($res);
$tabres=stripslashes_deep($tabres);


$tab['index_equipe']=$tabres['index_equipe'];
$tab['route_index']=$tabres['route_index'];
$tab['numero_equipe']=$tabres['numero_equipe'];
$tab['nom_equipe']=$tabres['nom_equipe'];
$tab['foulard']=$tabres['foulard'];
$tab['tente']=$tabres['tente'];
$tab['sous_camp']=$tabres['sous_camp'];
$tab['image_foulard']=$tabres['image_foulard'];
?>
