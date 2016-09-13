<?php
# Supprime la photo sélectionnée par la variable $index_photo (dans l'url) 
$req_inscription="DELETE FROM  `carnet_priere` WHERE `index_photo`=".$index_photo;
$res_insertion =    log_mysql_query($req_inscription  , $mysql );

if ( $res_insertion <> 1)
{
   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
}
?>
