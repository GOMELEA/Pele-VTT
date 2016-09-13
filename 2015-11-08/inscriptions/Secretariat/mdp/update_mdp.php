<?php
# Gère la sauvegarde sur la base Mysql de la fiche d'inscription

# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     REQUETE SELECT            XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
$req = "SELECT * FROM mdp WHERE `index_mdp`=".$index_mdp;
$res =    log_mysql_query($req, $mysql );
$tabres = mysql_fetch_array ($res);

if ($tabres['autorisation']=="lecture")
{
	$tab['N_depart_lecture']=$tabres['n_departement'];
	$tab['login_lecture']=$tabres['login'];
	$tab['mdp_lecture']=$tabres['mdp'];
}

if ($tabres['autorisation']=="secretariat")
{
	$tab['N_depart_secretariat']=$tabres['n_departement'];
	$tab['login_secretariat']=$tabres['login'];
	$tab['mdp_secretariat']=$tabres['mdp'];
}
if ($tabres['autorisation']=="admin")
{
	$tab['login_admin']=$tabres['login'];
	$tab['mdp_admin']=$tabres['mdp'];
}
if ( $res_insertion == 1)
?>
