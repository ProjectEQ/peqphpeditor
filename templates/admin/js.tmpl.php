<script language="javascript">
  function showSearch() {
    document.getElementById("searchblock").style.display = "block";
  }
  function hideSearch() {
    document.getElementById("searchblock").style.display = "none";
  }
  function validateIP() {
    var ipformat = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
    if (document.getElementById('ip').value.match(ipformat)) {
      document.gm_ip.ip_address.style.backgroundColor = "green";
      document.gm_ip.submit();
      return true;
    }
    else {
      alert("You have entered an invalid IP address!");
      document.gm_ip.ip_address.style.backgroundColor = "red";
      document.gm_ip.ip_address.focus();
      return false;
    }
 }
</script>