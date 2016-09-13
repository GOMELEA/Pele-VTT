<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
      session_start(); 
	  $type = $_GET["type"];
	  $index = $_GET["index"];
	  $faire = $_GET["faire"];
	  $where = $_GET["where"];
	  $courriel = $_GET["courriel"];
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
	location.replace('soutien.php?index='+index+'&faire=supprimer&type=priere');
}
function envoie_etiquette(type) 
{
	courriel=prompt("Un fichier pdf pour des pages de 24 étiquettes (70*37mm) a été généré. \nEntrez le courriel à qui vous voulez envoyer ce fichier :","");
	if (type=='priere') {location.replace('soutien.php?type=priere&faire=etiquette&courriel='+courriel+'')}
	else {location.replace('soutien.php?faire=etiquette&courriel='+courriel+'')}
}
</SCRIPT>

<?php
include('../include/base/connexion_serveur.php');
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     SUPPRIME LA FICHE DE SOUTIEN
if ($faire=="supprimer")
	include('include/base/supprimer_soutien.php');
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     IMPRIME LES ETIQUETTES
if ($faire=="etiquette")
	include('include/etiquette_pdf.php');
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     SAUVE LA FICHE DE SOUTIEN
elseif ($faire=="sauver")
	include('include/base/sauve_soutien.php');
