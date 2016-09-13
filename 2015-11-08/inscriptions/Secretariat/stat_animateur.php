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
        <td> <p align="center" class="titre2_marron">Statistiques Animateurs: </p></td>
    </tr>
    <tr>
        <td><p class="titre2_marron">R&eacute;partition des Animateurs : </p></td>
    </tr>
    <tr>
        <td>
            <table border="1" class="titre2_noir">
                <tr>
                    <td width="110" ><div align="center">Age</div></td>
                    <td width="80" colspan="2"><div align="center">17 ans</div></td>
                    <td width="80" colspan="2"><div align="center">18 ans</div></td>
                    <td width="80" colspan="2"><div align="center">19 ans</div></td>
                    <td width="80" colspan="2"><div align="center">20 ans</div></td>
                    <td width="80" colspan="2"><div align="center">21 ans</div></td>
                    <td width="80" colspan="2"><div align="center">22 ans</div></td>
                    <td width="80" colspan="2"><div align="center">23 ans</div></td>
                    <td width="80" colspan="2"><div align="center">24 ans</div></td>
                    <td width="80" colspan="2"><div align="center">25 ans</div></td>
                    <td width="80" colspan="2"><div align="center">+</div></td>
                    <td width="110" ><div align="center">Age Moyen</div></td>
                </tr>
                	<?php
		  				$titre = array("='Monsieur", "<>'Monsieur");
						// Boucle sur le titre
						for($s=0;$s < 2;$s++) 
						{
							if ($s==1) echo '<tr> <td><div align="center">F</div></td>';
							if ($s==0) echo '<tr> <td><div align="center">H</div></td>';
							// Comptage du nombre de personne d'un certain age
							$total_age=$age17=$age18=$age19=$age20=$age21=$age22=$age23=$age24=$age25=$age_plus=0;
							$req="select `date_naissance` FROM `fiche` WHERE `type` = 'animateur' and `titre`".$titre[$s]."' " .$_SESSION['and'] ;
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
									case '17': $age17=$age17+1;break;
									case '18': $age18=$age18+1;break;
									case '19': $age19=$age19+1;break;
									case '20': $age20=$age20+1;break;
									case '21': $age21=$age21+1;break;
									case '22': $age22=$age22+1;break;
									case '23': $age23=$age23+1;break;
									case '24': $age24=$age24+1;break;
									case '25': $age25=$age25+1;break;
									default: $age_plus=$age_plus+1;
								}
								if ($s==1) $nbcol_F=$nbcol_F+1;
								if ($s==0) $nbcol_H=$nbcol_H+1;

							}
							// Boucle sur l'age
							for($a=17;$a < 26;$a++) 
							{
								$var='age'.$a;
								if (${$var}>0)
								{
									echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.${$var}.'</div></td>';
									if ($s==1) echo '<td class="titre3_anthracite"><div align="center">'.round((${$var}*100)/$nbcol_F).'%</div></td>';
									if ($s==0) echo '<td class="titre3_anthracite"><div align="center">'.round((${$var}*100)/$nbcol_H).'%</div></td>';
								}
								else echo '<td class="titre3_anthracite_sans_fond" colspan="2"></td>';
							}
						   echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.$age_plus.'</div></td>';
						   if ($s==1) echo '<td class="titre3_anthracite"><div align="center">'.round(($age_plus*100)/$nbcol_F).'%</div></td>';
						   if ($s==0) echo '<td class="titre3_anthracite"><div align="center">'.round(($age_plus*100)/$nbcol_H).'%</div></td>';
							// Age moyen
						   if ($s==1) echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.round($total_age/$nbcol_F,1).'</div></td>';
						   if ($s==0) echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.round($total_age/$nbcol_H,1).'</div></td>';
							echo '</tr>';
						}
					?>
                </tr>
            </table>
        </td>
    <tr>
        <td><p class="titre2_marron">Suivi des Animateurs : </p></td>
    </tr>
    	<td>
            <table border="1" class="titre2_noir">
                <tr>
                    <td width="110"><div align="center">Historique</div></td>
                    <td width="80" colspan="2"><div align="center">17 ans</div></td>
                    <td width="80" colspan="2"><div align="center">18 ans</div></td>
                    <td width="80" colspan="2"><div align="center">19 ans</div></td>
                    <td width="80" colspan="2"><div align="center">20 ans</div></td>
                    <td width="80" colspan="2"><div align="center">21 ans</div></td>
                    <td width="80" colspan="2"><div align="center">22 ans</div></td>
                    <td width="80" colspan="2"><div align="center">23 ans</div></td>
                    <td width="80" colspan="2"><div align="center">24 ans</div></td>
                    <td width="80" colspan="2"><div align="center">25 ans</div></td>
                    <td width="80" colspan="2"><div align="center">+</div></td>
                </tr>
                	<?php
						// CALCUL DU NOMBRE DE Pélé
						$nb_pele = array("1er","2ème","3ème","4éme","5ème");
						// Boucle sur la classe $indice est un tableau à 2 dimension totalisant le Nb de pélé par classes
						$jour_debut_pele=strtotime($_SESSION['jour_debut_camp']);
						for ($a=17;$a < 26;$a++)  
						{
							$date1=strtotime("-".$a." year",$jour_debut_pele);
							$b=$a+1;
							$date2=strtotime("-".$b." year",$jour_debut_pele);
							$req="select nom_usage, prenom,date_naissance  FROM `fiche` WHERE type = 'animateur' and date_naissance between '".date("Y-m-d",$date2)."' and '".date("Y-m-d",$date1)."' " .$_SESSION['and'] ;
							$res = log_mysql_query($req , $mysql);
							while ($tabres=mysql_fetch_array($res))
							{
								$req1="select count(*) FROM `fiche` WHERE nom_usage='".addslashes($tabres['nom_usage'])."' and prenom='".addslashes($tabres['prenom'])."' and date_naissance='".$tabres['date_naissance']."'  " ;
								$res1 = log_mysql_query($req1 , $mysql);
								$resultat=mysql_fetch_array($res1); 
								$indice=$a."-".$resultat[0];
								${$indice}=${$indice}+1;
							}
						}
						for ($nb=0;$nb<5;$nb++) // Boucle sur le nombre de pélé
						{
							echo '<tr> <td><div align="center">'.$nb_pele[$nb].' Pélé</div></td>';
							// Boucle sur la classe
							for ($a=17;$a < 26;$a++)
							{
								$ind=$nb+1;
								$indice=$a."-".$ind;
								if (${$indice}>0)
								{
									echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.${$indice}.'</div></td>';
									echo '<td class="titre3_anthracite"><div align="center">'.round((${$indice}*100)/${$a}).'%</div></td>';
								}
								else echo '<td class="titre3_anthracite_sans_fond" colspan="2"></td>';
							}
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
						$total_abandon=$total=0;
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
								$total=$total+${$c};
							}
							else echo '<td class="titre3_anthracite_sans_fond" colspan="2"></td>';
						}
						echo '<td class="titre3_anthracite_sans_fond"><div align="center">'.$total_abandon.'</div></td>';
						echo '<td class="titre3_anthracite"><div align="center">'.round(($total_abandon*100)/$total).'%</div></td>';
					?>
                </tr>
            </table>
            <br>


        <br></td>
    </tr>
</table >
</body >
</html >
