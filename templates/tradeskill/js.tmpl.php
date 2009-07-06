    <script language="javascript">
      function toggleComponentType() {
        var x = document.forms[1].type.selectedIndex;
        if (x == 0) {
          document.forms[1].iscontainer.value=1;

          document.forms[1].successcount.disabled=true;
          document.forms[1].successcount.value=0;

          document.forms[1].failcount.disabled=true;
          document.forms[1].failcount.value=0;

          document.forms[1].componentcount.disabled=true;
          document.forms[1].componentcount.value=0;
        }
        else if (x == 1) {
          document.forms[1].iscontainer.value=0;

          document.forms[1].successcount.disabled=true;
          document.forms[1].successcount.value=0;

          document.forms[1].failcount.disabled=false;
          document.forms[1].failcount.value=0;

          document.forms[1].componentcount.disabled=false;
          document.forms[1].componentcount.value=1;
        }
        else {
          document.forms[1].iscontainer.value=0;

          document.forms[1].failcount.disabled=true;
          document.forms[1].failcount.value=0;

          document.forms[1].componentcount.disabled=true;
          document.forms[1].componentcount.value=0;

          document.forms[1].successcount.disabled=false;
          document.forms[1].successcount.value=1;
        }
      }
      
      function enable() {
        document.forms[1].failcount.disabled=false;
        document.forms[1].componentcount.disabled=false;
        document.forms[1].successcount.disabled=false;
      }

      function showSearch() {
        document.getElementById("searchframe").style.display = "block";
        document.getElementById("button").style.display = "block";
      }

      function hideSearch(name) {
        document.getElementById("searchframe").style.display = "none";
        document.getElementById("button").style.display = "none";
      }

    </script>