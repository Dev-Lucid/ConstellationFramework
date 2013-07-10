#!/usr/bin/php
<?php
$base = __DIR__.'/../../../';
include(__DIR__.'/../lib/php/csn.php');
csn::init($base);
ob_end_clean();

$to_update = $argv[1];

echo("checking submodule $submodule.....\n");

$modules = parse_ini_file($base.'.gitmodules',true);
#print_r($modules);
#exit();
$found = false;
foreach($modules as $module)
{
	$name = array_pop(explode('/',$module['path']));
	echo("\tchecking ".$name.": ".strpos($module['url'],'Dev-Lucid')."\n");
	if(($name == $to_update or $to_update == 'all') && (strpos($module['url'],'Dev-Lucid') !== false))
	{
		$cmd = "cd $base; cd ".$module['path'].";git status;";
		$output  = shell_exec($cmd);
		if(strpos($output,'nothing to commit') !== false)
		{
			echo("\t\tNo changes\n");
		}
		else
		{	
			echo("\t\tadding changes\n");
			$cmd = 'cd '.$base.'; cd '.$module['path'].';';
			$cmd .= 'git add *;git commit -m "'.$argv[2].'";';
			$branch = (isset($module['branch'])?$module['branch']:'master');
			$cmd .= 'git push origin '.$branch.';';
			echo(shell_exec($cmd));
			$found = true;
		}
		#echo($cmd.': '.$output."\n");
	}
}

if($found)
{
	$cmd = "cd $base;";
	$cmd .= 'git commit -a -m "updating libs";';
	$cmd .= 'git push origin master;';
	echo(shell_exec($cmd));
}



exit("\ncomplete!");




?>