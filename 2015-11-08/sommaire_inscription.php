<?php 
# <!-- Propose au participant de sélectionner la route sur laquelle ils veulent s'incrire -->
session_start(); 
$toute_route = $_GET["toute_route"];

// ************************************************* Test si une inscription est en cours  ****************************************************************
if ($_SESSION['inscription_en_cours']=="oui")  
{
   echo "Désolé, mais une inscription est en cours sur cet ordinateur. <BR><BR>" ;
   echo "Vous pouvez,<BR>" ;
   echo "Soit :<BR>" ;
   echo '<a href="inscriptions/valid_inscription.php">    Continuer votre inscription en cours</a><br>' ;
   echo "Soit :<BR>" ;
   echo '<a href="inscriptions/include/base/arret_session.php">    Forcer une nouvelle inscription</a><br>' ;
  die('');
}

include('inscriptions/Secretariat/include/fonction_php.php');
include('inscriptions/Secretariat/include/log_url.php');     
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <LINK rel=stylesheet type="text/css" href="total.css">
</head>

<body>
<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Tableau listant les différentes routes         XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
<table width="1010" border="0" align="center" bgcolor="#FFFFFF" >
  <tr>
    <td>
      <p align="center"><img src="inscriptions/Photo/bandeau_vide.jpg" ></p>
      <?php   
      $annee=date ('Y');
      $aujourdhui = mktime(0, 0, 0, date("m"), date("d")-2, date("y")); 			
      $aujourdhui=date("Y-m-d H:i:s",$aujourdhui);
      include('inscriptions/include/base/connexion_serveur.php');
      // ****************** Recherche des routes dont le début du camp est passé depuis 2 jours
      $req_liste= "  SELECT * FROM `route` WHERE `annee`= '".$annee."'and `route_publique`=1 and `jour_debut_camp`>'".$aujourdhui."' order by dayofyear(jour_debut_camp),departement " ;
      // ****************** Si l'option toute_route="ok" - inscription par le secrétariat - on affiche toutes les routes
      if ($toute_route=="ok") 
          {$req_liste= "  SELECT * FROM `route` WHERE `annee`= '".$annee."' order by dayofyear(jour_debut_camp),departement " ;}
      $res_liste= mysql_query($req_liste , $mysql);
      $nb_resultat=mysql_num_rows($res_liste);
      // ****************** AFFICHAGE DES ROUTES OU ON PEUT ENCORE S'INSCRIRE
      if ($nb_resultat<>'0')
      {	echo '
      <p align="center" class="titre2_marron">Choisissez votre Pélé VTT: </p>
  <!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Titres du tableau    XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
	  <table border="0" align="center">
        <tr>
          <td width="107" class="titre2_noir">&nbsp;</td>
          <td width="150" class="titre2_noir">&nbsp;</td>
          <td width="123" class="titre2_noir"></td>
          <td width="128" class="titre2_noir">&nbsp;</td>
          <td colspan="3" class="titre2_noir"><div align="center">Places Disponibles</div></td>
          <td width="139">&nbsp;</td>
        </tr>
        <tr bordercolor="#999999" class="titre2_noir" borderwidth="1">
          <td height="52" colspan="2" ><div align="center">D&eacute;partement</div></td>
          <td bgcolor="#efb554"><div align="center">Lieux</div></td>
          <td><div align="center">Dates</div></td>
          <td width="100" bgcolor="#95c5eb" ><div align="center" class="titre3_noir">Coll&eacute;gien</div></td>
          <td width="100"><div align="center" class="titre3_noir">Coll&eacute;gienne</div></td>
          <td width="100" bgcolor="#FFFF33"><div align="center" class="titre3_noir">Staff</div></td>
          <td >&nbsp;</td>
        </tr>
  <!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Affichage des routes   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->';
	  while ($tabres = mysql_fetch_array ($res_liste))
	  {$tabres=stripslashes_deep($tabres);?>
<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Affichage d'une route   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
		<tr bordercolor="#99ee99" border-width=10>
		  <td height="83" class="titre2_marron" width="117">
			  <p align="center"> <?php echo $tabres['departement'] ?><br><?php echo $tabres['n_departement'] ?><br>
			  <span class="titre3_noir">	
				<?php 
					echo '<a href="inscriptions/accueil_route.php?&route='.$tabres['index_route'].'">Info Pratiques</a><br>';
					if ($tabres['courriel_expediteur']<>"") echo '<a title= "Courriel" href="mailto:'.$tabres['courriel_expediteur'].'"><img src="inscriptions/Photo/icone_courriel.jpg" alt="Courriel"/></a>';
					if ($tabres['url_site']<>"") echo '<a title= "Site Web" href="'.$tabres['url_site'].'"><img src="inscriptions/Photo/icone_web.jpg" alt="Site Web"/></a>';
					if ($tabres['url_facebook']<>"") echo '<a title= "Page Facebook" href="'.$tabres['url_facebook'].'"><img src="inscriptions/Photo/icone_facebook.jpg" alt="Page Facebook"/></a>';
					if ($tabres['url_twitter']<>"") echo '<a title= "Compte Twitter" href="'.$tabres['url_twitter'].'"><img src="inscriptions/Photo/icone_twitter.jpg" alt="Compte Twitter"/></a>';
					
				?></span></p>
		  </td>
		  <td align="center" width="150">
			  <img src="inscriptions/Photo/<?php echo $tabres['departement'] ?>.jpg" width="138" height="150">
		  </td>
		  <td bgcolor="#efb554" class="titre2_noir" width="124"><div align="center">
				<p><span class="titre3_noir">de </span><?php echo $tabres['lieu_depart'] ?></p>
				<p><span class="titre3_noir">à </span><?php echo $tabres['lieu_arrive'] ?></p></div>
		  </td>
		  <td class="titre2_noir" width="128">
			  <p align="center"><span class="titre3_noir">du </span><?php echo convdate($tabres['jour_debut_camp']) ?></p>
			  <p align="center"><span class="titre3_noir">au </span><?php echo convdate($tabres['jour_fin_camp']) ?></p>
		  </td>
		  <?php
		  // ****************** Test si les inscriptions sont ouvertes
		  
			$date_debut_inscription = strtotime($tabres['debut_inscription']);
			$_var_maintenant=time()+0*60*60;   // "gestion" du décalage horaire.....  
			if ($_var_maintenant > $date_debut_inscription) 
		  // ****************** Si Oui Affichage des Dispo
			{  // ****************** Calcul de la dispo des COLLEGIENS
			  $req="select count(*) FROM `fiche` WHERE type = 'collegien' and route_index='".$tabres['index_route']."' and sexe='H' and corbeille <>'oui'" ;
			  $res = mysql_query($req , $mysql);
			  $resultat=mysql_fetch_array($res); 
			  $dispo_collegien= $tabres['max_collegien']-$resultat[0];
			  if ($dispo_collegien<1 or $tabres['forcage_collegien_attente']==1)
			  {	echo'
				  <td width="100" bgcolor="#95c5eb" class="titre3_noir" height="1"><div align="center">';
					  echo 'Inscrivez-vous <br> sur la liste <br>d\'attente'; 
					  echo '</div>
				  </td>';
			  }
			  else
			  {	echo'
				  <td width="100" bgcolor="#95c5eb" class="titre1_noir"><div align="center">';
					  echo max($dispo_collegien,0);
					  echo '</div>
				  </td>';
			  }
			  // ****************** Calcul de la dispo des COLLEGIENNES
			  $req="select count(*) FROM `fiche` WHERE type = 'collegien' and route_index='".$tabres['index_route']."' and sexe='F'  and corbeille <>'oui'" ;
			  $res = mysql_query($req , $mysql);
			  $resultat=mysql_fetch_array($res); 
			  $dispo_collegienne= $tabres['max_collegienne']-$resultat[0];
			  if ($dispo_collegienne<1 or $tabres['forcage_collegienne_attente']==1)
			  {	echo'
				  <td width="100" class="titre3_noir" height="1"><div align="center">';
					  echo 'Inscrivez-vous <br> sur la liste <br>d\'attente'; 
					  echo '</div>
				  </td>';
			  }
			  else
			  {	echo'
				  <td width="100" class="titre1_noir"><div align="center">';
					  echo max($dispo_collegienne,0);
					  echo '</div>
				  </td>';
			  }
			  // ****************** Calcul de la dispo des STAFF
			  $req="select count(*) FROM `fiche` WHERE type = 'staff' and route_index='".$tabres['index_route']."' and corbeille <>'oui'" ;
			  $res = mysql_query($req , $mysql);
			  $resultat=mysql_fetch_array($res); 
			  $dispo_staff= $tabres['max_staff']-$resultat[0];
			  if ($dispo_staff<1 or $tabres['forcage_staff_attente']==1)
			  {	echo'
				  <td width="100" bgcolor="#FFFF33" class="titre3_noir" height="1"><div align="center">';
					  echo 'Inscrivez-vous <br> sur la liste <br>d\'attente'; 
					  echo '</div>
				  </td>';
			  }
			  else
			  {	echo'
				  <td width="100" bgcolor="#FFFF33" class="titre1_noir"><div align="center">';
					  echo max($dispo_staff,0);
					  echo '</div>
				  </td>';
			  }
			}
		  // ****************** Si Non Affichage de la date d'ouverture
			else
			{
				echo'
				<td colspan="3" height="1"><div align="center">';
				echo '<span class="titre3_noir">Les inscriptions pour les jeunes<BR> ne sont ouvertes qu\'&agrave; partir <BR>
						du</span> <span class="titre2_noir">'.convdate_litteral($tabres['debut_inscription']).'<BR><BR>Pour les autres, c\'est ouvert !!!</span>'; 
				echo '</div>
				</td>';
			}

			
			echo'
			<td valign="middle" class="titre2_noir" align="center" >
				<p> <a href="inscriptions/accueil_route.php?&route='.$tabres['index_route'].'">Inscrivez-vous</p>
				<p ><img src="inscriptions/Photo/Inscription_en_ligne.jpg"></a></p>
			</td>
		</tr>';
	   } ?>  <!-- Fin de la boucle sur les routes -->
      </table>
      </div>
      <?php
      } // Fin du If //
      ?>
	</td>
  </tr>
  <br>
