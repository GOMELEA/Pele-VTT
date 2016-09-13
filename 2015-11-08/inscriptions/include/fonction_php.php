<?php
function NumTel($tel)
{
    $ch = 10;  // Numéro à 10 chiffres
    $tel = eregi_replace('[^0-9]',"",$tel); // supression sauf chiffres
    $tel = trim($tel);  // suppression espaces avant et après
    if (strlen($tel) > $ch)
    {
        $d = strlen($tel) - $ch; // retrouve la position pour ne garder que les $ch derniers si n°>10 chiffres
    }
    else
    {
        $d = 0;
    }
    $tel = substr($tel,$d,$ch); // récupération des $ch derniers chiffres
    $regex = '([0-9]{1,2})([0-9]{1,2})([0-9]{1,2})([0-9]{1,2})([0-9]{1,2})$';
    $newtel = eregi_replace($regex,
        '\\1-\\2-\\3-\\4-\\5',$tel); // mise en forme
    return $newtel; /* Exemple : 03-81-51-45-78  */
}
?>
