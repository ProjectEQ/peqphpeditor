    <script language="javascript">
      function showSearch(name) {
        document.getElementById(name).style.visibility = "visible";
        document.getElementById(name).style.width = "400px";
        document.getElementById(name).style.height = "150px";
        document.getElementById("spell_button").value = "Hide Spell Search";
        document.getElementById("spell_button").onclick = function(){hideSearch(name)};
      }

      function hideSearch(name) {
        document.getElementById(name).style.visibility = "hidden";
        document.getElementById(name).style.width = 1;
        document.getElementById(name).style.height = 0;
        document.getElementById("button").value = "Show Spell Search";
        document.getElementById("button").onclick = function(){showSearch(name)};
      }
    </script>
