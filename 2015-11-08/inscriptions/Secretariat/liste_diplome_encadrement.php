<?php
	session_start(); 
	include('include/fonction_php.php');
	include('../include/base/connexion_serveur.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <LINK rel=stylesheet type="text/css" href="../../total.css">
</head>
<body>
<table width="1200" border="0" align="center" bgcolor="#FFFFFF" >
    <tr>
        <td> <p align="center"><?php include('menu.html'); ?></p> </td>
    </tr>
    <tr>
        <td> <p align="center" class="titre2_marron">Liste des Diplômes d'encadrement </p><br></td>
    </tr>
    <tr>
        <td class="titre2_marron">Diplômes requis: <br></td>
    </tr>
    <tr>
    	<td>
            <table border="1" class="titre2_noir">
                <tr>
                    <td width="87" height="45">&nbsp;</td>
                    <td width="80"><div align="center">Max</div></td>
                    <td width="85"><div align="center">BAFD ou Stagiaire</div></td>
                    <td width="85"><div align="center">BAFA</div></td>
                    <td width="96"><div align="center">Stagiaire</div></td>
                    <td width="113"><div align="center">Sans Diplôme</div></td>
                    <td width="126" rowspan="3" valign="bottom"><div align="center">Animateurs</div></td>
                </tr>
                <tr>
					<? $total_collegien=$_SESSION['max_collegienne']+$_SESSION['max_collegien']; ?>
                    <td class="Style3">Collegien</td>
                    <td><div align="center"><? echo $total_collegien; ?></div></td>
                    <td rowspan="2"><div align="center">
						<? 
                        if (($total_collegien + $_SESSION['max_staff'])<=100 ) $bafd=1;
                        else $bafd=ceil(($total_collegien + $_SESSION['max_staff']-100)/50)+1;
                        echo $bafd;?></div></td>
                    <td><div align="center"><? $bafa_col=ceil($total_collegien/12*.5); echo $bafa_col;?></div></td>
                    <td><div align="center"><? $sans_col=floor($total_collegien/12*.2); $stag_col=ceil($total_collegien/12)-$bafa_col-$sans_col; echo $stag_col;?></div></td>
                    <td><div align="center"><? $anim_velo= ceil($total_collegien/6)-$bafa_col-$stag_col; echo $anim_velo;?></div></td>
                </tr>
                <tr>
                    <td>Staff </td>
                    <td><div align="center"><? echo $_SESSION['max_staff']; ?></div></td>
                    <td><div align="center"><? $bafa_staff=ceil($_SESSION['max_staff']/12*.5); echo $bafa_staff;?></div></td>
                    <td><div align="center"><? $sans_staff=floor($_SESSION['max_staff']/12*.2); $stag_staff=ceil($_SESSION['max_staff']/12)-$bafa_staff-$sans_staff; echo $stag_staff;?></div></td>
                    <td><div align="center"><? echo $sans_staff;?></div></td>
                </tr>
                <tr bgcolor="#FFFF66">
                    <td colspan="2" ><div align="right">Total</div></td>
                    <td><div align="center"><? echo ($bafd);?></div></td>
                    <td><div align="center"><? echo ($bafa_staff+$bafa_col);?></div></td>
                    <td><div align="center"><? echo ($stag_staff+$stag_col);?></div></td>
                    <td><div align="center"><? echo ($sans_staff+$anim_velo);?></div></td>
                    <td><div align="center"><? echo ($bafa_staff+$bafa_col+$stag_staff+$stag_col+$sans_staff+$anim_velo);?></div></td>
                </tr>
            </table>
        </td>            
    <tr>
        <td class="titre2_marron"> <br>Dipl&ocirc;m&eacute;s pr&eacute;sents: <br></td>
    </tr>
    <tr>
    	<td>
            <table border="1" class="titre2_noir">
                <tr>
                    <td width="137">&nbsp;</td>
                    <td width="65"><div align="center">BAFD</div></td>
                    <td width="105"><div align="center">Stagiaire BAFD </div></td>
                    <td width="83"><div align="center">BAFA</div></td>
                    <td width="84"><div align="center">Stagiaire BAFA </div></td>
                    <td width="125"><div align="center">Sans Diplôme </div></td>
                    <td width="75" bgcolor="#FFFF66"><div align="center">Total</div></td>
                </tr>
                    <?php
                      $titre_litteral = array("Animateurs", "ABS", "TTV","GGG","OGM");
                      $titre = array("animateur", "abs", "ttv","ggg","ogm");
                      $diplom=array("BAFD","BAFD","BAFA","BAFA","");
                      $stagiaire=array("0","1","0","1","0");
                        // ************************************************* Boucle pour la création des lignes  ****************************************************************
                      for($j=0;$j < 5;$j++) 
                      {	echo '<tr>'."\n";
                        echo '<td><div align="center">'.$titre_litteral[$j].'</div></td>'."\n";
                        $total=0;
                        // ************************************************* Boucle sur les diplomes  ****************************************************************
                        for($i=0;$i < 6;$i++) 
                        { 	// ******************************************   Calcul du nombre de diplome par cellule  ***************************
                            if ($i<>5)
                            {
                                if ($diplom[$i]=="BAFD")
									$or=' or (diplome_equivalence= "BAFD si exp" and attestation_encadrement="1")';
								elseif ($diplom[$i]=="BAFA")
									$or=' or (diplome_equivalence= "BAFD si exp" and attestation_encadrement="0")';
								
								$req="SELECT COUNT(*)  FROM `fiche` INNER JOIN diplome ON diplome_encadrement = index_diplome ".
									$_SESSION['where'] ." and `type`= '".$titre[$j]."' and (`diplome_equivalence`= '".$diplom[$i]."'".$or." ) and `stagiaire_encadrement`= '".$stagiaire[$i]."'  ";
                                $res = log_mysql_query($req , $mysql);
                                $resultat=mysql_fetch_array($res); 
                                echo  '<td><div align="center"><a href="liste_detail_diplome_encadrement.php?type='.$titre[$j].'&diplome='.$diplom[$i].'&stagiaire='.$stagiaire[$i].'"> '.$resultat[0].'</a>';
                                $total=$total+$resultat[0];
                                echo '</div></td>'."\n";
                            }
                            Else
                            {	if ($j==0)
                                {	echo  '<td bgcolor="#FFFF66"><div align="center">';
                                    echo $total;
                                    echo '</div></td>'."\n";
                                }
                            }
                        }
                        echo "</tr>";
                    }
                    // ************************************************* Calcul du total des diplomes  ****************************************************************
                    echo '<tr bgcolor="#FFFF66" class="Style3">'."\n";
                    echo '<td><div align="right">Total</div></td>'."\n";
                    $total=0;
                    for($i=0;$i < 4;$i++) 
                    { 	// ******************************************   Calcul du nombre de diplome par cellule  ***************************
						if ($diplom[$i]=="BAFD")
							$or=' or (diplome_equivalence= "BAFD si exp" and attestation_encadrement="1")';
						elseif ($diplom[$i]=="BAFA")
							$or=' or (diplome_equivalence= "BAFD si exp" and attestation_encadrement="0")';
						
						$req="SELECT COUNT(*)  FROM `fiche` INNER JOIN diplome ON diplome_encadrement = index_diplome ".
							$_SESSION['where'] ." and (`diplome_equivalence`= '".$diplom[$i]."'".$or." ) and `stagiaire_encadrement`= '".$stagiaire[$i]."'  ";
						$res = log_mysql_query($req , $mysql);
						$resultat=mysql_fetch_array($res); 
						echo  '<td><div align="center"><a href="liste_detail_diplome_encadrement.php?diplome='.$diplom[$i].'&stagiaire='.$stagiaire[$i].'"> '.$resultat[0].'</a>';
						$total=$total+$resultat[0];
						echo '</div></td>'."\n";
                    }
                    echo "</tr>";
		?>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
