<?php
error_reporting(5);
require_once('conn.php');

$dbname = 'tamarind';
$sql = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}
echo "-----------------------------------------------------------------------";
echo "<br/>";
echo "<b>Tables</b>";
echo "<br/>";
echo "-----------------------------------------------------------------------";
echo "<br/>";
while ($row = mysql_fetch_row($result)) {
    echo "{$row[0]}";
    echo "<br/>";
}
echo "-----------------------------------------------------------------------";
echo "<br/>";
mysql_free_result($result);
if ($_GET['table'])
{
	echo "-----------------------------------------------------------------------";
	echo "<br/>";
	$table = $_GET['table'];
	echo "<b>".$table."</b><br/>";
	echo "-----------------------------------------------------------------------";
	echo "<br/>";
	$result = mysql_query("SHOW FIELDS FROM ".$table);
	while ($row = mysql_fetch_row($result))
	{
    echo "{$row[0]}";
    echo "<br/>";
	}
	echo "-----------------------------------------------------------------------";
}

$br = "<br/>";

echo $br;
$p = array ('sss','ddd','fff','aaa');
$e = '1';
echo gettype($p);
echo $br;
echo gettype($e);
echo $br;

$sql = "SELECT * FROM settings";
$query = mysql_query($sql);
while ($row = mysql_fetch_array($query))
{
	echo $br;
	echo 'multiple_buyers: '.$row['multiple_buyers'].$br;
	echo 'serial_numbers: '.$row['serial_numbers'].$br;
	// echo 'multiple_buyers'.$row['multiple_buyers'].$br;
}
?>