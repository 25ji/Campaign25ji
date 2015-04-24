
$(document).ready(function() {

	// imagesLoaded for bg images as well
	var images = $('img');
	$('.bg-img').each(function(){
		var el = $(this), image = el.css('background-image').match(/url\((['"])?(.*?)\1\)/);
		if(image) images = images.add($('<img>').attr('src', image.pop()));
	});
	images.imagesLoaded();



	var $container = $('#packery');

	// Fire packery only when images are loaded
	$container.imagesLoaded(function(){
		$container.packery({
			itemSelector : '.item',
			stamp: '.stamp',
			gutter: 0
		});
	});

	// Infinite Scroll
	$container.infinitescroll({
		navSelector  : 'div.pagination',
		nextSelector : 'div.pagination a:first',
		itemSelector : '.item',
		bufferPx	 : 200,
		loading: {
			finishedMsg: 'We\'re done here.',
			//img: +templateUrl+'ajax-loader.gif'
		}
	},

	// Infinite Scroll Callback
	function( newElements ) {
		var $newElems = jQuery( newElements ).hide();
		$newElems.imagesLoaded(function(){
			$newElems.fadeIn();
			$container.append($newElems).packery('appended', $newElems);
		});
	});

});