</table>
<br><br><br>
<table width="1010" border="0" align="center" bgcolor="#FFFFFF" >
  <tr>
  <?php   
  $annee=date ('Y');
  $moi=date ('n');
  if ($moi<7) $annee=$annee-1;
  $req_liste= "  SELECT * FROM `route` WHERE `annee`= '".$annee."'and `jour_fin_camp`<='".$aujourdhui."' order by n_departement " ;
  $res_liste= mysql_query($req_liste , $mysql);
  $nb_resultat=mysql_num_rows($res_liste);
  // ****************** AFFICHAGE DES ROUTES DE l'ANNEE PASSE 
  if ($nb_resultat<>'0')
  {  echo '
  <tr>
    <td>
	  <p align="center" class="titre2_marron">'; echo "<br>Ils ont fait l'édition ".$annee." :"; echo ' </p>
  <!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Titres du tableau    XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
	  <table border="0">
		<tr bordercolor="#999999" class="titre2_noir" borderwidth="1">
		  <td height="52" width="310"><div align="center">D&eacute;partement</div></td>
		  <td bgcolor="#efb554" width="125"><div align="center">Lieux</div></td>
		  <td  width="130"><div align="center">Dates</div></td>
		  <td width="300" ><div align="center">Qui ?</div></td>
		</tr>
	  </table>
	  <div style="width: 900px; height: 615px; overflow: auto;">
	  <table border="0" align="center">

  <!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Affichage des routes   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->';
		while ($tabres = mysql_fetch_array ($res_liste))
		{$tabres=stripslashes_deep($tabres);?>
<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Affichage d'une route   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
		<tr bordercolor="#99ee99" border-width=10>
		  <td height="83" class="titre2_marron">
			  <p align="center"> <?php echo $tabres['departement'] ?><br><?php echo $tabres['n_departement'] ?><br>
			  <span class="titre3_noir">	
				<?php 
					echo '<a href="http://www.pele-vtt.fr/inscriptions/accueil_route.php?&route='.$tabres['index_route'].'">Info Pratiques</a><br>';
					if ($tabres['courriel_expediteur']<>"") echo '<a title= "Courriel" href="mailto:'.$tabres['courriel_expediteur'].'"><img src="inscriptions/Photo/icone_courriel.jpg" alt="Courriel"/></a>';
					if ($tabres['url_site']<>"") echo '<a title= "Site Web" href="'.$tabres['url_site'].'"><img src="inscriptions/Photo/icone_web.jpg" alt="Site Web"/></a>';
					if ($tabres['url_facebook']<>"") echo '<a title= "Page Facebook" href="'.$tabres['url_facebook'].'"><img src="inscriptions/Photo/icone_facebook.jpg" alt="Page Facebook"/></a>';
					if ($tabres['url_twitter']<>"") echo '<a title= "Compte Twitter" href="'.$tabres['url_twitter'].'"><img src="inscriptions/Photo/icone_twitter.jpg" alt="Compte Twitter"/></a>';
					
				?></span></p>
		  </td>
		  <td align="center">
			  <img src="inscriptions/Photo/<?php echo $tabres['departement'] ?>.jpg" width="138" height="150">
		  </td>
		  <td width="125" bgcolor="#efb554" class="titre2_noir"><div align="center">
				<p><span class="titre3_noir">de </span><?php echo $tabres['lieu_depart'] ?></p>
				<p><span class="titre3_noir">à </span><?php echo $tabres['lieu_arrive'] ?></p></div>
		  </td>
		  <td width="130" class="titre2_noir">
			  <p align="center"><span class="titre3_noir">du </span><?php echo convdate($tabres['jour_debut_camp']) ?></p>
			  <p align="center"><span class="titre3_noir">au </span><?php echo convdate($tabres['jour_fin_camp']) ?></p>
		  </td>
		  <?php
		  // ******************   Affiche le nombre de collégiens et staff qui ont participé
		  echo'
		  <td bgcolor="#efb554" width="300" class="titre2_noir" align="center"><div align="center">';
			 $req="select count(*) FROM `fiche` WHERE type = 'collegien' and route_index='".$tabres['index_route']."'  and corbeille <>'oui'" ;
			 $res = mysql_query($req , $mysql);
			 $resultat=mysql_fetch_array($res); 
			 $_collegien= $resultat[0];
			 $req="select count(*) FROM `fiche` WHERE type = 'staff' and route_index='".$tabres['index_route']."'  and corbeille <>'oui'" ;
			 $res = mysql_query($req , $mysql);
			 $resultat=mysql_fetch_array($res); 
			 $_staff= $resultat[0];
			 echo '<span class="titre1_noir">'.$_collegien.'</span> Collégien(ne)s ';
			 echo 'et <span class="titre1_noir">'.$_staff.'</span> Staff <br> ';
		  echo '</div>
		  </td>';
		  ?>
		</tr>
		 <?php 
         } ?>
	  </table>	
      </div>
	  <p align="center" class="titre2_marron"><br>Ne ratez pas l'édition <?php echo ($annee+1);?>!!!! </p>
	  <p align="center">&nbsp;</p>
	  <p align="center">&nbsp;</p>
	  <p align="center">&nbsp;</p>
	</td>
  </tr>
   <?php 
   } ?>
</table>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>

</body>
</html>
