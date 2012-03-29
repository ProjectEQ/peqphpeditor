<?php
function getPPFormat() {
  $fmt =  "Lchecksum/";
  $fmt .= "a64name/";
  $fmt .= "a32last_name/";
  $fmt .= "Lgender/";
  $fmt .= "Lrace/";
  $fmt .= "Lclass/";
  $fmt .= "Lunknown0112/";
  $fmt .= "Llevel/";

  $binds = 5;
  for ($x = 0; $x < $binds; $x++) {
    $fmt .= "Lbind".($x+1)."_zone/";
    $fmt .= "fbind".($x+1)."_x/";
    $fmt .= "fbind".($x+1)."_y/";
    $fmt .= "fbind".($x+1)."_z/";
    $fmt .= "fbind".($x+1)."_h/";
  }

  $fmt .= "Ldeity/";
  $fmt .= "Lguild_id/";
  $fmt .= "Lbirthday/";
  $fmt .= "Llastzone/"; //Last character save
  $fmt .= "Ltimeplayed/";
  $fmt .= "cpvp/";
  $fmt .= "clevel2/";
  $fmt .= "canon/";
  $fmt .= "cgm/";
  $fmt .= "cguildrank/";
  $fmt .= "cguildbanker/";
  $fmt .= "c6unknown0246/";
  $fmt .= "Ldrunk/";
  $fmt .= "L9spellslotrefresh/";
  $fmt .= "Labilityslotrefresh/";
  $fmt .= "chaircolor/";
  $fmt .= "cbeardcolor/";
  $fmt .= "clefteye/";
  $fmt .= "crighteye/";
  $fmt .= "chairstyle/";
  $fmt .= "cbeard/";
  $fmt .= "cability_time_seconds/";
  $fmt .= "cability_number/";
  $fmt .= "cability_time_minutes/";
  $fmt .= "cability_time_hours/";
  $fmt .= "c6unknown0306_/";
  $fmt .= "L9item_material/";
  $fmt .= "c44unknown0348_/";

  $colors = 9;
  for ($x = 0; $x < $colors; $x++) {
    $fmt .= "citemtint".($x+1)."_blue/";
    $fmt .= "citemtint".($x+1)."_green/";
    $fmt .= "citemtint".($x+1)."_red/";
    $fmt .= "citemtint".($x+1)."_use_tint/";
  }

  $maxaa = 240;
  for($x = 0; $x < $maxaa; $x++) {
    $fmt .= "Laa".($x+1)."_id/";
    $fmt .= "Laa".($x+1)."_value/";
  }

  $fmt .= "funknown2348/";
  $fmt .= "a32servername/";
  $fmt .= "a32title/";
  $fmt .= "a32suffix/";
  $fmt .= "Lguildid2/";
  $fmt .= "Lexp/";
  $fmt .= "Lunknown2456/";
  $fmt .= "Lpractice/";
  $fmt .= "Lmana/";
  $fmt .= "Lhp/";
  $fmt .= "Lunknown2472/";
  $fmt .= "LSTR/";
  $fmt .= "LSTA/";
  $fmt .= "LCHA/";
  $fmt .= "LDEX/";
  $fmt .= "L_INT/";
  $fmt .= "LAGI/";
  $fmt .= "LWIS/";
  $fmt .= "cface/";
  $fmt .= "c47unknown2505_/";
  $fmt .= "c28languages/";
  $fmt .= "c4unknown2580_/";
  $fmt .= "l480spellbook/";
  $fmt .= "c128unknown4504_/";
  $fmt .= "l9mem_spells/";
  $fmt .= "c32unknown4668_/";
  $fmt .= "fy/";
  $fmt .= "fx/";
  $fmt .= "fz/";
  $fmt .= "fheading/";
  $fmt .= "c4unknown4716_/";
  $fmt .= "lplatinum/";
  $fmt .= "lgold/";
  $fmt .= "lsilver/";
  $fmt .= "lcopper/";
  $fmt .= "lplatinum_bank/";
  $fmt .= "lgold_bank/";
  $fmt .= "lsilver_bank/";
  $fmt .= "lcopper_bank/";
  $fmt .= "lplatinum_hand/";
  $fmt .= "lgold_hand/";
  $fmt .= "lsilver_hand/";
  $fmt .= "lcopper_hand/";
  $fmt .= "lplatinum_shared/";
  $fmt .= "c24unknown4772_/";
  $fmt .= "L75skills/";
  $fmt .= "c284unknown5096_/";
  $fmt .= "lpvp2/";
  $fmt .= "lunknown5384/";
  $fmt .= "lpvptype/";
  $fmt .= "lunknown5392/";
  $fmt .= "Lability_down/";
  $fmt .= "c8unknown5400_/";
  $fmt .= "Lautosplit/";
  $fmt .= "c8unknown5412_/";
  $fmt .= "lzone_change_count/";
  $fmt .= "c16unknown5424_/";
  $fmt .= "Ldrakkin_heritage/";
  $fmt .= "Ldrakkin_tattoo/";
  $fmt .= "Ldrakkin_details/";
  $fmt .= "lexpansions/";
  $fmt .= "ltoxicity/";
  $fmt .= "c16unknown5460_/";
  $fmt .= "lhunger/";
  $fmt .= "lthirst/";
  $fmt .= "lability_up/";
  $fmt .= "c16unknown5488_/";
  $fmt .= "Szone_id/";
  $fmt .= "Sinstanceid/";

  $maxbuff = 25;
  for($x = 0; $x < $maxbuff; $x++) {
    $fmt .= "ceffect".($x+1)."slotid/";
    $fmt .= "ceffect".($x+1)."level/";
    $fmt .= "ceffect".($x+1)."bard_mod/";
    $fmt .= "ceffect".($x+1)."effect/";
    $fmt .= "leffect".($x+1)."spellid/";
    $fmt .= "leffect".($x+1)."duration/";
    $fmt .= "seffect".($x+1)."ds_remaining/";
    $fmt .= "ceffect".($x+1)."persistent_buff/";
    $fmt .= "ceffect".($x+1)."reserved/";
    $fmt .= "leffect".($x+1)."playerid/";
  }

  $fmt .= "a64groupmember1/";
  $fmt .= "a64groupmember2/";
  $fmt .= "a64groupmember3/";
  $fmt .= "a64groupmember4/";
  $fmt .= "a64groupmember5/";
  $fmt .= "a64groupmember6/";
  $fmt .= "c656unknown6392_/";
  $fmt .= "Lentityid/";
  $fmt .= "Lleader_aa_active/";
  $fmt .= "Lunknown7056/";
  $fmt .= "lguk_points/";
  $fmt .= "lmir_points/";
  $fmt .= "lmmc_points/";
  $fmt .= "lruj_points/";
  $fmt .= "ltak_points/";
  $fmt .= "lavail_points/";
  $fmt .= "lguk_wins/";
  $fmt .= "lmir_wins/";
  $fmt .= "lmmc_wins/";
  $fmt .= "lruj_wins/";
  $fmt .= "ltak_wins/";
  $fmt .= "lguk_losses/";
  $fmt .= "lmir_losses/";
  $fmt .= "lmmc_losses/";
  $fmt .= "lruj_losses/";
  $fmt .= "ltak_losses/";
  $fmt .= "c72unknown7124_/";
  $fmt .= "Ltribute_timer/";
  $fmt .= "Lshowhelm/";
  $fmt .= "Ltribute_total/";
  $fmt .= "Lunknown7208/";
  $fmt .= "Ltribute_points/";
  $fmt .= "Lunknown7216/";
  $fmt .= "Ltribute_active/";

  $tributes = 5;
  for ($x = 0; $x < $tributes; $x++) {
    $fmt .= "Ltribute".($x+1)."/";
    $fmt .= "Ltribute".($x+1)."tier/";
  }

  $fmt .= "L100disciplines/";
  $fmt .= "L20recast_timer/";
  $fmt .= "c160unknown7744_/";
  $fmt .= "Lendurance/";
  $fmt .= "Lgroup_exp/";
  $fmt .= "Lraid_exp/";
  $fmt .= "Lgroup_points/";
  $fmt .= "Lraid_points/";
  $fmt .= "L32leader_ability/";
  $fmt .= "c132unknown8052_/";
  $fmt .= "Lair/";  //Client side data
  $fmt .= "Lpvp_kills/";
  $fmt .= "Lpvp_deaths/";
  $fmt .= "Lpvp_points/";
  $fmt .= "Lpvp_total/";
  $fmt .= "Lpvp_killstreak_max/";
  $fmt .= "Lpvp_deathstreak_max/";
  $fmt .= "Lpvp_killstreak_now/";
  $fmt .= "a64pvplastkill_name/";
  $fmt .= "Lpvplastkill_level/";
  $fmt .= "Lpvplastkill_race/";
  $fmt .= "Lpvplastkill_class/";
  $fmt .= "Lpvplastkill_zone/";
  $fmt .= "Lpvplastkill_time/";
  $fmt .= "Lpvplastkill_points/";
  $fmt .= "a64pvplastdeath_name/";
  $fmt .= "Lpvplastdeath_level/";
  $fmt .= "Lpvplastdeath_race/";
  $fmt .= "Lpvplastdeath_class/";
  $fmt .= "Lpvplastdeath_zone/";
  $fmt .= "Lpvplastdeath_time/";
  $fmt .= "Lpvplastdeath_points/";
  $fmt .= "Lpvp_kills_today/";

  for($x = 0; $x < 50; $x++) {
    $fmt .= "a64pvprecentkill".($x+1)."_name/";
    $fmt .= "Lpvprecentkill".($x+1)."_level/";
    $fmt .= "Lpvprecentkill".($x+1)."_race/";
    $fmt .= "Lpvprecentkill".($x+1)."_class/";
    $fmt .= "Lpvprecentkill".($x+1)."_zone/";
    $fmt .= "Lpvprecentkill".($x+1)."_time/";
    $fmt .= "Lpvprecentkill".($x+1)."_points/";
  }

  $fmt .= "Laa_spent/";
  $fmt .= "Laa_exp/";
  $fmt .= "Laa_points/";
  $fmt .= "c36unknown12808_/";

  //Bandolier
  for($x = 0; $x < 4; $x++) {
    $fmt .= "a32bandolier".($x+1)."_name/";
    for($y = 0;$y < 4;$y++) {
      $fmt .= "Lbandolier".($x+1)."_item".($y+1)."_id/";
      $fmt .= "Lbandolier".($x+1)."_item".($y+1)."_icon/";
      $fmt .= "a64bandolier".($x+1)."_item".($y+1)."_name/";
    }
  }

  $fmt .= "c4506unknown14124_/";

  //Suspended minion
  $fmt .= "Ssm_spellid/";
  $fmt .= "Lsm_hp/";
  $fmt .= "Lsm_mana/";
  for($x = 0;$x < $maxbuff;$x++) {
    $fmt .= "csmbuffs".($x+1)."_slotid/";
    $fmt .= "csmbuffs".($x+1)."_level/";
    $fmt .= "csmbuffs".($x+1)."_bard_mod/";
    $fmt .= "csmbuffs".($x+1)."_effect/";
    $fmt .= "lsmbuffs".($x+1)."_spellid/";
    $fmt .= "lsmbuffs".($x+1)."_duration/";
    $fmt .= "ssmbuffs".($x+1)."_ds_remaining/";
    $fmt .= "csmbuffs".($x+1)."_persistent_buff/";
    $fmt .= "csmbuffs".($x+1)."_reserved/";
    $fmt .= "lsmbuffs".($x+1)."_playerid/";
  }
  $fmt .= "L9sm_item/";
  $fmt .= "a64sm_name/";

  $fmt .= "Ltimeonaccount/";

  //potion belt
  for($x = 0;$x < 4;$x++) {
    $fmt .= "Lpotion".($x+1)."_item_id/";
    $fmt .= "Lpotion".($x+1)."_icon/";
    $fmt .= "a64potion".($x+1)."_name/";
  }

  $fmt .= "c8unknown19532_/";
  $fmt .= "Lradiant_crystals/";
  $fmt .= "Lradiant_total/";
  $fmt .= "Lebon_crystals/";
  $fmt .= "Lebon_total/";
  $fmt .= "cgroup_consent/"; //Not working right. Client side only?
  $fmt .= "craid_consent/"; //Not working right. Client side only?
  $fmt .= "cguild_consent/"; //Not working right. Client side only?
  $fmt .= "c5unknown19559_/";
  $fmt .= "Lresttimer";

  return $fmt;
}
?>
