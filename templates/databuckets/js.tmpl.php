<script language="javascript">
  function showSearch(element_name) {
    if (element_name == "a_searchframe") {
      document.getElementById("a_searchframe").style.display = "block";
    }
    else if (element_name == "searchframe") {
      document.getElementById("searchframe").style.display = "block";
    }
    else if (element_name == "n_searchframe") {
      document.getElementById("n_searchframe").style.display = "block";
    }
    document.getElementById("button").style.display = "block";
  }

  function hideSearch() {
    document.getElementById("a_searchframe").style.display = "none";
    document.getElementById("searchframe").style.display = "none";
    document.getElementById("n_searchframe").style.display = "none";
    document.getElementById("button").style.display = "none";
  }
</script>