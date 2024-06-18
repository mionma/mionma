/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens
 */

(function ($) {


	/* */
	$(window).scroll(function() {
		var height = $(window).scrollTop();
		if(height > 2) {
			$('#site-header').addClass('scrolled');
		} else {
			$('#site-header').removeClass('scrolled');
		}
	});

	const body = $('body');
	const siteHeader = $('#site-header');
	const headerNav = $('nav#header-nav');
	const menuHamburger = $('#menu-toggle');


	// Return early if the menu-hamburger or mobile-navigation doesn't exist.
	if ( ! menuHamburger || ! siteHeader || ! headerNav ) {
		console.log('cannot find navigation elements');
		return;
	}

	function toggleMobileMenu() {
		if ( ! menuHamburger.hasClass('active')) {

			siteHeader.addClass('menu-active');

			$( '#sticky-contact' ).hide();
			// set hamburger active for animation
			menuHamburger.addClass( 'active' );
			// set menu active
			headerNav.addClass( 'active' );

			// disable body scroll
			body.addClass( 'no-scroll' );
		} else {
			// class for white background opacity
			siteHeader.removeClass('menu-active');

			menuHamburger.removeClass( 'active' );
			headerNav.removeClass( 'active' );

			body.removeClass( 'main-blur' );

			// enable body scroll
			body.removeClass( 'no-scroll' );
		}
	}

	// Toggle the mobileNavigation
	menuHamburger.on( 'click', function() {
		toggleMobileMenu();
	} );


	/*
	 * Submenu Switch
	 */

	// open submenus when hover over menu item, only on desktop viewports
	$('#header-nav > ul.menu > li.menu-item').hover(function(){
		// only for desktop viewport
		if( $(window).width() > 1194 ) {
			switchSubmenu( $(this) );
		}
	});

	// close all submenus when entering main content with mouse
	$('main#site-content').hover(function(){
		switchSubmenu( $(this) );
	});

	// accordeon control element for mobile gets added
	$('#header_menu .menu-item-has-children > a').parent().append('<div class="accordeon-control"></div>')
	// bind accordeon control to function
	$('#header_menu .accordeon-control').on('click', function() {
		switchSubmenu( $(this).parent() );
	});


	// switch submenu active if trigger was an li with submenu
	function switchSubmenu( trigger ) {
		let submenus = $('#header-nav ul.menu > li.menu-item-has-children');

		if( $(window).width() > 1194 ) {
			// desktop viewport automatic switch
			submenus.removeClass('submenu-active');
			submenus.find('ul.sub-menu').removeClass('submenu-active');
			body.removeClass('main-blur');

			if (trigger.hasClass('menu-item-has-children')) {
				trigger.addClass('submenu-active');
				trigger.find('ul.sub-menu').addClass('submenu-active');
				body.addClass('main-blur');
			}

		} else {
			// mobile viewport manual switch
			if (! trigger.hasClass('submenu-active')) {
				trigger.addClass('submenu-active');
				trigger.find('ul.sub-menu').addClass('submenu-active');
			} else {
				trigger.removeClass('submenu-active');
				trigger.find('ul.sub-menu').removeClass('submenu-active');
			}
		}
	}



})(jQuery);
