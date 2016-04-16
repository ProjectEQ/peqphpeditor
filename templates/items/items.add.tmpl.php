  <form name="item_edit" method="post" action="index.php?editor=items&id=<?=$id?>&action=9">
    <div class="edit_form">
      <div class="edit_form_header">
        Add Item
      </div>
      <div class="edit_form_content">
        <fieldset style="text-align: left;">
          <legend><strong><font size="4">General</font></strong></legend>
          <input type="hidden" name="id" value="<?=$id?>" />
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="12%">ID:<br/><input type="text" name="id" size="7" value="<?=$newid?>"></td>
              <td align="left" width="33%">Name:<br/><input type="text" name="itemname" size="45" value=""></td>
              <td align="left" width="33%">
                Type:<br/>
                <select name="itemtype" style="width:265px;">
<?foreach($itemtypes as $k => $v):?>
                  <option value="<?=$k?>"><?=$k?>: <?=$v?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
          </table>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="50%">Lore Name:<br/><input type="text" name="lore" size="45" value=""></td>
              <td align="left" width="50%">
                Class:<br/>
                <select name="itemclass">
                  <option value="0">Common Item</option>
                  <option value="1">Container</option>
                  <option value="2">Book</option>
                </select>
              </td>
            </tr>
          </table>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="33%">Stackable:<br/>
                <select name="stackable">
                  <option value="0">0: No</option>
                  <option value="1">1: Yes</option>
                </select>
              </td>
              <td align="left" width="33%">Stacksize:<br/><input type="text" name="stacksize" size="10" value="1"></td>
              <td align="left" width="33%">Charges:<br/><input type="text" name="maxcharges" size="10" value="0"></td>
            </tr>
          </table>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
<?if($filename != ''):?>
              <td align="left" width="25%"><a href="index.php?editor=items&id=<?=$id?>&name=<?=$filename?>&action=3">File Name:<br/><input type="text" name="filename" size="20" value=""></td>
<?endif;?>
<?if($filename == ''):?>
              <td align="left" width="33%">File Name:<br/><input type="text" name="filename" size="20" value=""></td>
<?endif;?>
              <td align="left" width="33%">
                Book:<br/>
                <select name="book">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                  <option value="2">Message</option>
                </select>
              </td>
              <td align="left" width="33%">Booktype:<br/><input type="text" name="booktype" size="10" value="0"></td>
            </tr>
          </table>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="33%">Charmfile:<br/><input type="text" name="charmfile" size="20" value=""></td>
              <td align="left" width="33%">Charmfile ID:<br/><input type="text" name="charmfileid" size="10" value="0"></td>
              <td align="left" width="33%">Script File ID:<br/><input type="text" name="scriptfileid" size="10" value="0"></td>
            </tr>
          </table>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="33%">Power Source Capacity:<br/><input type="text" name="powersourcecapacity" size="10" value="0"></td>
              <td align="left" width="33%">Potion Belt Slots:<br/><input type="text" name="potionbeltslots" size="10" value="0"></td>
              <td align="left" width="33%">&nbsp;</td>
            </tr>
          </table>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="25%">
                Bag Size:<br/>
                <select class="left" name="bagsize">
<?foreach($itembagsize as $k => $v):?>
                  <option value="<?=$k?>"><?=$v?></option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="25%">Bag Slots:<br/><input type="text" name="bagslots" size="10" value="0"></td>
              <td align="left" width="25%">Bag Weight Reduction:<br/><input type="text" name="bagwr" size="10" value="0"></td>
              <td align="left" width="25%">
                Bag Type:<br/>
                <select class="left" name="bagtype">
