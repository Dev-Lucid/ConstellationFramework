<?php
# Copyright 2013 Mike Thorn (github: WasabiVengeance). All rights reserved.
# Use of this source code is governed by a BSD-style
# license that can be found in the LICENSE file.
if(!class_exists('bsc_widget_modal'))
{
	bsc::load_widget_class('modal');
}

class bsc_widget_csn_modal extends bsc_widget_modal
{
	function init()
	{
		$this->option_order = array(
			'title',
			'content',
			'footer',
			'autoclose',
		);
		$this->options['tag'] = 'div';
		$this->class('modal-body');

		$this->header = bsc::heading()->class('modal-title')->id('bsc_modal_header')->level(4);
		$this->footer = bsc::div()->class('modal-footer');
	}
	
	function option($name,$value)
	{
		switch($name)
		{
			case 'title':
				$this->header->text($value);
				break;
			case 'content':
				if(is_string($value))
					$value = bsc::text($value);
				$this->add($value);
				break;
			case 'footer':
				$this->footer->add($value);
				break;
			case 'autoclose':
				if(!is_numeric($value))
					$value = 1200;
				jvc::set_response('js','window.setTimeout(function(){ $(\'#bsc_modal\').parent().parent().modal(\'hide\');},'.$value.');');
				break;
			default:
				parent::option($name,$value);
				break;
		}
		return $this;
	}
	

	
	function show($data)
	{
		jvc::set_response('js','$(\'#bsc_modal\').parent().parent().modal();');
		$html = parent::render($data);
		jvc::set_response('bsc_modal',$html);
	}
}

?>