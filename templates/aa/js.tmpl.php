  <script language="javascript">

    function box_changed(box_type, all_box_type) {
      var boxes_checked = true;
      var boxes = document.getElementsByName(box_type);
      for (var i = 0; i < boxes.length; i++) {
        if (boxes[i].checked == false) {
          boxes_checked = false;
          break;
        }
      }
      if (boxes_checked == true) {
        document.getElementById(all_box_type).checked = true;
      }
      else {
        document.getElementById(all_box_type).checked = false;
      }
    }

    function all_box_changed(box_type, all_box_type) {
      var boxes = document.getElementsByName(box_type);
      for (var i = 0; i < boxes.length; i++) {
        boxes[i].checked = document.getElementById(all_box_type).checked;
      }
    }

  </script>
