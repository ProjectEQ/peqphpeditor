      <center>
        <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
        <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
      </center>
      <form method="post" action="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&action=8">
        <div class="edit_form" style="width: 250px;">
          <div class="edit_form_header">Add Recipe Component</div>
          <div class="edit_form_content">
            <strong>Item ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
            <input class="indented" id="id" type="text" name="item_id" size="7" value=""><br><br>
            <strong>Item is a:</strong><br>
            <select class="indented" name="type" id="type" onChange="toggleComponentType()">
              <option value="0">Combine Container</option>
              <option value="1">Component</option>
              <option value="2">Product</option>
            </select><br><br>
            <table width="100%">
              <tr>
                <td align="center" width="5%"><a href="javascript:toggleContainer();" id="ContainerCollapsed" style="display:inline;" name="Show Common Containers">[+]</a><a href="javascript:toggleContainer();" id="ContainerExpanded" style="display:none;" name="Show Common Containers">[-]</a></td>
                <td width="30%"><strong>Common Containers</strong></td>
              </tr>
            </table><br>
            <table id="ContainerTable" style="display:none;" width="100%">
              <tr>
                <td align="center" width="10%"><strong>ID</strong></td>
                <td width="30%"><strong>Name</strong></td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='9';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">9</a></td>
                <td width="30%">Medicine Bag</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='15';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">15</a></td>
                <td width="30%">Oven</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='16';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">16</a></td>
                <td width="30%">Loom</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='17';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">17</a></td>
                <td width="30%">Forge</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='18';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">18</a></td>
                <td width="30%">Fletching Kit</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='19';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">19</a></td>
                <td width="30%">Brew Barrel</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='20';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">20</a></td>
                <td width="30%">Jeweler's Kit</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='21';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">21</a></td>
                <td width="30%">Pottery Wheel</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='22';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">22</a></td>
                <td width="30%">Kiln</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='24';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">24</a></td>
                <td width="30%">Wizard Lexicon</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='25';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">25</a></td>
                <td width="30%">Magician Lexicon</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='26';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">26</a></td>
                <td width="30%">Necromancer Lexicon</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='27';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">27</a></td>
                <td width="30%">Enchanter Lexicon</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='32';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">32</a></td>
                <td width="30%">Teir`Dal Forge</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='33';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">33</a></td>
                <td width="30%">Oggok Forge</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='38';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">38</a></td>
                <td width="30%">Cabilis Forge</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='46';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">46</a></td>
                <td width="30%">Tackle Box</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='17162';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">17162</a></td>
                <td width="30%">Collapsible Mixing Bowl</td>
              </tr>
              <tr>
                <td align="center" width="10%"><a href="javascript:document.getElementById('id').value='17906';javascript:document.getElementById('type').value='0';javascript:toggleContainer();">17906</a></td>
                <td width="30%">Mixing Bowl</td>
              </tr>
            </table>
            <fieldset>
              <legend><strong><font size="-1">Components:</font></strong></legend>
              Qty Required:<br>
              <input class="indented" type="text" name="componentcount" size="7" value="0" disabled><br><br>
              Qty Returned on Fail:<br>
              <input class="indented" type="text" name="failcount" size="7" value="0" disabled><br><br>
              Qty Returned on Salvage:<br>
              <input class="indented" type="text" name="salvagecount" size="7" value="0" disabled>
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
          </div>
        </div>
      </form>
