<?php
require('platform/sql_uploads.php');
$dbms_schema = 'database.sql';
$host = "localhost";
$user = "root";
$pass = "";
$db = 'tamarind';

$sql_query = @fread(@fopen($dbms_schema, 'r'), @filesize($dbms_schema)) or die('problem ');
$sql_query = remove_remarks($sql_query);
$sql_query = split_sql_file($sql_query, ';');

mysqli_connect($host,$user,$pass) or die('error connection');

//if database already exists dont show the installation process
if (mysqli_select_db($db, mysqli_connect('localhost','root','')))
{
    header('Location:already_installed.php');
}

//creating a database
$create_db = 'CREATE DATABASE '.$db;
$create_db_result = mysqli_query($con, ($create_db);
if (!$create_db_result)
{
   die('Error creating database!');
}

//selecting the database
mysqli_select_db($db) or die('error database selection');

$i=1;
foreach($sql_query as $sql){
//echo $i++;
mysqli_query($con, ($sql) or die('error in query');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tamarind Business</title>
<style type="text/css">
@import url("styles/main.css");
@import url("styles/default.css");
/*@import url("styles/screen.css");
@import url("styles/print.css");*/
</style>
<style type="text/css">
body {background:#666;}
</style>
<?php require("favicon.php"); ?>
<?php require_once("scripts.php"); ?>
</head>
<body>


<div>
    <div class="bbg shadow_med dontPrint">
        <div class="ma cf tc main_links lh40" style="width:980px;" id="main_links">
            <div class="tc fb">Software Installation (Trial Version)</div>
        </div>
    </div>

    <div class="ma mt50 mb50" style="width:500px;" id="install_window">
        
        <div class="bc3" style="" id="install_header">
            <div class="bca db" style="width:500px;">
                <span>Start Installation</span>
                <span class="selected">Finish installation</span>
            </div>
            <div class="cbo"></div>
        </div>
        
        <div id="install_content" class="p30" style="height:120px;">
        		<p>
        		You have succesfully completed the installation process. Please click on finish. To start using the sofware.
        		</p>
            <p>
            This is purely experimental version released for trial purposes. Most of the features are in working condition, You might be able to take out the print outs of bill in proper manner. Use it at your own risk.
            </p>
        </div>
        
        <div id="install_actions" class="p10 bcd">
            <a href="index.php?install=trial" class="button fr">Finish</a>
            <div class="cbo"></div>
        </div>
    </div>
</div>

</body>
</html>