<?foreach($world_containers as $k => $v):?>
                  <option value="<?=$k?>"><?=$k?>: <?=$v?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
          </table>
        </fieldset>
        <fieldset>
          <legend><strong><font size="4">Restrictions</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="16%">
                No Drop:<br/>
                <select name="nodrop">
                  <option value="1">No</option>
                  <option value="0">Yes</option>
                </select>
              </td>
              <td align="left" width="16%">
                No Rent:<br/>
                <select name="norent">
                  <option value="1">No</option>
                  <option value="0">Yes</option>
                  <option value="255">255</option>
                </select>
              </td>
              <td align="left" width="16%">
                Magic:<br/>
                <select name="magic">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
              <td align="left" width="16%">
                Tradeskill:<br/>
                <select name="tradeskills">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
              <td align="left" width="16%">
                Artifact:<br/>
                <select name="artifactflag">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
              <td align="left" width="16%">
                Quest:<br/>
                <select name="questitemflag">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
            </tr>
            <tr>
              <td align="left" width="16%">
                Attuneable:<br/>
                <select name="attuneable">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
              <td align="left" width="16%">
                No Pet:<br/>
                <select name="nopet">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
              <td align="left" width="16%">
                FV No Drop:<br/>
                <select name="fvnodrop">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
              <td align="left" width="16%">
                No Transfer:<br/>
                <select name="notransfer">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
              <td align="left" width="16%">
                Potion Belt:<br/>
                <select name="potionbelt">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
              <td align="left" width="16%">
                Benefit:<br/>
                <select name="benefitflag">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                  <option value="3">3</option>
                </select>
              </td>
            </tr>
            <tr>
              <td align="left" width="16%">
                Expendable Arrow:<br/>
                <select name="expendablearrow">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
              <td align="left" width="16%">
                Lore:<br/><input type="text" name="loregroup" size="5" value="0">
              </td>
              <td align="left" width="16%">
                Req Level:<br/><input type="text" name="reqlevel" size="5" value="0">
              </td>
              <td align="left" width="16%">
                Rec Level:<br/><input type="text" name="reclevel" size="5" value="0">
              </td>
              <td align="left" width="16%">
                Rec Skill:<br/><input type="text" name="recskill" size="5" value="0">
              </td>
              <td align="left" width="16%">
                Evolving Level:<br/><input type="text" name="evolvinglevel" size="5" value="0">
              </td>
            </tr>
          </table>
          <table cellpadding="20px">
            <tr>
              <td valign="top" align="left">
                Slots:<br/>
                <input type="checkbox" name="slot_Charm" value="1"> Charm<br/>
                <input type="checkbox" name="slot_Ear01" value="2"> Ear01<br/>
                <input type="checkbox" name="slot_Head" value="4"> Head<br/>
                <input type="checkbox" name="slot_Face" value="8"> Face<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="slot_Ear02" value="16"> Ear02<br/>
                <input type="checkbox" name="slot_Neck" value="32"> Neck<br/>
                <input type="checkbox" name="slot_Shoulder" value="64"> Shoulders<br/>
                <input type="checkbox" name="slot_Arms" value="128"> Arms<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="slot_Back" value="256"> Back<br/>
                <input type="checkbox" name="slot_Bracer01" value="512"> Bracer01<br/>
                <input type="checkbox" name="slot_Bracer02" value="1024"> Bracer02<br/>
                <input type="checkbox" name="slot_Range" value="2048"> Range<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="slot_Hands" value="4096"> Hands<br/>
                <input type="checkbox" name="slot_Primary" value="8192"> Primary<br/>
                <input type="checkbox" name="slot_Secondary" value="16384"> Secondary<br/>
                <input type="checkbox" name="slot_Ring01" value="32768"> Ring01<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="slot_Ring02" value="65536"> Ring02<br/>
                <input type="checkbox" name="slot_Chest" value="131072"> Chest<br/>
                <input type="checkbox" name="slot_Legs" value="262144"> Legs<br/>
                <input type="checkbox" name="slot_Feet" value="524288"> Feet<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="slot_Waist" value="1048576"> Waist<br/>
                <input type="checkbox" name="slot_Ammo" value="2097152"> Ammo<br/>
                <input type="checkbox" name="slot_Powersource" value="4194304"> Powersource<br/>
                <input type="checkbox" name="all_none" value="yes" onClick="Check(document.item_edit)"> <b>All/None</b><br/>
              </td>
            </tr>
          </table>
          <table cellpadding="20px">
            <tr>
              <td valign="top" align="left">
                Races:<br/>
                <input type="checkbox" name="race_Human" value="1"> Human<br/>
                <input type="checkbox" name="race_Barbarian" value="2"> Barbarian<br/>
                <input type="checkbox" name="race_Erudite" value="4"> Erudite<br/>
                <input type="checkbox" name="race_Wood_Elf" value="8"> Wood Elf<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="race_High_Elf" value="16"> High Elf<br/>
                <input type="checkbox" name="race_Dark_Elf" value="32"> Dark Elf<br/>
                <input type="checkbox" name="race_Half_Elf" value="64"> Half Elf<br/>
                <input type="checkbox" name="race_Dwarf" value="128"> Dwarf<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="race_Troll" value="256"> Troll<br/>
                <input type="checkbox" name="race_Ogre" value="512"> Ogre<br/>
                <input type="checkbox" name="race_Halfling" value="1024"> Halfling<br/>
                <input type="checkbox" name="race_Gnome" value="2048"> Gnome<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="race_Iksar" value="4096"> Iksar<br/>
                <input type="checkbox" name="race_Vah_Shir" value="8192"> Vah Shir<br/>
                <input type="checkbox" name="race_Froglok" value="16384"> Froglok<br/>
                <input type="checkbox" name="race_Drakkin" value="32768"> Drakkin<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="race_Shroud" value="65536"> Shroud<br/>
                <input type="checkbox" name="all_none2" value="yes" onClick="Check2(document.item_edit)"> <b>All/None</b><br/>
              </td>
            </tr>
          </table>
          <table cellpadding="20px">
            <tr>
              <td valign="top" align="left">
                Classes:<br/>
                <input type="checkbox" name="class_Warrior" value="1"> Warrior<br/>
                <input type="checkbox" name="class_Cleric" value="2"> Cleric<br/>
                <input type="checkbox" name="class_Paladin" value="4"> Paladin<br/>
                <input type="checkbox" name="class_Ranger" value="8"> Ranger<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="class_Shadowknight" value="16"> Shadowknight<br/>
                <input type="checkbox" name="class_Druid" value="32"> Druid<br/>
                <input type="checkbox" name="class_Monk" value="64"> Monk<br/>
                <input type="checkbox" name="class_Bard" value="128"> Bard<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="class_Rogue" value="256"> Rogue<br/>
                <input type="checkbox" name="class_Shaman" value="512"> Shaman<br/>
                <input type="checkbox" name="class_Necromancer" value="1024"> Necromancer<br/>
                <input type="checkbox" name="class_Wizard" value="2048"> Wizard<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="class_Magician" value="4096"> Magician<br/>
                <input type="checkbox" name="class_Enchanter" value="8192"> Enchanter<br/>
                <input type="checkbox" name="class_Beastlord" value="16384"> Beastlord<br/>
                <input type="checkbox" name="class_Berserker" value="32768"> Berserker<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="all_none3" value="yes" onClick="Check3(document.item_edit)"> <b>All/None</b><br/>
              </td>
            </tr>
          </table>
          <table cellpadding="20px">
            <tr>
              <td valign="top" align="left">
                Deities:<br/>
                <input type="checkbox" name="deity_Agnostic" value="1"> Agnostic<br/>
                <input type="checkbox" name="deity_Bertox" value="2"> Bertoxxulous<br/>
                <input type="checkbox" name="deity_Brell" value="4"> Brell Serilis<br/>
                <input type="checkbox" name="deity_Cazic" value="8"> Cazic-Thule<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="deity_Erollsi" value="16"> Erollisi Marr<br/>
                <input type="checkbox" name="deity_Bristlebane" value="32"> Bristlebane<br/>
                <input type="checkbox" name="deity_Innoruuk" value="64"> Innoruuk<br/>
                <input type="checkbox" name="deity_Karana" value="128"> Karana<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="deity_Mithaniel_Marr" value="256"> Mithaniel Marr<br/>
                <input type="checkbox" name="deity_Prexus" value="512"> Prexus<br/>
                <input type="checkbox" name="deity_Quellious" value="1024"> Quellious<br/>
                <input type="checkbox" name="deity_Rallos_Zek" value="2048"> Rallos Zek<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="deity_Rodcet_Nife" value="4096"> Rodcet Nife<br/>
                <input type="checkbox" name="deity_Solusek_Ro" value="8192"> Solusek Ro<br/>
                <input type="checkbox" name="deity_The_Tribunal" value="16384"> The Tribunal<br/>
                <input type="checkbox" name="deity_Tunare" value="32768"> Tunare<br/>
              </td>
              <td valign="top" align="left">
                <br/>
                <input type="checkbox" name="deity_Veeshan" value="65536"> Veeshan<br/>
                <input type="checkbox" name="all_none4" value="yes" onClick="Check4(document.item_edit)"> <b>All/None</b><br/>
              </td>
            </tr>
          </table>
        </fieldset>
        <fieldset>
          <legend><strong><font size="4">Stats</font></strong></legend><br/>
          <fieldset>
            <legend><font size="4">Damage</font></legend>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="33%">Damage:<br/><input type="text" name="damage" size="5" value="0"></td>
                <td align="left" width="33%">Delay:<br/><input type="text" name="delay" size="5" value="0"></td>
                <td align="left" width="33%">Range:<br/><input type="text" name="range" size="5" value="0"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="14%">Bane Dmg:<br/><input type="text" name="banedmgamt" size="5" value="0"></td>
                <td align="left" width="14%">Bane Race Dmg:<br/><input type="text" name="banedmgraceamt" size="5" value="0"></td>
                <td align="left" width="14%">
                  Bane Race:<br/>
                  <select class="left" name="banedmgrace">
