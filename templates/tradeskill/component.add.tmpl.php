      <center>
        <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
        <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
      </center>

      <form method="post" action="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&action=8">
      <div class="edit_form" style="width: 250px;">
        <div class="edit_form_header">
          Add Recipe Component
        </div>
        <div class="edit_form_content">
            <strong>Item ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
            <input class="indented" id="id" type="text" name="item_id" size="7" value=""><br><br>

            <strong>Item is a:</strong><br>
            <select class="indented" name="type" onChange="toggleComponentType()">
              <option value="0">Combine Container</option>
              <option value="1">Component</option>
              <option value="2">Product</option>
            </select><br><br>
			<table width="100%">
              <tr>
			    <td align="center" width="5%"><a href="javascript:toggleContainer();" id="ContainerCollapsed" style="display:inline;" name="Show Common Containers">[+]</a><a href="javascript:toggleContainer();" id="ContainerExpanded" style="display:none;" name="Show Common Containers">[-]</a></td>
			    <td width="30%"><strong> Common Containers</strong></td>
			  </tr>
			</table><br>
            <table id="ContainerTable" style="display:none;" width="100%">
              <tr>
                <td align="center" width="10%"><strong>ID</strong></td>
                <td width="30%"><strong>Name</strong></td>
              </tr>
              <tr>
                <td align="center" width="10%">9</td>
                <td width="30%">Medicine Bag</td>
              </tr>
              <tr>
                <td align="center" width="10%">15</td>
                <td width="30%">Oven</td>
              </tr>
              <tr>
                <td align="center" width="10%">16</td>
                <td width="30%">Loom</td>
              </tr>
              <tr>
                <td align="center" width="10%">17</td>
                <td width="30%">Forge</td>
              </tr>
              <tr>
                <td align="center" width="10%">18</td>
                <td width="30%">Fletching Kit</td>
              </tr>
              <tr>
                <td align="center" width="10%">19</td>
                <td width="30%">Brew Barrel</td>
              </tr>
              <tr>
                <td align="center" width="10%">20</td>
                <td width="30%">Jeweler's Kit</td>
              </tr>
              <tr>
                <td align="center" width="10%">21</td>
                <td width="30%">Pottery Wheel</td>
              </tr>
              <tr>
                <td align="center" width="10%">22</td>
                <td width="30%">Kiln</td>
              </tr>
              <tr>
                <td align="center" width="10%">24</td>
                <td width="30%">Wizard Lexicon</td>
              </tr>
              <tr>
                <td align="center" width="10%">25</td>
                <td width="30%">Magician Lexicon</td>
              </tr>
              <tr>
                <td align="center" width="10%">26</td>
                <td width="30%">Necromancer Lexicon</td>
              </tr>
              <tr>
                <td align="center" width="10%">27</td>
                <td width="30%">Enchanter Lexicon</td>
              </tr>
              <tr>
                <td align="center" width="10%">32</td>
                <td width="30%">Teir`Dal Forge</td>
              </tr>
              <tr>
                <td align="center" width="10%">33</td>
                <td width="30%">Oggok Forge</td>
              </tr>
              <tr>
                <td align="center" width="10%">46</td>
                <td width="30%">Tackle Box</td>
              </tr>
            </table>
            <fieldset>
              <legend><strong><font size="-1">Components:</font></strong></legend>
		    			Qty Required:<br>
              <input class="indented" type="text" name="componentcount" size="7" value="0" disabled><br><br>
              Qty Returned on Fail: <br>
              <input class="indented" type="text" name="failcount" size="7" value="0" disabled>
            </fieldset><br><br>

            <fieldset>
              <legend><strong><font size="-1">Products:</font></strong></legend>
              Qty Produced: <br>
              <input class="indented" type="text" name="successcount" size="7" value="0" disabled>
            </fieldset><br>

            <center>
              <input type="hidden" name='iscontainer' value="1">
              <input type="hidden" name="recipe_id" value="<?=$rec?>">
              <input type="submit" name="submit" value="Submit Changes" onClick="enable();">
            </center>
          </form>
        </div>
      </div>