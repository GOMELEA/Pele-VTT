<?php
function stripslashes_deep($value)
{
    $value = is_array($value) ?
                array_map('stripslashes_deep', $value) :
                stripslashes($value);

    return $value;
}
function getJour($day) 
{
$jour["Monday"] = "Lundi";
$jour["Tuesday"] = "Mardi";
$jour["Wednesday"] = "Mercredi";
$jour["Thursday"] = "Jeudi";
$jour["Friday"] = "Vendredi";
$jour["Saturday"] = "Samedi";
$jour["Sunday"] = "Dimanche";
return $jour[$day];
}

function getMois($month)
{
$mois["January"] = "Janvier";
$mois["February"] = "Février";
$mois["March"] = "Mars";
$mois["April"] = "Avril";
$mois["May"] = "Mai";
$mois["June"] = "Juin";
$mois["July"] = "Juillet";
$mois["August"] = "Août";
$mois["September"] = "Septembre";
$mois["October"] = "Octobre";
$mois["November"] = "Novembre";
$mois["December"] = "Décembre";

return $mois[$month];
}


function NumTel($tel)
{
    $ch = 10;  // Numéro à 10 chiffres
	$tel = preg_replace('@[^0-9]@i',"",$tel); // supression sauf chiffres
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
function convdate($date1)
{
	$d1 = explode("-", $date1);
	$date2 = date("d-m-Y",mktime(0,0,0, $d1[1], $d1[2], $d1[0]));
	return $date2;
}
function convdate_litteral($date1)
{
	$d1 = explode("-", $date1);
	$d2 = explode(":", $date1);
	$d2[0]=substr($d2[0], -2);
	$date1_mk=mktime($d2[0],$d2[1],$d2[2], $d1[1], $d1[2], $d1[0]);
	$date2 = getJour(date("l",$date1_mk))." ".date("j",$date1_mk)." ".getMois(date("F",$date1_mk))." à ".date("G",$date1_mk)."h".date("i",$date1_mk)." " ;
	return $date2;
}
function maketime($d) { 

  $jour = substr($d,8,2)."/";        // jour 
  $mois = substr($d,5,2)."/";  // mois 
  $anne = substr($d,0,4). " "; // année 
  if (strlen ($d)>10)
  {
	  $heure = substr($d,11,2);     // heures 
	  $minutes = substr($d,14,2);     // minutes 
	  $secondes = substr($d,17,2);     // secondes 
  }
  else $heure=$minutes=$secondes=0;

  $date2 = mktime($heure,$minutes,$secondes, $mois, $jour, $anne);
  return $date2;
} 
function date_fran($date1)
{
  $mois = array("Janv", "Fev", "Mars",
                "Avril","Mai", "Juin", 
                "Juill", "Août","Sept",
                "Oct", "Nov", "Dec");
  $jours= array("Dim", "Lundi", "Mardi",
                "Merc", "Jeudi", "Vend",
                "Sam");
  return $jours[date("w",$date1)]." ".date("j",$date1)." ".$mois[date("n",$date1)-1];
}
function date_fran_jour($date1)
{
  $jours= array("Dim", "Lun", "Mar",
                "Mer", "Jeu", "Ven",
                "Sam");
  return $jours[date("w",$date1)]." ".date("j",$date1);
}
function OterAccents($chaine)
{
	return( strtr( $chaine,
	"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
	"AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn" ) );
} 
function formatage_nom_de_fichier($string) 
{
    $charset = 'iso-8859-1';
	$string = str_replace(' ','',OterAccents($string));
	$string = htmlspecialchars_decode($string);
    $string = iconv($charset, 'ASCII//TRANSLIT', $string);
    $string = preg_replace('/[^A-Za-z0-9]+/', '-', $string);
    $string = trim($string, '-');
    $string = mb_strtolower($string);

    return $string;
} 
function formatage_repertoire($string) 
{
    $charset = 'iso-8859-1';
	$string = str_replace(' ','_',OterAccents($string));
	$string = htmlspecialchars_decode($string);
    $string = iconv($charset, 'ASCII//TRANSLIT', $string);
    $string = preg_replace('/[^A-Za-z0-9]+/', '_', $string);
    $string = trim($string, '-');
    $string = mb_strtoupper($string);

    return $string;
} 

function sauvegarde($nom_fichier,$extension_demande,$nom_de_sauvegarde,$taille_max)
{
	if(!empty($_FILES[$nom_fichier]['tmp_name']) AND is_uploaded_file($_FILES[$nom_fichier]['tmp_name']))
	{//On va vérifier la taille du fichier en ne passant pas par $_FILES['fichier_source']['size'] pour éviter les failles de sécurité
		if(filesize($_FILES[$nom_fichier]['tmp_name'])<$taille_max)
		{//On vérifie maintenant le type de l'image à l'aide de la fonction getimagesize()
			$the_file_name = $_FILES[$nom_fichier]['name'];
			$extension = substr ($the_file_name,-4,4);
			//Si le Type est JPEG (correspond au chiffre 2) on copie l'image
			$extension=strtolower($extension);
			if($extension===$extension_demande)
			{//Copie le fichier dans le répertoire de destination
				if(move_uploaded_file($_FILES[$nom_fichier]['tmp_name'], $nom_de_sauvegarde))
				{//Le fichier a été uploadé correctement
				}
				else
				{//Erreur
				echo 'Erreur lors de la copie du fichier';
				}
			}
			else
			{ echo '****** !!!!!!! ERREUR Le fichier '.$_FILES[$nom_fichier]['name'].' n est pas un fichier '.$extension_demande.'  !!!!!!! ******';
			}
		}
		else
		{ echo '****** !!!!!!! ERREUR Le fichier '.$_FILES[$nom_fichier]['name'].' est trop gros !!!!!!! il est supérieur à '.$taille_max.' octets ******';
		}
	}
	$_FILES['$nom_fichier'] = array(); 
}
function sauvegarde_photo_carnet($nom_fichier,$extension_demande,$nom_de_sauvegarde)
{
	if(!empty($_FILES[$nom_fichier]['tmp_name']) AND is_uploaded_file($_FILES[$nom_fichier]['tmp_name']))
	{//On va vérifier la taille du fichier en ne passant pas par $_FILES['fichier_source']['size'] pour éviter les failles de sécurité
		if(filesize($_FILES[$nom_fichier]['tmp_name'])>1000000)
		{//On vérifie maintenant le type de l'image à l'aide de la fonction getimagesize()
			$the_file_name = $_FILES[$nom_fichier]['name'];
			$extension = substr ($the_file_name,-4,4);
			//Si le Type est JPEG (correspond au chiffre 2) on copie l'image
			$extension=strtolower($extension);
			if($extension===$extension_demande)
			{//Copie le fichier dans le répertoire de destination
				if(move_uploaded_file($_FILES[$nom_fichier]['tmp_name'], $nom_de_sauvegarde))
				{//Le fichier a été uploadé correctement
				}
				else
				{//Erreur
				echo 'Erreur lors de la copie du fichier';
				}
			}
			else
			{ echo '****** !!!!!!! ERREUR Le fichier '.$_FILES[$nom_fichier]['name'].' n est pas un fichier '.$extension_demande.'  !!!!!!! ******';
			}
		}
		else
		{ echo '****** !!!!!!! ERREUR Le fichier '.$_FILES[$nom_fichier]['name'].' est de trop mauvaise qualité <1 Mo !!!!!!! ******';
		}
	}
	$_FILES['$nom_fichier'] = array(); 
}
function age($naiss)  
{
  list($annee, $mois, $jour) = split('[-.]', $naiss);
  $today['mois'] = date('n');
  $today['jour'] = date('j');
  $today['annee'] = date('Y');
  $annees = $today['annee'] - $annee;
  if ($today['mois'] <= $mois) {
    if ($mois == $today['mois']) {
      if ($jour > $today['jour'])
        $annees--;
      }
    else
      $annees--;
    }
  echo $annees;
}
function log_mysql_query($req , $mysql)
{
	if ($_SERVER["REMOTE_USER"]<>"")
		$nom_fichier="/var/www/Jemca/www.pele-vtt.fr/inscriptions/data/_Log/".date("Y-m-d")."-".$_SERVER["REMOTE_USER"]."-"."Diff.sql";
	else 
		$nom_fichier="/var/www/Jemca/www.pele-vtt.fr/inscriptions/data/_Log/".date("Y-m-d")."-".$_SERVER["REMOTE_ADDR"]."-"."Diff.sql";
		
	$fichierDiff = fopen($nom_fichier, "a");
	$log="/*".date("G:i")."|".$_SERVER['PHP_SELF']."|"."*/".$req."\n";
	fwrite($fichierDiff, $log);
	fclose($fichierDiff);
	if (eregi("SELECT",$req))
		{}
	else
		{
			$nom_fichier="/var/www/Jemca/www.pele-vtt.fr/inscriptions/data/_SaveSQL/".date("Y-m-d")."-Diff.sql";
			$fichierDiff = fopen($nom_fichier, "a");
			$log="/*".date("G:i")."-".$_SERVER["REMOTE_USER"]."-".$_SERVER["REMOTE_ADDR"]."*/".$req."\n";
			fwrite($fichierDiff, $log);
			fclose($fichierDiff);
		}
	return mysql_query($req , $mysql);

}
?>

