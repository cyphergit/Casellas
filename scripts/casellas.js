$(function() {
    
    var bannerAnimation = function () {
        var quoteImg = $("img.quote-img");
        quoteImg.hover(
                function () { $(this).stop().animate({"opacity": "0"}, "slow");},
                function () { $(this).stop().animate({"opacity": "1"}, "slow");});
    };    
    
    var navbarTransform = function(windowHeight) {
        if ($(window).scrollTop() > windowHeight) {
            $('.logo-casellas').attr("src", "images/casellas-logo-transparent.png");                        
        } else {
            $('.logo-casellas').attr("src", "images/casellas-logo.png");            
        }
    };
    
    var navbarScale = function(windowHeight) {        
        if ($(this).scrollTop() > 130) {            
            $('.cypher-nav-wrapper').addClass('cypher-nav-scale').removeClass('cypher-nav-bg');
            $('.navbar .nav').addClass('cypher-navbar-pos');
        } else {
            $('.cypher-nav-wrapper').addClass('cypher-nav-bg').removeClass('cypher-nav-scale');
        }
    };
    
    var socialFloater = function() {
        if ($(this).scrollTop() > 80) {
            $('.socialFloater').fadeIn();
        } else {
            $('.socialFloater').fadeOut();
        }
    };
    
    var loadAccordion = function() { $('#content-reviews').accordion({ heightStyle: "content" }); };
    
    var loadDatePicker = function() { $('#txtVipBirthDate, #txtRDate').datepicker({ inline: true }); };
    
    var loadFancybox = function () {
        $("#enquiry, .social-enquiry").fancybox({
            'padding': 0,
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'showCloseButton': false,
            'centerOnScroll': true
        });

        $("#logo-link-enquiry").fancybox({
            'padding': 0,
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'showCloseButton': false,
            'centerOnScroll': true
        });
    };
    
    $(window).scroll(function () {
        var scrollValue = 10;
        if ($(this).scrollTop() > scrollValue) {            
            navbarTransform(scrollValue);            
            socialFloater();
            $('.cypher-nav-wrapper').addClass('cypher-nav-bg').removeClass('cypher-nav-nobg');
        } else {
            navbarTransform(scrollValue);
            socialFloater();
            $('.cypher-nav-wrapper').addClass('cypher-nav-nobg').removeClass('cypher-nav-bg');            
        }
    });
    
    //PAGE LOAD NOTIFICATION
    $(window).load(function () {
        $('.pageLoader').fadeOut("slow");
        
        var url = window.location.href;
        var searchResult = url.search("home");        
        var website = "http://www.casellas.com.au/";
        
        if (url == website || searchResult != -1) {
            $.fancybox("#notification-container", {
                'padding': 0,
                'autoScale': false,
                'showCloseButton': false,
                'centerOnScroll': true
            });
        }
    });
    //END PAGE LOAD NOTIFICATION
    
    var loadAll = function () {
        bannerAnimation();
        loadAccordion();
        loadDatePicker();
        loadFancybox();
    };
    
    loadAll();
});
