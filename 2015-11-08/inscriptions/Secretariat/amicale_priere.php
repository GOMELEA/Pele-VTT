<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
      session_start(); 
	  $type = $_GET["type"];
	  $index = $_GET["index"];
	  $faire = $_GET["faire"];
	  include('include/fonction_php.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
.Style3 {
	font-family: Tahoma;
	font-size: 16px;
	position: relative;
	font-weight: bold;

}
.Style11 {
	font-family: Tahoma;
	font-size: 20px;
	position: relative;
	font-weight: bold;
	color: #967236;
}
.Style12 {
	font-family: Verdana;
	font-size: 10px;
	position: relative;
	color: #333333;
}
-->
</style>
 <link href="/normal.css" rel="stylesheet" type="text/css">
    <LINK rel=stylesheet type="text/css" href="../../total.css">
 <style type="text/css">
<!--
.Style8 {color: #FFFFFF}
.Style19 {
	font-family: Tahoma;
	font-size: 12px;
	color: #990000;
	font-style: italic;
}
.Style20 {
	font-size: 12px;
	font-weight: bold;
}
.Style22 {font-size: 14px}
.Style24 {font-size: 12; font-weight: bold; }
body {
	background-color: #EFB554;
}
.Style25 {	font-family: Verdana;
	font-size: 12px;
	position: relative;
	color: #333333;
	background-color: #EEEEEE;
}
-->
 </style>
</head>

<body>
<SCRIPT LANGUAGE="JavaScript">
function confirmation(index) 
{
var msg = "Êtes-vous sur de vouloir supprimer cette fiche ?";
if (confirm(msg))
location.replace('amicale_priere.php?index='+index+'&faire=supprimer');
}
function control_equipe() 
{
}

</SCRIPT>

<?php
include('../include/base/connexion_serveur.php');
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     SUPPRIME LA FICHE
if ($faire=="supprimer")
	include('include/base/supprimer_soutien.php');
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     MODIFIE LA FICHE
elseif ($faire=="modifier")
{
	include('include/base/charge_equipe.php');
}
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     SAUVE LA FICHE
elseif ($faire=="sauver")
{
	include('include/base/sauve_soutien.php');
}
?>
<table width="1100" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td>
	<p align="center"><?php include('menu.html'); ?><br></p>	
	</td>
  </tr>
  <tr>
    <td>
    	<p align="center" class="Style11">Amicale Prière (commun à toutes les routes)</p>
	</td>
  </tr>
  <tr>
    <td>
        <form method="POST" action="amicale_priere.php" >
        <table border="0">
          <tr class="titre4_anthracite">
            <td>Texte à rechercher</td>
            <td>Année</td>
            <td>Ville</td>
            <td>Pays</td>
            <td>Saisi par</td>
            <td>Route</td>
            <td>Déja imprimé</td>
            <td rowspan=2><button type="button" onclick="self.location.href='fiche_soutien.php?type=priere'"> Nouvelle Fiche</button> </td>
          </tr>
          <tr>
            <td><input id="rech_texte" name="rech_texte" size="20" type="text" value="<?php echo $_POST['rech_texte']?>" onChange="submit()"></td>
            <td><select size="1" id="rech_annee" name="rech_annee" onChange="submit();" >
                  <option value=""></option>
                  <option value="<?php echo $_POST['rech_annee'];?>"  selected="selected" ><?php echo $_POST['rech_annee']; ?></option>
					 <?
					$resultat_index=log_mysql_query("SELECT DISTINCT `annee` FROM `soutien`  ") or die ("Requête non executée.");
                    while ($ligne_index=mysql_fetch_array($resultat_index))
                    {
                        $ligne=stripslashes_deep($ligne);
                        echo '<option value='.$ligne_index["annee"].'>'.$ligne_index["annee"].'</option>';
                    }
                    echo '</select>';
                    ?> </td>
            <td><select size="1" id="rech_ville" name="rech_ville" onChange="submit();" >
                  <option value="<?php echo $_POST['rech_ville'];?>"  selected="selected" ><?php echo $_POST['rech_ville']; ?></option>
                  <option value=""></option>
					 <?
                    $resultat_index=log_mysql_query("SELECT DISTINCT `ville` FROM `soutien`  ") or die ("Requête non executée.");
                    while ($ligne_index=mysql_fetch_array($resultat_index))
                    {
                        $ligne=stripslashes_deep($ligne);
                        echo '<option value='.$ligne_index["ville"].'>'.$ligne_index["ville"].'</option>';
                    }
                    echo '</select>';
                    ?> </td>
            <td><select size="1" id="rech_pays" name="rech_pays" onChange="submit();" >
                  <option value="<?php echo $_POST['rech_pays'];?>"  selected="selected" ><?php echo $_POST['rech_pays']; ?></option>
                  <option value=""></option>
					 <?
                    $resultat_index=log_mysql_query("SELECT DISTINCT `pays` FROM `soutien`  ") or die ("Requête non executée.");
                    while ($ligne_index=mysql_fetch_array($resultat_index))
                    {
                        $ligne=stripslashes_deep($ligne);
                        echo '<option value='.$ligne_index["pays"].'>'.$ligne_index["pays"].'</option>';
                    }
                    echo '</select>';
                    ?> </td>
                    
            <td><select size="1" id="rech_saisi_par" name="rech_saisi_par" onChange="submit();">
                  <option value="<?php echo $_POST['rech_saisi_par'];?>"  selected="selected" ><?php  echo $_POST['rech_saisi_par'];?></option>
                  <option value=""></option>
                  <option value="GG ABS">GG ABS</option>
                  <option value="GG Animateur">GG Animateur</option>
                  <option value="GG Intendance">GG Intendance</option>
                  <option value="GG Media">GG Media</option>
                  <option value="GG Parcours">GG Parcours</option>
                  <option value="GG Priere">GG Prière</option>
                  <option value="GG Santé">GG Santé</option>
                  <option value="GG Secretariat">GG Secretariat</option>
                  <option value="GG Staff">GG Staff</option>
                  <option value="GG Technique">GG Technique</option>
                  <option value="GG Vélo">GG Vélo</option>
                  <option value="GGG">GGG</option>
                  <option value="OGM">OGM</option>
                </select></td>
            <td><select size="1" id="rech_departement" name="rech_departement" onChange="submit();" >
                  <option value=""></option>
                  <option value="<?php echo $_POST['rech_departement'];?>"  selected="selected" ><?php echo $_POST['rech_departement']; ?></option>
					 <?
                    $resultat_index=log_mysql_query("SELECT DISTINCT `departement` FROM `soutien`  ") or die ("Requête non executée.");
                    while ($ligne_index=mysql_fetch_array($resultat_index))
                    {
                        $ligne=stripslashes_deep($ligne);
                        echo '<option value='.$ligne_index["departement"].'>'.$ligne_index["departement"].'</option>';
                    }
                    echo '</select>';
                    ?> </td>
            <td><select size="1" id="rech_imprime" name="rech_imprime" onChange="submit();">
                  <option value="<?php echo $_POST['rech_imprime']?>"  selected="selected" ><?php echo $_POST['rech_imprime'];?></option>
                          <option value=""></option>
                          <option value="Oui">Oui</option>
                          <option value="Non">Non</option>
                    </select></td>
          </table>
        <table width="1200" border="0">
          <tr class="titre4_anthracite">
            <td>Société / Communauté</td>
            <td>Titre</td>
            <td>Nom</td>
            <td>Pr&eacute;nom</td>
            <td width="100">Observations</td>
            <td>Courriel</td>
            <td>N° Tel</td>
            <td>N° Mobil</td>
            <td>Impression</td>
            <td>Actions</td>
            </tr>
        <?php  
			$_where= 'Where 1=1 ';
			if ($_POST['rech_texte']<>"") $_where=$_where.' AND (`type` LIKE \'%'.$_POST['rech_texte'].'%\' OR societe LIKE \'%'.$_POST['rech_texte'].'%\' OR titre LIKE \'%'.$_POST['rech_texte'].
			'%\' OR nom_usage LIKE \'%'.$_POST['rech_texte'].'%\' OR prenom LIKE \'%'.$_POST['rech_texte'].'%\' OR adresse_1 LIKE \'%'.$_POST['rech_texte'].'%\' OR adresse_2 LIKE \'%'.$_POST['rech_texte'].
			'%\' OR adresse_3 LIKE \'%'.$_POST['rech_texte'].'%\' OR ville LIKE \'%'.$_POST['rech_texte'].'%\' OR pays LIKE \'%'.$_POST['rech_texte'].
			'%\' OR observations LIKE \'%'.$_POST['rech_texte'].'%\')';
			if ($_POST['rech_annee']<>"") $_where=$_where.' AND annee=\''.$_POST['rech_annee'].'\' ';
			if ($_POST['rech_ville']<>"") $_where=$_where.' AND ville=\''.$_POST['rech_ville'].'\' ';
			if ($_POST['rech_pays']<>"") $_where=$_where.' AND pays=\''.$_POST['rech_pays'].'\' ';
			if ($_POST['rech_saisi_par']<>"") $_where=$_where.' AND saisi_par=\''.$_POST['rech_saisi_par'].'\' ';
			if ($_POST['rech_departement']<>"") $_where=$_where.' AND departement=\''.$_POST['rech_departement'].'\' ';
			if ($_POST['rech_imprime']=="Oui") $_where=$_where.' AND year(date_impression )>='.date('Y').' ';
			if ($_POST['rech_imprime']=="Non") $_where=$_where.' AND year(date_impression )<'.date('Y').' ';
			
			$req_liste= "  SELECT * FROM soutien ".$_where."   order by societe,nom,prenom" ;
			$res_liste= log_mysql_query($req_liste , $mysql);
			while ($tabres = mysql_fetch_array ($res_liste))
			{$tabres=stripslashes_deep($tabres);
             ?>
            <tr bordercolor="#666666" class="Style25">
            <td><?php echo '<a id="info_bulle" class="info_bulle">'.$tabres['societe'].'<span>';
						if ($tabres['adresse_1']<>"") echo $tabres['adresse_1'].'<br>';
						if ($tabres['adresse_2']<>"") echo $tabres['adresse_2'].'<br>';
						if ($tabres['adresse_3']<>"") echo $tabres['adresse_3'].'<br>';
						echo $tabres['cdpostal'].'  '.$tabres['ville'].'<br>';
						if ($tabres['pays']<>"") echo $tabres['pays'].'<br>';
						echo '</span></a>' ; ?>  </td>
            <td><?php echo $tabres['titre']; ?>  </td>
            <td><?php echo $tabres['nom_usage']; ?>  </td>
            <td><?php echo $tabres['prenom']; ?>  </td>
            <td><?php if ($tabres['observations']<>'') echo '<a id="info_bulle" class="info_bulle">+ d\'infos<span>'.$tabres['observations'].'</span></a>' ; ?>   </td>
            <td><?php echo $tabres['courriel']; ?>  </td>
            <td><?php echo $tabres['telephone']; ?>  </td>
            <td><?php echo $tabres['tel_mobile']; ?>  </td>
            <td><?php echo $tabres['date_impression']; ?>  </td>
            <td><?php echo '<a href="fiche_soutien.php?type=priere&faire=modifier&index='.$tabres['index_soutien'].'"><img src="../Photo/modifier.png" border="0" height="20" Title="Modifier"></a>    '; 
					  echo '<img src="../Photo/corbeille.jpg"  height="20" Title="Supprimer" onClick="confirmation('.$tabres['index_soutien'].');">  '; 			
					  echo '<a href="imprim_soutien.php?index='.$tabres['index_soutien'].'"><img src="../Photo/imprimer.gif" border="0" height="20" Title="Imprimer la carte postale"></a>'; 			
			
			
			?>  </td>
            </tr>
            <?php
             }
            ?>
        </table>
        
        
        
	</td>
  </tr>
</table>





</body>
</html>
