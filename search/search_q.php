<?php
error_reporting(E_ERROR | E_PARSE);
require("../conn.php");
require_once("../platform/query.php");
require_once("../platform/escape_data.php");
$searchString = escape_data($_REQUEST['search']);

$tabIndex = 100;

$farmers = "SELECT * FROM farmers WHERE name LIKE '$searchString%' ORDER BY name LIMIT 0,5";
$farmersResult = mysqli_query($con, $farmers);
$farmersCount = mysqli_num_rows($farmersResult);
if ($farmersCount > 0)
{
  ?>
  <div class="searchHeader">Farmers</div>
  <?php
  while($rowFarmer = mysqli_fetch_array($farmersResult, MYSQLI_ASSOC))
  {
    ?>
    <div
      class="searchElements"
      id="<?php echo $rowFarmer['id']; ?>"
      tabindex="<?php $tabIndex++; echo $tabIndex; ?>"
      onmousedown="ajaxpage('search/farmers/farmers.php?farmerId=<?php echo $rowFarmer['id']; ?>','mainContent');"
    >
      <?php
        echo ucwords($rowFarmer['name']);
      ?>
    </div>
    <?php
  }
}

$buyers = "SELECT * FROM buyers WHERE name LIKE '$searchString%' ORDER BY name LIMIT 0,5";
$buyersResult = mysqli_query($con, $buyers);
$buyersCount = mysqli_num_rows($buyersResult);
if ($buyersCount > 0)
{
  ?>
    <div class="searchHeader">Buyers</div>
  <?php
  while($rowBuyer = mysqli_fetch_array($buyersResult, MYSQLI_ASSOC))
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
$villagesResult = mysqli_query($con, $villages);
$villagesCount = mysqli_num_rows($villagesResult);
if ($villagesCount > 0)
{
  ?>
    <div class="searchHeader">Villages</div>
    <?php
  while($rowVillage = mysqli_fetch_array($villagesResult, MYSQLI_ASSOC))
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

<?php
// option for opening the farmer with ID directly
var_dump(is_numeric($searchString));
if (is_numeric($searchString)) {
  $db = new query($con);
  $farmer = $db->select('id,fid,name','farmers','fid='.$searchString);
  
  if ($farmer)
  {
    var_dump($farmer);
    ?>
    <div class="resultFooter">
      <?php echo "Results for &quot;".$searchString."&quot;";?>
    </div>
    <?php
  }
}
?>
