jQuery(document).ready(function($){
	$('#acf-field_52d80858327a3').change(function() {
		var id = $(this).val();

		// alert(id);
		$.ajax({
	        type: 'GET',
	        url: ajaxurl,
	        data: {
	        	action: 'quanJobUserId',
	        	userId: id
	        },
			
			success: function(response) {
				var response = $.parseJSON(response);
				$('#acf-field_52d80898327a4').val(response.mail);
				$('#acf-field_52d808f6327a5').val(response.phone);
			}
		});     
		return false;
	});
});
