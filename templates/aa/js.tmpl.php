  <script language="javascript">

    function box_changed(box_type, all_boxes_type) {
      var length = document.getElementsByName(box_type).length;
      var boxes_checked = true;

      for (var i = 0; i < length; i++) {
        if (document.base[box_type][i].checked == false) {
          boxes_checked = false;
          break;
        }
      }

      if (boxes_checked == true) {
        document.getElementById(all_boxes_type).checked = true;
      }
      else {
        document.getElementById(all_boxes_type).checked = false;
      }

    }

    function all_boxes_changed(box_type, all_boxes_type) {
      var boxes = document.getElementsByName(box_type);

      for (var i = 0; i < boxes.length; i++) {
        boxes[i].checked = document.getElementById(all_boxes_type).checked;
      }

    }

  </script>