<?foreach($itemraces as $k => $v):?>
                    <option value="<?=$k?>"><?=$k?>: <?=$v?></option>
<?endforeach;?>       
                  </select>
                </td>
                <td align="left" width="14%">
                  Bane Bodytype:<br/>
                  <select class="left" name="banedmgbody">
<?foreach($bodytypes as $k => $v):?>
                    <option value="<?=$k?>"><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
              </tr>
            </table><br/>
            <fieldset>
              <table width="100%" border="0" cellpadding="3" cellspacing="0">
                <tr>
                  <td align="left" width="35%">Extra Dmg Skill:<br/>
                    <select class="left" name="extradmgskill">
<?foreach($skilltypes as $k => $v):?>
                      <option value="<?=$k?>"><?=$k?>: <?=$v?></option>
<?endforeach;?>       
                    </select><br/>
                    Extra Dmg Amt:<br/>
                    <input type="text" name="extradmgamt" size="5" value="0">
                  </td>
                  <td align="left" width="25%">Elem Dmg Type:<br/>
                    <input type="text" name="elemdmgtype" size="5" value="0"><br/>
                    Elem Dmg Amt:<br/><input type="text" name="elemdmgamt" size="5" value="0">
                  </td>
                  <td align="left" width="25%">Spell Dmg:<br/><input type="text" name="spelldmg" size="5" value="0"></td>
                  <td align="left" width="25%">Backstab Dmg:<br/><input type="text" name="backstabdmg" size="5" value="0"></td>
                </tr>
              </table>
            </fieldset>
          </fieldset><br/><br/>
          <fieldset>
            <legend><font size="4">Base Stats</font></legend>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="14%">HP:<br/><input type="text" name="hp" size="5" value="0"></td>
                <td align="left" width="14%">Mana:<br/><input type="text" name="mana" size="5" value="0"></td>
                <td align="left" width="15%">Endurance:<br/><input type="text" name="endur" size="5" value="0"></td>
                <td align="left" width="14%">AC:<br/><input type="text" name="ac" size="5" value="0"></td>
                <td align="left" width="14%">Accuracy:<br/><input type="text" name="accuracy" size="5" value="0"></td>
                <td align="left" width="14%">Attack:<br/><input type="text" name="attack" size="5" value="0"></td>
              </tr>
              <tr>
                <td align="left" width="14%">HP Regen:<br/><input type="text" name="regen" size="5" value="0"></td>
                <td align="left" width="14%">Mana Regen:<br/><input type="text" name="manaregen" size="5" value="0"></td>
                <td align="left" width="15%">End Regen:<br/><input type="text" name="enduranceregen" size="5" value="0"></td>
                <td align="left" width="14%">Haste:<br/><input type="text" name="haste" size="5" value="0"></td>
                <td align="left" width="14%">Light:<br/><input type="text" name="light" size="5" value="0"></td>
              </tr>
            </table>
          </fieldset><br/><br/>
          <fieldset>
            <legend><font size="4">Stats</font></legend>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="14%">AGI:<br/><input type="text" name="aagi" size="5" value="0"></td>
                <td align="left" width="14%">CHA:<br/><input type="text" name="acha" size="5" value="0"></td>
                <td align="left" width="14%">DEX:<br/><input type="text" name="adex" size="5" value="0"></td>
                <td align="left" width="14%">INT:<br/><input type="text" name="aint" size="5" value="0"></td>
                <td align="left" width="14%">STA:<br/><input type="text" name="asta" size="5" value="0"></td>
                <td align="left" width="15%">STR:<br/><input type="text" name="astr" size="5" value="0"></td>
                <td align="left" width="15%">WIS:<br/><input type="text" name="awis" size="5" value="0"></td>
              </tr>
              <tr>
                <td align="left" width="14%">Cold:<br/><input type="text" name="cr" size="5" value="0"></td>
                <td align="left" width="14%">Disease:<br/><input type="text" name="dr" size="5" value="0"></td>
                <td align="left" width="14%">Fire:<br/><input type="text" name="fr" size="5" value="0"></td>
                <td align="left" width="14%">Magic:<br/><input type="text" name="mr" size="5" value="0"></td>
                <td align="left" width="14%">Poison:<br/><input type="text" name="pr" size="5" value="0"></td>
                <td align="left" width="15%">Corruption:<br/><input type="text" name="svcorruption" size="5" value="0"></td>
                <td align="left" width="15%">Stun:<br/><input type="text" name="stunresist" size="5" value="0"></td>
              </tr>
            </table>
          </fieldset><br/><br/>
          <fieldset>
            <legend><font size="4">Heroic Stats</font></legend>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="14%">Heroic AGI:<br/><input type="text" name="heroic_agi" size="5" value="0"></td>
                <td align="left" width="14%">Heroic CHA:<br/><input type="text" name="heroic_cha" size="5" value="0"></td>
                <td align="left" width="14%">Heroic DEX:<br/><input type="text" name="heroic_dex" size="5" value="0"></td>
                <td align="left" width="14%">Heroic INT:<br/><input type="text" name="heroic_int" size="5" value="0"></td>
                <td align="left" width="14%">Heroic STA:<br/><input type="text" name="heroic_sta" size="5" value="0"></td>
                <td align="left" width="15%">Heroic STR:<br/><input type="text" name="heroic_str" size="5" value="0"></td>
                <td align="left" width="15%">Heroic WIS:<br/><input type="text" name="heroic_wis" size="5" value="0"></td>
              </tr>
              <tr>
                <td align="left" width="14%">Heroic Cold:<br/><input type="text" name="heroic_cr" size="5" value="0"></td>
                <td align="left" width="14%">Heroic Disease:<br/><input type="text" name="heroic_dr" size="5" value="0"></td>
                <td align="left" width="14%">Heroic Fire:<br/><input type="text" name="heroic_fr" size="5" value="0"></td>
                <td align="left" width="14%">Heroic Magic:<br/><input type="text" name="heroic_mr" size="5" value="0"></td>
                <td align="left" width="14%">Heroic Poison:<br/><input type="text" name="heroic_pr" size="5" value="0"></td>
                <td align="left" width="15%">Heroic Corruption:<br/><input type="text" name="heroic_svcorrup" size="5" value="0"></td>
              </tr>
            </table>
          </fieldset><br/><br/>
          <fieldset>
            <legend><font size="4">Spell/Ability Stats</font></legend>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="14%">DMG Shield:<br/><input type="text" name="damageshield" size="5" value="0"></td>
                <td align="left" width="14%">DoT Shielding:<br/><input type="text" name="dotshielding" size="5" value="0"></td>
                <td align="left" width="14%">Shielding:<br/><input type="text" name="shielding" size="5" value="0"></td>
                <td align="left" width="14%">Spell Shield:<br/><input type="text" name="spellshield" size="5" value="0"></td>
                <td align="left" width="14%">Strikethrough:<br/><input type="text" name="strikethrough" size="5" value="0"></td>
                <td align="left" width="14%">Combat Effects:<br/><input type="text" name="combateffects" size="5" value="0"></td>
              </tr>
              <tr>
                <td align="left" width="14%">Avoidance:<br/><input type="text" name="avoidance" size="5" value="0"></td>
                <td align="left" width="14%">Dmg Shield Mit:<br/><input type="text" name="dsmitigation" size="5" value="0"></td>
                <td align="left" width="15%">Heal Amt:<br/><input type="text" name="healamt" size="5" value="0"></td>
                <td align="left" width="15%">Clairvoyance:<br/><input type="text" name="clairvoyance" size="5" value="0"></td>
                <td align="left" width="14%">Purity:<br/><input type="text" name="purity" size="5" value="0"></td>
              </tr>
            </table>
          </fieldset><br/><br/>
          <fieldset>
            <legend><font size="4">Skill Stats</font></legend>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="40%">
                  Skill Mod:<br/>
                  <select class="left" name="skillmodtype">
