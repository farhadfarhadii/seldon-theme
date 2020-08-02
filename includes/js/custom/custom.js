jQuery( document ).ready( function( $ ) {
  
  $('.svg-convert').svgConvert();

  $('.navbar-default .row > div').matchHeight();
  
  $('.match-height, .match-height-home-header, .match-height-page-bg, .match-height-showcase, .match-height-roles, .match-height-bio-block, .match-height-benefits-blocks, .match-height-career-block, .match-height-block-content').matchHeight();

    $('.aside blockquote').each(function () {
      var thisP = $(this).find('p');
      var text = thisP.text();
      text += '<span class="close-quote"></span>'
      $(thisP).html(text);
    });


  $('.slick-slideshow').slick({
    dots: true,
  });

  if ($('body').hasClass('page-home')) { 
    setCookie('audience', 'tech');  
  }

  $('.audience-toggle').click(function () {
    var audience = $(this).data('audience');
    // EJY check if home page by current path with localhost caveat
    toggleAudienceContent(audience);
  });

  var audience = getCookie('audience');
  if (!audience) {
    setCookie('audience', 'tech');
    audience = 'tech';
    setAudience(audience);
    // $('button[data-audience="tech"]').click();
  } else {
    setAudience(audience);
    // $('button[data-audience="' + audience + '"]').click();
  }

  var currentPath = window.location.pathname;

  // set page content, styles, etc based on cookie
  function toggleAudienceContent(audience) {
    var url = window.location.href;
    var currentAudience = audience === 'tech' ? 'exec' : 'tech';

    if ($('body').hasClass('page-home')) {
      url = url + '/' + audience;
    } else {
      url = url.replace(currentAudience, audience);
    }

    setCookie('audience', audience);
    location.href = url;
  }

  // create a "clickable" class which makes entire container clickable
	$(".clickable").click(function() {
  		window.location = $(this).find("a").attr("href"); 
  		return false;
	});

  function setAudience(audience) {
    $('body').removeClass('tech exec').addClass(audience);
    $('#toggle-' + audience).addClass('active'); 
    setMenuUrls(audience);
  }

  // set main nav urls to tech or exec
  function setMenuUrls(audience) {
    var currentPageUrl = window.location.href;

    $('#main-menu a').each(function () {
      var url = this.href;
      var replace = audience === 'tech' ? '/exec/' : '/tech/'
      url = url.replace(replace, '/' + audience + '/');
      $(this).attr('href', url);
      if (url === currentPageUrl) {
        $(this).parent().addClass('active');
      }
    });
    var homeUrl = $('a.navbar-brand').attr('href') + '/' + audience;
    $('a.navbar-brand').attr('href', homeUrl);
  }

  window.onresize = checkWidth;
  window.onload = checkWidth;

  function checkWidth() {
    var w = window.innerWidth;
    if (w > 768) {
      $('.match-height-home-cta').matchHeight();
    }
  }

  var cookieConsent = getCookie('acceptCookies');
  if (!cookieConsent) {
    $('#CookiesNotice').removeClass('hide');
  }

  $('#main-menu .request-demo-button a')
    .removeAttr('href')
    .attr({
      'data-toggle':'modal',
      'data-target':'#modalDemoRequest',
      'role':'button'
    });


}); // end doc ready

  jQuery('#modalDemoRequest').on('shown.bs.modal', function () {
    jQuery('#modalDemoRequest').find('input').first().focus();
  });


function consentToCookies() {
  setCookie('acceptCookies', true);
  jQuery('#CookiesNotice').addClass('hide');
}

function setCookie(cname, cvalue) {
  var d = new Date();
  d.setTime(d.getTime() + (90*24*60*60*1000)); // 90 days
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}  


