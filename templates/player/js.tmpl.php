  <script language="javascript">
    function toggle_safe() {
      if (document.getElementById('safe').checked) {
        document.getElementById('x').disabled = true;
        document.getElementById('y').disabled = true;
        document.getElementById('z').disabled = true;
      }
      else {
        document.getElementById('x').disabled = false;
        document.getElementById('y').disabled = false;
        document.getElementById('z').disabled = false;
      }
    }
    function clear_coords() {
      document.getElementById('x').value = "0";
      document.getElementById('y').value = "0";
      document.getElementById('z').value = "0";
    }
  </script>
