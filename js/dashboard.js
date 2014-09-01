jQuery(document).ready(function($) {
	$('#wp-admin-bar-new-content').hover(function () {
		
		var mq = window.matchMedia("(min-width: 782px)");
		var me = $(this).find(".ab-item").first();
		
		if(mq.matches) {
			me.css("padding-bottom", "28px");
		} else {
			me.css("padding-bottom", "19px");
		}
		
	}, function () {
	    	
	    var me = $(this).find(".ab-item").first();	
	    me.css("padding-bottom", "5px");
	});
});