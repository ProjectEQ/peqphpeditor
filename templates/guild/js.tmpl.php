<script>
  function showRankChange(i) {
    document.getElementById("current_rank_" + i).style.display = "none";
    document.getElementById("new_rank_" + i).style.display = "block";
  }
  function showSearch() {
    document.getElementById("searchframe").style.display = "block";
    document.getElementById("button").style.display = "block";
  }
  function hideSearch() {
    document.getElementById("searchframe").style.display = "none";
    document.getElementById("button").style.display = "none";
  }
</script>