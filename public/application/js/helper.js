/**
 * @category Application
 * @package js
 * @author FAN
 */
(function($, window) {

	var yfHelper = window.yfHelper = {

		ajaxResponseHasError : function(response) {
			try {
				if (response.success === false) {
					return true;
				} else {
					return false;
				}
			} catch (e) {
				return false;
			}
		},

		ajaxException : function(response, isModalError, callback, timeout) {
			if (isModalError) {
				yfMsgModal.error(response.message);
			} else {
				Msg.error(response.message, timeout);
			}
			if ($.isFunction(callback)) {
				callback.call(this)
			}
		}
	};

})(jQuery, window);