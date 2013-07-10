#!/usr/bin/php
<?php
echo("Building Models...");
include(__DIR__.'/../../lib/php/csn.php');
csn::init(__DIR__.'/../../../../');

$cmd = 'php -f '.__DIR__.'/../../../../lib/DatabaseManager/bin/build_models.php';

foreach($config['dbm'] as $name=>$value)
{
	if($name != 'hooks')
		$cmd .=' '.$name.'='.$value;
}
$result = shell_exec($cmd);
if(strpos($result,'DBM: ') !== false)
{
	echo($result);
	exit("\n");
}

echo("      COMPLETE!\n");
?>