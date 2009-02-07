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

    <form name="faction" method="post" action="index.php?editor=faction&fid=<?=$id?>&action=2">
    <div style="border: 1px solid black;">
      <div class="edit_form_header">
         Edit Faction: <?=$name?> (<?=$id?>)
      </div>
      <div class="edit_form_content">
        <strong>Base:</strong><br>
        <input type="hidden" name="id" value="<?=$id?>">
        <input type="hidden" name="name" value="<?=$name?>">
        <input size="10" type="text" name="base" value="<?=$base?>"><br><br>
        <fieldset>
          <legend><strong>Classes</strong></legend>
          <table width="100%">
            <tr>
              <td width="20%">Warrior: <br> <input size="10" type="text" name="mod_c1" value="<?=$mod_c1?>"></td>
              <td width="20%">Cleric: <br> <input size="10" type="text" name="mod_c2" value="<?=$mod_c2?>"></td>
              <td width="20%">Paladin: <br> <input size="10" type="text" name="mod_c3" value="<?=$mod_c3?>"></td>
              <td width="20%">Ranger: <br> <input size="10" type="text" name="mod_c4" value="<?=$mod_c4?>"></td>
              <td width="20%">Shadow Knight: <br> <input size="10" type="text" name="mod_c5" value="<?=$mod_c5?>"></td>
            </tr>
            <tr>
              <td width="20%">Druid: <br> <input size="10" type="text" name="mod_c6" value="<?=$mod_c6?>"></td>
              <td width="20%">Monk: <br> <input size="10" type="text" name="mod_c7" value="<?=$mod_c7?>"></td>
              <td width="20%">Bard: <br> <input size="10" type="text" name="mod_c8" value="<?=$mod_c8?>"></td>
              <td width="20%">Rogue: <br> <input size="10" type="text" name="mod_c9" value="<?=$mod_c9?>"></td>
              <td width="20%">Shaman: <br> <input size="10" type="text" name="mod_c10" value="<?=$mod_c10?>"></td>
            </tr>
            <tr>
              <td width="20%">Necromancer: <br> <input size="10" type="text" name="mod_c11" value="<?=$mod_c11?>"></td>
              <td width="20%">Wizard: <br> <input size="10" type="text" name="mod_c12" value="<?=$mod_c12?>"></td>
              <td width="20%">Magician: <br> <input size="10" type="text" name="mod_c13" value="<?=$mod_c13?>"></td>
              <td width="20%">Enchanter: <br> <input size="10" type="text" name="mod_c14" value="<?=$mod_c14?>"></td>
              <td width="20%">Beastlord: <br> <input size="10" type="text" name="mod_c15" value="<?=$mod_c15?>"></td>
            </tr>
              <tr>
              <td width="20%">Berserker: <br> <input size="10" type="text" name="mod_c16" value="<?=$mod_c16?>"></td>
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
              <td width="20%">Human: <br> <input size="10" type="text" name="mod_r1" value="<?=$mod_r1?>"></td>
              <td width="20%">Barbarian: <br> <input size="10" type="text" name="mod_r2" value="<?=$mod_r2?>"></td>
              <td width="20%">Erudite: <br> <input size="10" type="text" name="mod_r3" value="<?=$mod_r3?>"></td>
              <td width="20%">Wood Elf: <br> <input size="10" type="text" name="mod_r4" value="<?=$mod_r4?>"></td>
              <td width="20%">High Elf: <br> <input size="10" type="text" name="mod_r5" value="<?=$mod_r5?>"></td>
            </tr>
            <tr>
              <td width="20%">Dark Elf: <br> <input size="10" type="text" name="mod_r6" value="<?=$mod_r6?>"></td>
              <td width="20%">Half Elf: <br> <input size="10" type="text" name="mod_r7" value="<?=$mod_r7?>"></td>
              <td width="20%">Dwarf: <br> <input size="10" type="text" name="mod_r8" value="<?=$mod_r8?>"></td>
              <td width="20%">Troll: <br> <input size="10" type="text" name="mod_r9" value="<?=$mod_r9?>"></td>
              <td width="20%">Ogre: <br> <input size="10" type="text" name="mod_r10" value="<?=$mod_r10?>"></td>
            </tr>
            <tr>
              <td width="20%">Halfling: <br> <input size="10" type="text" name="mod_r11" value="<?=$mod_r11?>"></td>
              <td width="20%">Gnome: <br> <input size="10" type="text" name="mod_r12" value="<?=$mod_r12?>"></td>
              <td width="20%">Iksar: <br> <input size="10" type="text" name="mod_r128" value="<?=$mod_r128?>"></td>
              <td width="20%">Vah Shir: <br> <input size="10" type="text" name="mod_r130" value="<?=$mod_r130?>"></td>
              <td width="20%">Froglok: <br> <input size="10" type="text" name="mod_r330" value="<?=$mod_r330?>"></td>
            </tr>
            <tr>
              <td width="20%">Eye of Zomm: <br> <input size="10" type="text" name="mod_r108" value="<?=$mod_r108?>"></td>
              <td width="20%">Wolf-form: <br> <input size="10" type="text" name="mod_r120" value="<?=$mod_r120?>"></td>
              <td width="20%">Werewolf: <br> <input size="10" type="text" name="mod_r14" value="<?=$mod_r14?>"></td>
              <td width="20%">Skeleton: <br> <input size="10" type="text" name="mod_r60" value="<?=$mod_r60?>"></td>
              <td width="20%">Iksar Skeleton: <br> <input size="10" type="text" name="mod_r161" value="<?=$mod_r161?>"></td>
            </tr>
              <tr>
              <td width="20%">Elemental: <br> <input size="10" type="text" name="mod_r75" value="<?=$mod_r75?>"></td>
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
              <td width="20%">Bertox: <br> <input size="10" type="text" name="mod_d201" value="<?=$mod_d201?>"></td>
              <td width="20%">Brell: <br> <input size="10" type="text" name="mod_d202" value="<?=$mod_d202?>"></td>
              <td width="20%">Cazic Thule: <br> <input size="10" type="text" name="mod_d203" value="<?=$mod_d203?>"></td>
              <td width="20%">Erollsi: <br> <input size="10" type="text" name="mod_d204" value="<?=$mod_d204?>"></td>
              <td width="20%">Bristlebane: <br> <input size="10" type="text" name="mod_d205" value="<?=$mod_d205?>"></td>
            </tr>
            <tr>
              <td width="20%">Innoruuk: <br> <input size="10" type="text" name="mod_d206" value="<?=$mod_d206?>"></td>
              <td width="20%">Karana: <br> <input size="10" type="text" name="mod_d207" value="<?=$mod_d207?>"></td>
              <td width="20%">Mithaniel Marr: <br> <input size="10" type="text" name="mod_d208" value="<?=$mod_d208?>"></td>
              <td width="20%">Prexus: <br> <input size="10" type="text" name="mod_d209" value="<?=$mod_d209?>"></td>
              <td width="20%">Quellious: <br> <input size="10" type="text" name="mod_d210" value="<?=$mod_d210?>"></td>
            </tr>
            <tr>
              <td width="20%">Rallos Zek: <br> <input size="10" type="text" name="mod_d211" value="<?=$mod_d211?>"></td>
              <td width="20%">Rodcet Nife: <br> <input size="10" type="text" name="mod_d212" value="<?=$mod_d212?>"></td>
              <td width="20%">Solusek Ro: <br> <input size="10" type="text" name="mod_d213" value="<?=$mod_d213?>"></td>
              <td width="20%">Tribunal: <br> <input size="10" type="text" name="mod_d214" value="<?=$mod_d214?>"></td>
              <td width="20%">Tunare: <br> <input size="10" type="text" name="mod_d215" value="<?=$mod_d215?>"></td>
            </tr>
            <tr>
              <td width="20%">Veeshan: <br> <input size="10" type="text" name="mod_d216" value="<?=$mod_d216?>"></td>
              <td width="20%">Agnostic: <br> <input size="10" type="text" name="mod_d140" value="<?=$mod_d140?>"></td>
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
