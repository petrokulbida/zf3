$.ajaxSetup({
	timeout : 15000,
	beforeSend : function() {
		yfLoader.show();
	},
	complete : function(jqXHR, status) {
		yfLoader.hide();
		
		var response = jqXHR.responseJSON;
		
		if (yfHelper.ajaxResponseHasError(response)) {
			yfHelper.ajaxException(response, true);
		}
	},
	error : function(xhr, str, error) {
		yfMsgModal.error(error);
	}
});