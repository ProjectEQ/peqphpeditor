<script language="javascript">
  function sanityCheck() {
    var intelligent = document.forms[1].i.checked;
    var stupid = document.forms[1].s.checked;

    if (intelligent && stupid) {
      alert("Warning: You made this NPC both intelligent AND stupid!");
    }
  }
</script>