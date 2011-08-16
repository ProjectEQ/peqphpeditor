  <script language="javascript">
    function toggle_all() {
      var boxes = document.getElementsByName("id[]");
      for (i = 0; i < boxes.length; i++) {
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
      for (i = 0; i < boxes.length; i++) {
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
  </script>