<?foreach($skilltypes as $k => $v):?>
                    <option value="<?=$k?>"><?=$k?>: <?=$v?></option>
<?endforeach;?>       
                  </select>
                </td>
                <td align="left" width="20%">Skill Mod Value:<br/><input type="text" name="skillmodvalue" size="5" value="0"></td>
                <td align="left" width="20%">Skill Mod Max:<br/><input type="text" name="skillmodmax" size="5" value="0"></td>
                <td width="20%">&nbsp;</td>
              </tr>
            </table>
          </fieldset><br/>
        </fieldset><br/>
        <fieldset>
          <legend><strong><font size="4">Costs</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="25%">Price:<br/><input type="text" name="price" size="9" value="0"></td>
              <td align="left" width="25%">Sellrate:<br/><input type="text" name="sellrate" size="9" value="1"></td>
              <td align="left" width="25%">Favor:<br/><input type="text" name="favor" size="9" value="0"></td>
              <td align="left" width="25%">Guild Favor:<br/><input type="text" name="guildfavor" size="9" value="0"></td>
            </tr>
            <tr>
              <td align="left" width="20%">LDoN Price:<br/><input type="text" name="ldonprice" size="9" value="0"></td>
              <td align="left" width="20%">LDoN Sellback:<br/><input type="text" name="ldonsellbackrate" size="9" value="0"></td> 
              <td align="left" width="20%">
                LDoN Sold:<br/>
                <select name="ldonsold">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
              <td align="left" width="20%">
                LDoN Theme:<br/>
                <select class="left" name="ldontheme">
