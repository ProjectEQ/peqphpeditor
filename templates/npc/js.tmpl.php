<script language="javascript">
  function tetherCheck() {
    var tethered = document.getElementsByName("32")[0].value;
    var leashed = document.getElementsByName("33")[0].value;

    if (tethered && leashed) {
      alert("Warning: You made this NPC both tethered AND leashed!");
    }
  }

  function underwaterCheck() {
    var underwater = document.forms[1].underwater.checked;
    var stuck = document.forms[1].stuck_behavior.value;

    if (underwater && stuck != 2) {
      document.forms[1].stuck_behavior.style.backgroundColor = "red";
      alert("NPC is marked as an Underwater NPC. It is recommended to set Stuck Behavior to 'Take No Action'.");
    }
    else {
      document.forms[1].stuck_behavior.style.backgroundColor = "white";
    }
  }

  function raceCheck() {
    var race = document.forms[1].race.value;
    var trackable = document.forms[1].trackable.checked;
    var findable = document.forms[1].findable.checked;

    if ((race == 240) && (trackable || findable)) {
      alert("Warning: This NPC should not be TRACKABLE or FINDABLE!");
    }
  }

  function damageCheck() { /* damage sanity check (scaling editor) */
    var min_damage = parseInt(document.forms[1].min_dmg.value);
    var max_damage = parseInt(document.forms[1].max_dmg.value);

    if (min_damage > max_damage) {
      document.forms[1].min_dmg.style.backgroundColor = "red";
      document.forms[1].max_dmg.style.backgroundColor = "red";
      alert("Min Dmg is greater than Max Dmg");
    }
    else {
      document.forms[1].min_dmg.style.backgroundColor = "white";
      document.forms[1].max_dmg.style.backgroundColor = "white";
    }
  }

  function sdamageCheck() { /* scaling and damage sanity check (standard editor) */
    var min_damage = parseInt(document.forms[1].mindmg.value);
    var max_damage = parseInt(document.forms[1].maxdmg.value);

    if (((min_damage == 0) && (max_damage != 0)) || ((max_damage == 0) && (min_damage != 0))) {
      document.forms[1].mindmg.style.backgroundColor = "red";
      document.forms[1].maxdmg.style.backgroundColor = "red";
      alert("For autoscaling, you should set both Min Dmg and Max Dmg 0");
    }
    else if (min_damage > max_damage) {
      document.forms[1].mindmg.style.backgroundColor = "red";
      document.forms[1].maxdmg.style.backgroundColor = "red";
      alert("Min Dmg is greater than Max Dmg");
    }
    else {
      document.forms[1].mindmg.style.backgroundColor = "white";
      document.forms[1].maxdmg.style.backgroundColor = "white";
    }
  }
</script>