<?php
error_reporting(E_ERROR | E_PARSE);
//if database already exists dont show the installation process
$db = 'tamarind';
if (mysql_select_db($db, mysql_connect('localhost','root','')))
{
    header('Location:already_installed.php');
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
                <span class="selected">Start Installation</span>
                <span>Finish installation</span>
            </div>
            <div class="cbo"></div>
        </div>
        
        <div id="install_content" class="p30" style="height:120px;">
            <p>
            This is trail version of the software. You can use it for 7 days.
            </p>
            <p>
            Please click "Next" button below to install the trial version of the software.
            </p>
            <p>
            This may take few seconds to finish. If the installation process exceeds 1 minute please try installing it again.
            </p>
        </div>
        
        <div id="install_actions" class="p10 bcd">
            <a href="import.php" class="button fr" style="margin-left:-1px;">Next</a>
            <a href="index.php" class="button fr">Cancel</a>
            <div class="cbo"></div>
        </div>
    </div>
</div>

</body>
</html>