<?foreach($itemldontheme as $k => $v):?>
                  <option value="<?=$k?>"><?=$v?></option>
<?endforeach;?>       
                </select>
              </td>
              <td align="left" width="20%">
                Point Type:<br/>
                <select class="left" name="pointtype">
<?foreach($itempointtype as $k => $v):?>
                  <option value="<?=$k?>"><?=$v?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
          </table>
        </fieldset><br/>
        <fieldset>
          <legend><strong><font size="4">Appearance</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="25%">Icon:<br/><input type="text" name="icon" size="9" value="0"></td>
              <td align="left" width="25%">IDFile:<br/><input type="text" name="idfile" size="9" value="IT"></td>
              <td align="left" width="25%">Weight:<br/><input type="text" name="weight" size="9" value="1"></td>
              <td align="left" width="25%">Color:<br/><input type="text" name="color" size="9" value="4278190080"></td>
            </tr>
          </table>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="33%">
                Size:<br/>
                <select class="left" name="size">
<?foreach($itemsize as $k => $v):?>
                  <option value="<?=$k?>"><?=$v?></option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="33%">
                Material:<br/>
                <select class="left" name="material">
<?foreach($itemmaterial as $k => $v):?>
                  <option value="<?=$k?>"><?=$k?>: <?=$v?></option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="33%">Elite Material:<br/><input type="text" name="elitematerial" size="9" value="0"></td>
            </tr>
          </table>
        </fieldset><br/>
        <fieldset>
          <legend><strong><font size="4">Spells</font></strong></legend>
          (<a href="javascript:showSearch();">Spell Search</a>)<br/><br/>
          <center>
            <iframe id='searchframe' src='templates/iframes/spellsearch.php'></iframe>
            <input id="button" type="button" value='Hide Spell Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
          </center>
          <center>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
               <td align="left" width="25%">Casttime:<br/><input type="text" name="casttime" size="9" value="0"></td>
               <td align="left" width="25%">Casttime_:<br/><input type="text" name="casttime_" size="9" value="0"></td>
               <td align="left" width="25%">Recast Delay:<br/><input type="text" name="recastdelay" size="9" value="0"></td>
               <td align="left" width="25%">Recast Type:<br/><input type="text" name="recasttype" size="9" value="0"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="14%">
                  Click Type:<br/>
                  <select class="left" name="clicktype">
