$(function() {
	ajaxSetUp();
    
    initModal();
    
    localeOnChange();
	
    var yfLoader = window.yfLoader = {
        
        show : function() {
            $('#loading').show();
        },
        
        hide : function() {
            $('#loading').hide();
        }
    };
});

function ajaxSetUp() {
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
}

function initModal() {
    var modals = $('.modal');
    
    modals.each(function() {
        if($(this).data('show')) {
            $(this).modal()
        }
    });
}

function localeOnChange() {
    $('#locale').change(function() {
		
    	$.ajax({
            type : 'post',
            url : $(this).data('url'),
            data : {
                locale: this.value
            },
            success : function(data) {
                if (data.success) {
				 	location.reload();
				}
			}
        });

    });
}