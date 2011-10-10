<?php
include("config.php");
include("function.php");


$out = array();
exec('./sources/stats.sh 2>&1', $out);

foreach($out as $line)
{
	echo utf8_decode(stripslashes($line))."\n";
}


?>