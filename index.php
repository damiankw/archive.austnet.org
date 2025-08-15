<?php
$dirs = glob('./[0-9][0-9][0-9][0-9]', GLOB_ONLYDIR);
foreach ($dirs as $dir) {
    $name = basename($dir);
    echo "<a href=\"$name/\">$name</a><br>\n";
}
?>