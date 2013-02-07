
<div class="bbg shadow_med dontPrint">
    <div class="ma cf tc main_links" style="width:980px;" id="main_links">
    	
        <a href="index.php" id="home" class="<?php if($tab=="index"){echo "selected";}?>">Home</a>
        
        <div id="tabs">
        
            <div class="flyoutContainers jewelBox ml10" id="newTab">
                <a href="#" class="" id="newButton" onmouseover="open_accordion('tabs','new','flyoutContainer'); tabLinks('newTab',this.id);">Add</a>
                <div id="new" class="flyoutContainer" style="display:none;">
                    <span onclick="ajaxpage('new/add_village.php','mainContent');">Village</span>
                    <span onclick="ajaxpage('new/add_farmer.php','mainContent');">Farmer</span>
                    <span onclick="ajaxpage('new/add_buyer.php','mainContent');">Buyer</span>
                    <span onclick="ajaxpage('new/add_quality.php','mainContent');">Quality</span>
                </div>
            </div>
            
            <div class="flyoutContainers jewelBox ml10" id="viewTab">
                <a href="#" class="" id="viewButton" onmouseover="open_accordion('tabs','view','flyoutContainer'); tabLinks('viewTab',this.id);">View</a>
                <div id="view" class="flyoutContainer" style="display:none;">
                	<span onclick="ajaxpage('view/auctions/view_auction_list.php','mainContent');">Auction List</span>
                    <span onclick="ajaxpage('view/weights/view_weight_list.php','mainContent');">Weight List</span>
                    <span onclick="ajaxpage('view/view_farmer_list.php','mainContent');">Farmer List</span>
                    <span onclick="ajaxpage('view/view_buyer_list.php','mainContent');">Buyer List</span>
                </div>
            </div>

            <div class="flyoutContainers jewelBox ml10" id="editTab">
                <a href="#" class="" id="editButton" onmouseover="open_accordion('tabs','edit','flyoutContainer'); tabLinks('newTab',this.id);">Edit</a>
                <div id="edit" class="flyoutContainer" style="display:none;">
                    <span onclick="ajaxpage('edit/get_village.php','mainContent');">Village</span>
                    <span onclick="ajaxpage('edit/get_farmer.php','mainContent');">Farmer</span>
                    <span onclick="ajaxpage('edit/get_buyer.php','mainContent');">Buyer</span>
                    <span onclick="ajaxpage('edit/get_quality.php','mainContent');">Quality</span>
                </div>
            </div>
        
        </div>
        
        <div id="ajaxMainLinks">
            <a href="#" class="" id="auctionList" onclick="ajaxpage('auction_list/auction_list.php','mainContent');tabLinks('main_links',this.id);">Auction List</a>
            <a href="#" class="" id="weightList" onclick="ajaxpage('weight_list/weight_list.php','mainContent');tabLinks('main_links',this.id);">Weight List</a>
            <a href="#" class="" id="pendingList" onclick="ajaxpage('view/weights/view_weight_list.php?pending=1','mainContent');tabLinks('main_links',this.id);">Pending List</a>
        </div>
        
        <?php 
		require_once("search/search.php");
		?>
        
        <div class="cbo"></div>
        
    </div>
</div>