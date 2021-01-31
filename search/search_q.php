<?php
error_reporting(E_ERROR | E_PARSE);
require("../conn.php");
require_once("../platform/query.php");
require_once("../platform/escape_data.php");
$searchString = escape_data($_REQUEST['search']);

$tabIndex = 100;

$farmers = "SELECT * FROM farmers WHERE name LIKE '$searchString%' ORDER BY name LIMIT 0,5";
$farmersResult = mysqli_query($farmers);
$farmersCount = mysql_num_rows($farmersResult);
if ($farmersCount > 0)
{
	?>
    <div class="searchHeader">Farmers</div>
    <?php
	while($rowFarmer = mysql_fetch_array($farmersResult))
	{
		?>
        <div class="searchElements" id="<?php echo $rowFarmer['id']; ?>" tabindex="<?php $tabIndex++; echo $tabIndex; ?>" onmousedown="ajaxpage('search/farmers/farmers.php?farmerId=<?php echo $rowFarmer['id']; ?>','mainContent');">
			<?php
            echo ucwords($rowFarmer['name']);
			?>
        </div>
   		<?php
	}
}

$buyers = "SELECT * FROM buyers WHERE name LIKE '$searchString%' ORDER BY name LIMIT 0,5";
$buyersResult = mysqli_query($buyers);
$buyersCount = mysql_num_rows($buyersResult);
if ($buyersCount > 0)
{
	?>
    <div class="searchHeader">Buyers</div>
    <?php
	while($rowBuyer = mysql_fetch_array($buyersResult))
	{
		?>
        <div class="searchElements" id="<?php echo $rowBuyer['id']; ?>" tabindex="<?php $tabIndex++; echo $tabIndex; ?>" onmousedown="ajaxpage('search/buyers/buyers.php?buyerId=<?php echo $rowBuyer['id']; ?>','mainContent');">
			<?php
            echo ucwords($rowBuyer['name']);
			?>
        </div>
   		<?php
	}
}

$villages = "SELECT * FROM villages WHERE village LIKE '$searchString%' ORDER BY village LIMIT 0,5";
$villagesResult = mysqli_query($villages);
$villagesCount = mysql_num_rows($villagesResult);
if ($villagesCount > 0)
{
	?>
    <div class="searchHeader">Villages</div>
    <?php
	while($rowVillage = mysql_fetch_array($villagesResult))
	{
		?>
        <div class="searchElements" id="<?php echo $rowVillage['id']; ?>" tabindex="<?php $tabIndex++; echo $tabIndex; ?>" onmousedown="">
			<?php
            echo ucwords($rowVillage['village']);
			?>
        </div>
   		<?php
	}
}
?>

<div class="resultFooter">
	<?php echo "Results for &quot;".$searchString."&quot;";?>
</div>