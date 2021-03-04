jQuery( document ).ready( function( $ ) {
  
  try {
    $('.svg-convert').svgConvert();
  } catch {}

  $('.navbar-default .row > div').matchHeight();
  
  $('.match-height, .match-height-home-header, .match-height-page-bg, .match-height-showcase, .match-height-roles, .match-height-bio-block, .match-height-benefits-blocks, .match-height-career-block, .match-height-block-content, .mh-outer2, .sub-product-section .sub-product-wrap, .pricing-block').matchHeight();

    $.fn.matchHeight._afterUpdate = function(event, groups) {
      $('.article-summary-wrap').matchHeight();
      // $('.mh-inner').height($('.mh-outer').height());
    }

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
      $('.match-height-home-cta, .research-pub-top').matchHeight();
      $('#TopTwoPublications .pub-outer').matchHeight();
      $('.article-summary-content-wrap').matchHeight();
    }
    if (w > 992) {
      $.fn.matchHeight._afterUpdate = function(event, groups) {
        // $('.article-summary-wrap').matchHeight();
        $('.mh-inner').height($('.mh-outer').height());
      }     
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

    $(window).resize();

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


window.addEventListener('load', function(){
  window.cookieconsent.initialise({
   revokeBtn: "<div class='cc-revoke'></div>",
   type: "opt-in",
   theme: "classic",
   palette: {
       popup: {
           background: "#5159ff",
           text: "#fff"
        },
       button: {
           background: "#000",
           text: "#fff"
        }
    },
   content: {
       message: "<h2>Cookies!</h2>Yep, it’s another exciting cookie notice. We use cookies on this website to do some cool stuff such as the choose tech or exec button. Nothing sinister! You can read our privacy policies and terms of use etc by ",
       link: "clicking here.",
       allow: "I Accept",
       deny: "No Thanks",
       href: "https://www.seldon.io/terms-and-policies/"
    },
    onInitialise: function(status) {
      if(status == cookieconsent.status.allow) myScripts();
    },
    onStatusChange: function(status) {
      if (this.hasConsented()) myScripts();
    }
  })
});

function myScripts() {

   // Paste here your scripts that use cookies requiring consent. See examples below

  // Google Tag Manager
  (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-MKZC66');

   // // Google Analytics, you need to change 'UA-00000000-1' to your ID
   //    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
   //        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
   //        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
   //    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
   //    ga('create', 'UA-00000000-1', 'auto');
   //    ga('send', 'pageview');


   // // Facebook Pixel Code, you need to change '000000000000000' to your PixelID
   //    !function(f,b,e,v,n,t,s)
   //    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
   //        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
   //        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
   //        n.queue=[];t=b.createElement(e);t.async=!0;
   //        t.src=v;s=b.getElementsByTagName(e)[0];
   //        s.parentNode.insertBefore(t,s)}(window, document,'script',
   //        'https://connect.facebook.net/en_US/fbevents.js');
   //    fbq('init', '000000000000000');
   //    fbq('track', 'PageView');

}


