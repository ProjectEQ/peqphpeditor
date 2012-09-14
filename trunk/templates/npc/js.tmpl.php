<script language="javascript">
  function sanityCheck() {
    var tethered = document.forms[1].j.checked;
    var leashed = document.forms[1].J.checked;

    if (tethered && leashed) {
      alert("Warning: You made this NPC both tethered AND leashed!");
    }
  }
</script>