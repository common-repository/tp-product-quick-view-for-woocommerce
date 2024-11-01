(function( $ ) {
	'use strict';
	$(document).ready(function(){

		console.log(tppqw);

		$('.tpvenobox').venobox({

			// infinite loop
  			infinigall: (tppqw.infinite_loop) == 1 ? true : false,

			// close the lightbox by clicking the background overlay
  			overlayClose: (tppqw.close_lightbox) == 1 ? true : false,

			// 'top' || 'bottom'
  			titlePosition : tppqw.title_position,

			// title background color
			titleBackground: tppqw.title_background,

			// title color
			titleColor: tppqw.title_color,
		});
	});
})( jQuery );
