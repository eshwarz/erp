<?php
require_once('../functions/functions.php');
$bags = $_REQUEST["lotNumber"];
$settings = settings();
$multiple_buyers = $settings['multiple_buyers'];
?>

<?php
if (!empty($bags))
{
	?>
	<div class="fb tc p10 pb5">Enter Weights</div>
    <?php
}

for ($m=1;$m<=$bags;$m++)
{
    ?>
    <div class="sideHeader mt5">
        <div class="w100 fl p3 pl10">Bag <?php echo $m; ?></div>

        <?php
        if ($multiple_buyers == 1)
        {
            ?>
            <div class="fr">
                <select name="buyer<?php echo $m; ?>" id="buyer<?php echo $m; ?>" style="width:100px;margin-left:-1px;">
                    <option value="">Buyer</option>
                    <?php
                    $db = new query;
                    $records = $db->select("id,name","buyers","","name",0,0,1000);
                    for ($p=0;$p<count($records);$p++)
                    {
                        ?>
                        <option value="<?php echo $records[$p]["id"]; ?>"><?php echo ucwords($records[$p]["name"]); ?></option>
                        <?php
                    }
                    ?>

                </select>
            </div>
            <div class="fr">
                <input type="text" id="bag<?php echo $m; ?>" value="Enter Weight" onfocus="unfill(this.id,'Enter Weight');" onblur="fill(this.id,'Enter Weight');" style="width:100px;padding:4px;" />
            </div>
            <?php
        }
        else
        {
            ?>
            <div class="fr">
                <input type="text" id="bag<?php echo $m; ?>" value="Enter Weight" onfocus="unfill(this.id,'Enter Weight');" onblur="fill(this.id,'Enter Weight');" />
            </div>
            <?php
        }
        ?>
        
        <div class="cbo"></div>
    </div>
    <?php
}
?>