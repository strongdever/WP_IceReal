jQuery(document).ready(function($) {
	jQuery("#categorychecklist input[type='checkbox'], #otherschecklist input[type='checkbox'], #areachecklist input[type='checkbox']").on('change', function() {
		if (jQuery(this).parent('label').next('ul.children').length) {
			if( !jQuery(this).is(':checked') ) {
				jQuery(this).parent('label').next('ul.children').find("input[type='checkbox']").prop('checked', false);
			}
		}
		if (jQuery(this).parents('ul.children').length) {
			if( jQuery(this).is(':checked') ) {
				jQuery(this).parents('ul.children').prev('label').find("input[type='checkbox']").prop('checked', true);
			}
		}
	});
});