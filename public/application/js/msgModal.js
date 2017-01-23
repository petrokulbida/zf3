/**
 * @category Application
 * @package js
 * @author FAN
 */
(function($, window) {
	var yfMsgModal = window.yfMsgModal = {
		error : function(message) {
			this.show(message);
		},

		show : function(message) {
			if (message === undefined) {
				message = '';
			}
			
			$('#modalError .modal-body').html(message);
			$('#modalError').modal('show');

			$('#modalError').on('shown.bs.modal', function() {

				$(this).find('.modal-dialog').css({
					'margin-top' : function() {
						return -($(this).outerHeight() / 2);
					},
					'margin-left' : function() {
						return -($(this).outerWidth() / 2);
					},
					'top' : '50%',
					'left' : '50%',
					'position' : 'absolute'
				});
			});
		},
		hide : function() {
			$('#msgModal').removeClass('showed');
		}
	};

})(jQuery, window);