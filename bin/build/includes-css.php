#!/usr/bin/php
<?php
echo("Building CSS...");

# first, build the entry point for all of the less.
$entry_less = __DIR__.'/../../www/media/less/all-'.md5(time()).'.less';
$to_compile .= '@import "bootstrap";'."\n";
if(file_exists(__DIR__.'/../../www/media/less/customizations.less'))
{
	$to_compile .= '@import "customizations";'."\n";
}
file_put_contents($entry_less,$to_compile);



try
{


	$cmd = "recess --compile  --includePath=".__DIR__."/../../lib/TwitterBootstrap/less/:".__DIR__."/../../www/media/less/ ".$entry_less;
	if(file_exists(__DIR__.'/../../www/media/combined.css'))
		unlink(__DIR__.'/../../www/media/combined.css');
	$final_uncompressed_css = shell_exec($cmd);

	$cmd = "recess --compile --compress --includePath=".__DIR__."/../../lib/TwitterBootstrap/less/ ".$entry_less;
	if(file_exists(__DIR__.'/../../www/media/combined.min.css'))
		unlink(__DIR__.'/../../www/media/combined.min.css');
	$final_compressed_css = shell_exec($cmd);	
	

	# include some misc stylesheets
	$final_uncompressed_css .= file_get_contents(__DIR__.'/../../lib/BootstrapConstructor/lib/css/data-table.css');
	$final_compressed_css .= file_get_contents(__DIR__.'/../../lib/BootstrapConstructor/lib/css/data-table.css');
	$final_uncompressed_css .= file_get_contents(__DIR__.'/../../lib/BootstrapConstructor/lib/css/forms.css');
	$final_compressed_css .= file_get_contents(__DIR__.'/../../lib/BootstrapConstructor/lib/css/forms.css');

	
	# build/fix the font awesome css.
	$fontawesome = file_get_contents(__DIR__.'/../../lib/FontAwesome/css/font-awesome.css');
	$fontawesome_min = file_get_contents(__DIR__.'/../../lib/FontAwesome/css/font-awesome.min.css');
	$final_uncompressed_css .= str_replace('../font/','fonts/',$fontawesome);
	$final_compressed_css .= str_replace('../font/','fonts/',$fontawesome_min);

	file_put_contents(__DIR__.'/../../www/media/combined.css',$final_uncompressed_css);
	file_put_contents(__DIR__.'/../../www/media/combined.min.css',$final_compressed_css);

	# remove the entry point.
	unlink($entry_less);
	echo("         COMPLETE!\n");
}
catch(Exception $e)
{
	unlink($entry_less);
	exit("Error: ".print_r($e,true));
	
}

?>