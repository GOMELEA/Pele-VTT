 <body>
<?php
if ($index<>"")
{
$req_inscription="DELETE FROM  `route` WHERE `index_route`=$index ;";
$res_insertion =    log_mysql_query($req_inscription  , $mysql );
mysql_close();
}
?>
 </body>
