<?php
error_reporting(E_ERROR | E_PARSE);
require_once("../conn.php");
require_once("../platform/query.php");
require_once("../functions/functions.php");
$settings = settings();
?>
<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg">Weight List</div>
    <div id="result"></div>
    <div class="pt20 pb20">
        <form>
        	<?php
            if ($settings['serial_numbers'] == 1)
            {
                ?>
                <div class="sideHeader mt5">
                    <div class="w100 fl p3 pl10">Serial Number</div>
                    <div class="fr">
                        <input type="text" value="Serial Number" id="serialNumber" class="" onfocus="unfill(this.id,'Serial Number');" onblur="fill(this.id,'Serial Number');" />
                    </div>
                    <div class="cbo"></div>
                </div>
                <?php
            }
            ?>
            <div id="newFarmerModule" class="dn">
            	<div class="sideHeader">
                    <div class="w100 fl p3 pl10">Farmer</div>
                    <div class="pr fr">
                        <div class="fl">
                            <input type="text" value="Farmer's name" id="farmer_new" onfocus="unfill(this.id,'Farmer\'s name');" onblur="fill(this.id,'Farmer\'s name');" style="width:152px;"/>
                        </div>
                        <div class="fl button" id="newFarmer" style="padding:3px 5px;" onclick="selectFarmerModule();">Select
                        </div>
                    </div>
                    <div class="cbo"></div>
                </div>
                
                <div class="sideHeader mt5">
                    <div class="w100 fl p3 pl10">Select Village</div>
                    <div class="pr fr">
                        <select name="village" id="village">
                            <option value="">Select Anyone</option>
                            <?php
                            $db = new query;
                            $recordArray = $db->select("id,village","villages","","village",0,0,5000);
                            for ($m=0;$m<count($recordArray);$m++)
                            {
                                ?>
                                <option value="<?php echo $recordArray[$m]["id"]; ?>">
                                <?php echo ucwords($recordArray[$m]["village"]); ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="cbo"></div>
                </div>
            </div>
            
            <div id="selectFarmerModule">
                <div class="sideHeader mt5">
                    <div class="w100 fl p5 pl10">Farmer</div>
                    <div class="pr fr">
                        <div class="fl">
                            <select name="farmer" style="width:171px;" id="farmer" onchange="getVillage(this.id,'getVillage','showVillage');">
                                <option value="">Select Farmer</option>
                                <?php
                                $db = new query;
                                $records = $db->select("id,name,village_id","farmers","","name",0,0,20000);
                                for ($m=0;$m<count($records);$m++)
                                {
                                    $get_village_name = $db->select('village','villages','id='.$records[$m]["village_id"]);
                                    $village_name = $get_village_name[0]['village'];
                                    ?>
                                    <option value="<?php echo $records[$m]["id"]; ?>"><?php echo ucwords($records[$m]["name"]." (".$village_name.")"); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="fl button" id="newFarmer" style="padding:4px 5px;" onclick="newFarmerModule();">New</div>
                    </div>
                    <div class="cbo"></div>
                </div>
                
                <div class="sideHeader mt5 dn" id="showVillage">
                    <div class="w100 fl p5 pl10">Village</div>
                    <div class="fr bcf p5 c0 brd_b" style="width:197px;" id="getVillage"></div>
                    <div class="cbo"></div>
                </div>
            </div>
            
            <div class="sideHeader mt5">
            	<div class="w100 fl p5 pl10">Quality</div>
                <div class="fr">
                	<select name="quality" id="quality">
                        <option value="">Select Quality</option>
                        <?php
                        $db = new query;
                        $records = $db->select("id,quality","quality","","id",0,0,1000);
                        for ($m=0;$m<count($records);$m++)
                        {
                            ?>
                            <option value="<?php echo $records[$m]["id"]; ?>"><?php echo ucwords($records[$m]["quality"]); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="cbo"></div>
            </div>
            
            <div class="sideHeader mt5 <?php if($settings['multiple_buyers'] == 1) { echo 'dn'; } ?>">
            	<div class="w100 fl p5 pl10">Buyer</div>
                <div class="fr">
                	<select name="buyer" id="buyer">
                        <option value="<?php if($settings['multiple_buyers'] == 1) { echo '0'; } ?>">Select Buyer</option>
                        <?php
                        $db = new query;
                        $records = $db->select("id,name","buyers","","name",0,0,1000);
                        for ($m=0;$m<count($records);$m++)
                        {
                            ?>
                            <option value="<?php echo $records[$m]["id"]; ?>"><?php echo ucwords($records[$m]["name"]); ?></option>
                            <?php
                        }
                        ?>

                    </select>
                </div>
                <div class="cbo"></div>
            </div>
            
            <div class="sideHeader mt5">
            	<div class="w100 fl p3 pl10">Cost</div>
                <div class="fr">
                	<input type="text" value="Cost" id="cost" onfocus="unfill(this.id,'Cost');" onblur="fill(this.id,'Cost');" />
                </div>
                <div class="cbo"></div>
            </div>
            
            <div class="sideHeader mt5">
            	<div class="w100 fl p3 pl10">Lot Number</div>
                <div class="fr">
                	<input type="text" value="Lot Number" id="lotNumber" class="lotNumber" onfocus="unfill(this.id,'Lot Number');" onblur="fill(this.id,'Lot Number');" />
                    <input type="hidden" id="multiple_buyers" value="<?php echo $settings['multiple_buyers']; ?>" />
                </div>
                <div class="cbo"></div>
            </div>
            
            <div id="startWeights"></div>
            
            <div class="sideHeader mt5" style="background-color:transparent;">
            	<div class="w100 fl p3 pl10"></div>
                <div class="fr">
                    <?php
                    if ($settings['serial_numbers'] == 1)
                    {
                        ?>
                        <input type="submit" class="button" value="Save" id="weightListPost" onclick="ajaxPost('weight_list/weight_list_q.php','farmer_new,village,farmer,quality,buyer,cost,lotNumber,serialNumber','result');this.form.reset();document.getElementById('farmer').focus();return false;" />
                        <?php
                    }
                    else
                    {
                        ?>
                        <input type="submit" class="button" value="Save" id="weightListPost" onclick="ajaxPost('weight_list/weight_list_q.php','farmer_new,village,farmer,quality,buyer,cost,lotNumber','result');this.form.reset();document.getElementById('farmer').focus();return false;" />
                        <?php
                    }
                    ?>
                </div>
                <div class="cbo"></div>
            </div>
        </form>
    </div>
</div>