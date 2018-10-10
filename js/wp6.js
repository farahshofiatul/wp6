/*jQuery(document).ready(function($) {
	  var availableTags = ['coba','lagi'];
	  console.log('hey');						
      $( "#s" ).autocomplete({
        source: availableTags
      });
   });

/*

jQuery(document).ready(function($) {	
	  console.log('sssss');						
      $( "#s" ).autocomplete({
        source: function( request, response ) {
        $.ajax({
          url: autojs.ajax_url,
          dataType: "jsonp",
          type: "GET",
          data: {
          	'action': 'my_action',
            term: request.term
          },
          success: function( data ) {
            response( data ),
            console.log(data);
          }
        });
      }
      });
   });

*/
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
