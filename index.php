<?php
error_reporting(E_ERROR | E_PARSE);
$tab = "index";
// require_once("pdo_mysql.php");
require_once("conn.php");
require_once("destroy/self_destruct.php");
self_destruct();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tamarind Business</title>

<style type="text/css" media="screen">
@import url("styles/main.css");
@import url("styles/default.css");
/*@import url("styles/screen.css");*/
</style>

<style type="text/css" media="print">
@import url("styles/print.css");
</style>

<?php require("favicon.php"); ?>
<?php require_once("scripts.php"); ?>
</head>
<body>


<div>

	<?php require_once("main_links/main_links.php"); ?>
    
    <?php
	$company = new query;
	$companyRecords = $company->select("name,town","company");
	$companyName = $companyRecords[0]["name"];
	$companyTown = $companyRecords[0]["town"];
	?>
    <div class="ma pt20 pb20" style="width:980px;" id="mainContent">
    	<div class="wa bce brd_b">
        	<div class="wa p10 cf tc bbg fb"><?php echo $companyName; ?></div>
            <div class="pt20 pb20">
                
            </div>
        </div>
    </div>
    
    <?php
    require_once("popup/popup.php");
    ?>
</div>


</body>
</html>