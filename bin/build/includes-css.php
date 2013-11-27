#!/usr/bin/php
<?php
echo("Building CSS...");

# first, build the entry point for all of the less.
$entry_less = __DIR__.'/../../../../www/media/less/all-'.md5(time()).'.less';
$to_compile .= '@import "bootstrap";'."\n";
$to_compile .= '@import "bsc-data-table";'."\n";
$to_compile .= '@import "bsc-forms";'."\n";
if(file_exists(__DIR__.'/../../../../www/media/less/customizations.less'))
{
	$to_compile .= '@import "customizations";'."\n";
}
file_put_contents($entry_less,$to_compile);



try
{


	$include_path  = __DIR__."/../../../../lib/TwitterBootstrap/less/:";
	$include_path .= __DIR__."/../../../../www/media/less/:";
	$include_path .= __DIR__."/../../../../lib/BootstrapConstructor/lib/less/";
	
	$cmd = "lessc --compile  --include-path=".$include_path."  ".$entry_less;
	if(file_exists(__DIR__.'/../../www/media/combined.css'))
		unlink(__DIR__.'/../../www/media/combined.css');
	#echo($cmd);
	$final_uncompressed_css = shell_exec($cmd);

	$cmd = "lessc --compile --compress --include-path=".$include_path." ".$entry_less;
	if(file_exists(__DIR__.'/../../../../www/media/combined.min.css'))
		unlink(__DIR__.'/../../../../www/media/combined.min.css');
	$final_compressed_css = shell_exec($cmd);	
	


	
	# build/fix the font awesome css.
	$fontawesome = file_get_contents(__DIR__.'/../../../../lib/FontAwesome/css/font-awesome.css');
	$fontawesome_min = file_get_contents(__DIR__.'/../../../../lib/FontAwesome/css/font-awesome.min.css');
	$final_uncompressed_css .= str_replace('../fonts/','fonts/',$fontawesome);
	$final_compressed_css .= str_replace('../fonts/','fonts/',$fontawesome_min);
	
	copy(__DIR__.'/../../../../lib/FontAwesome/fonts/fontawesome-webfont.eot',__DIR__.'/../../../../www/media/fonts/fontawesome-webfont.eot');
	copy(__DIR__.'/../../../../lib/FontAwesome/fonts/fontawesome-webfont.svg',__DIR__.'/../../../../www/media/fonts/fontawesome-webfont.svg');
	copy(__DIR__.'/../../../../lib/FontAwesome/fonts/fontawesome-webfont.ttf',__DIR__.'/../../../../www/media/fonts/fontawesome-webfont.ttf');
	copy(__DIR__.'/../../../../lib/FontAwesome/fonts/fontawesome-webfont.woff',__DIR__.'/../../../../www/media/fonts/fontawesome-webfont.woff');
	copy(__DIR__.'/../../../../lib/FontAwesome/fonts/FontAwesome.otf',__DIR__.'/../../../../www/media/fonts/FontAwesome.otf');

	file_put_contents(__DIR__.'/../../../../www/media/combined.css',$final_uncompressed_css);
	file_put_contents(__DIR__.'/../../../../www/media/combined.min.css',$final_compressed_css);

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