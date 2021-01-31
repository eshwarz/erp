<?php
error_reporting(E_ERROR | E_PARSE);
require_once('conn.php');

$dbname = 'thejbbiu_tamarind';
$sql = "SHOW TABLES FROM $dbname";
$result = mysqli_query($con, $sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysqli_connect_error();
    exit;
}
echo "-----------------------------------------------------------------------";
echo "<br/>";
echo "<b>Tables</b>";
echo "<br/>";
echo "-----------------------------------------------------------------------";
echo "<br/>";
while ($row = mysqli_fetch_row($result)) {
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
	$result = mysqli_query($con, "SHOW FIELDS FROM ".$table);
	while ($row = mysqli_fetch_row($result))
	{
    echo "{$row[0]}";
    echo "<br/>";
	}
	echo "-----------------------------------------------------------------------";
}

$br = "<br/>";

echo $br;
$p = array('sss','ddd','fff','aaa');
$e = '1';
echo gettype($p);
echo $br;
echo gettype($e);
echo $br;

$sql = "SELECT * FROM settings";
$query = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
{
	echo $br;
	echo 'multiple_buyers: '.$row['multiple_buyers'].$br;
	echo 'serial_numbers: '.$row['serial_numbers'].$br;
	// echo 'multiple_buyers'.$row['multiple_buyers'].$br;
}
?>