<?php
try
{
	$db = mysqli_connect("sql102.epizy.com","epiz_31248537","r4IVikgYxfS","epiz_31248537_LiMeet");



if ($db -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
	
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>