<?foreach($itemcasttype as $k => $v):?>
                    <option value="<?=$k?>"><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td align="left" width="14%">Click Effect:<br/><input type="text" name="clickeffect" size="5" value="-1"></td>
                <td align="left" width="14%">Click Level:<br/><input type="text" name="clicklevel" size="5" value="0"></td>
                <td align="left" width="14%">Click Level 2:<br/><input type="text" name="clicklevel2" size="5" value="0"></td>
                <td align="left" width="20%">Click Name:<br/><input type="text" name="clickname" size="17" value=""></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="20%">
                  Proc Type:<br/>
                  <select class="left" name="proctype">
<?foreach($proccasttype as $k => $v):?>
                    <option value="<?=$k?>"><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td align="left" width="16%">Proc Effect:<br/><input type="text" name="proceffect" size="5" value="-1"></td>
                <td align="left" width="16%">Proc Level:<br/><input type="text" name="proclevel" size="5" value="0"></td>
                <td align="left" width="16%">Proc Level 2:<br/><input type="text" name="proclevel2" size="5" value="0"></td>
                <td align="left" width="16%">Proc Rate:<br/><input type="text" name="procrate" size="5" value="0"></td>
                <td align="left" width="16%">Proc Name:<br/><input type="text" name="procname" size="17" value=""></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="20%">
                  Worn Type:<br/>
                  <select class="left" name="worntype">
<?foreach($worncasttype as $k => $v):?>
                    <option value="<?=$k?>"><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td align="left" width="16%">Worn Effect:<br/><input type="text" name="worneffect" size="5" value="-1"></td>
                <td align="left" width="16%">Worn Level:<br/><input type="text" name="wornlevel" size="5" value="0"></td>
                <td align="left" width="16%">Worn Level 2:<br/><input type="text" name="wornlevel2" size="5" value="0"></td>
                <td align="left" width="16%">&nbsp;</td>
                <td align="left" width="16%">Worn Name:<br/><input type="text" name="wornname" size="17" value=""></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="20%">
                  Focus Type:<br/>
                  <select class="left" name="focustype">
<?foreach($focuscasttype as $k => $v):?>
                    <option value="<?=$k?>"><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td align="left" width="16%">Focus Effect:<br/><input type="text" name="focuseffect" size="5" value="-1"></td>
                <td align="left" width="16%">Focus Level:<br/><input type="text" name="focuslevel" size="5" value="0"></td>
                <td align="left" width="16%">Focus Level 2:<br/><input type="text" name="focuslevel2" size="5" value="0"></td>
                <td align="left" width="16%">&nbsp;</td>
                <td align="left" width="16%">Focus Name:<br/><input type="text" name="focusname" size="17" value=""></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="20%">
                  Scroll Type:<br/>
                  <select class="left" name="scrolltype">
