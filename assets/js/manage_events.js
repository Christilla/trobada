$(document).ready(function(){

	(function(){
		$.each($('.view-parts'), function(key, val){
			// console.log('view-part-' + key)
			// console.log(val)
			// $(val).addClass('hide-parts')
			// alert($(val).attr('id'))
			if($(val).attr('id') !== 'showing-dates-and-places')
				$(val).hide()
		});
	}())


	$('.action-trigger').click(function(e){
		// e.preventDefault();
		// console.log($(this).data('target'));

		const target = $(this).data('target')

		$.each($('.view-parts'), function(key, val){
			$(val).slideUp(300)
		});

		$('#' + target).slideDown(300)
	});





	$('.modal-form-places').click(function(e)
	{
		e.preventDefault();
		$(this).toggleClass('bg-success');
		var val = $(this).text();

		if(val === 'Montrer les lieux')
		{
			$(this).text('Cacher les lieux');
		}
		else
		{
			$(this).text('Montrer les lieux');
		}

		$(this).parent().parent().find('.form-places').toggle('slide');
	});

	$('.modal-all-places-toggle').click(function(e){
		e.preventDefault();
		$(this).toggleClass('bg-danger');
		$(this).parent().parent().parent().parent().find('.modal-all-places').toggle('slide');

		var val = $(this).text();

        if(val === 'Afficher les détails')
        {
            $(this).text('Masquer les détails');
        } 
        else 
        {
            $(this).text('Afficher les détails');
        }
	});

	$('.toggle-description').mouseenter(function(e){
		e.preventDefault();
		$(this).css('background-color', 'rgba(0,0,0,0.1)');
	});

	$('.toggle-description').mouseleave(function(e){
		e.preventDefault();
		$(this).css('background-color', '');
	});

	$('.toggle-description').click(function(e){
		e.preventDefault();
		//$('#event-description').toggleClass("my-max-height", 1000);
		if($('#event-description').hasClass('my-min-height')){
			$('#event-description').removeClass('my-min-height');
			$('#event-description').addClass('my-max-height');
		} else {
			$('#event-description').removeClass('my-max-height');
			$('#event-description').addClass('my-min-height');
		}

		if($(this).hasClass('down'))
		{
			$(this).html('<i class="fas fa-arrow-circle-up"></i>')
			$(this).toggleClass('down');
		} 
		else 
		{
			$(this).html('<i class="fas fa-arrow-circle-down"></i>');
			$(this).toggleClass('down');
			var target = '#title';
			$('html, body')
			.stop()
			.animate({scrollTop: $(target).offset().top}, 700);
		}
	});
})
