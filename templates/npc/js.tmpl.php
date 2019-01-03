<script language="javascript">
  function sanityCheck() {
    var tethered = document.forms[1].j.checked;
    var leashed = document.forms[1].J.checked;

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
</script>