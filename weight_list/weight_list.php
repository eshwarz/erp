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
          <div class="w100 fl p5 pl10">Serial Number</div>
          <div class="fr">
            <input type="text" id="serialNumber" placeholder="Serial Number" />
          </div>
          <div class="cbo"></div>
        </div>
        <?php
      }
      ?>

      <div class="sideHeader mt5">
        <div class="w100 fl p5 pl10">Farmer ID</div>
        <div class="fr">
          <input type="text" id="fid" placeholder="Farmer ID" onkeyup="getVillage(this.id,'getVillage','showVillage');" />
        </div>
        <div class="cbo"></div>
      </div>

      <div id="selectFarmerModule">
        <div class="sideHeader mt5">
          <div class="w100 fl p5 pl10">Farmer</div>
          <div class="pr fr">
            <select name="farmer" id="farmer">
              <option value="">Select Farmer</option>
              <?php
              $db = new query($con);
              $records = $db->select("id,name,fid,village_id","farmers","","name",0,0,20000);
              for ($m=0;$m<count($records);$m++)
              {
                ?>
                <option value="<?php echo $records[$m]["id"]; ?>">
                  <?php echo ucwords($records[$m]["name"]." (".$records[$m]["fid"].")"); ?>
                </option>
                <?php
              }
              ?>
            </select>
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
            $db = new query($con);
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
            $db = new query($con);
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
        <div class="w100 fl p5 pl10">Cost</div>
        <div class="fr">
          <input type="text" id="cost" placeholder="Cost" />
        </div>
        <div class="cbo"></div>
      </div>
      
      <div class="sideHeader mt5">
        <div class="w100 fl p5 pl10">Lot Number</div>
        <div class="fr">
          <input type="number" id="lotNumber" class="lotNumber" placeholder="Lot Number" />
          <input type="hidden" id="multiple_buyers" value="<?php echo $settings['multiple_buyers']; ?>" />
        </div>
        <div class="cbo"></div>
      </div>

      <div class="sideHeader mt5">
        <div class="w100 fl p5 pl10">Total Weight</div>
        <div class="fr">
          <input type="number" id="totalWeight" placeholder="Total Weight" />
        </div>
        <div class="cbo"></div>
      </div>
      
      <div id="startWeights"></div>
      
      <div class="sideHeader mt5" style="background-color:transparent;">
        <div class="w100 fl p5 pl10"></div>
        <div class="fr">
          <?php
          if ($settings['serial_numbers'] == 1)
          {
            ?>
            <input type="submit" class="button" value="Save" id="weightListPost" onclick="ajaxPost('weight_list/weight_list_q.php','farmer_new,village,farmer,quality,buyer,cost,lotNumber,serialNumber,totalWeight','result');this.form.reset();document.getElementById('farmer').focus();return false;" />
            <?php
          }
          else
          {
            ?>
            <input
              type="submit"
              class="button"
              value="Save"
              id="weightListPost"
              onclick="ajaxPost('weight_list/weight_list_q.php','farmer_new,village,farmer,quality,buyer,cost,lotNumber,totalWeight','result');this.form.reset();document.getElementById('farmer').focus();return false;" />
            <?php
          }
          ?>
        </div>
        <div class="cbo"></div>
      </div>
    </form>
  </div>
</div>