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
      alert("NPC is marked as an Underwater NPC. It is recommended to set Stuck Behavior to 'Take No Action'.");
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
</script>