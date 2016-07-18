  <script language="javascript">
    function toggle_all() {
      var boxes = document.getElementsByName("id[]");
      for (var i = 0; i < boxes.length; i++) {
        boxes[i].checked = document.getElementById("all").checked;
      }
    }

    function mark_all() {
      document.getElementById("all").checked = true;
      toggle_all();
    }

    function box_checked() {
      var box_checked = false;
      var boxes = document.getElementsByName("id[]");
      for (var i = 0; i < boxes.length; i++) {
        if (boxes[i].checked == true) {
          box_checked = true;
          break;
        }
      }
      return box_checked;
    }

    function verify() {
      if (box_checked()) {
        var response = confirm("Are you sure you want delete these records?");
        if (response) {
          document.forms["purge"].submit();
        }
      }
      else {
        alert("No records selected.");
      }
    }

    function toggleCount() {
      if(document.getElementById("CustomCount").style.display == "none") {
        document.getElementById("CustomCount").style.display = "block";
      }
      else {
        document.getElementById("CustomCount").style.display = "none";
      }
    }

    function verifyCount() {
      var newCount = document.getElementById("new_count").value;
      if (parseInt(newCount) >= 1) {
        window.location = "index.php?editor=util&action=6&count=" + newCount;
      }
      else {
        alert("That is not a valid entry!");
      }
    }

    function editPlayerCount(oldCount) {
      document.getElementById("player_count_span").innerHTML = "<input id='newCount' type='number' size='3' value='" + oldCount + "'> <input type='button' value='Update' onClick='updatePlayerCount(document.getElementById(\"newCount\").value);'> <input type='button' value='Cancel' onClick='window.location.reload();'>";
    }

    function updatePlayerCount(newCount) {
      if (parseInt(newCount) >= 1) {
        window.location = "index.php?editor=util&action=5&account_count=" + document.getElementById("account_count").innerHTML + "&player_count=" + newCount;
      }
      else {
        alert("That is not a valid entry!");
      }
    }

    function editAccountCount(oldCount) {
      document.getElementById("account_count_span").innerHTML = "<input id='newCount' type='number' size='3' value='" + oldCount + "'> <input type='button' value='Update' onClick='updateAccountCount(document.getElementById(\"newCount\").value);'> <input type='button' value='Cancel' onClick='window.location.reload();'>";
    }

    function updateAccountCount(newCount) {
      if (parseInt(newCount) >= 1) {
        window.location = "index.php?editor=util&action=5&player_count=" + document.getElementById("player_count").innerHTML + "&account_count=" + newCount;
      }
      else {
        alert("That is not a valid entry!");
      }
    }

  </script>
