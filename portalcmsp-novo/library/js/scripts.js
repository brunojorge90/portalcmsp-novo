/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/



/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: https://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y }
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: https://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  // news on the header 
  $('.headlines-nav a').on('click', function(e) {
    viewport = updateViewportDimensions();
    if (viewport.width >= 768) {

      var active = $('.container-headlines .active');
      var next = active.next('article');
      if (next.length == 0) next = $('.container-headlines article').first();
      var prev = active.prev('article');
      if (prev.length == 0) prev = $('.container-headlines article').last();

      active.removeClass('active');
      if ($(this).hasClass('headlines-next')) next.addClass('active');
      if ($(this).hasClass('headlines-prev')) prev.addClass('active');

      e.preventDefault();
    }
  });
  // roll news every 10 seconds
  window.setInterval(function(){$('.headlines-nav .headlines-next').click();}, 10000);

  // "Transparência" menu
  $('.link-transparencia').on('click',function(e) {

    $(this).siblings('nav').find('.transparencia-menu').toggleClass('show');
    //2020-01-28: pediram para colocar link no título do menu apontando para a seção "/transparencia"
	//Porém, em mobile, o click leva ao link ao invés de apenas expandir o menu!
	//e.preventDefault();
  });

  // activate sliders
  $(".cmsp-rslides").responsiveSlides({
    speed: 500,            // Integer: Speed of the transition, in milliseconds
    timeout: 10000,          // Integer: Time between slide transitions, in milliseconds
    pager: true,             // Boolean: Show pager, true or false
    pause: true,           // Boolean: Pause on hover, true or false
    pauseControls: true,    // Boolean: Pause when hovering controls, true or false
    navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
    namespace: "cmsp-rslides",   // String: Change the default namespace used
  });

  // add markup for some form styling
  // select
  $('select:not(.select)').each(function() {
    var select = $(this);
    var wrapper = $('<div />').attr('class','form-select-wrapper');
    if(select.hasClass('mobile-only')) wrapper.addClass('mobile-only');

    $(this).wrap(wrapper);

    $('<a />')
      .text('select')
      .attr('class','open-select')
      .attr('href', '#')
      .on('click', function(e) {
        select.show().focus().click();
        e.preventDefault();
      })
      .insertAfter(select);
  });

  // checkbox/radio
  $('.input-checkbox').each(function () {
    var checkbox = $(this);
    var group = $('input[name="'+ $(this).attr('name') +'"]');
    checkbox.wrap('<div class="input-checkbox-wrapper" />');

    if(checkbox.is(':checked')) {
        checkbox.closest('.input-checkbox-wrapper').addClass('active');
    }

    function checkCheckboxes() {
      group.each(function() {
        if($(this).is(':checked')) {
          $(this).closest('.input-checkbox-wrapper').addClass('active');
        }
        else {
          $(this).closest('.input-checkbox-wrapper').removeClass('active');
        }
      });
    }

    checkbox.closest('.input-checkbox-wrapper').on('click',function() {
      checkbox.prop('checked',true);
      checkCheckboxes();
    });

    group.on('change',function () {
      checkCheckboxes();
    });
  });

  // custom lightboxes

  $.fn.cmspLightbox = function (options) {

    // set defaults
    // a = typeof a !== 'undefined' ? a : 42;

    $(this).on('click',function(e) {

      clicked = $(this);
      e.preventDefault();

      // create the container markup if it isnt there
      if($('.cmsp-lightbox-container').length == 0) {

        $('<div />')
          .attr('class','cmsp-lightbox-container')
          .appendTo($('body'));

        container = $('.cmsp-lightbox-container');

        $('<div />')
          .attr('class','cmsp-lightbox-background')
          .appendTo(container);

        $('<div />')
          .attr('class','cmsp-lightbox-wrap')
          .appendTo(container);

        $('<header />')
          .attr('class','cmsp-lightbox-header')
          .appendTo(container.find('.cmsp-lightbox-wrap'));

        $('<section />')
          .attr('class','cmsp-lightbox-content')
          .appendTo(container.find('.cmsp-lightbox-wrap'));

        $('<footer />')
          .attr('class','cmsp-lightbox-footer')
          .appendTo(container.find('.cmsp-lightbox-wrap'));

        $('<div />')
          .attr('class','cmsp-lightbox-control')
          .appendTo(container.find('.cmsp-lightbox-wrap'));

          $('<a />')
            .attr('href','#')
            .text('fechar')
            .attr('class', 'cmsp-lightbox-close')
            .appendTo(container.find('.cmsp-lightbox-control'));

      } // end if

      // save container to add content
      var container = $('.cmsp-lightbox-container');

      // add content - title

      if(clicked.data('title') !== undefined) {
        container.find('.cmsp-lightbox-header')
          .html('<h1>'+ clicked.attr('data-title') +'</h1>');
      }

      // add content - footer
      if(clicked.data('description') !== undefined) {
        container.find('.cmsp-lightbox-footer')
          .html('<p>'+ clicked.attr('data-description') +'</p>')
      }

      // add content - content

      // if its a youtube link
      if(clicked.hasClass('cmsp-lightbox-youtube')) {

        // add video class
        container.addClass('video-lightbox')

        // extract youtube id
        var url = clicked.attr('href');
        var hashes = url.slice(url.indexOf('?') + 1).split('&');
        var getvars = {};
        for(i in hashes) {
          hash = hashes[i].split('=');
          getvars[hash[0]] = hash[1];
        }
        var youtubeID = getvars['v'];

        container.find('.cmsp-lightbox-content')
          .html('<div class="video-container"><iframe src="https://youtube.com/v/' + youtubeID + '?autoplay=true"></div>');
      }
      // if its an external iframe
      if(clicked.hasClass('cmsp-lightbox-iframe')) {
        var url = clicked.attr('href');
        container.find('.cmsp-lightbox-content')
          .html('<div class="iframe-container"><iframe src="'+ url +'"></div>');
      }
      // if its anything else (assume its an image)
      else {
        container.find('.cmsp-lightbox-content')
          .html('<img src="'+ clicked.attr('href') +'">');
      }

      // add events

      // after everything is placed, show the lightbox
      function showLightbox() {
        container.find('.cmsp-lightbox-wrap').fadeIn(300);
      }
      container.fadeIn(300);
      
      if(clicked.hasClass('cmsp-lightbox-youtube') || clicked.hasClass('cmsp-lightbox-iframe')) {
        showLightbox();
      }
      else {
        container.find('.cmsp-lightbox-content').imagesLoaded().done(showLightbox).fail(function(){alert('erro ao carregar imagem')});
      }

      // close events
      function closeLightbox() {
        container.fadeOut(300,function() {
          container.find('.cmsp-lightbox-wrap').hide();
        });
      }

      container.find('.cmsp-lightbox-close, .cmsp-lightbox-background').unbind('click');
      container.find('.cmsp-lightbox-close, .cmsp-lightbox-background').on('click', function(e) {
        e.preventDefault();
        closeLightbox();
      });

    }); // end onclick

  }

  $('.cmsp-lightbox').cmspLightbox();


  // boxes scripts

  /* Consulta Rápida */
  showQuickSearchTab = function (tab, container) {
    container.find('.active').removeClass('active');
    container.find('.'+tab).addClass('active');
  }

  $('.box-quick-search-nav a').on('click', function (e) {
    showQuickSearchTab($(this).closest('li').attr('class'), $(this).closest('.box-quick-search-container'));
    e.preventDefault();
  });

  $('.box-quick-search-nav .nav-mobile').on('change', function () {
    showQuickSearchTab($(this).val(), $(this).closest('.box-quick-search-container'));
  });

  /* Galeria Multimídia */
  $('.box-gallery-nav a').on('click', function (e) {
    var active = $(this).closest('.box-gallery').find('.box-gallery-item.active');
    var next = active.next('.box-gallery-item');
    if (next.length == 0) next = $(this).closest('.box-gallery').find('.box-gallery-item:first-of-type');
    var prev = active.prev('.box-gallery-item');
    if (prev.length == 0) prev = $(this).closest('.box-gallery').find('.box-gallery-item:last-of-type');

    active.removeClass('active');
    if ($(this).hasClass('next')) next.addClass('active');
    if ($(this).hasClass('prev')) prev.addClass('active');

    e.preventDefault();
  });

  window.setInterval(function() {
    $('.box-gallery-nav .next').click();
  }, 5000);

  /* Rede social - posts */
  $('.box-network-posts-nav a').on('click', function (e) {
    var container = $(this).closest('.box-network-posts');
    var containerWidth = container.width();

    var active = container.find('.box-network-post.active');

    var next = active.next('.box-network-post');
    if (next.length == 0) next = container.find('.box-network-post:first-of-type');
    var prev = active.prev('.box-network-post');
    if (prev.length == 0) prev = container.find('.box-network-post:last-of-type');

    active.removeClass('active').show();

    var display = next;
    if ($(this).hasClass('prev')) display = prev;
    
    display.addClass('active').show();
    if($(this).hasClass('prev')) display.css('left', containerWidth * -1);
    if($(this).hasClass('next')) display.css('left', containerWidth * 1);
    display.animate({left: 0}, 500);
    if($(this).hasClass('prev')) active.animate({left: containerWidth * 1}, 500, function() { active.hide(); });
    if($(this).hasClass('next')) active.animate({left: containerWidth * -1}, 500, function() { active.hide(); });

    e.preventDefault();
  });

  /* Banners - row */
  $('.banners-row').each(function () {
    var wrapper = $(this).find('ul');
    if(wrapper.find('li').length > 4) {
      var mask = $('<div />').attr('class','banners-row-wrap').css('overflow','hidden');
      wrapper.appendTo(mask);
      mask.appendTo($(this));
      
      viewport = updateViewportDimensions();
      if (updateViewportDimensions().width >= 768) {
        var elem_width = wrapper.find('li').width() + parseInt(wrapper.find('li').css('margin-right'));
        wrapper.width(elem_width * wrapper.find('li').length);
      }
      else {
        wrapper.attr('style','');
      }

      // function for cycling
      banners_cycle = function(type) {

        if (updateViewportDimensions().width >= 768) {
          // renew (in case screen width changed)
          elem_width = wrapper.find('li').width() + parseInt(wrapper.find('li').css('margin-right'));
          wrapper.width(elem_width * wrapper.find('li').length);

          if(type == 'next') {
            wrapper.animate({marginLeft: elem_width * -1}, 800, function () {
              wrapper.find('li:first-of-type').appendTo(wrapper);
              wrapper.css('margin-left','0');
            });
          }
          else {
            wrapper.find('li:last-of-type').prependTo(wrapper);
            wrapper.css('margin-left',elem_width * -1);
            wrapper.animate({marginLeft: 0}, 800);
          }
        }
        else {
          wrapper.attr('style','');
        }

      }

      // automatically cycle
      var banners_cycle_interval = window.setInterval(function() {
          banners_cycle('next');
      }, 5000);

      // add buttons
      $('<a />')
        .text('Prev')
        .attr('class','banners-row-prev')
        .attr('href','#')
        .on('click',function (e) {
          e.preventDefault();
          banners_cycle('prev');
        })
        .appendTo($(this));

      $('<a />')
        .text('Next')
        .attr('class','banners-row-next')
        .attr('href','#')
        .on('click',function (e) {
          e.preventDefault();
          banners_cycle('next');
        })
        .appendTo($(this));;

      // pause/restart the cycle on hover

      $(this).on('mouseover',function() {
        window.clearInterval(banners_cycle_interval);
      });
      $(this).on('mouseout', function() {
        banners_cycle_interval = window.setInterval(function() {
            banners_cycle('next');
        }, 5000);
      })
    }
  });

  /*
   * show/hide style content
   */

  $('.showhide .showhide-title a').on('click', function(e) {
    e.preventDefault();

    container = $(this).closest('.showhide');
    content = container.find('.showhide-content');

    if(content.is(':hidden')) {
      content.slideDown(400);
      container.addClass('show');
    }
    else {
      content.slideUp(400);
      container.removeClass('show');
    }

  });

  /*
   * vertically align our box heights
   */

  $('.cmsp-row').each(function() {
    var tallest = 0;

    // loop once to find the tallest box height
    $(this).find('.content-box').each(function() {
      if($(this).height() > tallest) tallest = $(this).outerHeight(false);
    });

    // loop again to set the new heights
    $(this).find('.content-box').each(function() {
      var padding = $(this).find('.box-height-adjust').outerHeight(false) - $(this).find('.box-height-adjust').height();
      var content_height = tallest - $(this).find('.content-box-top').outerHeight(true) - $(this).children('footer').outerHeight(true) - padding;

      $(this).find('.box-height-adjust').height(content_height);
    });

  });

  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
  */
  loadGravatars();

  var fixCurrentMenuVereadores = function() {
    var pathArray = window.location.pathname.split( '/' );
    var menuLinksVereadores = ['vereador', 'vereadores'];
    var menuLinksParticipe = ['rede-social', 'banco-de-ideias', 'abaixo-assinado-virtual', 'participe'];
    
    if(in_array(pathArray[1], menuLinksVereadores) ) {
      $("#menu-menu-top-1 li:first").addClass('current-menu-item');
      return;
    }

    if(in_array(pathArray[1], menuLinksParticipe) ) {
      $("#menu-menu-top-1 li:eq(2)").addClass('current-menu-item');
      return;
    }
    $("#menu-menu-top-1 li:eq(1)").addClass('current-menu-item');

  }();
}); /* end of as page load scripts */