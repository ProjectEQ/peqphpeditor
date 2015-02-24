<script language="javascript">
  function showSearch() {
    document.getElementById("searchblock").style.display = "block";
  }
  function hideSearch() {
    document.getElementById("searchblock").style.display = "none";
  }
  function prepareTransfer() {
    document.getElementById("to_text").style.textDecoration = "none";
    document.getElementById("submitblock").style.display = "block";
  }
  function validateTransfer() {
    var from_acct = document.getElementById("from_acct").value;
    var to_acct = document.getElementById("to_text").value;
    if (from_acct == to_acct) {
      alert("You cannot transfer to the same account!");
    }
    else {
      document.getElementById("transfer").submit();
    }
  }
</script>