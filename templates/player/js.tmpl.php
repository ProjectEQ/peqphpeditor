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

    // populate versions select based on zone selection
    function populateVersions() {
      const zoneHidden = document.getElementById('zoneid');
      const zoneSel = document.getElementById('move_zone');
      const zoneVersionsSel = document.getElementById('move_zone_version');
      const currentZone = zoneSel.value;

      zoneVersionsSel.innerHTML = '';

      if (currentZone && zone_versions[currentZone]) {
        zone_versions[currentZone].forEach (v => {
          const opt = document.createElement('option');
          opt.value = v;
          opt.textContent = v;
          zoneVersionsSel.appendChild(opt);
        });

        zoneVersionsSel.selectedIndex = 0;
      }

      updateZoneHidden();
    }

    // populate a hidden input with zoneidnumber.version
    function updateZoneHidden() {
      const zoneHidden = document.getElementById('zoneid');
      const zoneSel = document.getElementById('move_zone');
      const zoneVersionsSel = document.getElementById('move_zone_version');
      const zone = zoneSel.value;
      const version = zoneVersionsSel.value;

      zoneHidden.value = zone && version ? `${zone}.${version}` : '';
    }

    const zone_versions = <?php echo json_encode($zoneVersions); ?>;

    document.addEventListener("DOMContentLoaded", function () {
      populateVersions();
    });
  </script>
