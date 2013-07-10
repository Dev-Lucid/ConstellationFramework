#!/usr/bin/php
<?php
$input = '';
$base = __DIR__.'/../../../..';
include(__DIR__.'/../../../../lib/jsmin-php/jsmin.php');
include(__DIR__.'/../../lib/php/csn.php');
csn::init(__DIR__.'/../../../../');
ob_end_flush();

echo("Building JS... ");

foreach($config['csn']['javascript'] as $file)
{
	$input .= file_get_contents(((strpos($file,'http') === 0)?'':$base).$file)."\n";
}

file_put_contents(__DIR__.'/../../../../www/media/combined.js',$input);
file_put_contents(__DIR__.'/../../../../www/media/combined.min.js',JSMin::minify($input));

echo("         COMPLETE!\n");
?>