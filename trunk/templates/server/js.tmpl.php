  <script language="javascript">
    function toggleNotify() {
      document.getElementById("notify").style.display = "inline";
    }
    function toggleNote() {
      if (document.getElementById("note").disabled == true) {
        document.getElementById("note").disabled = false;
      }
      else {
        document.getElementById("note").disabled = true;
      }
    }
    function toggleMultiDelete() {
      //Hide delete images
      document.getElementById("multiD").style.display = "none";
      var dElements = document.getElementsByName("delete_entry");
      for (var x = 0; x < dElements.length; x++) {
        dElements[x].style.display = "none";
      }
      //Show checkboxes
      var cbElements = document.getElementsByName("cb_delete[]");
      for (var x = 0; x < cbElements.length; x++) {
        cbElements[x].style.display = "inline";
      }
      //Show form buttons and select_all link
      document.getElementById("action_buttons_top").style.display = "inline";
      document.getElementById("action_buttons_bottom").style.display = "inline";
      document.getElementById("select_all").style.display = "inline";
    }
    function toggleSelectAll() {
      if (document.getElementById("select_all").innerHTML == "Select All") {
        //Select all checkboxes
        var cbElements = document.getElementsByName("cb_delete[]");
        for (var x = 0; x < cbElements.length; x++) {
          cbElements[x].checked = true;
        }
        //Change hyperlink
        document.getElementById("select_all").innerHTML = "Deselect All";
      }
      else {
        //Deselect all checkboxes
        var cbElements = document.getElementsByName("cb_delete[]");
        for (var x = 0; x < cbElements.length; x++) {
          cbElements[x].checked = false;
        }
        //Change hyperlink
        document.getElementById("select_all").innerHTML = "Select All";
      }
    }
  </script>
