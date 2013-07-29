<?php


global $config;

# create log hook functions
$default_log = function($string){	lgr::write($string,'default'); };
$page_log   = function($string){	jvc::set_response('footer',$string.'<br />','prepend'); };
$sql_log     = function($string){	lgr::write($string,'sql'); };

$config = array(
	'csn'=>array(
		'layout'=>'2col-3-9',
		'stage'=>'',
		'stages'=>array(
		),
		'paths'=>array(
			'base'=>$base_dir,
		),
		'javascript'=>array(
			'http://code.jquery.com/jquery-latest.min.js',
			'/lib/TwitterBootstrap/js/affix.js',
			'/lib/TwitterBootstrap/js/alert.js',
			'/lib/TwitterBootstrap/js/button.js',
			'/lib/TwitterBootstrap/js/carousel.js',
			'/lib/TwitterBootstrap/js/collapse.js',
			'/lib/TwitterBootstrap/js/dropdown.js',
			'/lib/TwitterBootstrap/js/modal.js',
			'/lib/TwitterBootstrap/js/tooltip.js',
			'/lib/TwitterBootstrap/js/popover.js',
			'/lib/TwitterBootstrap/js/scrollspy.js',
			'/lib/TwitterBootstrap/js/tab.js',
			'/lib/TwitterBootstrap/js/transition.js',
			'/lib/console.js/console.js',
			'/lib/jquery-hashchange/jquery.ba-hashchange.js',
			'/lib/BootstrapConstructor/lib/js/bsc.js',
			'/lib/BootstrapConstructor/lib/js/bsc.form.js',
			'/lib/BootstrapConstructor/lib/js/bsc.widget.js',
			'/lib/BootstrapConstructor/lib/js/bsc.widget.dataTable.js',
			'/lib/DatabaseManager/lib/js/dbm.js',
			'/lib/DataValidator/lib/js/dvr.js',
			'/lib/JsonVC/lib/js/jvc.js',
			'/lib/LanguageHelper/lib/js/lng.js',
			'/lib/Logger/lib/js/lgr.js',
			'/lib/SessionManager/lib/js/ssm.js',
			'/lib/ConstellationFramework/lib/js/csn.js',
		),
		'less'=>array(
		
		
		),
	),
	'lgr'=>array(
		'logs'=>array(
			'default'=>__DIR__.'/../../../var/log/default.log',
			'sql'=>__DIR__.'/../../../var/log/sql.log',
			'error'=>__DIR__.'/../../../var/log/error.log',
		)
	),	
	'bsc'=>array(
		'widget_search_paths'=>array(__DIR__.'/../lib/php/bsc_widgets/'),
		'hooks'=>array(
			'log'=>$default_log,
			'translator'=>function($text){ return lng::translate($text); },
		),
		'libs'=>array(
			'css'=>array(
				'/media/combined.min.css',
			),
			'head_Js'=>array(
			),
			'foot_js'=>array(
				'/media/combined.min.js',
			),
		),
		'initial_js'=>"",
	),
	'dbm'=>array(
		'hooks'=>array('log'=>$sql_log),
		'model_path'=>__DIR__.'/../../../db/models/',
	),
	'dvr'=>array(
		'hooks'=>array('log'=>$default_log),
	),
	'dfm'=>array(
		'hooks'=>array('log'=>$default_log),
	),
	'jvc'=>array(
		'hooks'=>array(
			'log'=>$default_log,
			'deinit'=>function(){
				ssm::deinit();
				lng::deinit();
				dfm::deinit();
				dvr::deinit();
				dbm::deinit();
				bsc::deinit();
				lgr::deinit();
			}
		),
		'paths'=>array(
			'base'=>__DIR__.'/../../../www/',
		),
		'config_file'=>'config.php',
	),
	'lng'=>array(
		'hooks'=>array('log'=>$default_log),
		'language'=>'en',
		'variant'=>'us',
		'paths'=>array(__DIR__.'/dictionaries/'),
	),
	'ssm'=>array(
		'hooks'=>array('log'=>$default_log),
	),
);

?>