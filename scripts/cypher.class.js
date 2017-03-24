var cypherClass = function () {

    this.navFullWidth = function() {            
            //Retain background of navigation
            //whenever the page refresh/reload
            if ($(document).scrollTop() > 50) {
                //alert("test");
                //$('.scrollToTop').fadeIn();
                $('.cypher-nav-wrapper').addClass('cypher-nav-bg').removeClass('cypher-nav-nobg');
                //$('.nav-links-wrapper').addClass('navbar-nav-noborder').removeClass('navbar-nav-border');

            } else {
                //$('.scrollToTop').fadeOut();
                $('.cypher-nav-wrapper').addClass('cypher-nav-nobg').removeClass('cypher-nav-bg');
                //$('.nav-links-wrapper').addClass('navbar-nav-border').removeClass('navbar-nav-noborder');
            }
    };

    this.init_navigation = function() {
        this.navFullWidth();
    };

    this.loadAll = function () {
        this.init_navigation();
    };
};