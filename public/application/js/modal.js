/**
 * onReady
 */
$(function() {
	initModal();
});

function initModal() {
	var modals = $('.modal');
	
	modals.each(function() {
		if($(this).data('show')) {
			$(this).modal()
		}
	});
}


/**
 * user valid
 */
function logIn() {
    var formValues = $('#signin-modal-form').serialize();

    console.log(formValues);

    return;

	$.ajax({
		type : 'POST',
		url : '/core/index/login',
		data : formValues,
		success : function(data) {
			if (yfHelper.ajaxResponseHasError(data)) {
				yfHelper.ajaxException(data, true);
				return;
			}
			location.reload();
		}
	});
}