jQuery(document).ready(function($){
	$("#s").autocomplete({
		source: function(request,response){
			$.ajax({
				url: autojs.ajax_url,
				dataType: "json",
				data: {
					'action': 'my_action',
					term: request.term
				},
				success: function(data){
					response(data)
				}
			});
		}
	});

});
