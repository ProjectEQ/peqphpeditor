<script language="javascript">
  function sanityCheck() {
    var intelligent = document.forms[1].i.checked;
    var stupid = document.forms[1].s.checked;
    var tethered = document.forms[1].j.checked;
    var leashed = document.forms[1].J.checked;

    if (intelligent && stupid) {
      alert("Warning: You made this NPC both intelligent AND stupid!");
    }
    if (tethered && leashed) {
      alert("Warning: You made this NPC both tethered AND leashed!");
    }
  }
</script>