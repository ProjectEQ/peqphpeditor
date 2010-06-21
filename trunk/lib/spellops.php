<?php

switch ($action) {
  case 0:
    $body = new Template("templates/spellops/spellops.default.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    break;
}

?>
