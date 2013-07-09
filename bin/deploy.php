#!/usr/bin/php
<?php
include(__DIR__.'/../lib/ConstellationFramework/lib/php/csn.php');
csn::init(__DIR__.'/../');

$stage = $config['csn']['stages'][$argv[1]];

$cmd  = $stage['ssh-command'];
$cmd .= ' "cd '.$stage['path'].';svn update;"';
echo shell_exec($cmd);
exit("\nCOMPLETE\n");


?>