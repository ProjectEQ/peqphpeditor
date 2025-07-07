  <script language="javascript">
    // populate versions select based on zone selection
    function populateVersions() {
      const zoneSel = document.getElementById('zoneid');
      const zoneVersionsSel = document.getElementById('zoneversion');
      const currentZone = zoneSel.value;

      zoneVersionsSel.innerHTML = '<option value="-1">-1</option>';

      if (currentZone && zone_versions[currentZone]) {
        zone_versions[currentZone].forEach (v => {
          const opt = document.createElement('option');
          opt.value = v;
          opt.textContent = v;
          zoneVersionsSel.appendChild(opt);
        });

        zoneVersionsSel.value = <?php echo (isset($exp_mods['instance_version'])) ? $exp_mods['instance_version'] : '-1'; ?>;
      }
    }

    const zone_versions = <?php echo json_encode($zoneVersions); ?>;

    document.addEventListener("DOMContentLoaded", function () {
      populateVersions();
    });
  </script>