<?foreach($scrollcasttype as $k => $v):?>
                    <option value="<?=$k?>"><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td align="left" width="16%">Scroll Effect:<br/><input type="text" name="scrolleffect" size="5" value="-1"></td>
                <td align="left" width="16%">Scroll Level:<br/><input type="text" name="scrolllevel" size="5" value="0"></td>
                <td align="left" width="16%">Scroll Level 2:<br/><input type="text" name="scrolllevel2" size="5" value="0"></td>
                <td align="left" width="16%">&nbsp;</td>
                <td align="left" width="16%">Scroll Name:<br/><input type="text" name="scrollname" size="17" value=""></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="20%">
                  Bard Type:<br/>
                  <select class="left" name="bardtype">
<?foreach($itembardtype as $k => $v):?>
                    <option value="<?=$k?>"><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td align="left" width="16%">Bard Effect:<br/><input type="text" name="bardeffect" size="5" value="-1"></td>
                <td align="left" width="16%">Bard Level:<br/><input type="text" name="bardlevel" size="5" value="0"></td>
                <td align="left" width="16%">Bard Level 2:<br/><input type="text" name="bardlevel2" size="5" value="0"></td>
                <td align="left" width="16%">Bard Value:<br/><input type="text" name="bardvalue" size="5" value="0"></td>
                <td align="left" width="16%">Bard Name:<br/><input type="text" name="bardname" size="17" value=""></td>
              </tr>
            </table>
          </center>
        </fieldset><br/>
        <fieldset>
          <legend><strong><font size="4">Augment</font></strong></legend>
          <center>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="16%">Slot 1 Type:<br/><input type="text" name="augslot1type" size="5" value="0"></td>
                <td align="left" width="16%">
                  Slot 1 Visible:<br/>
                  <select name="augslot1visible">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </td>
                <td align="left" width="16%">Slot 2 Type:<br/><input type="text" name="augslot2type" size="5" value="0"></td>
                <td align="left" width="16%">
                  Slot 2 Visible:<br/>
                  <select name="augslot2visible">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </td>
                <td align="left" width="16%">Slot 3 Type:<br/><input type="text" name="augslot3type" size="5" value="0"></td>
                <td align="left" width="16%">
                  Slot 3 Visible:<br/>
                  <select name="augslot3visible">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="16%">Slot 4 Type:<br/><input type="text" name="augslot4type" size="5" value="0"></td>
                <td align="left" width="16%">
                  Slot 4 Visible:<br/>
                  <select name="augslot4visible">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </td>
                <td align="left" width="16%">Slot 5 Type:<br/><input type="text" name="augslot5type" size="5" value="0"></td>
                <td align="left" width="16%">
                  Slot 5 Visible:<br/>
                  <select name="augslot5visible">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </td>
              </tr>
            </table><br/>
            <fieldset>
              <table width="100%" border="0" cellpadding="3" cellspacing="0">
                <tr>
                  <td align="left" width="50%">
                    Augment Restrictions:<br/>
                    <select class="left" name="augrestrict">
<?foreach($itemsaugrestrict as $k => $v):?>
                      <option value="<?=$k?>"><?=$k?>: <?=$v?></option>
