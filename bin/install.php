#!/usr/bin/php
<?php
$base = __DIR__.'/../../../';
include(__DIR__.'/../lib/php/csn.php');
csn::init($base);
ob_end_clean();

array_shift($argv);

$vals = array(
	'stage'=>'production',
	'hostname'=>'localhost',
	'port'=>80,
	'path'=>realpath($base.'/www/'),
	'name'=>'',
);

if(count($argv) > 0)
	$vals['stage'] = array_shift($argv);
if(count($argv) > 0)
	$vals['hostname'] = array_shift($argv);
if(count($argv) > 0)
	$vals['port'] = array_shift($argv);
if(count($argv) > 0)
	$vals['name'] = array_shift($argv);
	
if($vals['name'] == '')
	 $vals['name'] = $vals['hostname'];
	 
#print_r( $vals);
#exit();
	
$config = file_get_contents(__DIR__.'/../etc/apache_conf');
foreach($vals as $position=>$value)
{
	$config = str_replace('|'.$position.'|',$value,$config);
}

if(file_exists($base.'etc/apache-'.$vals['stage'].'.conf'))
	unlink($base.'etc/apache-'.$vals['stage'].'.conf');

file_put_contents($base.'etc/apache-'.$vals['stage'].'.conf',$config);

$cmd = "\nto finish install, \n";
$cmd .= "\tsudo cp etc/apache-".$vals['stage'].".conf /etc/apache2/sites-available/".$vals['name']."-".$vals['stage'].".conf;\n";
$cmd .= "\tsudo ln -s  /etc/apache2/sites-available/".$vals['name']."-".$vals['stage'].".conf /etc/apache2/sites-enabled/".$vals['name']."-".$vals['stage'].".conf;\n";
$cmd .= "\tsudo /etc/init.d/apache2 restart;\n";
exit($cmd);
?>
