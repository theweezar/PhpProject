<h1>new feed</h1>

<?php

$mili_sec = round(microtime(true) * 1000);
$sec = round(microtime(true));

echo "<p>mili_sec : ".$mili_sec."</p>";
echo "<p>sec      : ".$sec."</p>";
echo "<p>".date("d/m/Y - H:i:s")."</p>";
