<?php
	session_start(); 
	$Selection = $_GET["Selection"];
	$go = $_GET["go"];
	if ($_SESSION['index_route']=="" and $Selection=="") header("Location: http://www.pele-vtt.fr/inscriptions/Secretariat/index.php\n\n"); 
	include('include/fonction_php.php');
	include('include/log_url.php');     
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <LINK rel=stylesheet type="text/css" href="../../total.css">
</head>
<body>

<?php
include('../include/base/connexion_serveur.php');
?>
<table width="1200" border="0" align="center" bgcolor="#FFFFFF" >
    <tr>
        <td> <p align="center"><?php include('menu.html'); ?></p> </td>
    </tr>
    <tr>
        <td> <p align="center" class="titre2_marron">Statistiques Staff: </p></td>
    </tr>
    <tr>
        <td><p class="titre2_marron">R&eacute;partition des Staffs : </p></td>
    </tr>
    <tr>
        <td>
            <table border="1" class="titre2_noir">
                <tr>
                    <td width="100"><div align="center">Classe</div></td>
                    <td width="110" colspan="2"><div align="center">3 ème</div></td>
                    <td width="110" colspan="2"><div align="center">2 nd</div></td>
                    <td width="110" colspan="2"><div align="center">1 ère</div></td>
                    <td width="110" colspan="2"><div align="center">Term</div></td>
                    <td width="110" colspan="2"><div align="center">PostBac</div></td>
               </tr>
                	<?php
						// Calcul Nb total de fille et de garçons
						$req="select count(*) FROM `fiche` WHERE type = 'staff' and sexe='H' ".$_SESSION['and'] ;
						$res = log_mysql_query($req , $mysql);
						$resultat=mysql_fetch_array($res); 
						$nbcol_H=$resultat[0];
						$req="select count(*) FROM `fiche` WHERE type = 'staff' and sexe='F' ".$_SESSION['and'] ;
						$res = log_mysql_query($req , $mysql);
						$resultat=mysql_fetch_array($res); 
						$nbcol_F=$resultat[0];

						$classe = array("3ème","2nd", "1ère","Term","PostBac");
		  				$sexe = array("H", "F");
						// Boucle sur le sexe
						for($s=0;$s < 2;$s++) 
						{
							echo '<tr> <td><div align="center">'.$sexe[$s].'</div></td>';
							// Boucle sur la classe
							for($c=0;$c < 5;$c++) 
							{
								$req="select count(*) FROM `fiche` WHERE type = 'staff' and sexe ='".$sexe[$s]."' and classe='".$classe[$c]."' " .$_SESSION['and'] ;
								$res = log_mysql_query($req , $mysql);
								$resultat=mysql_fetch_array($res); 
								$total=$s.".".$c;
								${$total}=$resultat[0];
								if ($resultat[0]>0)
								{
								   echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.$resultat[0].'</div></td>';
								   if ($sexe[$s]=="F") echo '<td class="titre3_anthracite"><div align="center">'.round(($resultat[0]*100)/$nbcol_F).'%</div></td>';
								   if ($sexe[$s]=="H") echo '<td class="titre3_anthracite"><div align="center">'.round(($resultat[0]*100)/$nbcol_H).'%</div></td>';
								}
								else echo '<td class="titre3_anthracite_sans_fond" colspan="2"></td>';
							}
							echo '</tr>';
						}
						// Total
						echo '<tr> <td><div align="center">Total</div></td>';
						// Boucle sur la classe
						for($c=0;$c < 5;$c++) 
						{
							$totalf="0.".$c;
							$totalh="1.".$c;
							${$c}=${$totalf}+${$totalh};
							if (${$c}>0)
							{
								echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.${$c}.'</div></td>';
								echo '<td class="titre3_anthracite"><div align="center">'.round(( ${$c}*100)/($nbcol_F+$nbcol_H)).'%</div></td>';
							}
							else echo '<td class="titre3_anthracite_sans_fond" colspan="2"></td>';
						}
						echo '</tr>';
						
					?>
                </tr>
            </table>
            <br>
            <table border="1" class="titre2_noir">
                <tr>
                    <td width="100" ><div align="center">Age</div></td>
                    <td width="110" colspan="2"><div align="center">14 ans</div></td>
                    <td width="110" colspan="2"><div align="center">15 ans</div></td>
                    <td width="110" colspan="2"><div align="center">16 ans</div></td>
                    <td width="110" colspan="2"><div align="center">17 ans</div></td>
                    <td width="110" colspan="2"><div align="center">18 ans</div></td>
                    <td width="110" colspan="2"><div align="center">+</div></td>
                    <td width="110" ><div align="center">Age Moyen</div></td>
                </tr>
                	<?php
		  				$sexe = array("H", "F");
						// Boucle sur le sexe
						for($s=0;$s < 2;$s++) 
						{
							echo '<tr> <td><div align="center">'.$sexe[$s].'</div></td>';
							// Comptage du nombre de personne d'un certain age
							$total_age=$age14=$age15=$age16=$age17=$age18=$age_plus=0;
							$req="select `date_naissance` FROM `fiche` WHERE `type` = 'staff' and `sexe` ='".$sexe[$s]."' " .$_SESSION['and'] ;
							$res = log_mysql_query($req , $mysql);
							while ($tabres=mysql_fetch_array($res))
							{
								$naissance=mktime(0,0,0,substr($tabres['date_naissance'],5,2),substr($tabres['date_naissance'],8,2),substr($tabres['date_naissance'],0,4));
								$d1 = explode("-", $_SESSION['jour_debut_camp']);
								$date_camp=mktime(0,0,0, $d1[1], $d1[2], $d1[0]);
								$secondes = ($date_camp > $naissance)? $date_camp - $naissance : $naissance - $date_camp;
								$age = date('Y', $secondes) - 1970;
								$total_age=$total_age+$age;
								switch ($age) 
								{
									case '14': $age14=$age14+1;break;
									case '15': $age15=$age15+1;break;
									case '16': $age16=$age16+1;break;
									case '17': $age17=$age17+1;break;
									case '18': $age18=$age18+1;break;
									default: $age_plus=$age_plus+1;
								}
							}
							// Boucle sur l'age
							for($a=14;$a < 19;$a++) 
							{
								$var='age'.$a;
								if (${$var}>0)
								{
									echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.${$var}.'</div></td>';
									if ($sexe[$s]=="F") echo '<td class="titre3_anthracite"><div align="center">'.round((${$var}*100)/$nbcol_F).'%</div></td>';
									if ($sexe[$s]=="H") echo '<td class="titre3_anthracite"><div align="center">'.round((${$var}*100)/$nbcol_H).'%</div></td>';
								}
								else echo '<td class="titre3_anthracite_sans_fond" colspan="2"></td>';
							}
						   echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.$age_plus.'</div></td>';
						   if ($sexe[$s]=="F") echo '<td class="titre3_anthracite"><div align="center">'.round(($age_plus*100)/$nbcol_F).'%</div></td>';
						   if ($sexe[$s]=="H") echo '<td class="titre3_anthracite"><div align="center">'.round(($age_plus*100)/$nbcol_H).'%</div></td>';
							// Age moyen
						   if ($sexe[$s]=="F") echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.round($total_age/$nbcol_F,1).'</div></td>';
						   if ($sexe[$s]=="H") echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.round($total_age/$nbcol_H,1).'</div></td>';
							echo '</tr>';
						}
					?>
                </tr>
            </table>
        </td>
    <tr>
        <td><p class="titre2_marron">Suivi des Staffs : </p></td>
    </tr>
    	<td>
            <table border="1" class="titre2_noir">
                <tr>
                    <td width="100"><div align="center">Historique</div></td>
                    <td width="110" colspan="2"><div align="center">3 ème</div></td>
                    <td width="110" colspan="2"><div align="center">2 nd</div></td>
                    <td width="110" colspan="2"><div align="center">1 ère</div></td>
                    <td width="110" colspan="2"><div align="center">Term</div></td>
                    <td width="110" colspan="2"><div align="center">PostBac</div></td>
                    <td width="110" colspan="2"><div align="center">Total</div></td>
                </tr>
                	<?php
						// CALCUL DU NOMBRE DE Pélé
						$nb_pele = array("1er","2ème","3ème","4éme","5ème","6ème","7ème","8ème");
						// Boucle sur la classe $indice est un tableau à 2 dimension totalisant le Nb de pélé par classes
						for($c=0;$c < 8;$c++) 
						{
							$req="select nom_usage, prenom,date_naissance  FROM `fiche` WHERE type = 'staff' and classe='".$classe[$c]."' " .$_SESSION['and'] ;
							$res = log_mysql_query($req , $mysql);
							while ($tabres=mysql_fetch_array($res))
							{
								$req1="select count(*) FROM `fiche` WHERE nom_usage='".addslashes($tabres['nom_usage'])."' and prenom='".addslashes($tabres['prenom'])."' and date_naissance='".$tabres['date_naissance']."'  " ;
								$res1 = log_mysql_query($req1 , $mysql);
								$resultat=mysql_fetch_array($res1); 
								$indice=$c."-".$resultat[0];
								${$indice}=${$indice}+1;
							}
						}
						for ($nb=0;$nb<8;$nb++) // Boucle sur le nombre de pélé
						{
							$_total_historique=0;
							echo '<tr> <td><div align="center">'.$nb_pele[$nb].' Pélé</div></td>';
							// Boucle sur la classe
							for($c=0;$c < 5;$c++) 
							{
								$ind=$nb+1;
								$indice=$c."-".$ind;
								if (${$indice}>0)
								{
									echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.${$indice}.'</div></td>';
									echo '<td class="titre3_anthracite"><div align="center">'.round((${$indice}*100)/${$c}).'%</div></td>';
								}
								else echo '<td class="titre3_anthracite_sans_fond" colspan="2"></td>';
								$_total_historique=$_total_historique+${$indice};
							}
							// Total
									echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.$_total_historique.'</div></td>';
									echo '<td class="titre3_anthracite"><div align="center">'.round(($_total_historique*100)/($nbcol_H+$nbcol_F)).'%</div></td>';
							echo '</tr>';
						}
					?>
                </tr>
            </table>
            <br>
            <table border="1" class="titre2_noir">
                <tr>
                    <td width="100" ><div align="center">Est devenu</div></td>
                    <td width="110" colspan="2"><div align="center">3 ème</div></td>
                    <td width="110" colspan="2"><div align="center">2 nd</div></td>
                    <td width="110" colspan="2"><div align="center">1 ère</div></td>
                    <td width="110" colspan="2"><div align="center">Term</div></td>
                    <td width="110" colspan="2"><div align="center">PostBac</div></td>
                    <td width="110" colspan="2"><div align="center">Total</div></td>
                </tr>
                <tr>
                	<?php
						// CALCUL DU NOMBRE DE Pélé
						$futur = array("animateur","ttv");
						// Boucle sur la classe $indice est un tableau à 2 dimension totalisant le Nb de pélé par classes
						for($c=0;$c < 5;$c++) 
						{
							$req="select nom_usage, prenom,date_naissance  FROM `fiche` WHERE type = 'staff' and classe='".$classe[$c]."' " .$_SESSION['and'] ;
							$res = log_mysql_query($req , $mysql);
							while ($tabres=mysql_fetch_array($res))
							{
								$req1="select count(*) FROM `fiche` WHERE `type`='animateur' and nom_usage='".$tabres['nom_usage']."' and prenom='".$tabres['prenom']."' and date_naissance='".$tabres['date_naissance']."'  " ;
								$res1 = log_mysql_query($req1 , $mysql);
								$resultat=mysql_fetch_array($res1); 
								if ($resultat[0]>0) 
								{
									$indice=$c."-animateur";
									${$indice}=${$indice}+1;
								}
								$req1="select count(*) FROM `fiche` WHERE `type`='ttv' and nom_usage='".$tabres['nom_usage']."' and prenom='".$tabres['prenom']."' and date_naissance='".$tabres['date_naissance']."'  " ;
								$res1 = log_mysql_query($req1 , $mysql);
								$resultat=mysql_fetch_array($res1); 
								if ($resultat[0]>0) 
								{
									$indice=$c."-ttv";
									${$indice}=${$indice}+1;
								}
							}
						}
						for ($nb=0;$nb<2;$nb++) // Boucle le futur du collegien
						{
							$_total_futur=0;
							echo '<tr> <td><div align="center">'.$futur[$nb].'</div></td>';
							// Boucle sur la classe
							for($c=0;$c < 5;$c++) 
							{
								$ind=$nb+1;
								$indice=$c."-".$futur[$nb];
								if (${$indice}>0)
								{
									echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.${$indice}.'</div></td>';
									echo '<td class="titre3_anthracite"><div align="center">'.round((${$indice}*100)/${$c}).'%</div></td>';
								}
								else echo '<td class="titre3_anthracite_sans_fond" colspan="2"></td>';
								$_total_futur=$_total_futur+${$indice};
							}
							echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.$_total_futur.'</div></td>';
							echo '<td class="titre3_anthracite"><div align="center">'.round(($_total_futur*100)/($nbcol_H+$nbcol_F)).'%</div></td>';
							echo '</tr>';
						}
					?>
                </tr>
            </table>
            <br>
            <table border="1" class="titre2_noir">
                <tr>
                    <td width="100" rowspan="2"><div align="center">Abandonne le Pélé</div></td>
                    <td width="110" colspan="2"><div align="center">3 ème</div></td>
                    <td width="110" colspan="2"><div align="center">2 nd</div></td>
                    <td width="110" colspan="2"><div align="center">1 ère</div></td>
                    <td width="110" colspan="2"><div align="center">Term</div></td>
                    <td width="110" colspan="2"><div align="center">PostBac</div></td>
                    <td width="110" colspan="2"><div align="center">Total</div></td>
                </tr>
                <tr>
                	<?php
						// Boucle sur la classe $indice est un tableau à 2 dimension totalisant le Nb de pélé par classes
						$total_abandon=0;
						for($c=0;$c < 5;$c++) 
						{
							$req="select nom_usage, prenom,date_naissance  FROM `fiche` WHERE type = 'staff' and classe='".$classe[$c]."' " .$_SESSION['and'] ;
							$res = log_mysql_query($req , $mysql);
							$nb_abandon=0;
							while ($tabres=mysql_fetch_array($res))
							{
								$req1="select count(*) FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE nom_usage='".addslashes($tabres['nom_usage'])."' and prenom='".addslashes($tabres['prenom'])."' and date_naissance='".
									$tabres['date_naissance']."' and annee>'".$_SESSION['annee']."'" ;
								$res1 = log_mysql_query($req1 , $mysql);
								$resultat=mysql_fetch_array($res1); 
								if ($resultat[0]==0) $nb_abandon=$nb_abandon+1;
							}
							if ($nb_abandon>0)
							{
								echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.$nb_abandon.'</div></td>';
								echo '<td class="titre3_anthracite"><div align="center">'.round(($nb_abandon*100)/${$c}).'%</div></td>';
								$total_abandon=$total_abandon+$nb_abandon;
							}
							else echo '<td class="titre3_anthracite_sans_fond" colspan="2"></td>';
						}
						echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.$total_abandon.'</div></td>';
						echo '<td class="titre3_anthracite"><div align="center">'.round(($total_abandon*100)/($nbcol_H+$nbcol_F)).'%</div></td>';
					?>
                </tr>
            </table>
            <br>


        <br></td>
    </tr>
</table >
</body >
</html >
