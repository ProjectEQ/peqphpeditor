       <center>
       <table style="border: 1px solid black; background-color: #CCC;">
         <tr><td colspan=2><b>Legend:</b></td></tr>
         <tr><td align=right>1101+</td><td align=left> Ally</td></tr>
         <tr><td align=right>701 to 1100</td><td align=left>Warmly</td></tr>
         <tr><td align=right>401 to 700</td><td align=left>Kindly</td></tr>
         <tr><td align=right>101 to 400</td><td align=left>Amiably</td></tr>
         <tr><td align=right>0 to 100</td><td align=left>Indifferently</td></tr>
         <tr><td align=right>-100 to -1</td><td align=left>Apprehensively</td></tr>
         <tr><td align=right>-700 to -101</td><td align=left>Dubiously</td></tr>
         <tr><td align=right>-999 to -701</td><td align=left>Threateningly</td></tr>
         <tr><td align=right>-1000-</td><td align=left>Ready to attack</td></tr>
       </table><br><br>
       </center>

      <div style="border: 1px solid black">
       <div class="edit_form_header" style="height: 16px; line-height: 16px;">
         <div style="float: right">
           <a href="index.php?editor=faction&fid=<?=$id?>&action=1"><img src="images/c_table.gif" title="Edit this Faction" border="0"></a>
           <a onClick="return confirm('Really Delete Faction <?=$id?>?');" href="index.php?editor=faction&fid=<?=$id?>&action=6"><img src="images/remove3.gif" title="Delete this faction" border="0"></a>
         </div>
          <?=$name?> (Faction ID: <?=$id?>)
       </div>
      <div class="edit_form_content">
        <strong>Base</strong> <?=$base?><br><br>
        <fieldset>
          <legend><strong>Classes</strong></legend>
          <table width="100%">
            <tr>
              <td width="20%">Warrior: <?=$mod_c1?></td>
              <td width="20%">Cleric: <?=$mod_c2?></td>
              <td width="20%">Paladin: <?=$mod_c3?></td>
              <td width="20%">Ranger: <?=$mod_c4?></td>
              <td width="20%">Shadow Knight: <?=$mod_c5?></td>
            </tr>
            <tr>
              <td width="20%">Druid: <?=$mod_c6?></td>
              <td width="20%">Monk: <?=$mod_c7?></td>
              <td width="20%">Bard: <?=$mod_c8?></td>
              <td width="20%">Rogue: <?=$mod_c9?></td>
              <td width="20%">Shaman: <?=$mod_c10?></td>
            </tr>
            <tr>
              <td width="20%">Necromancer: <?=$mod_c11?></td>
              <td width="20%">Wizard: <?=$mod_c12?></td>
              <td width="20%">Magician: <?=$mod_c13?></td>
              <td width="20%">Enchanter: <?=$mod_c14?></td>
              <td width="20%">Beastlord: <?=$mod_c15?></td>
            </tr>
            <tr>
              <td width="20%">Berserker: <?=$mod_c16?></td>
              <td width="20%">&nbsp;</td>
              <td width="20%">&nbsp;</td>
              <td width="20%">&nbsp;</td>
              <td width="20%">&nbsp;</td>
            </tr>
          </table>
        </fieldset><br>

        <fieldset>
          <legend><strong>Races</strong></legend>
          <table width="100%">
            <tr>
              <td width="20%">Human: <?=$mod_r1?></td>
              <td width="20%">Barbarian: <?=$mod_r2?></td>
              <td width="20%">Erudite: <?=$mod_r3?></td>
              <td width="20%">Wood Elf: <?=$mod_r4?></td>
              <td width="20%">High Elf: <?=$mod_r5?></td>
            </tr>
            <tr>
              <td width="20%">Dark Elf: <?=$mod_r6?></td>
              <td width="20%">Half Elf: <?=$mod_r7?></td>
              <td width="20%">Dwarf: <?=$mod_r8?></td>
              <td width="20%">Troll: <?=$mod_r9?></td>
              <td width="20%">Ogre: <?=$mod_r10?></td>
            </tr>
            <tr>
              <td width="20%">Halfling: <?=$mod_r11?></td>
              <td width="20%">Gnome: <?=$mod_r12?></td>
              <td width="20%">Iksar: <?=$mod_r128?></td>
              <td width="20%">Vah Shir: <?=$mod_r130?></td>
              <td width="20%">Froglok: <?=$mod_r330?></td> 
            </tr>
            <tr>
              <td width="20%">Eye of Zomm: <?=$mod_r108?></td>
              <td width="20%">Wolf-form: <?=$mod_r120?></td>
              <td width="20%">Werewolf: <?=$mod_r14?></td>
              <td width="20%">Skeleton: <?=$mod_r60?></td>
              <td width="20%">Iksar Skeleton: <?=$mod_r161?></td>
            </tr>
              <tr>
              <td width="20%">Elemental: <?=$mod_r75?></td>
              <td width="20%">&nbsp;</td>
              <td width="20%">&nbsp;</td>
              <td width="20%">&nbsp;</td>
              <td width="20%">&nbsp;</td>
            </tr>
          </table>
        </fieldset><br>


        <fieldset>
          <legend><strong>Deity</strong></legend>
          <table width="100%">
            <tr>
              <td width="20%">Bertox: <?=$mod_d201?></td>
              <td width="20%">Brell: <?=$mod_d202?></td>
              <td width="20%">Cazic Thule: <?=$mod_d203?></td>
              <td width="20%">Erollsi: <?=$mod_d204?></td>
              <td width="20%">Bristlebane: <?=$mod_d205?></td>
            </tr>
            <tr>
              <td width="20%">Innoruuk: <?=$mod_d206?></td>
              <td width="20%">Karana: <?=$mod_d207?></td>
              <td width="20%">Mithaniel Marr: <?=$mod_d208?></td>
              <td width="20%">Prexus: <?=$mod_d209?></td>
              <td width="20%">Quellious: <?=$mod_d210?></td>
            </tr>
            <tr>
              <td width="20%">Rallos Zek: <?=$mod_d211?></td>
              <td width="20%">Rodcet Nife: <?=$mod_d212?></td>
              <td width="20%">Solusek Ro: <?=$mod_d213?></td>
              <td width="20%">Tribunal: <?=$mod_d214?></td>
              <td width="20%">Tunare: <?=$mod_d215?></td>
            </tr>
            <tr>
              <td width="20%">Veeshan: <?=$mod_d216?></td>
              <td width="20%">Agnostic: <?=$mod_d140?></td>
              <td width="20%">&nbsp;</td>
              <td width="20%">&nbsp;</td>
              <td width="20%">&nbsp;</td>
            </tr>
          </table>
        </fieldset>
      </div>
      </div>
