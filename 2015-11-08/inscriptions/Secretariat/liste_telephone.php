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
        <td> <p align="center" class="titre2_marron">Liste des Téléphones des responsables: </p><br></td>
    </tr>
    <tr>
        <td> 
        <table align="center" border="0">
          <tr>
            <td valign="top">
                <table border="0"  >
                  <tr>
                    <td colspan="4" class="titre2_marron">Grands Chefs </td>
                  </tr>
                  <tr class="titre2_anthracite">
                    <td><div align="right">OGM</div></td>
                    <?php   $req_liste= "  SELECT * FROM fiche WHERE `type`= 'ogm' ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       $tabres = mysql_fetch_array ($res_liste);
                       $tabres=stripslashes_deep($tabres);
                    ?>
                    <td ><?php echo $tabres['nom_usage']; ?></td>
                    <td ><?php echo $tabres['prenom']; ?></td>
                    <td ><?php echo $tabres['tel_mobile'] ?></td>
                  </tr>
                  <tr class="titre2_anthracite">
                    <td><div align="right">GGG</div></td>
                    <?php   $req_liste= "  SELECT * FROM fiche WHERE `type`= 'ggg' ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       $tabres = mysql_fetch_array ($res_liste);
                       $tabres=stripslashes_deep($tabres);
                    ?>
                    <td ><?php echo $tabres['nom_usage']; ?></td>
                    <td ><?php echo $tabres['prenom']; ?></td>
                    <td ><?php echo $tabres['tel_mobile'] ?></td>
                  </tr>
                  <tr>
                    <td colspan="5" class="titre2_marron">Réparation Vélo </td>
                  </tr>
                    <?php   $req_liste= "  SELECT * FROM fiche WHERE `gg`='GG Velo'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">GG</div></td>
                    <td ><?php echo $tabres['nom_usage']; ?></td>
                    <td ><?php echo $tabres['prenom']; ?></td>
                    <td ><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>
                    <?php
                        }
                       $req_liste= "  SELECT * FROM fiche WHERE `velo`= 1 and `gg`<>'GG Velo'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">&nbsp;</div></td>
                    <td ><?php echo $tabres['nom_usage']; ?></td>
                    <td ><?php echo $tabres['prenom']; ?></td>
                    <td ><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>		
                    <?php
                        }
                    ?>	  
    
                  <tr>
                    <td colspan="5" class="titre2_marron">Infirmerie </td>
                  </tr>
                    <?php   $req_liste= "  SELECT * FROM fiche WHERE `gg`='GG Santé'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td><div align="right">GG</div></td>
                    <td><?php echo $tabres['nom_usage']; ?></td>
                    <td> <?php echo $tabres['prenom']; ?></td>
                    <td><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>
                    <?php
                        }
                       $req_liste= "  SELECT * FROM fiche WHERE `infirmerie`= 1 and `gg`<>'GG Santé' ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">&nbsp;</div></td>
                    <td><?php echo $tabres['nom_usage']; ?></td>
                    <td> <?php echo $tabres['prenom']; ?></td>
                    <td><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                  <tr>
                    <td colspan="5" class="titre2_marron">Parcours </td>
                  </tr>
                    <?php   $req_liste= "  SELECT * FROM fiche WHERE `gg`='GG Parcours'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">GG</div></td>
                    <td ><?php echo $tabres['nom_usage']; ?></td>
                    <td ><?php echo $tabres['prenom']; ?></td>
                    <td ><?php echo $tabres['tel_mobile'] ?></td>
                 </tr>
                    <?php
                        }
                       $req_liste= "  SELECT * FROM fiche WHERE `parcours`= 1 and `gg`<>'GG Parcours'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">&nbsp;</div></td>
                    <td ><?php echo $tabres['nom_usage']; ?></td>
                    <td ><?php echo $tabres['prenom']; ?></td>
                    <td ><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>		
                    <?php
                        }
                    ?>
    
                  <tr>
                    <td colspan="5" class="titre2_marron">Technique </td>
                  </tr>
                    <?php   $req_liste= "  SELECT * FROM fiche WHERE `gg`='GG Technique'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">GG</div></td>
                    <td ><?php echo $tabres['nom_usage']; ?></td>
                    <td ><?php echo $tabres['prenom']; ?></td>
                    <td ><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>
                    <?php
                        }
                       $req_liste= "  SELECT * FROM fiche WHERE `technique`= 1 and `gg`<>'GG Technique'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">&nbsp;</div></td>
                    <td ><?php echo $tabres['nom_usage']; ?></td>
                    <td ><?php echo $tabres['prenom']; ?></td>
                    <td ><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>		
                    <?php
                        }
                    ?>		
                  <tr>
                    <td colspan="5" class="titre2_marron">Staff </td>
                  </tr>
                    <?php   $req_liste= "  SELECT * FROM fiche WHERE `gg`='GG Staff'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">GG</div></td>
                    <td ><?php echo $tabres['nom_usage']; ?></td>
                    <td ><?php echo $tabres['prenom']; ?></td>
                    <td ><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                      <tr>
                    <td colspan="5" class="titre2_marron">Multi-Media </td>
                    </tr>
                    <?php   $req_liste= "  SELECT * FROM fiche WHERE `gg`='GG Media'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">GG</div></td>
                    <td ><?php echo $tabres['nom_usage']; ?></td>
                    <td ><?php echo $tabres['prenom']; ?></td>
                    <td ><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>
                    <?php
                        }
                       $req_liste= "  SELECT * FROM fiche WHERE `media`= 1 and `gg`<>'GG Media'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">&nbsp;</div></td>
                    <td ><?php echo $tabres['nom_usage']; ?></td>
                    <td ><?php echo $tabres['prenom']; ?></td>
                    <td ><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>		
                    <?php
                        }
                    ?>		
                  <tr>
                    <td colspan="5" class="titre2_marron">ABS </td>
                  </tr>
                    <?php   $req_liste= "  SELECT * FROM fiche  WHERE `gg`='GG Abs'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">GG</div></td>
                    <td ><?php echo $tabres['nom_usage']; ?></td>
                    <td ><?php echo $tabres['prenom']; ?></td>
                    <td ><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>
                    <?php
                        }
                       $req_liste= "  SELECT * FROM fiche  WHERE `type`= 'abs' and `gg`<>'GG Abs'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">&nbsp;</div></td>
                    <td ><?php echo $tabres['nom_usage']; ?></td>
                    <td ><?php echo $tabres['prenom']; ?></td>
                    <td ><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>		
                    <?php
                        }
                    ?>			
              
                  </table></td>
                </td>
                <td valign="top">			
                    <table  border="0">
                                    <tr>
                    <td colspan="5" class="titre2_marron">Secretariat </td>
                    </tr>
                    <?php   $req_liste= "  SELECT * FROM fiche WHERE `gg`='GG Secretariat'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">GG</div></td>
                    <td><?php echo $tabres['nom_usage']; ?></td>
                    <td> <?php echo $tabres['prenom']; ?></td>
                    <td><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>
                    <?php
                        }
                       $req_liste= "  SELECT * FROM fiche WHERE `secretariat`= 1 and `gg`<>'GG Secretariat'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">&nbsp;</div></td>
                    <td><?php echo $tabres['nom_usage']; ?></td>
                    <td> <?php echo $tabres['prenom']; ?></td>
                    <td><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>	
                    <?php
                        }
                    ?>
                              <tr>
                    <td colspan="5" class="titre2_marron">Animateurs  </td>
                  </tr>
                    <?php   $req_liste= "  SELECT * FROM fiche WHERE `gg`='GG Animateur' ".$_SESSION['and']." order by nom_usage"  ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                  
                    <td ><div align="right">GG</div></td>
                    <td ><?php echo $tabres['nom_usage']; ?></td>
                    <td><?php echo $tabres['prenom']; ?></td>
                    <td><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>
                    <?php
                        }
                       $req_liste= "  SELECT * FROM fiche INNER JOIN equipe ON fiche.equipe= equipe.index_equipe  WHERE `type`= 'animateur' and `gg`<>'GG Animateur'  and fiche.route_index='".$_SESSION['index_route']."' and `corbeille`<>'oui' order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">&nbsp;</div></td>
                    <td ><?php echo $tabres['nom_usage']; ?></td>
                    <td><?php echo $tabres['prenom']; ?></td>
                    <td><?php echo $tabres['tel_mobile'] ?></td>
                    <td><?php echo $tabres['numero_equipe'].' - '.$tabres['nom_equipe'] ?></td>
                    </tr>		
                    <?php
                        }
                    ?>	
                                      <tr>
                    <td colspan="5" class="titre2_marron">Intendance </td>
                    </tr>
                    <?php   $req_liste= "  SELECT * FROM fiche WHERE `gg`='GG Intendance'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">GG</div></td>
                    <td><?php echo $tabres['nom_usage']; ?></td>
                    <td> <?php echo $tabres['prenom']; ?></td>
                    <td><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                    <?php   $req_liste= "  SELECT * FROM fiche WHERE `intendance`= 1 and `gg`<>'GG Intendance'  ".$_SESSION['and']." order by nom_usage" ;
                       $res_liste= log_mysql_query($req_liste , $mysql);
                       while ($tabres = mysql_fetch_array ($res_liste))
                      { $tabres=stripslashes_deep($tabres);
                    ?>
                  <tr class="titre2_anthracite">
                    <td ><div align="right">&nbsp;</div></td>
                    <td><?php echo $tabres['nom_usage']; ?></td>
                    <td> <?php echo $tabres['prenom']; ?></td>
                    <td><?php echo $tabres['tel_mobile'] ?></td>
                    </tr>		
                    <?php
                        }
                    ?>		
                </table>
                </td>
              </tr>
            </table>


</table>
</body>
</html>
