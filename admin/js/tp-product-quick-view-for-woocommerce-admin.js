(function( $ ) {
	'use strict';

	$( document ).ready(function() {
		//console.log(tppqw);
		$("#tppqw-tabs").tabs();
		$('.tp_colorpiker').minicolors();

		$('#tppqw_button_position').on('change', function(){
			var position = this.value;
			var priority = $(this).find(':selected').data('priority');
			
			$('#tppqw_button_position_priority').val(priority);

			//alert(priority);
		});

	});

})( jQuery );
