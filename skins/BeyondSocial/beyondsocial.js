/**
 * BeyondSocial-specific scripts
 */
jQuery( function ( $ ) {

	/**
	 * BS js
	 */


	hideEmptyPElements()

	// function to hide <h2>Links</h2> if there are no links added to the page
	function hideEmptyLinksSection(){
		if (!$('div.link').length) {
			$('h2 span#Links').parent().detach();
			$('div.toc a[href=#Links]').parent().detach();
		}
	}
	// hide empty parameter in Articles
	function hideEmptyImgLink(){
		$('div#article-wrapper .sidebox .image').each(function () {
			if($(this).text() == '[[File: | ]]'){
				$(this).detach();
			};
		});
	}
	hideEmptyImgLink()

	// function to add captions to plain images
	function showCaption(){
		$('div#article-wrapper a.image img').each(function () {
			var caption = $(this).attr('alt');
			$(this).parent().after('<div class="caption">'+caption+'</div>');
		});
	}
	showCaption()

	// function to align images in the overview pages
	function centerLandscapeImages(){
		$('div.overview .thumb-wrapper img, div.oneline-wrapper .thumb-wrapper img').each(function () {
			// let images that are very narrow scale up to 231px
			if($(this).width() < 231){
				$(this).css('width','231px');
				$(this).css('height','auto');
			}
			// center landscape images
			if($(this).width() > $(this).height()){
				$(this).css('margin-left','-70%');
			}
			// center portrait images
			else{
				var marginleft = ($(this).width() - 231 ) / 2;
				$(this).css('margin-left','-'+marginleft+'px');
			}
			$(this).css('opacity',1);
		});
	}
	centerLandscapeImages()

	// function to change links from the images in an overview page + oneline sections
	function changeImageLinks(){
		$('div.overview a.image').each(function () {
			var link = $(this).parent().next().children().first().attr('href');
			$(this).attr('href',link);
		});
		$('div.oneline-wrapper a.image').each(function () {
			var link = $(this).parent().next().children().first().attr('href');
			$(this).attr('href',link);
		});
	}
	changeImageLinks()

	// function to hide empty <p> elements
	function hideEmptyPElements(){
		$('p').each(function() {
			if($(this).parent() != $('.summary')){
				if($(this).html() == '<br>\n'){
					$(this).detach();
				}
				if($(this).html() == '<br>'){
					$(this).detach();
				}
			}
		});
	}
	hideEmptyLinksSection()

	// add a key to event enddate and time
	function addKeyInEventData(){
		$('div.enddate .value').each(function() {
			if($(this).text() != ' '){
				$(this).parent().find('div.key').text('End: ');
			}
		});
		$('div.time .value').each(function() {
			if($(this).text() != ' '){
				$(this).parent().find('div.key').text('Time: ');
			}
		});
	}
	addKeyInEventData()

	// scroll anchor links
	function scrollAnchorLinks(){
		$("a[href*=#]").click(function(e) {
			e.preventDefault();
			$('html, body').animate({scrollTop: $( $.attr(this, 'href') ).offset().top - 25}, 500);
		}); 
	}
	scrollAnchorLinks()

	// check if http:// is added to the external links
	function checkExternalLinks(){
		var http = 'http://';
		$('div.link-external').each(function(){
			if($(this).text()[0] == '['){
				var input = $(this).text().replace('[','');
				var input = input.replace(']','');
				var input = input.split(" ");
				var link = input[0];
				var text = input[1];
				$(this).html('<a class="external text" href="http://'+link+'" target="_blank">'+text+'</a>');
			}
		});
	}
	checkExternalLinks()

	// function to open a new tab which loads Tw/FB as a sharing option. Written by Template.
	function shareClick(){
		$(document).on('click','#share a', function(e){
			e.preventDefault()
			var currentUrl=window.location.href
			if($(this).attr('id') == 'shareTwitter'){
				window.open('https://twitter.com/intent/tweet?text='+currentUrl); 
			}else if($(this).attr('id') == 'shareFacebook'){
				window.open('https://www.facebook.com/sharer/sharer.php?u='+currentUrl); 
			}
		});
	}
	// this function loads the first img on the page into the head, so FB can read it and place it next to the shared link. Written by Template.
	function addFBImage(){
		if($('.content').find('img').length == true){
			$('head').append('<link rel="image_src" type="image/jpeg" href="'+$('#mw-content-text').find('img').first()[0].src+'" />')
		}else{
			$('head').append('<link rel="image_src" type="image/jpeg" href="'+$(document).find('img').first()[0].src+'" />')
		}
	}
	shareClick()
	addFBImage()

	// ************************************************************

	/**
	 * Collapsible tabs
	 */
	var $cactions = $( '#p-cactions' ),
		$tabContainer = $( '#p-views ul' ),
		rAF = window.requestAnimationFrame || setTimeout,
		// Avoid forced style calculation during page load
		initialCactionsWidth = function () {
			var width = $cactions.width();
			initialCactionsWidth = function () {
				return width;
			};
			return width;
		};

	rAF( initialCactionsWidth );

	/**
	 * Focus search input at the very end
	 */
	$( '#searchInput' ).attr( 'tabindex', $( document ).lastTabIndex() + 1 );

	/**
	 * Dropdown menu accessibility
	 */
	$( 'div.beyondsocialMenu' ).each( function () {
		var $el = $( this );
		$el.find( '> h3 > a' ).parent()
			.attr( 'tabindex', '0' )
			// For accessibility, show the menu when the h3 is clicked (bug 24298/46486)
			.on( 'click keypress', function ( e ) {
				if ( e.type === 'click' || e.which === 13 ) {
					$el.toggleClass( 'menuForceShow' );
					e.preventDefault();
				}
			} )
			// When the heading has focus, also set a class that will change the arrow icon
			.focus( function () {
				$el.find( '> a' ).addClass( 'beyondsocialMenuFocus' );
			} )
			.blur( function () {
				$el.find( '> a' ).removeClass( 'beyondsocialMenuFocus' );
			} )
			.find( '> a:first' )
			// As the h3 can already be focused there's no need for the link to be focusable
			.attr( 'tabindex', '-1' );
	} );

	// Bind callback functions to animate our drop down menu in and out
	// and then call the collapsibleTabs function on the menu
	$tabContainer
		.bind( 'beforeTabCollapse', function () {
			// If the dropdown was hidden, show it
			if ( $cactions.hasClass( 'emptyPortlet' ) ) {
				$cactions
					.removeClass( 'emptyPortlet' )
					.find( 'h3' )
						.css( 'width', '1px' ).animate( { width: initialCactionsWidth() }, 'normal' );
			}
		} )
		.bind( 'beforeTabExpand', function () {
			// If we're removing the last child node right now, hide the dropdown
			if ( $cactions.find( 'li' ).length === 1 ) {
				$cactions.find( 'h3' ).animate( { width: '1px' }, 'normal', function () {
					$( this ).attr( 'style', '' )
						.parent().addClass( 'emptyPortlet' );
				} );
			}
		} )
		.collapsibleTabs( {
			expandCondition: function ( eleWidth ) {
				// (This looks a bit awkward because we're doing expensive queries as late as possible.)

				var distance = $.collapsibleTabs.calculateTabDistance();
				// If there are at least eleWidth + 1 pixels of free space, expand.
				// We add 1 because .width() will truncate fractional values but .offset() will not.
				if ( distance >= eleWidth + 1 ) {
					return true;
				} else {
					// Maybe we can still expand? Account for the width of the "Actions" dropdown if the
					// expansion would hide it.
					if ( $cactions.find( 'li' ).length === 1 ) {
						return distance >= eleWidth + 1 - initialCactionsWidth();
					} else {
						return false;
					}
				}
			},
			collapseCondition: function () {
				// (This looks a bit awkward because we're doing expensive queries as late as possible.)
				// TODO The dropdown itself should probably "fold" to just the down-arrow (hiding the text)
				// if it can't fit on the line?

				// If there's an overlap, collapse.
				if ( $.collapsibleTabs.calculateTabDistance() < 0 ) {
					// But only if the width of the tab to collapse is smaller than the width of the dropdown
					// we would have to insert. An example language where this happens is Lithuanian (lt).
					if ( $cactions.hasClass( 'emptyPortlet' ) ) {
						return $tabContainer.children( 'li.collapsible:last' ).width() > initialCactionsWidth();
					} else {
						return true;
					}
				} else {
					return false;
				}
			}
		} );

} );
