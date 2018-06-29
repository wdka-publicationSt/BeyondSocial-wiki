/**
 * BeyondSocial-specific scripts
 */
jQuery( function ( $ ) {

	/**
	 * BS js
	 */


	hideEmptyPElements()

	// display 'Editorial' before an editorial FirstHeader
	if($('#editorial-wrapper').length == 1){
		$('#firstHeading').prepend('(editorial) ');
	}
	// display 'Event' before an event FirstHeader
	if($('.event-page').length == 1){
		$('#firstHeading').prepend('(event) ');
	}

	// function to align images in the overview pages
	function centerLandscapeImages(){
		$('.thumb-wrapper img').each(function () {
			// let images that are very narrow scale up to 231px
			if($(this).width() < 231){
				$(this).css('width','231px');
				$(this).css('height','auto');
			}
			// center landscape images
			if($(this).width() > $(this).height()){
				$(this).css('margin-left','-40%');
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

	// function to hide <h2>Links</h2> if there are no links added to the page
	function hideEmptyLinksSection(){
		if (!$('div.link').length) {
			// console.log('no links!!!!!');
			$('h1 span#Links').parent().detach();
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
	function checker(value) {
		var prohibited = ['.png', '.jpg', '.gif', '.pdf'];
		return prohibited.every(function(v) {
			return value.indexOf(v) == -1;
		});
	}
	function showCaption(){
		$('div#article-wrapper a.image img').each(function () {
			var caption = $(this).attr('alt');
			console.log(checker(caption));
			if(checker(caption) == true){
				$(this).parent().after('<div class="caption">'+caption+'</div>');
			}
		});
	}
	showCaption()

	// function to change links from the images in an overview page + oneline sections
	function changeImageLinks(){
		$('div.thumb-wrapper a.image').each(function () {
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
			if($(this).text() != ''){
				$(this).parent().find('div.key').html('<b>End: </b>');
			}
		});
		$('div.time .value').each(function() {
			if($(this).text() != ''){
				$(this).parent().find('div.key').html('<b>Time: </b>');
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


	// *************************************
	// extended print function using the API 
	// to retrieve sociality data

	// $('body').prepend('<div id="cover">Beyond Social</div>');
	$('body').append('<div class="socialitydata right"></div>');
	$('body').append('<div class="socialitydata left"></div>');
	$('.metadata').append('<div class="socialitydata"></div>');
	currentpagename = location.href.match(/([^\/]*)\/*$/)[1];
	// console.log(currentpagename);

	var firsteditor;
	function getMetadata(page){
		var request = 'http://beyond-social.org/wiki/api.php?action=query&prop=revisions|contributors&rvlimit=1&rvprop=timestamp|user&rvdir=newer&titles='+page+'&format=json';
		var created;
		var user;
		$.ajax({
			dataType: 'json',
			url: request,
			type:'GET',
			dataType: "jsonp",
			success: function(data){
				// console.log('metadata', data.query.pages);
				$.each(data.query.pages, function(id, request){
					// console.log('creation date', request.revisions[0].timestamp);
					created = new Date(request.revisions[0].timestamp).toString('d MMMM yyyy HH:mm:ss');
					$('.metadata .socialitydata').append('<div class="item">This article is created at '+created+'</div>');			

					var contributors = $.map(request.contributors, function(contributor, i){
						return contributor.name;
					});
					$('.metadata .socialitydata .item').append(' and is edited by ');
					$('.metadata .socialitydata .item').append(contributors.join(' & '));
					$('.metadata .socialitydata .item').append('.');

					// console.log('user', request.revisions[0].user);
					// user = request.revisions[0].user;
				});
			}
		});
	}
	
	function getCategoryPages(category){
		var request = 'http://beyond-social.org/wiki/api.php?action=parse&page='+category+'&contentmodel=wikitext&format=json';
		$.ajax({
			dataType: 'json',
			url: request,
			type:'GET',
			dataType: "jsonp",
			success: function(data){
				console.log('*other pages in the category: '+ category+'*');
				$.each(data.parse.text, function(_, text){
					$('.socialitydata.right').append('<div class="item"><div class="data-item">Other articles in <strong>'+data.parse.title+'</strong> are:</div> '+text+'</div>');
				});
			}
		});
	}

	function mainAjax(requestnum){
		// handler(firsteditor);
		requests = [
			'http://beyond-social.org/wiki/api.php?action=query&titles='+currentpagename+'&prop=categories&cllimit=10&format=json',
			'http://beyond-social.org/wiki/api.php?action=query&list=recentchanges&rcprop=title|comment|flags|user|timestamp&rclimit=25&rctoponly&format=json',
			'http://beyond-social.org/wiki/api.php?action=query&titles='+currentpagename+'&prop=contributors&inprop=lastrevid&format=json',
			// 'http://beyond-social.org/wiki/api.php?action=query&list=usercontribs&ucuser='+firsteditor+'&uclimit=15&format=json',
		]
		var done;
		function getRandom(list) {
			return Math.floor(Math.random() * (list.length - 0) + 0);
		}
		// start API call
		$.ajax({
			dataType: 'json',
			// url: requests[getRandom(requests)],
			url: requests[requestnum],
			type:'GET',
			dataType: "jsonp",
			success: function(data){
				// console.log('data.query', data.query);

				$.map( data.query, function( request, requestname ) {
					if(requestname == 'recentchanges'){
						// display recent changes made on the wiki 
						$('.socialitydata.left .item').append('<hr>');
						// console.log('*recent changes*');
						$('.socialitydata.left').append('<div class="item data-item">Recent Changes of the previous month include:<br></div>');
						$.each(request, function(i, item){
							timestamp = new Date(item.timestamp).toString('d MMMM yyyy HH:mm:ss');
							var actions = [' edited ', ' worked on ', ' made a change in '];
							if(item.title.indexOf("File:") >= 0){
								var action = ' uploaded ';
							}
							else{
								var action = actions[getRandom(actions)];
							}
							$('.socialitydata.left').append('<div class="item data-item">'+timestamp+'<p>'+item.user+action+' <em>'+item.title+'</em></p></div>');
						});
					}

					if(requestname == 'pages'){
						$.each(request, function(id, item){
							if(item.categories != undefined){
								// display categories + pages in the first category
								// console.log('pages > categories');
								var categories = $.map(item.categories, function(category, i){
									return category.title;
								});
								$('.socialitydata.right').append('<div class="item categories">This article is added to: </div>');
								$('.socialitydata.right .item').append(categories.join(', '));
								// console.log('>> selected category', categories[getRandom(categories)]);
								getCategoryPages(categories[getRandom(categories)]);
							}
						});
					}
				});
			}
		});
	}
	mainAjax(0);
	mainAjax(1);
	mainAjax(2);
	getMetadata(currentpagename);

	
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
