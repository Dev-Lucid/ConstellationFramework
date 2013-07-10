#!/usr/bin/php
<?php
echo("Building Tables...");
include(__DIR__.'/../../lib/php/csn.php');
csn::init(__DIR__.'/../../../../');

$sql = file_get_contents(__DIR__.'/../../../../db/build.sql');
dbm::query($sql);

echo("      COMPLETE!\n");
?>