var csn={'hooks':{}};

csn.init=function(defaultController,defaultParams){
	jvc.init();
	var curUrl = new String(location.href);
	if(curUrl.indexOf('#!') < 0 && defaultController != ''){
		jvc.requestData(defaultController,defaultParams);
	}
}

// configure JVC to handle bootstrap stuff, link in validator
//jvc['afterAjaxResponseJS'] = '$(\'[rel=popover]\').popover();$(\'[rel=tooltip]\').tooltip();';
jvc['beforeAjaxSubmit'] = dvr.validate;
jvc['showFormErrors'] = bsc.form.showErrors;
jvc['clearFormErrors'] = bsc.form.clearErrors;
jvc['beforeNavigate'] = function(){
	var navBar = $('button.navbar-toggle');
	if(!navBar.hasClass('collapsed')){
		navBar.click();
	}else{	
	}
}