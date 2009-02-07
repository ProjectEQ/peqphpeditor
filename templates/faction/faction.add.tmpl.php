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

    <form name="faction" method="post" action="index.php?editor=faction&action=5">
    <div style="border: 1px solid black;">
      <div class="edit_form_header">
         Add Faction:
      </div>
      <div class="edit_form_content">
          <fieldset>
          <legend><strong>Base</strong></legend>
          <table width="100%">
        <tr>
        <td width="33%">Name: <br> <input size="20" type="text" name="name" value=""></td>
        <td width="33%">ID: <br> <input size="10" type="text" name="id" value="<?=$suggestflid?>"></td>
        <td width="34%">Base: <br> <input size="10" type="text" name="base" value="0"></td>
        </tr>
        </table>
        </fieldset><br>

        <fieldset>
          <legend><strong>Classes</strong></legend>
          <table width="100%">
            <tr>
              <td width="20%">Warrior: <br> <input size="10" type="text" name="mod_c1" value="0"></td>
              <td width="20%">Cleric: <br> <input size="10" type="text" name="mod_c2" value="0"></td>
              <td width="20%">Paladin: <br> <input size="10" type="text" name="mod_c3" value="0"></td>
              <td width="20%">Ranger: <br> <input size="10" type="text" name="mod_c4" value="0"></td>
              <td width="20%">Shadow Knight: <br> <input size="10" type="text" name="mod_c5" value="0"></td>
            </tr>
            <tr>
              <td width="20%">Druid: <br> <input size="10" type="text" name="mod_c6" value="0"></td>
              <td width="20%">Monk: <br> <input size="10" type="text" name="mod_c7" value="0"></td>
              <td width="20%">Bard: <br> <input size="10" type="text" name="mod_c8" value="0"></td>
              <td width="20%">Rogue: <br> <input size="10" type="text" name="mod_c9" value="0"></td>
              <td width="20%">Shaman: <br> <input size="10" type="text" name="mod_c10" value="0"></td>
            </tr>
            <tr>
              <td width="20%">Necromancer: <br> <input size="10" type="text" name="mod_c11" value="0"></td>
              <td width="20%">Wizard: <br> <input size="10" type="text" name="mod_c12" value="0"></td>
              <td width="20%">Magician: <br> <input size="10" type="text" name="mod_c13" value="0"></td>
              <td width="20%">Enchanter: <br> <input size="10" type="text" name="mod_c14" value="0"></td>
              <td width="20%">Beastlord: <br> <input size="10" type="text" name="mod_c15" value="0"></td>
            </tr>
              <tr>
              <td width="20%">Berserker: <br> <input size="10" type="text" name="mod_c16" value="0"></td>
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
              <td width="20%">Human: <br> <input size="10" type="text" name="mod_r1" value="0"></td>
              <td width="20%">Barbarian: <br> <input size="10" type="text" name="mod_r2" value="0"></td>
              <td width="20%">Erudite: <br> <input size="10" type="text" name="mod_r3" value="0"></td>
              <td width="20%">Wood Elf: <br> <input size="10" type="text" name="mod_r4" value="0"></td>
              <td width="20%">High Elf: <br> <input size="10" type="text" name="mod_r5" value="0"></td>
            </tr>
            <tr>
              <td width="20%">Dark Elf: <br> <input size="10" type="text" name="mod_r6" value="0"></td>
              <td width="20%">Half Elf: <br> <input size="10" type="text" name="mod_r7" value="0"></td>
              <td width="20%">Dwarf: <br> <input size="10" type="text" name="mod_r8" value="0"></td>
              <td width="20%">Troll: <br> <input size="10" type="text" name="mod_r9" value="0"></td>
              <td width="20%">Ogre: <br> <input size="10" type="text" name="mod_r10" value="0"></td>
            </tr>
            <tr>
              <td width="20%">Halfling: <br> <input size="10" type="text" name="mod_r11" value="0"></td>
              <td width="20%">Gnome: <br> <input size="10" type="text" name="mod_r12" value="0"></td>
              <td width="20%">Iksar: <br> <input size="10" type="text" name="mod_r128" value="0"></td>
              <td width="20%">Vah Shir: <br> <input size="10" type="text" name="mod_r130" value="0"></td>
              <td width="20%">Froglok: <br> <input size="10" type="text" name="mod_r330" value="0"></td>
            </tr>
            <tr>
              <td width="20%">Eye of Zomm: <br> <input size="10" type="text" name="mod_r108" value="0"></td>
              <td width="20%">Wolf-form: <br> <input size="10" type="text" name="mod_r120" value="0"></td>
              <td width="20%">Werewolf: <br> <input size="10" type="text" name="mod_r14" value="0"></td>
              <td width="20%">Skeleton: <br> <input size="10" type="text" name="mod_r60" value="0"></td>
              <td width="20%">Iksar Skeleton: <br> <input size="10" type="text" name="mod_r161" value="0"></td>
            </tr>
            <tr>
              <td width="20%">Elemental: <br> <input size="10" type="text" name="mod_r75" value="0"></td>
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
              <td width="20%">Bertox: <br> <input size="10" type="text" name="mod_d201" value="0"></td>
              <td width="20%">Brell: <br> <input size="10" type="text" name="mod_d202" value="0"></td>
              <td width="20%">Cazic Thule: <br> <input size="10" type="text" name="mod_d203" value="0"></td>
              <td width="20%">Erollsi: <br> <input size="10" type="text" name="mod_d204" value="0"></td>
              <td width="20%">Bristlebane: <br> <input size="10" type="text" name="mod_d205" value="0"></td>
            </tr>
            <tr>
              <td width="20%">Innoruuk: <br> <input size="10" type="text" name="mod_d206" value="0"></td>
              <td width="20%">Karana: <br> <input size="10" type="text" name="mod_d207" value="0"></td>
              <td width="20%">Mithaniel Marr: <br> <input size="10" type="text" name="mod_d208" value="0"></td>
              <td width="20%">Prexus: <br> <input size="10" type="text" name="mod_d209" value="0"></td>
              <td width="20%">Quellious: <br> <input size="10" type="text" name="mod_d210" value="0"></td>
            </tr>
            <tr>
              <td width="20%">Rallos Zek: <br> <input size="10" type="text" name="mod_d211" value="0"></td>
              <td width="20%">Rodcet Nife: <br> <input size="10" type="text" name="mod_d212" value="0"></td>
              <td width="20%">Solusek Ro: <br> <input size="10" type="text" name="mod_d213" value="0"></td>
              <td width="20%">Tribunal: <br> <input size="10" type="text" name="mod_d214" value="0"></td>
              <td width="20%">Tunare: <br> <input size="10" type="text" name="mod_d215" value="0"></td>
            </tr>
            <tr>
              <td width="20%">Veeshan: <br> <input size="10" type="text" name="mod_d216" value="0"></td>
              <td width="20%">Agnostic: <br> <input size="10" type="text" name="mod_d140" value="0"></td>
              <td width="20%">&nbsp;</td>
              <td width="20%">&nbsp;</td>
              <td width="20%">&nbsp;</td>
            </tr>
          </table>
        </fieldset><br><br>
        <center>
          <input type="submit" value="Submit Changes">
        </center>
      </div>
      </div>