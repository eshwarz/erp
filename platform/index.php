<?php
require_once("error_reporting.php");
require_once("conn.php");
require_once("query.php");
require_once("dateof.php");
require_once("forms.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Project</title>
<style>
@import url("styles/default.css");
body{font-family:Verdana, Geneva, sans-serif;font-size:12px;color:#FFF;background:#000;}
</style>
</head>
<body>

<?php
$db = new query;

//$db->delete("posts","id=1");
//$db->update("posts","name,post","'Mona Darls','how is its going on honey?'","id=4");
$db->insert("posts","name,post","'Mona Darls','i miss you'");
/*
$recordArray = $db->select("id,name,post,UNIX_TIMESTAMP(time)","posts","name LIKE '%a%'","id",1,0,10);
$record = &$recordArray;

$date = new dateof;

for($m = 0; $m < count($record); $m++)
{
	echo "id = ".$record[$m]["id"]."<br>";
	echo "name = ".$record[$m]["name"]."<br>";
	echo "post = ".$record[$m]["post"]."<br>";
	echo "time = ".$date->month_d_Y_h_m_A($record[$m]["UNIX_TIMESTAMP(time)"],5.5)."<br>";
	echo "<br>"; 
}
*/
?>
<hr />

<?php
$form_elements = new forms;
$form_elements->input("text","fname","Enter First Name","brd_light p5 f12 bca rad5 w200","first_name");
echo "<br /><br />";
$form_elements->textarea("about_me","Describe about you","brd_light p5 f12 bca rad5 w200 h60","about_me");
?>


</body>
</html>