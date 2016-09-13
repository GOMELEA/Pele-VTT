<?php
# Supprime l'utilisateur sélectionné par la variable $index_mdp (dans l'url) 
$req = "SELECT * FROM mdp WHERE `index_mdp`=".$index_mdp;
$res =    log_mysql_query($req, $mysql );
$tabres = mysql_fetch_array ($res);

$req_inscription="DELETE FROM  `mdp` WHERE `index_mdp`=".$index_mdp;
$res_insertion =    log_mysql_query($req_inscription  , $mysql );

if ( $res_insertion == 1)
{
	delUser($tabres['login']);
	if ($tabres['autorisation']=="admin") delUser_admin($tabres['login']);
}
else
{
   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
}



?>
