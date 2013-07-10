#!/usr/bin/php
<?php
$base = __DIR__.'/../../../';
include(__DIR__.'/../lib/php/csn.php');
csn::init($base);

$to_update = $argv[1];

echo("updating submodule $submodule.....\n");

$modules = parse_ini_file($base.'.gitmodules',true);

$found = false;
foreach($modules as $module)
{
	$name = array_pop(explode('/',$module['path']));
	if($name == $to_update or $to_update == 'all')
	{
		echo("\tupdating ".$name."\n");
		$cmd = "cd $base; cd ".$module['path'].";";
		
		$cmd .= 'git pull origin '.((isset($module['branch']))?$module['branch']:'master').';';
		$cmd .= 'cd ..;';
		$cmd .= "git add $name;";
		echo(shell_exec($cmd));
		$found = true;
	}
}
if($found)
{
	$cmd = "cd $base;";
	$cmd .= 'git commit -a -m "updating libs";';
	$cmd .= 'git push origin master;';
	echo(shell_exec($cmd));
}
else
{
	exit("could not find module: $name\n");
}


exit("\ncomplete!");




?>