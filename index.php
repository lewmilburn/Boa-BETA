<?php
$start = microtime(true);

require __DIR__.'/Boa/Boa.php';
new Boa\App();

$time_elapsed_secs = microtime(true) - $start;
echo $time_elapsed_secs * 1000 .' ms';