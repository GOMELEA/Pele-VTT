<?php
require_once('./base/connexion_serveur.php');

if(isset($_POST['queryString'])) {

		$queryString = $_POST['queryString'] ;

		if(strlen($queryString) > 0) {
			
			$queryString = strtoupper($queryString);
			
			$query  = "select LTRIM(CONCAT_WS(' ', REPLACE(REPLACE(c.artmin, '(',''), ')', ''), c.nccenr)) as commune
                    		, CONCAT_WS(' ', d.dep, d.nccenr) as dept
                          from communes c
						     , departements d
                          where (d.dep = c.dep OR SUBSTRING(c.pole, 0, 2) = d.dep)
						  and ( UPPER(LTRIM(CONCAT_WS(' ', REPLACE(REPLACE(c.artmin, '(',''), ')', ''), c.nccenr))) like '" . $queryString . "%'" .
						        "or UPPER(c.nccenr) like '" . $queryString . "%') 
						  LIMIT 0,10";
			
			// setlocale(LC_CTYPE, 'fr_FR.UTF-8');
			
			$result = mysql_query($query, $mysql);
			
			if (false === $result) {
				echo mysql_error();
			} else {
				
			// mb_internal_encoding('UTF-8');
			
			while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {

				// echo '<li onClick="fillCommune(\''.iconv('UTF-8', 'ISO-8859-15',$row['commune']).'\'); fillDept(\''.iconv('UTF-8', 'ISO-8859-15',$row['dept']).'\');">'.iconv('UTF-8', 'ISO-8859-15',$row['commune']).'</li>';
				echo '<li onClick="fillCommune(\''.htmlspecialchars($row['commune']).'\'); fillDept(\''.htmlentities($row['dept']).'\');">'.htmlspecialchars($row['commune']).'</li>';

			}
		}

		}

	}

?>