<?php

class csn
{
	public static function init($base_dir,$db_init=true)
	{
		global $config;
		include(__DIR__.'/../../etc/config.php');
		include($base_dir.'etc/config.php');
	
		# include all libraries
		include(__DIR__.'/../../../Logger/lib/php/lgr.php');
		include(__DIR__.'/../../../BootstrapConstructor/lib/php/bsc.php');
		include(__DIR__.'/../../../DatabaseManager/lib/php/dbm.php');
		include(__DIR__.'/../../../DataValidator/lib/php/dvr.php');
		include(__DIR__.'/../../../DataFormatter/lib/php/dfm.php');
		include(__DIR__.'/../../../JsonVC/lib/php/jvc.php');
		include(__DIR__.'/../../../LanguageHelper/lib/php/lng.php');
		include(__DIR__.'/../../../SessionManager/lib/php/ssm.php');
		include(__DIR__.'/../../../ImageHelper/lib/php/img.php');

		# init all libraries. Order is unimportant, other than lgr must be first.
		lgr::init($config['lgr']);
		bsc::init($config['bsc']);
		if($db_init)
			dbm::init($config['dbm']);
		dvr::init($config['dvr']);
		dfm::init($config['dfm']);
		jvc::init($config['jvc']);
		lng::init($config['lng']);
		ssm::init($config['ssm']);
		img::init($config['img']);
		
	}
	
	public static function process()
	{	
		global $config;
		# examine url, process controllers as necessary
		jvc::process();

		# output the page
		jvc::process('pre-page');
		include(__DIR__.'/../../../../www/layouts/'.$config['csn']['layout'].'.php');
		jvc::process('post-page');
		echo($page);
	
		# exit and call all deinit hooks
		jvc::deinit();
	}
}

?>