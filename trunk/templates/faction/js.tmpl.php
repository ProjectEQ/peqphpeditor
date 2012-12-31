<script language="javascript">
  function toggleModType() {
    if (document.getElementById("mod_race").checked) {
      document.getElementById("select_race").style.display = "inline";
      document.getElementById("select_class").style.display = "none";
      document.getElementById("select_deity").style.display = "none";
    }
    else if (document.getElementById("mod_class").checked) {
      document.getElementById("select_race").style.display = "none";
      document.getElementById("select_class").style.display = "inline";
      document.getElementById("select_deity").style.display = "none";
    }
    else {
      document.getElementById("select_race").style.display = "none";
      document.getElementById("select_class").style.display = "none";
      document.getElementById("select_deity").style.display = "inline";
    }
  }

  function validateModType() {
    if (document.getElementById("mod_race").checked && (document.getElementById("select_race").value != "Select a Race")) {
      document.getElementById("mod_name").value = "r" + document.getElementById("select_race").value;
      document.getElementById("form").submit();
    }
    else if (document.getElementById("mod_class").checked && (document.getElementById("select_class").value != "Select a Class")) {
      document.getElementById("mod_name").value = "c" + document.getElementById("select_class").value;
      document.getElementById("form").submit();
    }
    else if (document.getElementById("mod_deity").checked && (document.getElementById("select_deity").value != "Select a Deity")) {
      document.getElementById("mod_name").value = "d" + document.getElementById("select_deity").value;
      document.getElementById("form").submit();
    }
    else {
      alert("You must select a Race, Class, or Deity type");
    }
  }
</script>