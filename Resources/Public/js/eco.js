
$(document).ready(function() {
 
	// imagesLoaded for bg images as well
	var images = $('img');
	$('.bg-img').each(function(){
		var el = $(this), image = el.css('background-image').match(/url\((['"])?(.*?)\1\)/);
		if(image) images = images.add($('<img>').attr('src', image.pop()));
	});
	images.imagesLoaded();
	
	
	/*
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
	$('#packery').infinitescroll({
		navSelector  : 'div.pagination', 
		nextSelector : 'div.pagination a:first', 
		itemSelector : '.post',
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
			$container.isotope( 'appended', $newElems );
		});
	});
	*/
});

 
docReady( function() {
	
	// document is ready, let's do some fun stuff!
	var container = document.querySelector('#packery');
	var pckry = new Packery( container,{
		itemSelector : '.item',
		stamp: '.stamp',
		gutter: 0
	});

	/*
	// document is ready, let's do some fun stuff!
	var $container = $('#packery');
	
	// Fire Isotope only when images are loaded
	$container.imagesLoaded(function(){
		$container.packery({
			itemSelector : '.item',
			stamp: '.stamp',
			gutter: 0
		});
	});
	*/
	

});