<?endforeach;?>
                    </select>
                  </td>
                  <td align="left" width="50%">Augment Distiller:<br/><input type="text" name="augdistiller" size="5" value="0"></td>
                </tr>
              </table>
              <table cellpadding="20px">
                <tr>
                  <td valign="top" align="left">Type:<br/>
                    <input type="checkbox" name="augtype_Type_1" value="1"> Type 1<br/>
                    <input type="checkbox" name="augtype_Type_2" value="2"> Type 2<br/>
                    <input type="checkbox" name="augtype_Type_3" value="4"> Type 3<br/>
                    <input type="checkbox" name="augtype_Type_4" value="8"> Type 4<br/>
                    <input type="checkbox" name="augtype_Type_5" value="16"> Type 5<br/>
                    <input type="checkbox" name="augtype_Type_6" value="32"> Type 6<br/>
                  </td>
                  <td valign="top" align="left"><br/>
                    <input type="checkbox" name="augtype_Type_7" value="64"> Type 7<br/>
                    <input type="checkbox" name="augtype_Type_8" value="128"> Type 8<br/>
                    <input type="checkbox" name="augtype_Type_9" value="256"> Type 9<br/>
                    <input type="checkbox" name="augtype_Type_10" value="512"> Type 10<br/>
                    <input type="checkbox" name="augtype_Type_11" value="1024"> Type 11<br/>
                    <input type="checkbox" name="augtype_Type_12" value="2048"> Type 12<br/>
                  </td>
                  <td valign="top" align="left"><br/>
                    <input type="checkbox" name="augtype_Type_13" value="4096"> Type 13<br/>
                    <input type="checkbox" name="augtype_Type_14" value="8192"> Type 14<br/>
                    <input type="checkbox" name="augtype_Type_15" value="16384"> Type 15<br/>
                    <input type="checkbox" name="augtype_Type_16" value="32768"> Type 16<br/>
                    <input type="checkbox" name="augtype_Type_17" value="65536"> Type 17<br/>
                    <input type="checkbox" name="augtype_Type_18" value="131072"> Type 18<br/>
                  </td>
                  <td valign="top" align="left"><br/>
                    <input type="checkbox" name="augtype_Type_19" value="262144"> Type 19<br/>
                    <input type="checkbox" name="augtype_Type_20" value="524288"> Type 20<br/>
                    <input type="checkbox" name="augtype_Type_21" value="1048576"> Type 21<br/>
                    <input type="checkbox" name="augtype_Type_22" value="2097152"> Type 22<br/>
                    <input type="checkbox" name="augtype_Type_23" value="4194304"> Type 23<br/>
                    <input type="checkbox" name="augtype_Type_24" value="8388608"> Type 24<br/>
                  </td>
                  <td valign="top" align="left"><br/>
                    <input type="checkbox" name="augtype_Type_25" value="16777216"> Type 25<br/>
                    <input type="checkbox" name="augtype_Type_26" value="33554432"> Type 26<br/>
                    <input type="checkbox" name="augtype_Type_27" value="67108864"> Type 27<br/>
                    <input type="checkbox" name="augtype_Type_28" value="134217728"> Type 28<br/>
                    <input type="checkbox" name="augtype_Type_29" value="268435456"> Type 29<br/>
                    <input type="checkbox" name="augtype_Type_30" value="536870912"> Type 30<br/>
                  </td>
                  <td valign="top" align="left"><br/>
                    <input type="checkbox" name="all_none5" value="yes" onClick="Check5(document.item_edit)"> <b>All/None</b>
                  </td>
                </tr>
              </table>
            </fieldset>
          </center>
        </fieldset><br/>
        <fieldset>
          <legend><strong><font size="4">Faction</font></strong></legend>
          <center>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="10%">Faction Mod 1:<br/>
                  <select class="left" name="factionmod1">
<?foreach($factions as $faction): extract($faction);?>
                    <option value="<?=$id?>"><?=$name?></option>
<?endforeach;?>
                  </select>
                </td>
                <td align="left" width="10%">Amt 1:<br/><input type="text" name="factionamt1" size="5" value="0"></td>
                <td align="left" width="10%">Faction Mod 2:<br/>
                  <select class="left" name="factionmod2">
<?foreach($factions as $faction): extract($faction);?>
                  <option value="<?=$id?>"><?=$name?></option>
<?endforeach;?>
                  </select>
                </td>
                <td align="left" width="10%">Amt 2:<br/><input type="text" name="factionamt2" size="5" value="0"></td>
              </tr>
              <tr>
                <td align="left" width="10%">Faction Mod 3:<br/>
                  <select class="left" name="factionmod3">
<?foreach($factions as $faction): extract($faction);?>
                    <option value="<?=$id?>"><?=$name?></option>
<?endforeach;?>
                  </select>
                </td>
                <td align="left" width="10%">Amt 3:<br/><input type="text" name="factionamt3" size="5" value="0"></td>
                <td align="left" width="10%">Faction Mod 4:<br/>
                  <select class="left" name="factionmod4">
<?foreach($factions as $faction): extract($faction);?>
                    <option value="<?=$id?>"><?=$name?></option>
<?endforeach;?>
                  </select>
                </td>
                <td align="left" width="10%">Amt 4:<br/><input type="text" name="factionamt4" size="5" value="0"></td>
              </tr>
            </table>
          </center>
        </fieldset><br/>
        <fieldset>
          <legend><strong><font size="4">Verification</font></strong></legend>
          <center>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="25%">Created:<br/><input type="text" name="created" size="20" value="<?=$year?><?=$mon?><?=$mday?><?=$hours?><?=$minutes?><?=$seconds?>"></td>
                <td align="left" width="25%">Verified:<br/><input type="text" name="verified" size="20" value="<?=$year?>-<?=$mon?>-<?=$mday?> <?=$hours?>:<?=$minutes?>:<?=$seconds?>"></td>
                <td align="left" width="25%">Updated:<br/><input type="text" name="updated" size="20" value="<?=$year?>-<?=$mon?>-<?=$mday?> <?=$hours?>:<?=$minutes?>:<?=$seconds?>"></td>
                <td align="left" width="25%">Source:<br/><input type="text" name="source" size="20" value="CUSTOM"></td>
              </tr>
              <tr>
                <td align="left" width="25%">Comment:<br/><input type="text" name="comment" size="20" value=""></td>
              </tr>
            </table>
          </center>
        </fieldset><br/>
        <center>
          <input type="submit" value="Submit Changes">
        </center>
      </div>
    </div>
  </form>