?>
<table width="1100" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td>
	<p align="center"><?php include('menu.html'); ?><br></p>
	</td>
  </tr>
  <tr>
    <td>
    	<p align="center" class="Style11"><? if ($type=='priere') echo 'Amicale Prière (commun à toutes les routes)'; else echo 'Autres Soutiens';?></p>
	</td>
  </tr>
  <tr> 
    <td>
        <form method="POST" action="<? if ($type=='priere') echo 'soutien.php?type=priere'; else echo 'soutien.php';?>" >

		<!-- ************ SELECTION ***************  -->
        <table border="0">
          <tr class="titre4_anthracite">   <!-- ************ TITRE DES FILTRES DE SELECTION ***************  -->
            <td>Texte à rechercher</td>
            <? if ($type=='priere') echo '<td>Année</td>';?>
            <? if ($type<>'priere') echo '<td>Type</td>';?>
            <td>Ville</td>
            <td>Pays</td>
            <td>Saisi par</td>
            <? if ($type=='priere') echo '<td>Route</td>';?>
            <td>Déja imprimé</td> 
            <td rowspan=2><button type="button" onclick="self.location.href='fiche_soutien.php<? if ($type=='priere') echo '?type=priere';?>'"> Nouvelle Fiche</button> </td>
            <td rowspan=2><INPUT TYPE='Button' onClick='envoie_etiquette(<? if ($type=='priere') echo '"priere"'?>)' VALUE='Etiquette'> </td>
            <td rowspan=2><button TYPE='Button' onClick="self.location.href='export_soutien_xls.php'" >Export Excel </button></td>
          </tr>
          <?
            if ($type<>'priere') $_where='WHERE annee='.$_SESSION['annee'].' and departement="'.$_SESSION['n_departement'].'" and `type`<>\'priere\' ';
            else $_where='WHERE `type`=\'priere\' ';
		  ?>
          <tr>                              <!-- ************ FILTRES DE SELECTION ***************  -->
            <td>
                <input id="rech_texte" name="rech_texte" size="20" type="text" value="<?php echo $_POST['rech_texte']?>" onChange="submit()"></td>
             <? if ($type=='priere') // ****************** FILTRE SUR L'ANNEE
			 	{echo '
            <td><select size="1" id="rech_annee" name="rech_annee" onChange="submit();" >
                  <option value=""></option>
                  <option value="'.$_POST['rech_annee'].'"  selected="selected" >'.$_POST['rech_annee'].'</option>';
					$resultat_index=log_mysql_query("SELECT DISTINCT `annee` FROM `soutien`  ".$_where." order by `annee`",$mysql) or die ("Requête non executée.");
                    while ($ligne_index=mysql_fetch_array($resultat_index))
                    {
                        $ligne=stripslashes_deep($ligne);
                        echo '<option value='.$ligne_index["annee"].'>'.$ligne_index["annee"].'</option>';
                    }
                    echo '</select>';} ?>
			</td>
             <? if ($type<>'priere')  // ****************** FILTRE SUR LE TYPE
			 	{echo '
            <td><select size="1" id="rech_type" name="rech_type" onChange="submit();" >
                  <option value=""></option>
                  <option value="'.$_POST['rech_type'].'"  selected="selected" >'.$_POST['rech_type'].'</option>';
					$resultat_index=log_mysql_query("SELECT DISTINCT `type` FROM `soutien`  ".$_where,$mysql) or die ("Requête non executée.");
                    while ($ligne_index=mysql_fetch_array($resultat_index))
                    {
                        $ligne=stripslashes_deep($ligne);
                        echo '<option value="'.$ligne_index["type"].'">'.$ligne_index["type"].'</option>';
                    }
                    echo '</select>';} ?>
			</td>
            <td><select size="1" id="rech_ville" name="rech_ville" onChange="submit();" >
                  <option value="<?php echo $_POST['rech_ville'];?>"  selected="selected" ><?php echo $_POST['rech_ville']; ?></option>
                  <option value=""></option>
					 <?				// ****************** FILTRE SUR LA VILLE
                    $resultat_index=log_mysql_query("SELECT DISTINCT `ville` FROM `soutien`  ".$_where,$mysql) or die ("Requête non executée.");
                    while ($ligne_index=mysql_fetch_array($resultat_index))
                    {
                        $ligne=stripslashes_deep($ligne);
                        echo '<option value="'.$ligne_index["ville"].'">'.$ligne_index["ville"].'</option>';
                    }
                    echo '</select>';
                    ?> </td>
            <td><select size="1" id="rech_pays" name="rech_pays" onChange="submit();" >
                  <option value="<?php echo $_POST['rech_pays'];?>"  selected="selected" ><?php echo $_POST['rech_pays']; ?></option>
                  <option value=""></option>
					 <?				// ****************** FILTRE SUR LE PAYS
                    $resultat_index=log_mysql_query("SELECT DISTINCT `pays` FROM `soutien`  ".$_where,$mysql) or die ("Requête non executée.");
                    while ($ligne_index=mysql_fetch_array($resultat_index))
                    {
                        $ligne=stripslashes_deep($ligne);
                        echo '<option value="'.$ligne_index["pays"].'">'.$ligne_index["pays"].'</option>';
                    }
                    echo '</select>';
                    ?> </td>
            <td><select size="1" id="rech_saisi_par" name="rech_saisi_par" onChange="submit();">
                  <option value="<?php echo $_POST['rech_saisi_par'];?>"  selected="selected" ><?php echo $_POST['rech_saisi_par']; ?></option>
                  <option value=""></option>
					 <?				// ****************** FILTRE SUR SAISI PAR
                    $resultat_index=log_mysql_query("SELECT DISTINCT `saisi_par` FROM `soutien`  ".$_where,$mysql) or die ("Requête non executée.");
                    while ($ligne_index=mysql_fetch_array($resultat_index))
                    {
                        $ligne=stripslashes_deep($ligne);
                        echo '<option value="'.$ligne_index["saisi_par"].'">'.$ligne_index["saisi_par"].'</option>';
                    }
                    echo '</select>';
                    ?> </td>
             <? if ($type=='priere') // ****************** FILTRE SUR LA ROUTE
			 	{echo '				
            <td><select size="1" id="rech_departement" name="rech_departement" onChange="submit();" >
                  <option value=""></option>
                  <option value="'.$_POST['rech_departement'].'"  selected="selected" >'.$_POST['rech_departement'].'</option>';
					$resultat_index=log_mysql_query("SELECT DISTINCT `departement` FROM `soutien`  ".$_where,$mysql) or die ("Requête non executée.");
                    while ($ligne_index=mysql_fetch_array($resultat_index))
                    {
                        $ligne=stripslashes_deep($ligne);
                        echo '<option value='.$ligne_index["departement"].'>'.$ligne_index["departement"].'</option>';
                    }
                    echo '</select>
					</td>';}
			?>						<!-- **************** FILTRE SUR LA ROUTE  -->
            <td><select size="1" id="rech_imprime" name="rech_imprime" onChange="submit();">
                  <option value="<?php echo $_POST['rech_imprime']?>"  selected="selected" ><?php echo $_POST['rech_imprime'];?></option>
                          <option value=""></option>
                          <option value="Oui">Oui</option>
                          <option value="Non">Non</option>
                    </select></td>
         </tr>
        </table>
        </form>
        <br>

		<!-- ************ AFFICHAGE DES RESULTATS ***************  -->
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
        <?php   // ****************** CALCUL DU FILTRE POUR LA REQUETE SQL
			if ($type<>'priere') $_where='WHERE annee='.$_SESSION['annee'].' and departement="'.$_SESSION['n_departement'].'" and `type`<>\'priere\' ';
			else $_where='WHERE `type`=\'priere\' ';
			if ($_POST['rech_texte']<>"") $_where=$_where.' AND (`type` LIKE \'%'.$_POST['rech_texte'].'%\' OR societe LIKE \'%'.$_POST['rech_texte'].'%\' OR titre LIKE \'%'.$_POST['rech_texte'].
			'%\' OR nom LIKE \'%'.$_POST['rech_texte'].'%\' OR prenom LIKE \'%'.$_POST['rech_texte'].'%\' OR adresse_1 LIKE \'%'.$_POST['rech_texte'].'%\' OR adresse_2 LIKE \'%'.$_POST['rech_texte'].
			'%\' OR adresse_3 LIKE \'%'.$_POST['rech_texte'].'%\' OR ville LIKE \'%'.$_POST['rech_texte'].'%\' OR pays LIKE \'%'.$_POST['rech_texte'].
			'%\' OR observations LIKE \'%'.$_POST['rech_texte'].'%\')';
			if ($_POST['rech_type']<>"" ) $_where=$_where.' AND type=\''.$_POST['rech_type'].'\' ';
			if ($_POST['rech_annee']<>"") $_where=$_where.' AND annee=\''.$_POST['rech_annee'].'\' ';
			if ($_POST['rech_ville']<>"") $_where=$_where.' AND ville=\''.$_POST['rech_ville'].'\' ';
			if ($_POST['rech_pays']<>"") $_where=$_where.' AND pays=\''.$_POST['rech_pays'].'\' ';
			if ($_POST['rech_saisi_par']<>"") $_where=$_where.' AND saisi_par=\''.$_POST['rech_saisi_par'].'\' ';
			if ($_POST['rech_departement']<>"") $_where=$_where.' AND departement=\''.$_POST['rech_departement'].'\' ';
			if ($_POST['rech_imprime']=="Oui") $_where=$_where.' AND year(date_impression )>='.date('Y').' ';
			if ($_POST['rech_imprime']=="Non") $_where=$_where.' AND year(date_impression )<'.date('Y').' ';
			
			$_SESSION['where_soutien']=$_where;
			$req_liste= "  SELECT * FROM soutien ".$_where."   order by societe,nom,prenom" ;
			$res_liste= log_mysql_query($req_liste , $mysql);
			while ($tabres = mysql_fetch_array ($res_liste))
			{$tabres=stripslashes_deep($tabres);
             ?>
          <tr bordercolor="#666666" class="Style25"> <!-- ************ AFFICHAGE DES LIGNES DE RESULTATS ***************  -->
            <td><?php echo '<a id="info_bulle" class="info_bulle">'.$tabres['societe'].'<span>';
						if ($tabres['adresse_1']<>"") echo $tabres['adresse_1'].'<br>';
						if ($tabres['adresse_2']<>"") echo $tabres['adresse_2'].'<br>';
						if ($tabres['adresse_3']<>"") echo $tabres['adresse_3'].'<br>';
						echo $tabres['cdpostal'].'  '.$tabres['ville'].'<br>';
						if ($tabres['pays']<>"") echo $tabres['pays'].'<br>';
						echo '</span></a>' ; ?>  </td>
            <td><?php echo $tabres['titre']; ?>  </td>
            <td><?php echo $tabres['nom']; ?>  </td>
            <td><?php echo $tabres['prenom']; ?>  </td>
            <td><?php if ($tabres['observations']<>'') echo '<a id="info_bulle" class="info_bulle">+ d\'infos<span>'.$tabres['observations'].'</span></a>' ; ?>   </td>
            <td><?php echo $tabres['courriel']; ?>  </td>
            <td><?php echo $tabres['telephone']; ?>  </td>
            <td><?php echo $tabres['tel_mobile']; ?>  </td>
            <td><?php echo $tabres['date_impression']; ?>  </td>
            <td><?php echo '<a href="fiche_soutien.php?'; if ($type=="priere") echo 'type=priere'; 
						echo '&faire=modifier&index='.$tabres['index_soutien'].'"><img src="../Photo/modifier.png" border="0" height="20" Title="Modifier"></a>    '; 
					  echo '<img src="../Photo/corbeille.jpg"  height="20" Title="Supprimer" onClick="confirmation('.$tabres['index_soutien'].');">  '; 			
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
