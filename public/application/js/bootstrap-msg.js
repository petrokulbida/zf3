(function($, window) {
	var timer;

	var Msg = window.Msg = {
		timeout : {
			danger : 15 * 1000,
			success : 15 * 1000,
			info : 15 * 1000,
			warning : 15 * 1000
		},
		info : function(message, timeout) {
			this.show(message, 'info', timeout);
		},
		error : function(message, timeout) {
			this.danger(message, timeout);
		},
		danger : function(message, timeout) {
			this.show(message, 'danger', timeout);
		},
		success : function(message, timeout, callback) {
			this.show(message, 'success', timeout, callback);
		},
		warning : function(message, timeout) {
			this.show(message, 'warning', timeout);
		},
		show : function(message, type, timeout, callback) {
			
			var self = this;

			var msg = $('#msg');
			var dontHaveMsg = false;
			if (!msg[0]) {
				dontHaveMsg = true;
				msg = $('<div id="msg">' + '<a href="#" data-dismiss="msg" class="close">&times;</a>' + '<i></i> ' + '<span></span>' + '</div>');

				msg.find('[data-dismiss="msg"]').on('click', function(e) {
					e.preventDefault();

					self.hide();
				});

				msg.appendTo(document.body);
			}

			var iconClass = '';

			switch (type) {
				case 'info':
					iconClass = 'fa fa-info-circle';
					break;
				case 'danger':
					iconClass = 'fa fa-times-circle';
					break;
				case 'success':
					iconClass = 'fa fa-check-circle';
					break;
				case 'warning':
					iconClass = 'fa fa-exclamation-triangle';
					break;
				default:
			}

			clearTimeout(timer);
			timer = null;

			msg.find('span').html(message);
			msg.find('i').attr('class', iconClass);
			if (dontHaveMsg) {
				setTimeout(function() {
					msg.attr('class', 'alert alert-' + type + ' showed');
				}, 50);
			} else {
				msg.attr('class', 'alert alert-' + type + ' showed');
			}

			if (timeout === undefined) {
				timeout = Msg.timeout[type];
			}

			if (timeout > 0) {
				timer = setTimeout(function() {
					self.hide();
					if ($.isFunction(callback)) {
						callback.call(this);
					}
				}, timeout);
			}
		},
		hide : function() {
			$('#msg').removeClass('showed');
		}
	};

})(jQuery, window);