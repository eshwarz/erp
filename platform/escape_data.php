<?php
function escape_data ($data) 
{
	global $con; // Need the connection.
	if (ini_get('magic_quotes_gpc')) 
	{
		$data = stripslashes($data);
	}
	$data = str_replace("\n","<br>",$data);
	return mysqli_real_escape_string($con, trim($data));
}
?>