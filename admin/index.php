<?php
error_reporting(E_ERROR | E_PARSE);
require_once("../conn.php");
require_once("../platform/query.php");
require_once("../platform/helpers/content_helper.php");
$deleted = $_GET['deleted'];
$db = new query($con);
$company = $db->select("name","company");
$company_name = $company[0]["name"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
	<head>
		<title>Admin page - <?php echo $company_name; ?></title>
		<style type="text/css">
			@import url("../styles/admin.css");
			@import url("../styles/default.css");
		</style>
	</head>

	<body>
		<div id="topBar" class="shadow_med">
			<div id="topBarLinks" class="contentWidth ma">
				<a href="index.php">Home</a>
			</div>
			<?php clearBoth(); ?>
		</div>

		<div class="contentWidth ma">
			<div class="pt60">
				<div class="">
					<a href="functions/empty_db.php?id=alwl">Empty auction lists and weight lists</a>
					<?php 
					if ($deleted == 'alwl')
					{
						?>
						<span class="ca fb"> - Deleted</span>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</body>

</html>