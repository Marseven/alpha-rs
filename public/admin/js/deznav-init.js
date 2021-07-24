(function($) {
	
	function getUrlParams(dParam) {
		var dPageURL = window.location.search.substring(1),
			dURLVariables = dPageURL.split('&'),
			dParameterName,
			i;

		for (i = 0; i < dURLVariables.length; i++) {
			dParameterName = dURLVariables[i].split('=');

			if (dParameterName[0] === dParam) {
				return dParameterName[1] === undefined ? true : decodeURIComponent(dParameterName[1]);
			}
		}
	}
	
	var direction =  getUrlParams('dir');
	if(direction != 'ltr')
	{direction = 'ltr'; }

	var dezSettingsOptions = {
		typography: "poppins",
		version: "light",
		layout: "vertical",
		headerBg: "color_1",
		navheaderBg: "color_1",
		sidebarBg: "color_1",
		sidebarStyle: "full",
		//sidebarStyle: "compact",
		sidebarPosition: "fixed",
		headerPosition: "fixed",
		containerLayout: "full",
		direction: direction
	};
		
	new dezSettings(dezSettingsOptions); 

	jQuery(window).on('resize',function(){
		new dezSettings(dezSettingsOptions); 
	});

})(jQuery);