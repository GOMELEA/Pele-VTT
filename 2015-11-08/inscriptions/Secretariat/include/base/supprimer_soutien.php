<?php
# Supprime la fiche de soutien sélectionnée par la variable $index (dans l'url) 
$req_inscription="DELETE FROM  `soutien` WHERE `index_soutien`=".$index;
$res_insertion =    log_mysql_query($req_inscription  , $mysql );


if ( $res_insertion <> 1)
{
   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
}
?>
